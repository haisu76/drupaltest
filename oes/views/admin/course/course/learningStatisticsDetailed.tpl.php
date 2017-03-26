<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程课件-课程监控', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/main.css'
        )
        ,'js'=>array(
            '/admin/course/course/learningStatisticsDetailed.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner">
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('用户搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onSubmit="learningStatisticsDetailed.searchSubmit(); return false;">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('用户名/ID/邮箱', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input type="text" value="" id="user_data" class="input4 ~auto_width">
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('用户姓名', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input type="text" value="" id="real_name" class="input4 ~auto_width">
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('所属组', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input type="text" onclick="learningStatisticsDetailed.getGroupListTreeClickFun(this)" id="desc_cn" class="input4 ~auto_width">
                        </div>
                    </div>
                    
                    <!-- // 高级搜索 -->
                    <div class="button_area_search" style="float:left;width:100%;">
                        <div class="inner_box">
                            <a href="#" class="btn2" onclick="learningStatisticsDetailed.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('用户列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="clear"></div>
            <?php echo $this->learningStatisticsDetailedPageTable; ?>
        </div>
    </div>
</div>