<?php
$this->printHead(
    array(
        'title' => array('title'=>'个人中心', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css',
        )
    )
);
?>
<div class="box block_12" id="container">
    <!-- // header -->
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <!-- // header end -->

    <div class="box_inner"> 

        <div id="menu" class="none">This is the Menu</div>

        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <?php index::rightShare(); ?>

            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div center_a">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span><?php echo L::getText(isset($_GET['type']) && $_GET['type'] === 'a_' ? '我回答的问题' : '我提出的问题', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div>
                    </h1>
                    </div>
                    <?php echo $this->getQuestionPageTable; ?>
                </div>
                <!-- // main_body end --> 
                
            </div>

            <!-- // box_inner -->
            <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
        </div>
    </div>
</div>