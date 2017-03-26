<?php
$this->printHead(
    array(
        'title'=>array('title'=>'计划', 'file'=>__FILE__, 'line'=>__LINE__)
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
                    <div class="main_div plan">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span><?php echo L::getText('学习计划', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                        </h1>
                        
                        <!-- // 列表项目 -->
                        <?php echo $this->getPlanPageTable; ?>
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