<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程课件-添加课程', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/admin/index/backhead.css',
			'/admin/course/course.css'
        )
        ,'js' => array(
            '/admin/course/courseware/modfiyCourseware.js',
            '/admin/manyTrees.js'
        )
    )
);
?>

<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner">
        <?php
            if(!isset($_GET['share'])){
        ?>
        <!-- // 顶部 -->
        <div class="header">
        <?php
                require VIEW_DIR . '/admin/header.php';
                require VIEW_DIR . '/admin/course/header.php';
        ?>
        </div>
        <?php
            }
        ?>
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('课件搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onsubmit="modfiyCoursewareObj.searchSubmit(); return false;">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('课件名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="w_name" style="width:250px;" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('课件分类', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="w_category" style="width:250px;" onclick="modfiyCoursewareObj.coursewareCategoryClick()" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('标签', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="w_tagName" style="width:250px;" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('学时(分钟)', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input1 ~auto_width" type="text" id="w_length_min" />
                            <input class="input1 ~auto_width" type="text" id="w_length_max" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('所需积分', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input1 ~auto_width" type="text" id="w_credit_min" />
                            <input class="input1 ~auto_width" type="text" id="w_credit_max" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('课件创建日期', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input2" type="text" id="create_tm_min" />
                            <input class="input2" type="text" id="create_tm_max" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('创建人', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input2 ~auto_width" type="text" id="w_username" />
                        </div>
                    </div>
                    
                    <!-- // 高级搜索 -->
                    <div class="button_area_search" style="float:left;width:100%;">
                        <div class="inner_box"> <a href="#" class="btn2" onclick="modfiyCoursewareObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                    </div>
                    <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('课件列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content"> 
                <!-- //  -->
                
                <div class="table_content">
                    <?php echo $this->coursewareListPageTable; ?>
                </div>
            </div>
        </div>
        <!-- // footer -->
        <?php 
            if(!isset($_GET['share'])){
                require VIEW_DIR . '/admin/footer.php';
            }
        ?>
    </div>
    <!-- // box_inner end --> 
    
</div>
<!-- // box end -->