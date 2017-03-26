<?php
$this->printHead(
    array(
        'title' => array('title'=>'试卷管理', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array('/main.css')
        ,'js' => array('/admin/paper/paper.js','/admin/common.js','/order_data.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>

<script>
$(document).ready(function(){
	paprInitManageContentPage();
});
</script>
<!-- //搜索  -->
<div class="panel_1 con_input">
	<div class="content">
	

		<table width="100%" class="table1" id="papr_content_table">
			<colgroup>
				<col style="width:90px;" />
				<col style="width:50px;" />
				<col style="width:80px;" />
				<col style="width:100px;" />
				<col style="width:180px" />
				<col style="" />
				<col style="" />
				<col style="" />
			</colgroup>
			<thead>
				<tr>
					<th class="align_center"><?php echo L::getText('排序', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th><?php echo L::getText('序号', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th><?php echo L::getText('试题编号', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th><?php echo L::getText('题型', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th><?php echo L::getText('试题内容', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th><?php echo L::getText('分类', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th><?php echo L::getText('来源', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th><?php echo L::getText('难度', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
					<th class="action"></th>
				</tr>
			</thead>
			<tbody id="papr_content_tbody">
			<?php foreach($this->qsn_objs as $qsn){?>
				<tr id="papr_qsn_tr_<?php echo $qsn['qsn_id']?>">
				<td></td>
				<td id="papr_qsn_td_<?php echo $qsn['qsn_id']?>"></td>
				<td><?php echo $qsn['qsn_id']?><input type="hidden" value="<?php echo $qsn['qsn_id']?>" name="papr_qsn_content" id="papr_qsn_content_<?php echo $qsn['qsn_id']?>"/></td>
				<td><?php echo isset($qsn['qsn_type_desc'])?$qsn['qsn_type_desc']:L::getText('试题不存在', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
				<td><?php echo isset($qsn['qsn_content_display'])?$qsn['qsn_content_display']:L::getText('试题不存在', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
				<td><?php echo isset($qsn['qsn_category_desc'])?$qsn['qsn_category_desc']:''?></td>
				<td><?php echo isset($qsn['qsn_source_desc'])?$qsn['qsn_source_desc']:''?></td>
				<td><?php echo isset($qsn['qsn_level_desc'])?$qsn['qsn_level_desc']:''?></td>
				<td class="action" ></td>
				</tr>
			<?php }?>
			</tbody>
			<tfoot></tfoot>
		</table>

		<div class="clear"></div>
		
		<!-- // Button -->
		<div class="button_area_search">
			<div class="inner_box">
				<a href="javascript:void(0)" onclick="paprUpdateContent()" class="btn2" ><?php echo L::getText('确定', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="javascript:void(0)" onclick="window.parent.alertCloseAlertDiv()" class="btn2" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>
	</div>	
</div>