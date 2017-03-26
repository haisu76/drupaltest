<?php
$this->printHead(
    array(
        'title' => array('title'=>'用户积分管理', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/main.css'
        )
        ,'js'=>array(
            '/admin/user/usersRechargeStatistics.js'
        )
    )
);
?>
<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner">
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('充值搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onSubmit="usersRechargeStatisticsObj.searchSubmit(); return false;">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('用户名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="username" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('使用时间', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input type="text" id="active_time_min" class="input2">
                            <input type="text" id="active_time_max" class="input2">
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('生成时间', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input type="text" id="create_tm_min" class="input2">
                            <input type="text" id="create_tm_max" class="input2">
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('过期时间', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input type="text" id="service_time_min" class="input2">
                            <input type="text" id="service_time_max" class="input2">
                        </div>
                    </div>
                    
                    <!-- // 高级搜索 -->
                    <div class="button_area_search" style="float:left;width:100%;">
                        <div class="inner_box">
                            <a href="#" class="btn2" onclick="usersRechargeStatisticsObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('充值记录', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="clear"></div>
            <?php echo $this->usersRechargeStatisticsPageTable; ?>
        </div>
    </div>
    <!-- // box_inner end --> 
    
</div>
<!-- // box end -->