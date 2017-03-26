<?php

function weixin_stats_get_start_date() {
        $start_date     = (isset($_REQUEST['start_date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        if(!$start_date) $start_date=gmdate('Y-m-d', REQUEST_TIME - (60*60*24*30));
        return $start_date;
}

function weixin_stats_get_end_date() {
        $end_date       = (isset($_REQUEST['end_date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_REQUEST['end_date']))?$_REQUEST['end_date']:'';
        if(!$end_date) $end_date=gmdate('Y-m-d', REQUEST_TIME);
        return $end_date;
}

function weixin_stats_get_type(){
        return isset($_REQUEST['type'])?$_REQUEST['type']:'';
}

function weixin_stats_get_reply_type(){
        return isset($_GET['response_type'])?$_GET['response_type']:'total';
}

function get_weixin_reply_types() {
	return array(
		'total'		=> t('total'),
		'welcome'	=> t('welcome'),
		'auto_search_reply' => t('auto search reply'),
		'manual_reply'	=> t('manual reply'),
		'custom_reply'	=> t('custom reply'),
	);
}
function get_weixin_stats_types() {
	return array(
		'total'		=> t('total'),
		'text'		=> t('text'),
		'event'		=> t('event'),
		'subscribe'	=> t('user'),
		'unsubscribe'	=> t('user unsubscribe'),
		'netuser'	=> t('net user increase'),
		'location'	=> t('location'),
		'image'		=> t('image'),
		'link'		=> t('link'),
		'voice'		=> t('voice')
	);
}

function get_weixin_message_daily_number($start_date, $end_date) {
	$rows = array();
	$end_time = $end_date.' 23:59:59';
	$where = 'create_time > '.strtotime($start_date).' AND create_time < '.strtotime($end_time);
        $sum = "
        SUM(case when type='text' then 1 else 0 end) as text,
        SUM(case when type='event' AND event!='subscribe' AND event!='unsubscribe' then 1 else 0 end) as event, 
        SUM(case when type='event' AND event='subscribe' then 1 else 0 end) as subscribe, 
        SUM(case when type='event' AND event='unsubscribe' then 1 else 0 end) as unsubscribe,
        SUM(case when type='event' AND event='subscribe' then 1 when type='event' AND event='unsubscribe' then -1 else 0 end ) as netuser,
        SUM(case when type='location' then 1 else 0 end) as location, 
        SUM(case when type='image' then 1 else 0 end) as image, 
        SUM(case when type='link' then 1 else 0 end) as link, 
        SUM(case when type='voice' then 1 else 0 end) as voice
        ";
	$sql = "SELECT FROM_UNIXTIME(create_time, '%Y-%m-%d') as day, count(id) as total, {$sum} FROM {weixin_msg} WHERE {$where} GROUP BY day ORDER BY day;";
//	dpm($sql);
	$result = db_query($sql);
	while ($record = $result->fetchAssoc($result)) {
		$rows[] = $record; 
	}
//	dpm($rows);
	return $rows;

}

function get_weixin_reply_stats_number($start_date, $end_date) {
	$rows = array();
	$end_time = $end_date.' 23:59:59';
	$where = 'create_time > '.strtotime($start_date).' AND create_time < '.strtotime($end_time);
        $sql = "SELECT COUNT( * ) AS count, response FROM {weixin_msg} WHERE {$where} AND (type ='text' OR type = 'event') GROUP BY response ORDER BY count DESC";
//	dpm($sql);
	$result = db_query($sql);
	while ($record = $result->fetchAssoc($result)) {
		$rows[] = $record; 
	}
//	dpm($rows);
	return $rows;
}

function get_weixin_reply_number_by_type($start_date, $end_date, $reply_type) {
	$rows = array();
	$end_time = $end_date.' 23:59:59';
	$where = 'create_time > '.strtotime($start_date).' AND create_time < '.strtotime($end_time);
	if($reply_type == 'total'){
		$where .= " AND response != ''";
	}else{
		$where .= " AND response = '{$reply_type}'";
	}
	$sql = "SELECT COUNT( * ) AS count, response, type, content FROM ( SELECT response, type, LOWER(content) as content FROM {weixin_msg} WHERE {$where} AND type ='text' UNION ALL SELECT response, type,  LOWER(event_key) as content FROM {weixin_msg} WHERE {$where} AND type = 'event'  AND event!='subscribe' AND event!='unsubscribe') as T1 GROUP BY content ORDER BY count DESC LIMIT 0 , 100";
	$result = db_query($sql);
	while ($record = $result->fetchAssoc($result)) {
		$rows[] = $record; 
	}
//	dpm($rows);
	return $rows;
}

function get_weixin_message_stats_number($start_date, $end_date) {
	$end_time = $end_date.' 23:59:59';
	$where = 'create_time > '.strtotime($start_date).' AND create_time < '.strtotime($end_time);
        $sum = "
        SUM(case when type='text' then 1 else 0 end) as text,
        SUM(case when type='event' AND event!='subscribe' AND event!='unsubscribe' then 1 else 0 end) as event, 
        SUM(case when type='event' AND event='subscribe' then 1 else 0 end) as subscribe, 
        SUM(case when type='event' AND event='unsubscribe' then 1 else 0 end) as unsubscribe,
        SUM(case when type='event' AND event='subscribe' then 1 when type='event' AND event='unsubscribe' then -1 else 0 end ) as netuser,
        SUM(case when type='location' then 1 else 0 end) as location, 
        SUM(case when type='image' then 1 else 0 end) as image, 
        SUM(case when type='link' then 1 else 0 end) as link, 
        SUM(case when type='voice' then 1 else 0 end) as voice
        ";
	$sql = "SELECT {$sum} FROM {weixin_msg} WHERE {$where}";
	$result = db_query($sql);
	$record = $result->fetchAssoc($result);
	return $record;
}

function get_weixin_user_locations() {
	$rows = array();
	$sql = "SELECT open_user_id, location_x, location_y FROM {weixin_msg} WHERE type='location' OR (type='event' and event='LOCATION')";
	$result = db_query($sql);
	while ($record = $result->fetchAssoc($result)) {
		$rows[] = $record; 
	}
	return $rows;
}

function weixin_get_qrcode_types(){
	return  array(
		'QR_LIMIT_SCENE'	=> t('Permanent QR code'),
		'QR_SCENE'		=> t('Temporary QR code'),
	);
}

function weixin_get_qrcodes_rows() {
	$rows = array();
	$sql = "SELECT * from {weixin_qrcodes} WHERE user_type = 'market'";
	$result = db_query($sql);
	while ($record = $result->fetchAssoc($result)) {
		$rows[] = $record; 
	}
//	dpm($rows);
	return $rows;
}

function weixin_get_scenes_counts($start_date, $end_date) {
	$rows = array();
	$end_time = $end_date.' 23:59:59';
	$where = 'create_time > '.strtotime($start_date).' AND create_time < '.strtotime($end_time);
	$qrcodes = weixin_get_qrcodes_rows();
	foreach ($qrcodes as $code) {
		$scenes[] = $code['scene'];
	}
	if ($scenes) {
			$scenes = implode(',', $scenes);
			$sql = "SELECT event_key, count(*) as count FROM {weixin_msg} WHERE 1=1 AND {$where} AND type = 'event' AND event = 'SCAN' AND event_key in({$scenes}) GROUP BY event_key";
			$result = db_query($sql);
			/*
			while ($record = $result->fetchAssoc($result)) {
				$rows[] = $record; 
			}
			*/
			$rows = $result->fetchAllAssoc('event_key');
	}
	return $rows;
}

function change_to_quotes($str) {
    return sprintf("'%s'", $str);
}

function weixin_get_qrscenes_counts($start_date, $end_date) {
	$rows = array();
	$end_time = $end_date.' 23:59:59';
	$where = 'create_time > '.strtotime($start_date).' AND create_time < '.strtotime($end_time);
	$qrcodes = weixin_get_qrcodes_rows();
	foreach ($qrcodes as $record) {
		$qrscenes[] = 'qrscene_'.$record['scene'];
	}
	if ($qrscenes) {
			$qrscenes = implode(',', array_map('change_to_quotes',$qrscenes));
			$sql = "SELECT event_key, count(*) as count FROM {weixin_msg} WHERE 1=1 AND {$where} AND type = 'event' AND event = 'subscribe' AND event_key in({$qrscenes}) GROUP BY event_key";
			$result = db_query($sql);
			/*
			while ($record = $result->fetchAssoc($result)) {
				$rows[] = $record; 
			}
			*/
			$rows = $result->fetchAllAssoc('event_key');
	}
	return $rows;
}
