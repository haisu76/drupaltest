<?php

function weixin_rules_rules_event_info() {
	$event = array(
	'weixin_bind_event' => array(
		'label'  => t('Bind wechat id'),
		'group' => t('weixin event'),
		'variables' => array(
			'wechat_user' => array(
			'type' => 'user',
			'label' => t('wechat user'),
			),
		),
	),
	);
	return $event;
}

/*
function weixin_bind_event($user) {
	dpm($user);
}
 */

function weixin_rules_rules_action_info() {
  $fields['subject']['description'] = t('Subject of the message. To use the tokens provided by Privatemsg, use {token}, for example: {privatemsg_message:recipient:name}.');
  $actions = array(
    'weixin_user' => array(
      'label' => t('Send weixin to a user'),
      'parameter' => array(
        'recipient' => array(
		'type' => 'user',
		'label' => t('Recipient user'),
          	'description' => t('The user will be reveive wexin message'),
	),
        'template_id' => array(
		'type' => 'text',
		'label' => t('template_id'),
          	'description' => t('The weixin notify template ID'),
	),
        'template_type' => array(
		'type' => 'text',
		'label' => t('template list'),
          	'options list' => 'get_weixin_template_type',
	),
        'user_points' => array(
		'type' => 'text',
		'label' => t('user_points'),
		'description' => t('The user get points'),
          	'optional' => TRUE,
	),
	'user_points_description' => array(
		'type' => 'text',
		'label' => t('user points description'),
          	'description' => t('The user get points description'),
          	'optional' => TRUE,
	),
	'pm_message_author' => array(
		'type' => 'user',
		'label' => t('private message sender'),
          	'description' => t('The private message sender'),
          	'optional' => TRUE,
	),
	'pm_message_subject' => array(
		'type' => 'text',
		'label' => t('private message subject'),
          	'description' => t('The private message subject'),
          	'optional' => TRUE,
	),
	'pm_message_body' => array(
		'type' => 'text',
		'label' => t('private message body'),
          	'description' => t('The private message body'),
          	'optional' => TRUE,
	),
	'pm_message_url' => array(
		'type' => 'text',
		'label' => t('private message url'),
          	'description' => t('The private message url'),
          	'optional' => TRUE,
	),
      ),
      'group' => t('Weixin'),
       /*
      'base' => 'rules_action_mail_user',
      'callbacks' => array(
        'validate' => 'rules_action_custom_validation',
        'help' => 'rules_mail_help',
      ),
      */
    ),
  );
  return $actions;
}

function get_weixin_template_type() {
  return array(
    'login' => t('login template'),
    'bind' => t('wechat binding template'),
    'user_points' => t('user points template'),
    'private_message' => t('private message'),
  );
}

function weixin_rules_replace_tokens($text) {
  return preg_replace('/{([a-z0-9_:]+)}/', '[$1]', $text);
}


function weixin_user($user, $template_id, $template_type, $user_points, $user_points_description, $pm_author, $pm_subject, $pm_body, $pm_url, $color='#FF0000') {
	dpm($template_type);
	$template=array();
	/*
	$query = db_select('weixin_user_map','user_map');
	$query->condition('uid',$user->uid);
	$query->fields('user_map',array('wx_openid'));
	 */
	$query = db_select('weixin_user','weixin_user');
	$query->join('weixin_user_map','user_map', 'user_map.wx_openid = weixin_user.openid');
	$query->condition('uid',$user->uid);
	$query->fields('weixin_user',array('nickname','headimgurl','openid'));
	$result = $query->execute()->fetchAssoc();
	if(!empty($result)) {
		$user_id = $user->uid;
		$template['touser'] = $result['openid'];
		$template['template_id'] = $template_id;
//		$template['url'] = 'http://weixin.qq.com/download';
		$template['topcolor'] = sprintf("#%s",variable_get('template_color','FFFFFF'));
		if($template_type == "login") {
			$login_data['first']['value'] = t('!username login',array('!username'=>$user->name));
			$login_data['time']['value'] = format_date(time(),'short');
//			$login_data['keyword2']['value'] = 'IOS';
			$login_data['ip']['value'] = ip_address();
			$login_data['reason']['value'] = 'Please warning if not your login';
			$template['data'] = $login_data;
			if(! _weixin_notify_is_enabled($user->uid, 'wechat_login_notify_is_enabled'))
				return;
		} elseif($template_type == "bind") {
			$bind_data['first']['value'] = t('!username binding successfully',array('!username'=>$user->name));
			$bind_data['keyword1']['value'] = $result['nickname'];
			$bind_data['keyword2']['value'] = $user->name;
			$bind_data['keyword3']['value'] = t('Support user points notify, task notify, login notify');
			$bind_data['remark']['value'] = 'Please warning if not your login';
			$template['data'] = $bind_data;
		} elseif($template_type == "user_points") {
			$points_data['account']['value'] = $user->name;
			$points_data['time']['value'] = format_date(time(),'short');
			$points_data['type']['value'] = $user_points_description;
			$points_data['creditChange']['value'] = t('Award');
			$points_data['number']['value'] = $user_points;
			$points_data['creditName']['value'] = t('Total');
			$points_data['amount']['value'] = userpoints_get_current_points($user->uid,'all');
			$template['data'] = $points_data;
			if(! _weixin_notify_is_enabled($user->uid, 'wechat_user_points_notify_is_enabled'))
				return;
		} elseif($template_type == "private_message") {
			$pm_data['first']['value'] = t('You got a private message');
			$pm_data['sender']['value'] = $pm_author->name;
			$pm_data['subject']['value'] = $pm_subject;
			$pm_data['remark']['value'] = drupal_substr(strip_tags($pm_body),0,150);
			$template['data'] = $pm_data;
			$template['url'] = $pm_url;
		}
	//	dpm($template);
	//	dpm(json_encode($template));	
		weixin_template_message($template);
		rules_log('Pepole view the user !name', array('!name' => $user->name));
	}
}
