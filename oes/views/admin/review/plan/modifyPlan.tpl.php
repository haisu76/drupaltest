<?php
$this->printHead(
    array(
        'title' => array('title'=>'讲师评定-课程评定', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css' => array(
            '/admin/index/backhead.css',
			'/admin/review/review.css'
        )
        ,'js' => array(
            '/admin/review/plan/modfiyPlan.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="box block_3"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        
        <!-- // 顶部 -->
        <div class="header">
        <?php 
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/review/header.php';
        ?>
        </div>
        
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <form id="searchForm" onSubmit="modfiyPlanObj.searchSubmit(); return false;">
                <div class="title"><span><?php echo L::getText('学习计划搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
                <div class="content data_list_h2">
                    <dl>
                        <dt><?php echo L::getText('计划名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd>
                            <input class="input4 ~auto_width" type="text" id="p_name" />
                        </dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('计划分类：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd>
                            <input class="input4 ~auto_width" type="text" id="desc_cn" onClick="modfiyPlanObj.getGroupListTreeClickFun(this)" />
                        </dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('学习时间：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd>
                            <input class="input3 ~auto_width" type="text" id="start_time" />
                        </dd>
                        <dd>
                            <input class="input3 ~auto_width" type="text" id="end_time" />
                        </dd>
                    </dl>
                </div>
                <div class="clear"></div>
                
                <!-- // 搜索按钮 -->
                <div class="btn_area align_center">
                    <div class="inner_box" style="float:left;">
                        <a href="#" class="btn2" onclick="modfiyPlanObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                        <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                        <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                    </div>
                </div>
            </form>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('计划列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <div class="table_content">
                    <?php echo $this->planReviewListPageTable; ?>
                </div>
            </div>
        </div>
        
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
    
</div>