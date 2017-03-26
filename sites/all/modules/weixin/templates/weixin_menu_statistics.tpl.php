<?php
/*
* this template file is for weixin statistics
*/
?>

<?php 
	include(drupal_get_path('module', 'weixin_menus') .'/includes/weixin.menus.inc');
	$start_date = weixin_stats_get_start_date();
	$end_date = weixin_stats_get_end_date();
	$end_time = $end_date.' 23:59:59';
	$where = 'create_time > '.strtotime($start_date).' AND create_time < '.strtotime($end_time);
	$menu_itmes_obj = get_weixin_menu_itmes();
//	dpm($menu_itmes_obj);
	$menu_type = array('0' => 'click', '1'=> 'view', '2'=> 'parent');
	$i = 1;
	if(isset($menu_itmes_obj['menu']['button'])) {
		foreach ((array)$menu_itmes_obj['menu']['button'] as $key => $item) {
//			dpm($item);
			$menu_data[$i] = array(
			  'name' => urldecode($item['name']),
			  'key_url' => _weixin_menu_get_default_value($item),
			  'menu_type' => _weixin_menu_get_default_menu_type($item),
			  );
			$i++;
			$j = $i;
			if(!empty($item['sub_button'])) {
				foreach((array)$item['sub_button'] as $sub_key => $sub_item) {
					$menu_data[$j] = array(
						'name' => urldecode($sub_item['name']),
						'key_url' => _weixin_menu_get_default_value($sub_item),
						'menu_type' => _weixin_menu_get_default_menu_type($sub_item),
					);
					$j++;
					$i = $j;
				}
			}
		}
	}
//	dpm($menu_data);
	if($menu_data) {
		foreach($menu_data as $menu_item) {
			if($menu_item['menu_type'] == 0 || $menu_item['menu_type'] == 1) {
				$click_keys[] = $menu_item['key_url'];
			}
		}
	}
	if($click_keys) {
		$click_keys = "'".implode("','", $click_keys)."'";
	}
	/* for click keys */
	$sql = "SELECT event_key, count(*) as count FROM {weixin_msg} WHERE 1=1 AND {$where} AND type = 'event' AND event_key in({$click_keys}) GROUP BY event_key";
	$result = db_query($sql);
	$key_counts = $result->fetchAllKeyed();
	
	$sql = "SELECT count(*) as count FROM {weixin_msg} WHERE 1=1 AND {$where} AND type = 'event' AND event_key in({$click_keys})";
	$result = db_query($sql);
	$total_count = $result->fetchObject()->count;
//	dpm($menu_data);
//	dpm($click_keys);
?>

<div class="tablenav">
	<form method="get" action="menu" target="_self" id="export-filter" style="float:left;">

		<input type="date" name="start_date" id="start_date" value=<?php echo $start_date;?> size="11"/>
		-
		<input type="date" name="end_date" id="end_date" value=<?php echo $end_date;?> size="11"/>
		<input type="submit" value="show" class="button-secondary" name="">
	</form>
</div>

<div class="header_info">
<h2>
<?php echo $start_date,' - ',$end_date;?>
</h2>
	<div class="header_text">
		<?php echo t('menu statistics');?>
	</div>
</div>


<div style="clear:both;"></div>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th>menu</th>
			<th>type</th>
			<th>Key/URL</th>
			<th>click number</th>
			<th>ratio</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($menu_data as $key => $item) {
				echo "<tr>";
				echo "<td>". $item['name']. "</td>";
				echo "<td>". $menu_type[$item['menu_type']]. "</td>";
				echo "<td>". $item['key_url']. "</td>";
				echo "<td>";
				if (isset($key_counts[$item['key_url']])) {
					echo $key_counts[$item['key_url']];
				} else {
					echo 0;
				}
				echo "</td>";
				echo "<td>";
				if (isset($key_counts[$item['key_url']])) {
					echo round($key_counts[$item['key_url']]/$total_count*100,2).'%';
				} else {
					echo 0;
				}
				echo "</td>";
				echo "</tr>";	
			}
		?>
	</tbody>
</table>
