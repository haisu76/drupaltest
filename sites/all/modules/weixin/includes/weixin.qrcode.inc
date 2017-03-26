<?php

function get_weixin_qrcodes_header() {
	$columns = array(
		array('data' => t('Scene_ID')),
		array('data' => t('Name')),
		array('data' => t('Type')),
		array('data' => t('Expire time')),	
		array('data' => t('QRcode')),	
		array('data' => t('Operation')),	
	);
	return $columns;
}

function get_weixin_qrcodes_rows() {
	global $base_url;
	$qr_type = array(
		'QR_SCENE' => 'Temporary',
		'QR_LIMIT_SCENE' => 'Permanent',
	);
	$rows = array();
	$cell = array();
	$query = db_select('weixin_qrcodes','qr');
	$query->fields('qr',array('id','scene','name','type','ticket','expire'));
	$query->condition('user_type','market');
	$result = $query->execute();
	while($record = $result->fetchAssoc()) {
		$cell[] = $record['scene'];
		$cell[] = $record['name'];
		$cell[] = $qr_type[$record['type']];
		$qr_code_path = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($record['ticket']);
		$qr_code_thumb_path = $base_url.'/'.drupal_get_path('module', 'weixin').'/includes/timthumb.php?src='.$qr_code_path;

		if ($record['type'] == 'QR_SCENE') {
			$cell[] = format_date($record['expire'],'short');
		} else {
			$cell[] = t('NEVER');
		}
//		$cell[] = "<img src=".$qr_code_thumb_path.">";
		$cell[] = '<a href="'.$qr_code_path.'" rel="lightbox"><img src='.$qr_code_thumb_path."></a>";
		$delete_path = $base_url.'/'.'weixin/qrcode?id='.$record['id'].'&op=delete';
		$delete_path_link = '<a href='.$delete_path.'>delete</a>';
		$cell[] = $delete_path_link;
		$rows[] = $cell;
		unset($cell);
//		dpm($record);
	}
	return $rows;
}

function weixin_create_qrcode($scene,$name,$type='QR_LIMIT_SCENE',$expire='1200',$user_type='binding')
{
	$post = array();
	if($type == 'QR_SCENE'){
		$post['expire_seconds'] = $expire;
	}
	$post['action_name']	= $type;
	$post['action_info']	= array(
		'scene'=>array(
			'scene_id'=>$scene
		)
	);
	$weixin_robot_access_token = weixin_robot_get_access_token();
	$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$weixin_robot_access_token;
	$options = array (
		'method' => 'POST',
		'data' => urldecode(json_encode($post)),
		'timeout' => 15,
		);
	$request_val = drupal_http_request($url, $options);

	if ($request_val->code != 200) {
		drupal_set_message(t('HTTP error @errorcode occurred when trying to get token.', array('@errorcode' => $request_val->code)), 'error');
		return FALSE;
	}
	$qrcode_obj = json_decode($request_val->data,true);
	$data = array(
		'scene'	=> $scene,
		'name'	=> $name,
		'type'	=> $type,
		'ticket'=> $qrcode_obj['ticket'],
		'user_type' => $user_type,
	);
	if($type == 'QR_SCENE'){
		$data['expire'] = time()+$qrcode_obj['expire_seconds'];
	}
	drupal_write_record('weixin_qrcodes', $data);
	return $data;

//	$response = wp_remote_post($url,array( 'body' => json_encode($post),'sslverify'=>false));
	/*
	if(is_wp_error($response)){
		echo $response->get_error_code().'：'. $response->get_error_message();
		return false;
	}else{
		$result = json_decode($response['body']);
		$data = array(
			'scene'	=> $scene,
			'name'	=> $name,
			'type'	=> $type,
			'ticket'=> $result->ticket
		);
		if($type == 'QR_SCENE'){
			$data['expire'] = time()+$result->expire_seconds;
		}
		if(weixin_robot_get_qrcode($scene)){
			$wpdb->update($wpdb->weixin_qrcodes,$data,array('scene'=>$scene));
		}else{
			$wpdb->insert($wpdb->weixin_qrcodes,$data);
		}
		return $data;
	}
	*/
}

function weixin_qrcode_configuration()
{
	global $base_url;
	$qr_path = $base_url.'/'.'weixin/qrcode';
	$header = get_weixin_qrcodes_header();
	$rows = get_weixin_qrcodes_rows();
	$output = '';
	$output .= theme('table',array('header' => $header,'rows'=> $rows));
	$output .= drupal_render(drupal_get_form('weixin_qrcode_configuration_form'));
	$qr_path = $base_url.'/'.'weixin/qrcode';
	$qr_id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
	$qr_op = isset($_REQUEST['op'])?$_REQUEST['op']:'';
 	if (! empty($qr_id) && $qr_op == "delete" ) {
		db_delete('weixin_qrcodes')->condition('id', $qr_id)->execute();
		drupal_goto($qr_path);
	}
	return $output;
}

function weixin_qrcode_configuration_form_submit($form,&$form_state)
{
	$expire ='';
	$scene = $form_state['values']['weixin_qrcode_scene'];
	$name = $form_state['values']['weixin_qrcode_name'];

	$type = $form_state['values']['weixin_qrcode_type'];
	if ($type == 0) {
		$type = 'QR_LIMIT_SCENE';

	} elseif ($type == 1) {
		$type = 'QR_SCENE';
		$expire = $form_state['values']['weixin_qrcode_expire_time'];
	}
	weixin_create_qrcode($scene, $name, $type, $expire,'market');
}

function weixin_qrcode_configuration_form($form,&$form_state)
{
	$form = array();
	$qrcode_type = array('0' => t('Permanent'), '1'=> t('Temporary'));
	$form['description'] = array(
                '#type' => 'item',
                '#title' => t('QR code configure'),
        );
        $form['weixin_qrcode_scene'] = array (
                '#type' => 'textfield',
                '#title' => t('weixin qrcode scene ID'),
		'#description' => t('weixin qrcode scene id, the permanent scene id is (1-100000)'),
        );
	$form['weixin_qrcode_name'] = array(
		'#title' => t('weixin qrcode name'),
		'#type'  => 'textfield',
	);
	$form['weixin_qrcode_type'] = array(
		'#title' => t('weixin qrcode type'),
		'#type'  => 'select',
		'#multiple' => FALSE,
		'#options' => $qrcode_type,
		'#size' => 1,
		'#ajax' => array(
			'callback' => 'ajax_qrcode_callback',
			'wrapper' => 'textfields',
			'effect' => 'fade',
		)
	);
	$form['textfields'] = array(
#		'#title' => t("Generated text fields for first and last name"),
		'#prefix' => '<div id="textfields">',
		'#suffix' => '</div>',
		'#type' => 'markup',
#		'#description' => t('This is where we put automatically generated textfields'),
	);
	if (isset($form_state['values']['weixin_qrcode_type']) && $form_state['values']['weixin_qrcode_type'] == 1)	   {
		$form['textfields']['weixin_qrcode_expire_time'] = array(
			'#title' => t('weixin qrcode expire time'),
			'#type'  => 'textfield',
			'#description' => t('The qrcode expire time, the max time is 1800'),
		);
	}

	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => 'Add',
	);

	return $form;
}

function ajax_qrcode_callback($form, $form_state) {
	return $form['textfields'];
}


