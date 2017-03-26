<?php 
function weixin_interface_configuration()
{
	$output ='';
	$output .= drupal_render(drupal_get_form('interface_configuration_form'));
	return $output;
}

function weixin_basic_configuration()
{
	$output ='';
	$output .= drupal_render(drupal_get_form('basic_configuration_form'));
	return $output;
}

function get_weixin_reply_header() {
	$columns = array(
		array('data' => t('create_time')),
		array('data' => t('keyword')),
		array('data' => t('reply_type')),
		array('data' => t('reply_message')),
		array('data' => t('status')),	
		array('data' => t('operation')),	
	);
	return $columns;
}

function get_weixin_reply_rows() {
	global $base_url;
	$rows = array();
	$cell = array();
	$query = db_select('weixin_reply_keyword','replys');
	$query->fields('replys',array('time','keyword','reply','reply_type','status','id'));
	$result = $query->execute();
	while($record = $result->fetchAssoc()) {
		$cell[] = format_date($record['time'],'short');
		$cell[] = $record['keyword'];
//		$cell[] = $record['reply_type'];
		if ($record['reply_type'] == 1) {
			$cell[] = t('nodes');
		} elseif($record['reply_type'] == 0) {
			$cell[] = t('text message');
		} elseif($record['reply_type'] == 2) {
			$cell[] = t('term');
		}
		$cell[] = $record['reply'];
		if ($record['status']) {
			$cell[] = t('enable');
		} else {
			$cell[] = t('disable');
		}
		$options = array(
			'html' => TRUE,
		);
		$delete_path = $base_url.'/'.'weixin/configuration/reply?id='.$record['id'].'&op=delete';
		$edit_path = $base_url.'/'.'weixin/configuration/reply?id='.$record['id'].'&op=edit';
		$cell[] = '<a href='.$delete_path.'>delete</a> | <a href='.$edit_path.'>edit</a>';
		$rows[] = $cell;
		unset($cell);
	}
	return $rows;
}
function weixin_reply_configuration() {
	global $base_url;
	$output ='';
	$header = get_weixin_reply_header();
	$rows = get_weixin_reply_rows();
	$output .= theme('table', array('header'=>$header,'rows'=>$rows));
	$output .= drupal_render(drupal_get_form('weixin_reply_configuration_form'));
	$reply_keyword_id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
	$reply_op = isset($_REQUEST['op'])?$_REQUEST['op']:'';
	$reply_path = $base_url.'/'.'weixin/configuration/reply';
//	dpm($reply_op);
	if (! empty($reply_keyword_id) && $reply_op == "delete" ) {
		db_delete('weixin_reply_keyword')->condition('id', $reply_keyword_id)->execute();
		drupal_goto($reply_path);
	}
	return $output;
}

function weixin_reply_configuration_form_submit($form, &$form_state){
	dpm($form_state);
	global $base_url;
	$id = isset($form_state['values']['id'])?$form_state['values']['id']:'';
	$data = array(
		'keyword' => $form_state['values']['weixin_reply_keyword'],
		'reply' => $form_state['values']['weixin_reply_message'],
		'reply_type' => $form_state['values']['weixin_reply_type'],
		'status' => $form_state['values']['weixin_reply_active'],
		'time' => REQUEST_TIME,
		'id' => $id,
	);

	$reply_path = $base_url.'/'.'weixin/configuration/reply';
	if($form_state['values']['submit'] == 'edit') {
		drupal_write_record('weixin_reply_keyword',$data,'id');
		drupal_goto($reply_path);
	} else {
		drupal_write_record('weixin_reply_keyword',$data);
	}
}

function weixin_reply_configuration_form_validate($form, &$form_state) {
//	dpm($form_state);
	$appid_len = strlen($form_state['values']['weixin_reply_keyword']);
	$appsecret_len = strlen($form_state['values']['weixin_reply_message']);
	if($appid_len < 1 && $appsecret_len < 1 ) {
		form_set_error('form',t('Please input your reply keyword and reply message'));
	}
}

function weixin_reply_configuration_form($form,&$form_state)
{
	$reply_type = array('0' => t('text message'), '1'=> t('nodes'), '2'=> t('term'));
	$form = array();
	$form['description'] = array(
                '#type' => 'item',
                '#title' => t('Add custom reply'),
        );
        $form['weixin_reply_keyword'] = array (
                '#type' => 'textfield',
                '#title' => t('Reply keywords'),
        );
	 $form['weixin_reply_type'] = array (
		'#title' => t('weixin qrcode type'),
		'#type'  => 'select',
		'#multiple' => FALSE,
		'#options' => $reply_type,
		'#size' => 1,
		'#ajax' => array(
			'callback' => 'ajax_reply_type_callback',
			'wrapper' => 'textfields',
			'effect' => 'fade',
		)
        );
	$form['textfields'] = array(
#		'#title' => t("Generated text fields for first and last name"),
		'#prefix' => '<div id="textfields">',
		'#type' => 'markup',
//		'#title' => t('Reply message'),
//		'#type'  => 'textarea',
		'#suffix' => '</div>',
#		'#description' => t('This is where we put automatically generated textfields'),
	);
	/*
	$form['weixin_reply_message'] = array(
		'#title' => t('Reply message'),
		'#type'  => 'textarea',
	);
	*/
        $form['weixin_reply_active'] = array (
		'#title' => t('Active'),
                '#type' => 'checkbox',
		'#default_value' => 1,
//		'#default_value' => variable_get('weixin_interface_enable'),
	);

	if (isset($form_state['values']['weixin_reply_type']) && $form_state['values']['weixin_reply_type'] == 1) {
		$form['textfields']['weixin_reply_message'] = array(
			'#title' => t('Reply nodes'),
			'#type'  => 'textfield',
			'#description' => t('The weixin reply nodes,should such as "1,2,3"'),
		);
	} elseif (isset($form_state['values']['weixin_reply_type']) && $form_state['values']['weixin_reply_type'] == 2) {
		$form['textfields']['weixin_reply_message'] = array(
			'#title' => t('Reply term'),
			'#type'  => 'textfield',
			'#description' => t('The wexin reply term, use term id such as "1,2,3"'),
		);
	} else {
		$form['textfields']['weixin_reply_message'] = array(
			'#title' => t('Reply messages'),
			'#type'  => 'textarea',
			'#description' => t('The wexin custom reply text message'),
		);
	}
 
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => 'Add',
	);

	return $form;
}

