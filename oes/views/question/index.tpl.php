<?php
$this->printHead(
    array(
        'title'=>array('title'=>'问答列表', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/mainindex.css',
        )
    )
);
?>

<div id="container" class="box block_12">
    <!-- // header -->
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <!-- // header end -->

    <div class="box_inner"> 
        
        <div id="menu" class="none">This is the Menu</div>
        
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <!-- // 侧边列 -->
            <?php index::rightShare(); ?>
            
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div course_detail"> 
                        <!-- // 问答 -->
                        <div class="main_div faq_list"> 
                            <!-- // 问答 -->
                            <?php echo $this->getQuestionPageTable; ?>
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
