<?php
$this->printHead(
    array(
        'title' => array('title'=>'试卷管理', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/admin/index/backhead.css',
		               '/admin/paper/paper.css',
					   '/components/pageTable/pageTable.css')
        ,'js' => array('/admin/manyTrees.js',
        '/admin/paper/paper.js','/admin/common.js',
        '/admin/paper/papr_manage.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<script>
$(document).ready(function(){
	paprInitPaprManage();
	});
</script>
<!-- 2012 11 26 update block_5 > block_1 -->
<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner">
        
        <!-- // 顶部 -->
      <?php include(VIEW_DIR . "/admin/papr_top.php");?>
        
        <!-- //搜索  -->
        <div class="panel_1 con_input"  style="float:none;">
            <div class="title"><span><?php echo L::getText('试卷搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
            <div class="content">
                <div class="search" id="papr_search_param_div">
                    <div class="search_item">
                        <h1><?php echo L::getText('试卷名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
                        <input class="input3 ~auto_width" type="text" id="papr_name" name="papr_name" value="<?php echo isset($this->df_conditions['papr_name'])?$this->df_conditions['papr_name']:'';?>" />
                    </div>
                    
                    <div class="search_item">
                        <h1><?php echo L::getText('试卷分类', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
                        <a id="papr_category_name" name="papr_category_name" href="javascript:void(0)" onclick="paperCategoryTreeShow('papr_category_name','papr_category')"><?php echo isset($this->df_conditions['papr_category_desc'])?$this->df_conditions['papr_category_desc']:L::getText('请选择试卷分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
                        <input id="papr_category" type="hidden" value=""  name="papr_category" value="<?php echo isset($this->df_conditions['papr_category'])?$this->df_conditions['papr_category']:'';?>">
                    </div>
                    
                    <div class="search_item">
                        <h1><?php echo L::getText('试卷总分', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
                        <input class="input1 ~auto_width" type="text" id="papr_point" name="papr_point" value="<?php echo isset($this->df_conditions['papr_point'])?$this->df_conditions['papr_point']:'';?>" />
                    </div>
                    
                    <div class="search_item">
                        <h1><?php echo L::getText('试题总数', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
                        <input class="input1 ~auto_width" type="text" id="papr_qsn_count"  name="papr_qsn_count" value="<?php echo isset($this->df_conditions['papr_qsn_count'])?$this->df_conditions['papr_qsn_count']:'';?>" />
                    </div>
                    
                    <div class="search_item">
                        <h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
                        <select class="select2 ~auto_width" id="papr_status" name="papr_status" size="1">
                            <option value=""><?php echo L::getText('请选择试卷状态', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
                            	<?php foreach($this->papr_status as $psv){
								if($psv['c_cde'] !='020104'){?>
							<option value="<?php echo $psv['c_cde']?>"  <?php if(isset($this->df_conditions['papr_status'])&&$this->df_conditions['papr_status'] ==$psv['c_cde']){?>selected="selected"<?php }?>><?php echo $psv['desc_cn'] ?></option>
							<?php }
								}?>
                        </select>
                    </div>
					<div class="search_item">
						<h1><?php echo L::getText('试卷标签(用“,” 分割多个标签)', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3-5 ~auto_width" type="text" name="tag_names" id="tag_names" value="<?php echo isset($this->df_conditions['tag_names'])?$this->df_conditions['tag_names']:'';?>" />
					</div>
                    <div class="search_item">
                        <h1><?php echo L::getText('创建日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
                        <input id="create_tm_start" class="input2 ~auto_width Wdate" type="text" value="<?php echo isset($this->df_conditions['create_tm_start'])?$this->df_conditions['create_tm_start']:'';?>" name="create_tm_start" readonly="" style="width:100px; float:left;">
                        <input id="create_tm_end" class="input2 ~auto_width Wdate" type="text" value="<?php echo isset($this->df_conditions['create_tm_end'])?$this->df_conditions['create_tm_end']:'';?>" name="create_tm_end" readonly="" style="width:100px; float:left;">
                    </div>
                    
                </div>
                
                <div class="clear"></div>
                
                <!-- // Button -->
                <div class="button_area_search">
                    <div class="inner_box">
                        <a href="javascript:void(0)" class="btn2" id="search" onclick="paprSearchPaprList()"><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
                        <a href="javascript:void(0)" class="btn2" id="reset" onclick="paprResetSearchParams()"><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
                  
                    </div>
                </div>
              
            </div>
        </div>
        <form action="?a=updatePapr" method="POST" name="update_papr_form" id="update_papr_form">
		<input type="hidden" name="search_condition" id="search_condition" value="" />
		<input type="hidden" name="cur_page" id="cur_page" value="" />
		<input type="hidden" name="page_size" id="page_size" value="" />
		<input type="hidden" name="update_papr_id" id="update_papr_id" value="" />
		</form>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('试卷列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
            <div class="content">
                <!-- // toolbar  -->
                
                <div class="table_content" id="paper">
					<?php
					echo $this->papr_obj_tb;
					?>
                </div>
            </div>
        </div>
        <!-- // footer -->
      <?php include(VIEW_DIR.'/admin/footer.php');?>
    </div><!-- // box_inner end -->
    
</div><!-- // box end -->