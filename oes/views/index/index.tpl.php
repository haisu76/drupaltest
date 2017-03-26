<?php
$this->printHead(
    array(
        'title'=>array('title'=>'首页', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/mainindex.css',
        )
        ,'js'=>array(
            '/index/openIndex.js'
            ,'/exam/exam.js'
        )
    )
);
?>

<body>
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
                    <div class="main_div home_logged">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span> <?php echo L::getText('我要参加的考试', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                            <div class="right"> <a class="more_block" href="#" title="<?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?>"> <span class="more_txt"><?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?></span> <span class="icon_more"></span> </a> </div>
                        </h1>
                        <!-- // 列表项目 -->
                        <?php echo $this->getExamPageTable; ?>
                    </div>
                      <?php if(getLicenceInfo('Product', 'OTS')){?>
                    <div class="main_div course">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span><?php echo L::getText('我在学习的课程', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                            <div class="right"> <a class="more_block" href="<?php echo ROOT_URL; ?>/course.php"> <span class="more_txt"><?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?></span> <span class="icon_more"></span> </a> </div>
                        </h1>
                        <!-- // 列表项目 -->
                        <?php echo $this->getCoursePageTable; ?>
                    </div>
                    <?php }?> 
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>