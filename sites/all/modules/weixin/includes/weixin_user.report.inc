<?php


function weixin_user_list_header() {
  return array(
    array('data' => t('nickname')),
    array('data' => t('photo')),
    array('data' => t('sex')),
    array('data' => t('location')),
    array('data' => t('subscribe_time')),
  );
}

function weixin_robot_get_remote_user_list(){
	$weixin_user_list = array();
        $weixin_robot_access_token = weixin_robot_get_access_token();
	$weixin_cache_user_list = cache_get('weixin_user_list');
	if ($weixin_cache_user_list == FALSE) {
        	$url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$weixin_robot_access_token;
		$request_val = drupal_http_request($url);
		if ($request_val->code != 200) {
			drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
    			return FALSE;
		}
		$weixin_user_list_obj = json_decode($request_val->data,true);
		$i=0;
		foreach ($weixin_user_list_obj['data']['openid'] as $weixin_user_openid) {
			$weixin_user_list[$i] = weixin_robot_get_user_info($weixin_user_openid);
			$i++;
		}
		cache_set('weixin_user_list',$weixin_user_list,'cache',3600);
		return $weixin_user_list;
	} else {
//		dpm($weixin_cache_user_list);
		return $weixin_cache_user_list->data;
	}
}

function weixin_get_user_table_rows() {
	global $base_url;
	$rows = array();
	$cell = array();
	$user_list = weixin_robot_get_remote_user_list();
//	dpm($user_list);
	foreach($user_list as $user) {
		$user_image = array (
			'style_name' => 'thumbnail',
			'path' => $user['headimgurl'],
		);
		$cell[] = $user['nickname'];
		$weixin_user_pic_path = $base_url.'/'.drupal_get_path('module', 'weixin').'/includes/timthumb.php?src='.$user['headimgurl'];
//	 	dpm($weixin_user_pic_path);	
		$cell[] = '<a href="'.$user['headimgurl'].'" rel="lightbox"><img src='.$weixin_user_pic_path.'width="32" /></a>';
		if ($user['sex'] == 1) {
			$cell[] = t('man');
		} else {
			$cell[] = t('woman');
		}
		$cell[] = $user['country'].'-'.$user['province'].'-'.$user['city'];
		$cell[] = format_date($user['subscribe_time'],'short');
		$rows[] = $cell;
		unset($cell);
	}
//	dpm($rows);
	return $rows;
}


function weixin_robot_get_user_info($weixin_openid) {
	$weixin_user_info = cache_get($weixin_openid);
	if($weixin_user_info == false) {
		$weixin_remote_user = weixin_robot_get_remote_user_info($weixin_openid);
		$weixin_user = db_select('weixin_user','user')->fields('user')->condition('openid', $weixin_openid,'=')->execute()->fetchAssoc();
		if($weixin_user) {
			drupal_write_record('weixin_user',$weixin_remote_user,'openid');
		} 
		else {
			//FIXME, not handle speical nickname
			if($weixin_remote_user['openid'] != 'oO8L2jsx10lUNVNN26lJReTEwE_g') 
			{	
				drupal_write_record('weixin_user',$weixin_remote_user);
			}
		}
		cache_set($weixin_openid,$weixin_remote_user,'cache',3600);
		return $weixin_remote_user;
	} else {
		return $weixin_user_info->data;
	}
}

function weixin_robot_get_remote_user_info($weixin_openid){
        $weixin_robot_access_token = weixin_robot_get_access_token();
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$weixin_robot_access_token.'&openid='.$weixin_openid;
	$request_val = drupal_http_request($url);
//	dpm($request_val);
	if ($request_val->code != 200) {
		drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
    		return FALSE;
	}
	$weixin_user_info = json_decode($request_val->data,true);
//	dpm($weixin_user_info);
	return $weixin_user_info;
}

function weixin_robot_get_access_token(){
	$appid = variable_get('weixin_appid');
	$appsecret = variable_get('weixin_appsecret');
	$weixin_robot_access_token = variable_get('weixin_robot_access_token');
//	dpm($weixin_robot_access_token);
	if(empty($weixin_robot_access_token) || $weixin_robot_access_token->expires_in <= time()){
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
		$request_val = drupal_http_request($url);
		if ($request_val->code != 200) {
			drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
    			return FALSE;
		}
		$weixin_robot_access_token = json_decode($request_val->data);
		if(isset($weixin_robot_access_token->access_token)){
			$weixin_robot_access_token->expires_in+=time();
			variable_set('weixin_robot_access_token', $weixin_robot_access_token);
			return $weixin_robot_access_token->access_token;
//			cache_set('weixin_robot_access_token',$weixin_robot_access_token['access_token'],'cache',$weixin_robot_access_token['expires_in']);
//			return $weixin_robot_access_token['access_token'];
		}else{
			//print_r($weixin_robot_get_access_token);
			return FALSE;
		}
	}else{
		return $weixin_robot_access_token->access_token;
	}
}

