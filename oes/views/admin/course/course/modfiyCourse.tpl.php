<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程课件-课程列表', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/admin/index/backhead.css',
			'/admin/course/course.css'
        )
        ,'js'=>array(
            '/admin/course/course/modfiyCourse.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
    <?php
        if(!isset($_GET['share']))
        {
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
            <div class="title"><span><?php echo L::getText('课程搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onSubmit="modfiyCourseObj.searchSubmit(); return false;">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('课程名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="c_name" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('课程分类', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="desc_cn" onClick="modfiyCourseObj.getGroupListTreeClickFun(this)" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <select class="select2 ~auto_width" size="1" id="c_status">
                                <option value="0"><?php echo L::getText('不限', array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
                                <option value="1"><?php echo L::getText('启用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
                                <option value="2"><?php echo L::getText('禁用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
                            </select>
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('标签(多个标签用空格分割)', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="tag_name" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('课程创建日期', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input3 ~auto_width" type="text" id="min_create_tm" />
                            <input class="input3 ~auto_width" type="text" id="max_create_tm" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('创建人', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input2 ~auto_width" type="text" id="username" />
                        </div>
                    </div>
                    
                    <!-- // 高级搜索 -->
                    <div class="button_area_search" style="float:left;width:100%;">
                        <div class="inner_box">
                            <a href="#" class="btn2" onclick="modfiyCourseObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('课程列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="clear"></div>
            <?php echo $this->modfiyCourseListPageTable; ?>
        </div>
        <!-- // footer -->
        <?php 
            if(!isset($_GET['share']))
            {
                require VIEW_DIR . '/admin/footer.php'; 
            }
        ?>
    </div>
    <!-- // box_inner end --> 
    
</div>
<!-- // box end -->