function ajax_reply_type_callback($form, $form_state) {
	return $form['textfields'];
}

function weixin_form_weixin_reply_configuration_form_alter(&$form, &$form_state, $form_id)
{
	$reply_keyword_id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
	$reply_op = isset($_REQUEST['op'])?$_REQUEST['op']:'';
	$result = db_select('weixin_reply_keyword','r')
		->fields('r')->condition('id', $reply_keyword_id,'=')->execute()->fetchAssoc();
//	if ($form_id == 'weixin_reply_configuration_form' && $reply_op == 'edit') {
	if ($reply_op == 'edit') {
		dpm($form);
		dpm($result);
		$form['weixin_reply_keyword']['#default_value'] = $result['keyword'];
		$form['textfields']['weixin_reply_message']['#default_value'] = $result['reply'];
		$form['weixin_reply_active']['#default_value'] = $result['status'];
		$form['weixin_reply_type']['#default_value'] = $result['reply_type'];
		$form['id'] = array( 
			'#type' => 'hidden',
			'#value' => $result['id'],
		);
		$form['submit']['#value'] = 'edit';
	}
}

function basic_configuration_form($form,&$form_state)
{
	$form = array();
	$form['description'] = array(
                '#type' => 'item',
                '#title' => t('basic configuration'),
        );
        $form['weixin_token'] = array (
                '#type' => 'textfield',
                '#title' => t('weixin token'),
		'#default_value' => variable_get('weixin_token'),
        );
	$form['weixin_reply_message_number'] = array (
                '#type' => 'textfield',
                '#title' => t('Return weixin message number'),
		'#default_value' => variable_get('weixin_reply_message_number'),
        );
	$form['weixin_reply_default_img'] = array (
                '#type' => 'textfield',
                '#title' => t('Return weixin message default message'),
        );
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => 'Save Changes',
	);
	return $form;
}

function basic_configuration_form_submit($form, &$form_state) {
	variable_set('weixin_token',$form_state['values']['weixin_token']);
	variable_set('weixin_reply_message_number',$form_state['values']['weixin_reply_message_number']);
	drupal_set_message(t('set weixin token successfully'));
}

function interface_configuration_form_validate($form, &$form_state) {
//	dpm($form_state);
	$appid_len = strlen($form_state['values']['weixin_appid']);
	$appsecret_len = strlen($form_state['values']['weixin_appsecret']);
	if($appid_len < 15 && $appsecret_len < 30 ) {
		form_set_error('form',t('Pleae enter validate appid and appsecret'));
	}
}


function interface_configuration_form_submit($form, &$form_state) {
	variable_set('weixin_appid',$form_state['values']['weixin_appid']);
	variable_set('weixin_appsecret',$form_state['values']['weixin_appsecret']);
	variable_set('weixin_interface_enable',$form_state['values']['weixin_interface_enable']);
	variable_set('weixin_welcome_message',$form_state['values']['weixin_welcome_message']);
	variable_set('weixin_welcome_message_enable',$form_state['values']['weixin_welcome_message_enable']);
	drupal_set_message(t('set weixin appid, appsecret successfully'));
}

function interface_configuration_form($form, &$form_state)
{
	$form = array();
	$form['description'] = array(
                '#type' => 'item',
                '#title' => t('interface configuration'),
        );
        $form['weixin_appid'] = array (
                '#type' => 'textfield',
                '#title' => t('weixin appid'),
		'#default_value' => variable_get('weixin_appid'),
        );
        $form['weixin_appsecret'] = array (
                '#type' => 'textfield',
                '#title' => t('weixin appsecret'),
		'#default_value' => variable_get('weixin_appsecret'),
        );
        $form['weixin_interface_enable'] = array (
		'#title' => t('enable the weixin advanced interface'),
                '#type' => 'checkbox',
//		'#default_value' => 1,
		'#default_value' => variable_get('weixin_interface_enable'),
	);
	$form['weixin_welcome_message'] = array(
		'#title' => t('The weixin welcome message'),
		'#type'  => 'textarea',
		'#default_value' => variable_get('weixin_welcome_message'),
	);
        $form['weixin_welcome_message_enable'] = array (
		'#title' => t('enable the weixin welcome message'),
                '#type' => 'checkbox',
//		'#default_value' => 1,
		'#default_value' => variable_get('weixin_welcome_message_enable'),
	);
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => 'Save changes',
	);
	
//        $form['#redirect'] = FALSE;
//	$output .= drupal_get_form('interface_configuration_form', $form);
	return $form;
}



