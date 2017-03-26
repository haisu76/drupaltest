<?php
$this->printHead(
    array(
        'title'=>array('title'=>L::getText('考试', array('file'=>__FILE__, 'line'=>__LINE__)), 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/mainindex.css',
        )
        ,'js'=>array(
           '/exam/exam.js','/admin/common.js'
        )
    )
);
?>
<!-- 这里考虑能不能整合掉 -->
<script>
	var USER_IS_LOGIN = '<?php echo $this->user_is_login?>';
	var USER_ID = '<?php echo $this->user_id?>';
	var USER_STATUS = '<?php echo $this->user_status?>';
	var USER_GROUP = <?php echo json_encode($this->user_group)?>;
</script>
<!-- 这里考虑能不能整合掉 -->
<div id="container" class="box block_12">
     <!-- // header -->
        <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
        <!-- // header end -->
        <object id="ie" width=1 height=1 classid="clsid:68acce8b-f896-4091-bdc5-a93115a051dc">
    <param name="_version" value="65536">
    <param name="_extentx" value="164">
    <param name="_extenty" value="164">
    <param name="_stockprops" value="0">
</object>
    <div class="box_inner"> 
   
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <!-- // 侧边列 -->
            <?php index::rightShare(); ?>
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div course">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span><?php echo L::getText('练习列表', array('file'=>__FILE__, 'line'=>__LINE__))?> </div>
                            <div class="right">
                            </div>
                        </h1>
                        <!-- // 考试项目 -->
                        <?php echo $this->getExamPageTable; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
<script>
window.L.extension.injectLogin(function(){
    window.L.extension.pageTable.classObj.load($('table[_pagetabledataset]').get(0));
}, 'loginAfter');
</script>