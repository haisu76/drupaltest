<?php
include(drupal_get_path('module', 'weixin') .'/includes/weixin_stats.inc');
//	$log_date = weixin_stats_get_end_date();
//	dpm($log_date);

	function weixin_get_log_date() {
		$end_date = (isset($_REQUEST['log_date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_REQUEST['log_date']))?$_REQUEST['log_date']:'';
		if(!$end_date) $end_date=gmdate('Y-m-d', REQUEST_TIME);
		return $end_date;
	}

	$log_date = weixin_get_log_date();
	$log_date_start_time = $log_date.' 00:00:01';
	$log_date_end_time = $log_date.' 23:59:59';
	$data = array();
	$data['starttime'] = strtotime($log_date_start_time);
	$data['endtime'] = strtotime($log_date_end_time);
	$data['pagesize'] = 100;
	$data['pageindex'] = 1;
	$chat_message = getCustomServiceMessage($data);
	$rows = get_chat_log_rows($chat_message);
	$header = get_weixin_chat_log_header();
	$chat_table = theme('table',array('header' => $header, 'rows' => $rows));
	$chat_fliter = drupal_render(drupal_get_form('weixin_clients_fliter_form'));
?>

<div class="tablenav">
	<form method="get" action="chat_log" target="_self" id="export-filter" style="float:left;">

		<input type="date" name="log_date" id="log_date" value=<?php echo $log_date;?> size="11"/>
		<input type="submit" value="show" class="button-secondary" name="">
	</form>
</div>

<div class="header_info">
<h2>
	<?php echo $log_date; ?>
</h2>
<?php 
	echo $chat_fliter;
	echo $chat_table; 
?>
