<?php
$this->printHead(
    array(
        'title' => array('title'=>'个人中心-我参加的考试', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/user_myEnteredExam.css',
        )
        ,'js' => array(
            '/user/myEnteredExam.js','/admin/manyTrees.js','/admin/common.js'
        )
    )
);
?>
<script>
$(document).ready(function(){
	myEnteredExamInit();
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
                   <div class="main_div center_exam">
						<h1 class="main_title">
							<div class="left">
								<span class="icon"></span><?php echo L::getText('我参加的考试', array('file'=>__FILE__, 'line'=>__LINE__))?>
							</div>
							
						</h1>
						
						<div class="exam_search" id="exam_search_param_div">
                            <div class="exam_search_t1_box">
                                <div class="exam_search_t1_title"><?php echo L::getText('考试名称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</div>
                                <div class="exam_search_t1_inputbox">
                               	<input class="input3 ~auto_width" type="text" name="exam_name" id="exam_name" />
                                </div>
                            </div>
                            <div class="exam_search_t1_box">
                                <div class="exam_search_t1_title"><?php echo L::getText('考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?>：</div>
                                <div class="exam_search_t1_inputbox">
                                    <a href="javascript:void(0)" onclick="examCategoryTreeShow('exam_category_name','exam_category',false)" id="exam_category_name" name="exam_category_name"><?php echo L::getText('请选择考试分类', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<input type="hidden" id="exam_category" name="exam_category" value="" />
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
                             <a href="javascript:void(0)" onclick="myEnteredSearchExamList()" class="btn2" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
							<a href="javascript:void(0)" onclick="myEnteredResetSearchParams()" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
                            </div>
                        </div>

						<?php echo $this->getEnteredExamPageTable;?>
						<!-- // 跳转链接 -->
				
					
					</div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>