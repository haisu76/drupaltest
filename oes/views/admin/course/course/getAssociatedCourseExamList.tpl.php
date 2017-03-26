<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程课件-选择试卷', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/main.css'
        )
        ,'js'=>array(
            '/admin/course/course/getAssociatedCourseExamList.js',
            '/admin/manyTrees.js'
        )
    )
);
?>

<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('试卷搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onsubmit="getAssociatedCourseExamListObj.searchSubmit(); return false;">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('试卷名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input3" type="text" id="exam_name" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('试卷分类', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input3" type="text" id="exam_category" onclick="getAssociatedCourseExamListObj.getExamCategoryListTreeClickFun(this)" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('考试开始日期', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input id="exam_begin_tm" class="input3" type="text" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('考试结束日期', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input id="exam_end_tm" class="input3" type="text" />
                        </div>
                        <div class="search_item">
                            <h1>&nbsp;</h1>
                            <a href="#" class="btn2" onclick="getAssociatedCourseExamListObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                    </div>
                    <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('试卷列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <?php echo $this->getAssociatedCourseExamListPageTable; ?>
            </div>
        </div>
    </div>
</div>
