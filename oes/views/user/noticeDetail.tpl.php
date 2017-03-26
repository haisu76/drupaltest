<?php
$this->printHead(
    array(
        'title' => array('title'=>'公告-详细内容', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css',
        )
    )
);
?>
<div id="container" class="box block_12">
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <div class="box_inner">
        
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <!-- // 侧边列 -->
            <?php index::rightShare(); ?>
            
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div article_detail">
                        <div style="height:50px;" class="detail_title">
                            <div style=" width:100%; text-align:left;"><h1 class="article_title"><?php echo $this->noticeDetail['notice_title']; ?></h1></div>
                            <div class="title_detail">
                                <dl class="dd">
                                    <dt><?php echo L::getText('发布时间：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                    <dd><?php echo $this->noticeDetail['create_tm']; ?></dd>
                                </dl>
                                <dl class="dd">
                                    <dt><?php echo L::getText('发布人：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                    <dd><?php echo $this->noticeDetail['username']; ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="content article_body">
						    <?php echo htmlspecialchars_decode($this->noticeDetail['notice_content']); ?>
                        </div>
                        
                        <!-- // 跳转链接 -->
                        <div class="jump_link"> <a href="?a=notice" class="icon_link" ><span class="icon_jump"></span><?php echo L::getText('转到公告列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>