<?php
include(drupal_get_path('module', 'weixin') .'/includes/weixin.qrcode.inc');


function weixin_user_binding($form, $form_state, $user) {
	global $base_url;
	$form=array();
	$form['#user']=$user;
	$form['#attached']['css']=array(
		'div#edit-weixinuser { height: 100px; vertical-align: middle; padding-left: 20px;}'.
		'div#edit-weixinuser > img { width: 100px; height: 100px; vertical-align: middle;}'.
		'div#edit-weixinuser > span { padding-left: 20px; height: 50px;}'.
		'div#weixin_qrcode { display: inline-block; margin-left: 40px; width: 380px; margin-bottom: 20px;}'.
		'div#weixin_qrcode > img#weixin_qrcode { width: 300px; height: 300px;}'.
		'div#weixin_qrcode > img#weixin_qrcode_phone_scan { display: none; padding-bottom: 20px; margin-left: -100px; top: 30px; position: relative; height: 205px;}'.
		'' => array('type'=>'inline')
	);
	$r=db_query('SELECT EXISTS (SELECT * FROM {weixin_user_map} WHERE uid=:uid AND status=1)', array(':uid'=>$user->uid))->fetchField();
	if($r) {
		$query = db_select('weixin_user','weixin_user');
		$query->join('weixin_user_map','user_map', 'user_map.wx_openid = weixin_user.openid');
		$query->condition('uid',$user->uid);
		$query->fields('weixin_user',array('nickname','headimgurl'));
		$result = $query->execute()->fetchAssoc();
		if(isset($result)) {
			// invoke the points to user
			if (module_exists('weixin_rules')) {
				//dpm('weixin_bind_rules');
				if (variable_get('points_flag'.$user->uid) == 1) {
					rules_invoke_event('weixin_bind_event', $user);
					variable_set('points_flag'.$user->uid, 0);
				}
			}
			$weixin_user_pic_path = $base_url.'/'.drupal_get_path('module', 'weixin').'/includes/timthumb.php?src='.$result['headimgurl']; 
			$form['description']=array(
                                '#type' => 'item',
                                '#markup' => t('You are now bound with following weixin account.'),
                        );
			$form['weixinuser']=array(
                                '#type' => 'item',
                                '#markup' => '<a href="'.$result['headimgurl'].'" rel="lightbox"><img src='.$weixin_user_pic_path.'width="12" /></a>'.'<span>'.$result['nickname'].'</span>',
//                                  '#markup' => '<span>'.$result['nickname'].'</span>',
                        );
		}
//		dpm($result);
                $form['submit'] = array(
                        '#type' => 'submit',
                        '#value' => t('Unbound'),
                        '#submit' => array('weixin_user_binding_unbound'),
                );
	} else {
		// not found the bingding user;
		$form['#attached']['js']=array('function worker() {'.
			'jQuery.get("'.$GLOBALS['base_path'].'user/'.$user->uid.'/weixin_qrcode_callback", function(data) {'.
					"if(data=='0') {setTimeout(worker, 4000);}".
					'else {location.reload(true);}'.
					'});'.
				'} '.
				'jQuery(document).ready(function() {setTimeout(worker, 4000);});' => array('type'=>'inline'));

		$form['description']=array(
			'#type' => 'markup',
			'#markup' => '<p>'.t('You haven\'t bound your account with weixin id.').t('If you want to bind your account, please do as following.').'</p>',
		);
		$weixin_robot_access_token = weixin_robot_get_access_token();
		$expire_time = 5*60;
		$type = 'QR_SCENE';
		$scene_name = mt_rand(1,pow(2, 27));
//		dpm($scene_name);
		$scene_id = $scene_name;
		$qr_data = weixin_create_qrcode($scene_id, $scene_name, $type, $expire_time);
		$imgurl=sprintf('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s',urlencode($qr_data['ticket']));
//		dpm($qr_data);
		$form['#attached']['js']+=array(
			'jQuery(document).ready(function() {'.
				'jQuery("div#weixin_qrcode").mouseenter(function() {jQuery("img#weixin_qrcode_phone_scan").fadeIn();});'.
				'jQuery("div#weixin_qrcode").mouseleave(function() {jQuery("img#weixin_qrcode_phone_scan").fadeOut();});'.
			'});' => array('type' => 'inline')
		);
		$form['scan']=array(
			'#type' => 'item',
			'#markup' => t('Scan following qrcode to bind your account with !weixinid.', array('!weixinid'=>'<code>'.variable_get('weixin_token').'</code>'))
		);
		
		$form['qrcode']=array(
			'#type' => 'markup',
			'#prefix' => '<div id="weixin_qrcode">',
			'#markup' => sprintf('<img id="weixin_qrcode" src="%s"/>', $imgurl).
				sprintf('<img id="weixin_qrcode_phone_scan" '.
					'src="%s/qrcode_scan_phone.png">', $GLOBALS['base_path'].drupal_get_path('module', 'weixin')),
			'#suffix' => '</div>',
		);
		db_merge('weixin_validation')->key(array('uid'=>$user->uid))->fields(array(
			'uid' => $user->uid,
			'seed' => $scene_id,
			'validation_code' => $scene_id,
			'expiration_time' => time()+5*60,
		))->execute();
//		qr_code_binding($scene_id);
	}
	return $form;
}

function weixin_user_binding_unbound($form, $form_state) {
        db_delete('weixin_user_map')->condition('uid',$form['#user']->uid)->execute();
        watchdog('weixin',
                '@user detached his weixin account.',
                array('@user'=>$form['#user']->name),
                WATCHDOG_INFO
	);
//	dpm('points_flag'.$form['#user']->uid);
        drupal_set_message(t('Weixin acccount detached.'));
}


function weixin_qrcode_callback($user) {
	$r=db_query('SELECT EXISTS(SELECT * FROM {weixin_user_map} WHERE uid=:uid AND status=1)',
		array(':uid'=>$user->uid))->fetchField();
	if(empty($r)) {
		$r=db_query('SELECT EXISTS(SELECT * FROM {weixin_validation} WHERE expiration_time<:time AND uid=:uid)',
			array(':time'=>time(), ':uid'=>$user->uid))->fetchField();
		variable_set('points_flag'.$user->uid, 1); 
	}
	drupal_json_output($r);
}

function weixin_user_access($user) {
//	dpm($user);
	if($user->uid==$GLOBALS['user']->uid) return user_access('allow weixin binding');
	else return user_access('allow weixin binding', $user) && user_access('administer users');
}

function qr_code_binding($eventkey, $open_user_id, $event_type) {
	if(!empty($eventkey)) {
//		dpm($eventkey);
		file_put_contents('/tmp/event_key.log',var_export($eventkey,true));
		file_put_contents('/tmp/event_time.log',var_export(time(),true));
		if($event_type == "subscribe") {
			$scene_id = substr($eventkey, 8);
		} else {
			$scene_id = $eventkey;
		}
//		$scene_id=substr($eventkey,0,8);
//		dpm($scene_id);
		if($uid=db_query('SELECT uid FROM {weixin_validation} WHERE expiration_time>=:time AND seed=:seed',
		    array(':time'=>time(), ':seed'=>$scene_id))->fetchField()) {
			db_merge('weixin_user_map')->key(array('uid'=>$uid))->fields(array(
		    	'uid' => $uid,
		    	'wx_openid' => $open_user_id,
		    	'status' => 1
		    	))->execute();
			db_delete('weixin_validation')->condition('uid',$uid)->execute();
			$user=user_load($uid);
			$binding_messge=t('You have now bind with !username.', array('!username'=>format_username($user)));
			return $binding_messge;
		}
	}
}
