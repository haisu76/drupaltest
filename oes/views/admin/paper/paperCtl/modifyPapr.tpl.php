<?php
$this->printHead(
    array(
        'title' => array('title'=>'修改试卷', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array('/admin/index/backhead.css',
		               '/admin/paper/paper.css')
        ,'js' => array('/admin/manyTrees.js','/admin/tag/tag.js','/admin/paper/paper.js',
        '/admin/question/question.js','/admin/common.js','/order_data.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
QSN_TYPE_ALLOW_CATEGORY = <?php echo empty($this->qsn_type_allow_category)?'null':$this->qsn_type_allow_category;?>;
$(document).ready(function(){
	<?php //普通卷
	if($this->papr_obj['papr_type'] == '020301'){?>
	PAPR_QSN_TYPE_POSITION.normal = <?php echo count($this->papr_obj['papr_qsn_type'])?>;
	<?php }
	//随机卷
	else{?>
	PAPR_QSN_TYPE_POSITION.random = <?php echo count($this->papr_obj['papr_qsn_type'])?>;
	<?php }?>
	paprInitEditPage();
});
</script>
<form id="manage_papr_form" name="manage_papr_form" action="?a=index" method="post">
<input id="_pageTableParams" type="hidden" name="_pageTableParams" value='<?php echo isset($this->search_condition)?urldecode($this->search_condition):''?>' />
<input id="_pageTableCurPage" type="hidden" name="_pageTableCurPage" value="<?php echo isset($this->cur_page)?$this->cur_page:'1'?>" />
<input id="_pageTablePageSize" type="hidden" name="_pageTablePageSize" value="<?php echo isset($this->page_size)?$this->page_size:'10'?>" />
</form>
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<!--add 2012 11 27 div class="box_inner"-->
     <div class="box_inner">
	<?php include(VIEW_DIR . "/admin/papr_top.php");?>
		<div id="papr_params_div">
		<!-- // 数据 -->
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('试卷数据', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<input type="hidden" value="<?php echo $this->papr_obj['papr_id']?>" id="papr_id" name="papr_id">
			<div class="content con_paper">
				<div class="col_left">
                <!--del 2012 11 27 width="100%" -->
					<table  border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:80px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('试卷名称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input3 auto_width" style="width:100%;" id="papr_name" type="text" value="<?php echo $this->papr_obj['papr_name'] ?>" /></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td class="align_top"><?php echo L::getText('试卷说明', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
								<textarea id="papr_des" style="width:393px; height:80px;"><?php echo $this->papr_obj['papr_des'] ?></textarea>
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</div>
				<div class="col_right">
					<table  border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:110px;" />
							<col style="" />
						</colgroup>
						
						<tr>
							<td><?php echo L::getText('试卷分类', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
							<a href="javascript:void(0)" onclick="paperCategoryTreeShow('papr_category_name','papr_category')" id="papr_category_name" name="papr_category_name"><?php echo $this->papr_obj['papr_category_desc'] == ''?L::getText('请选择试卷分类', array('file'=>__FILE__, 'line'=>__LINE__)):$this->papr_obj['papr_category_desc'] ?></a>
							<input type="hidden" id="papr_category" name="papr_category" value="<?php echo $this->papr_obj['papr_category']?>" />
							
                             </td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><?php echo L::getText('试卷状态', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
							<select class="select1 ~auto_width" id="papr_status" name="papr_status">
							<?php foreach($this->papr_status as $psv){
								if($psv['c_cde'] !='020104'){?>
							<option value="<?php echo $psv['c_cde']?>" <?php if($psv['c_cde'] == $this->papr_obj['papr_status']){?>selected="selected"<?php }?>><?php echo $psv['desc_cn'] ?></option>
							<?php }
								}?>
							</select>
							</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><?php echo L::getText('试卷类型', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
							<select class="select3 ~auto_width" id="papr_type" name="papr_type" onchange="paprTypeChange()">
							<?php foreach($this->papr_type as $pst){?>
							<option value="<?php echo $pst['c_cde']?>" <?php if($pst['c_cde'] == $this->papr_obj['papr_type']){?>selected="selected"<?php }?>><?php echo $pst['desc_cn'] ?></option>
							<?php 
								}?>
							</select>
							</td>
							<td>&nbsp;</td>
						</tr>

						<tr>
							<td><a href="javascript:void(0)" class="icon_link" id="addTag" onclick="paperDisplayTag()"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;+</a>
							</td>
							<td id="papr_tag_td">
							<?php if(isset($this->papr_obj['tag_ids'])&&$this->papr_obj['tag_ids'][0]!=''){
								foreach ($this->papr_obj['tag_ids'] as $tik=>$tiv){
								?>
								<span class="icon_link" id="papr_tag_span_<?php echo $tiv?>">
								<input type="hidden" name="papr_tags" id="papr_tag_<?php echo $tiv?>" value="<?php echo $tiv?>">
								<a href="javascript:void(0)" ><?php echo $this->papr_obj['tag_names'][$tik]?></a>
								<a class="icon_del" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__))?>" href="javascript:void(0)" onclick="paprDelTag('<?php echo $tiv?>')"></a>
								</span>
							<?php }
							}?>
							</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><?php echo L::getText('数据分组', array('file'=>__FILE__, 'line'=>__LINE__)); ?>：</td>
							<td id="papr_group_td">
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<?php echo admin_user_permissions::dataStratifiedHtml(empty($this->papr_obj['papr_id']) ? null : $this->papr_obj['papr_id'], 't_paper','','papr_group_td'); ?>
		<!-- 抽取试题部分 -->
		<div class="panel_1 con_table">
		<!-- 公共部分start -->
			<div class="content">
				<!-- // toolbar  -->
				<div class="table_content">
					<div class="" style="margin-bottom:10px;">
					<?php foreach($this->qsn_type as $qt){?>
						<a class="icon_link" onclick="paprAddQsnType('<?php echo $qt['c_cde']?>','<?php echo $qt['desc_cn']?>')" href="javascript:void(0)" ><span class="icon_add"></span><?php echo $qt['desc_cn']?></a>
					<?php }?>
					</div>
				</div>
			</div>
		<!-- 公共部分end -->	
		<!-- 普通试卷列表start -->
			<div id="normal_papr_div" class="content" style="display:none; width:100%;">
				<table width="100%" class="table1" id="normal_papr_table">
					<colgroup>
						<col style="width:90px;" />
						<col style="width:100px;" />
						<col style="width:65px;" />
						<col style="" />
						<col style="width:65px;" />
					</colgroup>
					<thead>
						<tr>
							<th class="align_center"><?php echo L::getText('排序', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('题型', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('数量', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('题型标题', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('每题分数', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th class="action"></th>
						</tr>
					</thead>
					<tbody id="normal_papr_tbody">
					<?php 
					if($this->papr_obj['papr_type'] == '020301'&&isset($this->papr_obj['papr_qsn_type'])){
					foreach($this->papr_obj['papr_qsn_type'] as $pqt){?>
					<tr id="papr_normal_qsn_type_pos_<?php echo $pqt['qsn_type_position']?>" qsn_type_mark="<?php echo $pqt['qsn_type_position']?>">
					<td></td>
					<td><?php echo $pqt['qsn_type_desc']?>
					<?php $papr_content = '{';
					foreach($pqt['papr_qsn_content'] as $pqc){
						$papr_content.="'{$pqc['qsn_position']}':{'qsn_id':'{$pqc['qsn_id']}','qsn_position':'{$pqc['qsn_position']}'},";
					}
					$papr_content = rtrim($papr_content,',').'}';
					?>
					<input type="hidden" value="<?php echo $papr_content;?>" id="papr_content_<?php echo $pqt['qsn_type_position']?>" name="papr_content"/>
					<input type="hidden" value="<?php echo $pqt['qsn_type']?>" id="p_qsn_type_<?php echo $pqt['qsn_type_position']?>" name="p_qsn_type"/></td>
					<td id="papr_content_count_<?php echo $pqt['qsn_type_position']?>"><?php echo count($pqt['papr_qsn_content'])?></td>
					<td><input class="input2 auto_width" type="text" value="<?php echo $pqt['qsn_type_title']?>" id="qsn_type_title_<?php echo $pqt['qsn_type_position']?>" name="qsn_type_title"></td>
					<td><input class="input2 auto_width" type="text" value="<?php echo $pqt['qsn_point']?>" id="qsn_point_<?php echo $pqt['qsn_type_position']?>" name="qsn_point"></td>
					<td class="action">&nbsp;<div class="action_toolbar" >
					<div class="inner"><div class="right"></div>
					<div class="inner_box"><div class="action_link">
					<a class="iframe" href="javascript:void(0)" onclick="paprModifyContent(<?php echo $pqt['qsn_type_position']?>,'add','<?php echo $pqt['qsn_type']?>')" title="<?php echo L::getText('添加试题', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('添加试题', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					<a class="iframe" href="javascript:void(0)" onclick="paprModifyContent(<?php echo $pqt['qsn_type_position']?>,'select','<?php echo $pqt['qsn_type']?>')" title="<?php echo L::getText('选择试题', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('选择试题', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					<a class="iframe" href="javascript:void(0)" onclick="paprModifyContent(<?php echo $pqt['qsn_type_position']?>,'manage','<?php echo $pqt['qsn_type']?>')" title="<?php echo L::getText('管理试题', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('管理试题', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div></div></div></div></td></tr>
					<?php }
					}?>
					</tbody>
					<tfoot></tfoot>
				</table>
			</div>
		<!-- 普通试卷列表end -->
		<!-- 随机试卷列表start -->
			<div id="random_papr_div" class="content" style="display: none; width:100%;">
			<table width="100%" class="table1" id="random_papr_table">
					<colgroup>
						<col style="width:90px;" />
						<col style="width:100px;" />
						<col style="width:65px;" />
						<col style="" />
						<col style="width:65px;" />
					</colgroup>
					<thead>
						<tr>
							<th class="align_center"><?php echo L::getText('排序', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('题型', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('数量', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('题型标题', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('每题分数', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
							<th><?php echo L::getText('试题难度', array('file'=>__FILE__, 'line'=>__LINE__))?></th>
						</tr>
					</thead>
					<tbody id="random_papr_tbody">
					<?php 
					if($this->papr_obj['papr_type'] != '020301'&&isset($this->papr_obj['papr_qsn_type'])){
					foreach($this->papr_obj['papr_qsn_type'] as $pqt){
						$qsn_level_info = "{'qsn_type_pos':'".$pqt['qsn_type_position']."','qsn_level_info':{";
						$qsn_level_desc = "";
						$qsn_category_info = "";
						$qsn_category_desc = "";
						$qsn_category_name = "";
						$qsn_category_id = "";
						$qsn_category_info = "";
						$papr_content_count = 0;
						foreach($pqt['papr_qsn_level'] as $pql){
							$qsn_level_desc.=$pql['qsn_level_desc'].'('.$pql['qsn_count'].'),';
							$qsn_level_info.="'".$pql['qsn_level']."':{'qsn_level':'".$pql['qsn_level']."','qsn_count':'".$pql['qsn_count']."','qsn_type_pos':'".$pqt['qsn_type_position']."'},";
							$papr_content_count += $pql['qsn_count'];
						}
						$qsn_level_desc = rtrim($qsn_level_desc,',');
						$qsn_level_info= rtrim($qsn_level_info,',').'}}';
						foreach($pqt['papr_qsn_category'] as $pqc){
							$qsn_category_desc.=$pqc['qsn_category_desc'].',';
							$qsn_category_name .= "'".$pqc['qsn_category']."':'".$pqc['qsn_category_desc']."',";
							$qsn_category_id .= "'".$pqc['qsn_category']."':'".$pqc['qsn_category']."',";
							$qsn_category_info .= "'".$pqc['qsn_category']."':{'qsn_category':'".$pqc['qsn_category']."'},";
						}
						$qsn_category_name = rtrim($qsn_category_name,',');
						$qsn_category_id = rtrim($qsn_category_id,',');
						$qsn_category_info = rtrim($qsn_category_info,',');
						
						$qsn_category_info = empty($qsn_category_name)?'':"{'name':{".$qsn_category_name."},'id':{".$qsn_category_id."},'qsn_category_info':{".$qsn_category_info."}}";
						$qsn_category_desc = rtrim($qsn_category_desc,',');
					?>
					<tr qsn_type_mark="<?php echo $pqt['qsn_type_position']?>" id="papr_random_qsn_type_pos_<?php echo $pqt['qsn_type_position']?>">
					<td></td>
					<td><?php echo $pqt['qsn_type_desc']?>
					<input type="hidden" name="r_papr_content" id="r_papr_content_<?php echo $pqt['qsn_type_position']?>" value="">
					<input type="hidden" name="p_r_qsn_type" id="p_r_qsn_type_<?php echo $pqt['qsn_type_position']?>" value="<?php echo $pqt['qsn_type']?>"></td>
					<td id="r_papr_content_count_1"><?php echo $papr_content_count;?></td>
					<td><input type="text" name="r_qsn_type_title" id="r_qsn_type_title_<?php echo $pqt['qsn_type_position']?>" value="<?php echo $pqt['qsn_type_title']?>" class="input2 auto_width"></td>
					<td><input type="text" name="r_qsn_point" id="r_qsn_point_<?php echo $pqt['qsn_type_position']?>" value="<?php echo $pqt['qsn_point']?>" class="input2 auto_width"></td>
					<td><a name="p_qsn_category_desc" id="p_qsn_category_desc_<?php echo $pqt['qsn_type_position']?>" onclick="paprSelectQsnCategory(<?php echo $pqt['qsn_type_position']?>)" href="javascript:void(0)"><?php echo empty($qsn_category_desc)?L::getText('请选择分类', array('file'=>__FILE__, 'line'=>__LINE__)):$qsn_category_desc;?></a>
					<input type="hidden" name="p_qsn_category" id="p_qsn_category_<?php echo $pqt['qsn_type_position']?>" value="<?php echo $qsn_category_info?>"></td>
					<td><a name="p_qsn_level_desc" id="p_qsn_level_desc_<?php echo $pqt['qsn_type_position']?>" onclick="paprSelectQsnLevel(<?php echo $pqt['qsn_type_position']?>)" href="javascript:void(0)"><?php echo  empty($qsn_level_desc)?L::getText('请选择难度', array('file'=>__FILE__, 'line'=>__LINE__)):$qsn_level_desc;?></a>
					<input type="hidden" name="p_qsn_level" id="p_qsn_level_<?php echo $pqt['qsn_type_position']?>" value="<?php echo $qsn_level_info?>"></td></tr>
					<?php }
					}?>
					</tbody>
					<tfoot></tfoot>
				</table>
			</div>
		<!-- 随机试卷列表end -->
		</div>
	<!-- 抽取试题部分end -->
	<div class="button_area_search">
		<div class="center">
			<a href="javascript:void(0)" onclick="paprAddOrUpdatePapr();" id="papr_save_btn" class="btn"><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			<a href="javascript:void(0)" onclick="$('#manage_papr_form').submit();return false;" class="btn"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
		</div>
	</div>
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div>
    </div>
</div>
