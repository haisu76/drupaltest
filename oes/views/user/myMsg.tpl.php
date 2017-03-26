<?php
$this->printHead(
    array(
        'title' => array('title'=>'个人中心-我的短消息', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css',
            '/mainindex.css',
        )
        ,'js' => array(
            '/user/myMsg.js'
        )
    )
);
?>
<div id="container" class="box block_12">
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <div class="box_inner">
        
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <?php index::rightShare(); ?>
            
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div center_msg">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span><?php echo L::getText('我的短消息', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div>
                            <span style="float:right;_padding-top:10px;"><a href="#" class="icon_link" onClick="myMsgObj.submitMsg(this); return false;" ><span class=" icon_msg"></span><?php echo L::getText('写信息', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></span>
                            <div class="right"> <a class="more_block none" href="#" title="更多"> <span class="more_txt">更多</span> <span class="icon_more"></span> </a> </div>
                        </h1>
                        <?php echo $this->myMsgListPageTable; ?>
                    </div>
                </div>
            </div>
            <!-- // main_body end --> 
            
        </div>
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
