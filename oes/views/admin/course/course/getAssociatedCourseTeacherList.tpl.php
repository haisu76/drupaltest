<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程课件-选择教师', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/main.css'
        )
        ,'js'=>array(
            '/admin/course/course/getAssociatedCourseTeacherList.js',
            '/admin/manyTrees.js'
        )
    )
);
?>

<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('教师搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onsubmit="getAssociatedCourseTeacherListObj.searchSubmit(); return false;">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('教师姓名', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4" type="text" id="e_name" />
                        </div>
                        <div class="search_item">
                            <h1>&nbsp;</h1>
                            <a href="#" class="btn2" onclick="getAssociatedCourseTeacherListObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                    </div>
                    <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('教师列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <?php echo $this->getAssociatedCourseTeacherListPageTable; ?>
            </div>
        </div>
    </div>
</div>
