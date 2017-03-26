<?php
$this->printHead(
    array(
        'title' => array('title'=>'个人中心', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css',
        )
        ,'js' => array(
            '/user/myCourse.js'
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
                    <div class="main_div" id="tabs1">
                        <div class="tab">
                            <h1 class="main_title">
                                <div class="left"> <span class="icon"></span><?php echo L::getText('我的课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div>
                                <div class="right"> <a class="more_block" href="<?php echo ROOT_URL . '/course.php' ?>" > <span class="more_txt"><?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span> <span class="icon_more"></span> </a> </div>
                            </h1>
                            <div class="player_bottom_menu_box1">
                                <ul>
                                    <li onclick="myCourseObj.tabClickFun(this, 0);" id="player_bottom_menu_btn2"><a href="#" onClick="return false;"><?php echo L::getText('正在学习的课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                                    <li onclick="myCourseObj.tabClickFun(this, 1);"><a href="#" onClick="return false;"><?php echo L::getText('已经学过的课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- // tab内容1 -->
                        <div class="tab_content">
                            <?php echo $this->getCoursePageTableIng; ?>
                        </div>
                        
                        <!-- // tab内容2 -->
                        <div class="tab_content" style="display:none;">
                            <?php echo $this->getCoursePageTableEd; ?>
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