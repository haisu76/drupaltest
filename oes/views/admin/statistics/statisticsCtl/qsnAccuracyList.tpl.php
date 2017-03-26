<table style="" class="pageTable" id="qsn_accuracy_table">
<thead><tr>
<th style="text-align: left;width:165px;" _bottomth=""><font name="thTitle"><?php echo L::getText('统计样本', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
<th style="text-align: left;width:165px;" _bottomth=""><font name="thTitle"><?php echo L::getText('正确数', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
<th style="text-align: left;width:165px;" _bottomth=""><font name="thTitle"><?php echo L::getText('总数', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
<th style="text-align: left; width:165px;" _bottomth=""><font  name="thTitle" ><?php echo L::getText('正确率', array('file'=>__FILE__, 'line'=>__LINE__))?></font></th>
</tr></thead>
<tbody id="qsn_accuracy_tbody">
<?php 
if($this->accuracy_type == 'qsnlevel' || $this->accuracy_type == 'qsntype' || $this->accuracy_type == 'qsntag')
{
	$tr_bg = 'odd_bg';
	foreach($this->qsn_accuracy as $qa){
	
		?>
	<tr class="<?php echo $tr_bg;?>"><td><?php echo $qa['target_desc']?></td>
	<td><?php echo $qa['correct_count']?></td>
	<td><?php echo $qa['total_count']?></td><td><?php echo $qa['accuracy']?></td></tr>
	<?php 
		if($tr_bg == 'odd_bg'){ $tr_bg ='even_bg';}
		else{$tr_bg ='odd_bg';}
	}
}
?>
</tbody><tfoot><tr></tr></tfoot></table>
<?php if($this->accuracy_type == 'qsnsource' || $this->accuracy_type == 'qsncategory'){?>

<script>

var qsn_accuracy_list = <?php echo json_encode($this->qsn_accuracy);?>;
//alert(L.JSON.stringify(qsn_accuracy_list));

var tr_bg = 'odd_bg';

for(var i in qsn_accuracy_list){  
	var inner_html = '<tr id="'+qsn_accuracy_list[i].c_cde+'_tr"><td>';
	for(var a = 0 ;a < qsn_accuracy_list[i].level;a++)
	{
		inner_html +='&nbsp;&nbsp;&nbsp;';
	}
	inner_html += qsn_accuracy_list[i].desc_cn+'</td><td>'+qsn_accuracy_list[i].correct_count+'</td><td>'+qsn_accuracy_list[i].total_count+'</td><td>'+qsn_accuracy_list[i].accuracy+'</td></tr>';
	if(qsn_accuracy_list[i].level == 0)
	{
		$("#qsn_accuracy_tbody").append(inner_html);
	}else{
		$("#"+qsn_accuracy_list[i].p_cde+"_tr").after(inner_html);
	
	}
}  


</script>
<?php }?>