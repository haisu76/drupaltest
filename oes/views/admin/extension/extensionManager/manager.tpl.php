<?php
$this->printHead(
    array(
        'title' => array('title'=>'扩展管理', 'file'=>__FILE__, 'line'=>__LINE__),
        'css'   => array(
            '/admin/index/backhead.css',
            '/admin/extension/extensionManager/manager.css'
        ),
        'js'    => array(
            '/admin/extension/extensionManager/manager.js'
        )
    )
);
?>

<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner">
        <!-- // 顶部 -->
        <div class="header">
        <?php
        require VIEW_DIR . '/admin/databackup_top.php';
        ?>
        </div>
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('扩展列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <span class="col_right"><a href="#" onclick="managerObj.language(); return false;"><?php echo L::getText('更新语言包', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a><label><input type="checkbox" id="factory" onclick="managerObj.factory()" /><?php echo L::getText('开发模式', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label></span>
            <div class="content">
                <!-- //  -->
                
                <div class="table_content">
                    <?php echo $this->extensionPageTable; ?>
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