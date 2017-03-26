<?php
$this->printHead(
    array(
        'title' => array('title'=>'学习计划-添加计划', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/admin/index/backhead.css',
			'/admin/plan/plan.css'
        )
        ,'js'=>array(
            '/admin/plan/plan/modfiyPlan.js',
            '/admin/tag/tag.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="box block_2"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner">
        
        <!-- // 顶部 -->
        <div class="header">
        <?php 
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/plan/header.php';
        ?>
        </div>
        
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('搜索计划', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onSubmit="modfiyPlanObj.searchSubmit(); return false;">
                    <div class="search_item">
                        <h1><?php echo L::getText('计划名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                        <input class="input3 ~auto_width" type="text" id="p_name" />
                    </div>
                    <div class="search_item">
                        <h1><?php echo L::getText('课程名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                        <input class="input3 ~auto_width" type="text" id="c_name" />
                    </div>
                    <div class="search_item">
                        <h1><?php echo L::getText('计划分类', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                        <input class="input3 ~auto_width" type="text" id="desc_cn" onClick="modfiyPlanObj.getStudyPlanSourceListTreeClickFun(this)" />
                    </div>
                    <div class="search_item">
                        <h1><?php echo L::getText('创建人', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                        <input class="input3 ~auto_width" type="text" id="username" />
                    </div>
                    <div class="search_item">
                        <h1><?php echo L::getText('状态', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                        <select class="select2 ~auto_width" id="p_status">
                            <option value="0"><?php echo L::getText('不限', array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
                            <option value="1"><?php echo L::getText('可用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
                            <option value="2"><?php echo L::getText('编辑', array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
                            <option value="4"><?php echo L::getText('禁用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></option>
                            <!-- 3为审批,新版去掉 -->
                        </select>
                    </div>
                    <div class="search_item">
                        <h1><?php echo L::getText('学习时间', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                        <input class="input3 ~auto_width" type="text" id="p_begin_tm" />
                        <input class="input3 ~auto_width" type="text" id="p_end_tm" />
                    </div>
                    <!--add 2013 01 09-->
                    <div class="clear"></div>
                    <!-- // 搜索按钮 -->
                    <div class="button_area_search">
                        <div class="inner_box">
                            <a href="#" class="btn2" onClick="modfiyPlanObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <input type="submit" style="position:absolute; left:-10000px; width:0px;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('计划列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="clear"></div>
            <?php echo $this->modfiyPlanListPageTable; ?>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
    
</div>
