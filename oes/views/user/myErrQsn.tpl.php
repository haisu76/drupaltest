<?php
$this->printHead(
    array(
        'title' => array('title'=>'个人中心-我的错题', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css',
        )
        ,'js' => array(
            '/user/myErrQsn.js','/admin/manyTrees.js','/admin/common.js'
        )
    )
);
?>
<script>
$(document).ready(function(){
	myErrQsnInit();
});
</script>
<div id="container" class="box block_12">
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>

    <div class="box_inner">
        
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <?php index::rightShare(); ?>
            
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                 <div class="main_div">
					
						
						<!-- // 搜索 -->
                        <div class="exam_search" id="exam_search_param_div">
                            <div class="exam_search_t1_box">
                                <div class="exam_search_t1_title"><?php echo L::getText('考试名称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</div>
                                <div class="exam_search_t1_inputbox">
                               	<input class="input3 ~auto_width" type="text" name="exam_name" id="exam_name" />
                               	</div>
                            </div>
                            <div class="exam_search_t1_box">
                                <div class="exam_search_t1_title"><?php echo L::getText('试题类型', array('file'=>__FILE__, 'line'=>__LINE__))?>：</div>
                                <div class="exam_search_t1_inputbox">
                                <select class="select3 ~auto_width" id="qsn_type" name="qsn_type">
									<option value=""><?php echo L::getText('请选择题型', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
									<?php foreach($this->qsn_type as $qtv){?>
									<option value="<?php echo $qtv['c_cde']?>" ><?php echo $qtv['desc_cn'] ?></option>
									<?php }?>
									</select>
                              </div>
                            </div>
                            <div class="exam_search_t1_box">
                                <div class="exam_search_t1_title"><?php echo L::getText('试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?>：</div>
                                <div class="exam_search_t1_inputbox">
                                  <a href="javascript:void(0)" onclick="qsnCategoryTreeShow('qsn_category_name','qsn_category',false)" id="qsn_category_name" name="qsn_category_name"><?php echo L::getText('请选择试题分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="qsn_category" name="qsn_category" value="" />
                      
                                    
                              </div>
                            </div>
                            <div class="exam_search_t1_box">
                                <div class="exam_search_t1_title"><?php echo L::getText('考试日期', array('file'=>__FILE__, 'line'=>__LINE__))?>：</div>
                                <div class="exam_search_t1_inputbox">
                                   <input  class="input2 ~auto_width" id="exam_begin_tm" name="exam_begin_tm" type="text" value="">
						<input  class="input2 ~auto_width" id="exam_end_tm" name="exam_end_tm" type="text" value="">
			
                              </div>
                            </div>
                        
                            <div class="exam_search_btn">
                              <a href="javascript:void(0)" onclick="myErrQsnSearchList()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<a href="javascript:void(0)" onclick="myErrQsnResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
                            </div>
                        </div>
                        <!-- // search end -->

					
					<div class="main_div center_error_exam">
						<h1 class="main_title">
							<div class="left">
								<span class="icon"></span><?php echo L::getText('我的错题', array('file'=>__FILE__, 'line'=>__LINE__))?>
							</div>
							
						</h1>
						
						<!-- // 列表项目 -->
						<?php echo $this->ErrQsnPageTable;?>
						<!-- // 跳转链接 
						<div class="jump_link">
							<a href="#" class="icon_link" ><span class="icon_jump"></span>转到课程列表</a>
							<a href="#" class="icon_link" ><span class="icon_home"></span>转到首页</a>
						</div>
					-->
					</div>
					
				</div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>