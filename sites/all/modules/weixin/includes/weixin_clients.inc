<?php

const API_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';
const CUSTOM_SERVICE_GET_RECORD = '/customservice/getrecord?';
const CUSTOM_SERVICE_GET_KFLIST = '/customservice/getkflist?';
const CUSTOM_SERVICE_GET_ONLINEKFLIST = '/customservice/getonlinekflist?';
const TEMPLATE_SEND_URL = '/message/template/send?';

function getCustomServiceKFlist() {
	$weixin_robot_access_token = weixin_robot_get_access_token();
//	$url = API_URL_PREFIX.CUSTOM_SERVICE_GET_ONLINEKFLIST.'access_token='.$weixin_robot_access_token;
	$url = API_URL_PREFIX.CUSTOM_SERVICE_GET_KFLIST.'access_token='.$weixin_robot_access_token;
	$request_val = drupal_http_request($url);
	if ($request_val->code != 200) {
		drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
		return FALSE;
	}
	$clients_obj = json_decode($request_val->data,true);
	return $clients_obj;
}

function get_chat_log_rows($message) {
	$rows = array();
	$cell = array();
	for ($i=0; $i < count($message); $i++) {
		$cell[] = $message[$i]['opercode'];
//		$cell[] = $message[$i]['openid'];
		$user_info = weixin_robot_get_user_info($message[$i]['openid']);
//		dpm($user_info);
		$cell[] = $user_info['nickname'];
		$cell[] = $message[$i]['worker'];
		$cell[] = format_date($message[$i]['time'],'short');
		$cell[] = $message[$i]['text'];
		$rows[] = $cell;
		unset($cell);
	}
	return $rows;
}

function getCustomServiceMessage($data) {
	$weixin_robot_access_token = weixin_robot_get_access_token();
	$url = API_URL_PREFIX.CUSTOM_SERVICE_GET_RECORD.'access_token='.$weixin_robot_access_token;
	$options = array (
		'method' => 'POST',
		'data' => urldecode(json_encode($data)),
		'timeout' => 15,
		);
	$request_val = drupal_http_request($url,$options);
	if ($request_val->code != 200) {
		drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
		return FALSE;
	}
	$message_obj = json_decode($request_val->data,true);
//	dpm($message_obj);
	return $message_obj['recordlist'];
}

function getOnlineCustomServiceKFlist() {
	$weixin_robot_access_token = weixin_robot_get_access_token();
	$url = API_URL_PREFIX.CUSTOM_SERVICE_GET_ONLINEKFLIST.'access_token='.$weixin_robot_access_token;
//	$url = API_URL_PREFIX.CUSTOM_SERVICE_GET_KFLIST.'access_token='.$weixin_robot_access_token;
	$request_val = drupal_http_request($url);
	if ($request_val->code != 200) {
		drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
		return FALSE;
	}
	$clients_obj = json_decode($request_val->data,true);
	return $clients_obj;
}


function get_weixin_clients_header() {
	$columns = array(
		array('data' => t('KF_ID')),
		array('data' => t('nick name')),
		array('data' => t('KF account')),	
		array('data' => t('Status')),	
		array('data' => t('Auto accept')),	
		array('data' => t('Accept case')),	
	);
	return $columns;
}



function get_weixin_chat_log_header() {
	$columns = array(
		array('data' => t('opercode')),
		array('data' => t('openid')),
		array('data' => t('worker')),	
		array('data' => t('time')),	
		array('data' => t('message')),	
	);
	return $columns;
}

function get_weixin_clients_rows() {
	$rows = array();
	$cell = array();
	$status_list = array(
		'0'=>t('offline'),
		'1'=>t('pc online'),
		'2'=>t('mobile on line'),
		'3'=>t('mobile+pc on line'),
	);
	$weixin_clients = getCustomServiceKFlist();
	$weixin_online_clients = getOnlineCustomServiceKFlist();
	$id_rows = mergeById($weixin_clients['kf_list'], $weixin_online_clients['kf_online_list']);
	if(isset($id_rows)) {
		foreach( $id_rows as $row) {
			$status = isset($row['status'])? $row['status']:0;
			$row['status'] = $status_list[$status];
			$cell[] = $row['kf_id'];
			$cell[] = $row['kf_nick'];
			$cell[] = $row['kf_account'];
			$cell[] = $row['status'];
			$cell[] = isset($row['auto_accept'])? $row['auto_accept']:'';
			$cell[] = isset($row['accepted_case'])? $row['accepted_case']:'';
			$rows[] = $cell;
			unset($cell);
	//		dpm($row);
		}
	} 
	return $rows;
}

function mergeById(&$a,&$b){
	$c=array();
	if(isset($a)&&isset($b)) {
		foreach($a as $e) $c[$e['kf_id']]=$e;
		foreach($b as $e) $c[$e['kf_id']]=isset($c[$e['kf_id']])? $c[$e['kf_id']]+$e : $e;
		return $c;
	}
}


function weixin_clients_configuration() {
	$header = get_weixin_clients_header();
	$rows = get_weixin_clients_rows();
	$output = '';
	$output .= drupal_render(drupal_get_form('weixin_clients_configuration_form'));
	$output .= theme('table',array('header' => $header,'rows'=> $rows));
	return $output;
}

function weixin_clients_configuration_form_submit($form, &$form_state) {
	variable_set('weixin_clients_enable',$form_state['values']['weixin_clients_enable']);
//	variable_set('weixin_clients_message',$form_state['values']['weixin_clients_message']);
	drupal_set_message(t('set weixin multiple clients transfer.'));
}


function weixin_clients_fliter_form($form, &$form_state) {
	$weixin_clients = getCustomServiceKFlist();
	$qrcode_type = array('0' => t('Permanent'), '1'=> t('Temporary'));
	$kf_account_list = array();
	$i = 0;
	foreach( $weixin_clients['kf_list'] as $kf ) {
		$kf_account_list[$i] = $kf['kf_account'];
		$i++;
	}
//	dpm($kf_account_list);
	$form = array();
	$form['filter'] = array(
	  '#type' => 'fieldset',
	  '#collapsible' => TRUE,
	  '#collapsed' => TRUE,
	  '#title' => t('Filter option')
	);
	$form['filter']['kf_account'] = array(
	  '#type' => 'select',
  	  '#title' => t('kf account'),
	  '#options' => $kf_account_list,
//	  '#size' => 15,
	);
	$form['filter']['submit'] = array(
	  '#type' => 'submit',
	  '#value' => t('Filter'),
	);
	return $form;
}

function weixin_clients_configuration_form($form,&$form_state) {
	$form = array();
	$form['description'] = array(
                '#type' => 'item',
                '#title' => t('Enable the multiple clients transfer'),
        );
	$form['weixin_clients_enable'] = array (
		'#title' => t('enable the weixin clients transfer'),
                '#type' => 'checkbox',
//		'#default_value' => 1,
		'#default_value' => variable_get('weixin_clients_enable'),
	);
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => 'Save changes',
	);
	return $form;
}

function weixin_template_message($weixin_data) {
	$weixin_robot_access_token = weixin_robot_get_access_token();
	$url = API_URL_PREFIX.TEMPLATE_SEND_URL.'access_token='.$weixin_robot_access_token;
//	dpm($url);
	$options = array (
		'method' => 'POST',
//		'data' => urldecode(json_encode($data)),
		'data' => urldecode(json_encode($weixin_data)),
		'timeout' => 15,
		);
	$request_val = drupal_http_request($url,$options);
//	dpm($request_val);
	if ($request_val->code != 200) {
		drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
		return FALSE;
	}
}
