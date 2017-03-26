<?php
$this->printHead(
    array(
        'title' => array('title'=>'公告列表', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css',
            '/mainindex.css',
        )
    )
);
?>
<div id="container" class="box block_12">
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <div class="box_inner">
        
        <div id="menu" class="none">This is the Menu</div>
        
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <!-- // 侧边列 -->
            <?php index::rightShare(); ?>

            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div notice">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span><?php echo L::getText('公告列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div>
                        </h1>
                        <?php echo $this->noticeListPageTable; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
