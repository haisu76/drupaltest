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
	$rows = get_weixin_message_stats_number($start_date, $end_date);
	$daily_rows = get_weixin_message_daily_number($start_date, $end_date);
	$types = get_weixin_stats_types();
	$type = weixin_stats_get_type();
	if(!$type) $type = 'total';
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
		<?php echo t('summary data');?>
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
				foreach ($types as $key=>$value) {
					if ($key != 'total' && $rows[$key] !=0 ) 
					{
						$data []= '{"label": "'.$value.'", "value": '.$rows[$key].' }';
						echo "<tr>";
						echo "<td> $value </td>";
						echo "<td> $rows[$key] </td>";
						echo "</tr>";
					}
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
<h3><?php echo t('Dayil detail data');?></h3>
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
		$subtabs_base_url = 'stats?start_date='.$start_date.'&end_date='.$end_date;
		foreach ($types as $key=>$value) {
			echo "<li class=$key> <a href=$subtabs_base_url&type=$key";
			if ($type == $key) {
				echo ' class="current"';
			}
			echo ">$value</a> | </li>"; 
		}
	?>	
</ul>
<div style="clear:both;"></div>
<?php
  //* daily chart
  $data = array();
        if($type == 'total'){
                $morris_ykeys = array('total','text','event','subscribe','netuser');
                $morris_labels = array();
                foreach ($morris_ykeys as $morris_ykey) {
                        $morris_labels[] = $types[$morris_ykey];
                }

                foreach ($daily_rows as $row) {
                        $morris_data = '';
                        foreach ($morris_ykeys as $morris_ykey) {
                                $morris_data .= ', "'.$morris_ykey.'": '.$row[$morris_ykey];
                        }
                        $data []= '{"day": "'.$row['day'].'"'.$morris_data.' }';
                }

                $morris_ykeys = "'".implode("','", $morris_ykeys)."'";
                $morris_labels = "'".implode("','", $morris_labels)."'";

        }else{
                $morris_ykeys = "'".$type."'";
                $morris_labels = "'".$types[$type]."'";

                foreach ($daily_rows as $row) {
                        $data []= '{"day": "'.$row['day'].'"'.', "'.$type.'": '.$row[$type].' }';
                }
        }

        $data = "\n".implode(",\n", $data)."\n";
//	dpm($data);
?>
<div id="daily-chart"></div>

<script type="text/javascript">
        Morris.Line({
                element: 'daily-chart',
                data: [<?php echo $data;?>],
                xkey: 'day',
                ykeys: [<?php echo $morris_ykeys;?>],
                labels: [<?php echo $morris_labels;?>]
        });
</script>
<table class="widefat" cellspacing="0">
	<thead>
                <tr>
			<?php
				echo "<th>";
				echo t('DATE');
				echo "</th>";
				foreach ($types as $key=>$value) {
					echo "<th>";
					echo $value;
					echo "</th>";
				}
//				dpm($daily_rows);
			?>
	</thead>
	 <tbody>
			<?php
				foreach (array_reverse($daily_rows) as $row) {
					echo "<tr>";
					echo "<td>";
					echo $row['day'];
					echo "</td>";
					foreach ($types as $key=>$value) {
						echo "<td> $row[$key] </td>";
					}
					echo "</tr>";
				}
			?>
	</tbody>
</table>
