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
	$rows = get_weixin_reply_stats_number($start_date, $end_date);
	$types = get_weixin_reply_types();

	$reply_type = weixin_stats_get_reply_type();
	$reply_rows = get_weixin_reply_number_by_type($start_date, $end_date, $reply_type);
?>
<div class="tablenav">
	<form method="get" action="reply" target="_self" id="export-filter" style="float:left;">

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
		<?php echo t('Reply statistics & analysis');?>
	</div>
</div>
<!-- message type table -->
<div style="display:table;">
	<div style="display: table-row;">
		<div id="total-chart" style="display: table-cell; width:450px; float:left;"></div>
		<div style="display: table-cell; float:left; width:240px;">
			<table class="widefat" cellspacing="0">
				<thead>
					<tr>
						<th>type</th>
						<th>number</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$data = array();
				foreach ($rows as $key=>$value) {
					echo "<tr>";
//					dpm($value);
					if(isset($types[$value['response']])) {
						echo "<td>". $types[$value['response']] ."</td>";
						echo "<td>". $value['count']."</td>";
						$data []= '{"label": "'.$types[$value['response']].'", "value": '.$value['count'].' }';
					}
					echo "</tr>";
				}
				$data = "\n".implode(",\n", $data)."\n";
//				dpm($data);
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
                Morris.Donut({
                  element: 'total-chart',
                  data: [<?php echo $data;?>]
                });
</script>
<div style="clear:both;"></div>
<h3><?php echo t('Dayil reply detail data');?></h3>
<ul class="subtabs">
	<!--
	<li class="total">
		<a class="current">test</a>
	</li>
	<li class="text">
		<a href="?test">test2</a>
	</li>
	-->
	<?php 
		$subtabs_base_url = 'reply?start_date='.$start_date.'&end_date='.$end_date;
		foreach ($types as $key=>$value) {
//			dpm($key);
			echo "<li class=".$key."> <a href=$subtabs_base_url&response_type=".$key;
			if ($reply_type == $key) {
				echo ' class="current"';
			}
			echo ">$value</a> | </li>"; 
		}
	?>
</ul>
<div style="clear:both;"></div>
<table class="widefat" cellspacing="0">
    <thead>
      <tr>
        <th style="width:60px"><?php echo t('Rank')?></th>
        <th style="width:80px"><?php echo t('Count')?></th>
        <th style="width:300px"><?php echo t('Keyword')?></th>
        <th style="width:150px"><?php echo t('Reply type')?></th>
     </tr>
   </thead>
   <tbody>
	<?php
		$i = 0;
		foreach($reply_rows as $reply_row)
		{
			$i++;
			echo "<tr>";
			echo "<td> $i </td>";
			echo "<td>".$reply_row['count']."</td>";
			echo "<td>".$reply_row['content']."</td>";
			echo "<td>".$reply_row['response']."</td>";
			echo "</tr>";
		}
	?>
   </tbody>
</table>
