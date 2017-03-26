<?php
$this->printHead(
    array(
        'title'=>array('title'=>'首页', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css'
        )
        ,'js'=>array(
            '/index/openIndex.js'
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
                 <?php if(getLicenceInfo('Product', 'OTS')){?>
                    <div class="main_div home_item home_item_col3"> 
                        <!-- // 列表项目块 -->
                        <div class="list_block home_item_plan">
                            <h1 class="main_title">
                                <div class="left"> <span class="icon"></span><?php echo L::getText('学习计划', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                                <div class="right"> <a class="more_block none" href="#" > <span class="more_txt"><?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?></span> <span class="icon_more"></span> </a> </div>
                            </h1>
                            <div class="content">
                                <div class="inner">
                                    <ul>
                                        <li><a class="" href="#" ><?php echo L::getText('共', array('file'=>__FILE__, 'line'=>__LINE__)), $this->groupSum[0], L::getText('个分类', array('file'=>__FILE__, 'line'=>__LINE__));?>，<?php echo $this->elementNum['p_c_num'], L::getText('个学习计划', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- // 列表项目块 -->
                        <div class="list_block home_item_course">
                            <h1 class="main_title">
                                <div class="left"> <span class="icon"></span><?php echo L::getText('课程', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                                <div class="right"> <a class="more_block none" href="#" > <span class="more_txt"><?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?></span> <span class="icon_more"></span> </a> </div>
                            </h1>
                            <div class="content">
                                <div class="inner">
                                    <ul>
                                        <li><a class="" href="#" title=""><?php echo L::getText('共', array('file'=>__FILE__, 'line'=>__LINE__)), $this->groupSum[1], L::getText('个分类', array('file'=>__FILE__, 'line'=>__LINE__));?>，<?php echo $this->elementNum['c_c_num'], L::getText('个课程', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- // 列表项目块 -->
                        <div class="list_block home_item_training no_margin">
                            <h1 class="main_title">
                                <div class="left"> <span class="icon"></span><?php echo L::getText('练习', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                                <div class="right"> <a class="more_block none" href="#"> <span class="more_txt"><?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?></span> <span class="icon_more"></span> </a> </div>
                            </h1>
                            <div class="content">
                                <div class="inner">
                                    <ul>
                                        <li><a class="" href="#" title=""><?php echo L::getText('共', array('file'=>__FILE__, 'line'=>__LINE__)), $this->groupSum[2], L::getText('个分类', array('file'=>__FILE__, 'line'=>__LINE__));?>，<?php echo $this->elementNum['test_num'], L::getText('个练习', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="main_div home" id="tabs1">
                     <?php if(getLicenceInfo('Product', 'OTS')){?>
                        <div class="tab">
                            <div class="tab_title"> <a class="current" href="#" onclick="openIndex.tabCutover(this, 1); return false;"><?php echo L::getText('学习计划', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a class="" href="#" onclick="openIndex.tabCutover(this, 2); return false;"><?php echo L::getText('课程', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a class="" href="#" onclick="openIndex.tabCutover(this, 3); return false;"><?php echo L::getText('练习', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                        </div>
                       
                        <!-- // tab内容1 -->
                        <div id="tab_content_1" class="tab_content">
                            <?php echo $this->getPlanPageTable; ?>
                        </div>
                        
                        <!-- // tab内容2 -->
                        <div id="tab_content_2" class="tab_content" style="display:none;">
                            <?php echo $this->getCoursePageTable; ?>
                        </div>
                         <?php }?>
                        <!-- // tab内容3 -->
                        <div id="tab_content_3" class="tab_content" style=" <?php if(getLicenceInfo('Product', 'OTS')){?>display:none;<?php }?>">
                            <?php echo $this->getTestPageTable; ?>
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