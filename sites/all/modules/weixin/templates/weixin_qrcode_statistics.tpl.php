<?php
/*
* this template file is for weixin statistics
*/
?>
<link rel="stylesheet" href="http://cdn.staticfile.org/morris.js/0.4.3/morris.css" />
<link rel="stylesheet" href="css/weixin_style.css" />
<script type='text/javascript' src="http://cdn.staticfile.org/raphael/2.1.2/raphael-min.js"></script>
<script type='text/javascript' src="http://cdn.staticfile.org/morris.js/0.4.3/morris.min.js"></script>

<?php
	$start_date = weixin_stats_get_start_date();
	$end_date = weixin_stats_get_end_date();
	$qrcode_types = weixin_get_qrcode_types();
	$qrcodes_rows = weixin_get_qrcodes_rows();
	$scenes_counts = weixin_get_scenes_counts($start_date, $end_date);
	$qrscenes_counts = weixin_get_qrscenes_counts($start_date, $end_date);
?>

<div class="tablenav">
	<form method="get" action="stats" target="_self" id="export-filter" style="float:left;">

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
		<?php echo t('QR code scan/subscribe & analysis');?>
	</div>
</div>

<div style="clear:both;"></div>
<table class="widefat" cellspacing="0">
    <thead>
      <tr>
        <th style="width:60px"><?php echo t('Scene ID')?></th>
        <th style="width:80px"><?php echo t('Name')?></th>
        <th style="width:40px"><?php echo t('Type')?></th>
        <th style="width:80px"><?php echo t('Expire time')?></th>
        <th style="width:30px"><?php echo t('Subscribe Count')?></th>
        <th style="width:30px"><?php echo t('Scan Count')?></th>
     </tr>
   </thead>
	<?php
		foreach($qrcodes_rows as $qrcodes_row)
		{
			echo "<tr>";
			echo "<td>".$qrcodes_row['scene']."</td>";
			echo "<td>".$qrcodes_row['name']."</td>";
			echo "<td>".$qrcode_types[$qrcodes_row['type']]."</td>";
			if ($qrcodes_row['type'] == 'QR_SCENE') {
				echo "<td>".format_date($qrcodes_row['expire'],'short')."</td>";
			} else {
				echo "<td>".t('NEVER')."</td>";
			}
			$sub_count = isset($qrscenes_counts['qrscene_'.$qrcodes_row['scene']])?$qrscenes_counts['qrscene_'.$qrcodes_row['scene']]->count:0;
			echo "<td>".$sub_count."</td>";
			$scan_count = isset($scenes_counts[$qrcodes_row['scene']])?$scenes_counts[$qrcodes_row['scene']]->count:0;
			echo "<td>".$scan_count."</td>";
			echo "</tr>";
		}
	?>
   <tbody>
   </tbody>
</table>

