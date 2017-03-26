<?php
$this->printHead(
    array(
        'title' => array('title'=>'用户积分管理', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/main.css'
        )
        ,'js'=>array(
            '/admin/user/userCreditManagement.js'
        )
    )
);
?>
<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        <!-- // 顶部 -->
        <div class="header">
        <?php 
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/user/header.php';
        ?>
        </div>
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('生成积分卡', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form id="searchForm" onSubmit="userCreditManagementObj.generateSubmit(); return false;">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('充值金额', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="credit" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('生成数量', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="generateNum" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('过期时间', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input4 ~auto_width" type="text" id="service_time" />
                        </div>
                    </div>
                    
                    <!-- // 高级搜索 -->
                    <div class="button_area_search" style="float:left;width:100%;">
                        <div class="inner_box">
                            <a href="#" class="btn2" onclick="userCreditManagementObj.generateSubmit(); return false;" ><?php echo L::getText('生成', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('历史记录', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="clear"></div>
            <?php echo $this->userCreditGeneratedRecordPageTable; ?>
        </div>
        <!-- // footer -->
        <?php 
            require VIEW_DIR . '/admin/footer.php';
        ?>
    </div>
    <!-- // box_inner end --> 
    
</div>
<!-- // box end -->