<?php
$this->printHead(
    array(
        'title' => array('title'=>'功能权限管理', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/user/user.css'
        )
        ,'js' => array(
            '/admin/user/permissions/urlPermissionsPackage.js'
        )
    )
);
?>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        <?php include VIEW_DIR . '/admin/user_top.php'; ?>
        
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('权限搜索', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            <div class="content">
                <form onsubmit="urlPermissionsPackageObj.searchSubmit(); return false;" id="searchForm">
                    <div class="search">
                        <div class="search_item">
                            <h1><?php echo L::getText('描述内容', array('file'=>__FILE__, 'line'=>__LINE__));?></h1>
                            <input type="text" style="width:250px;" id="describe" class="input4 ~auto_width">
                        </div>
                    </div>
                    
                    <!-- // 高级搜索 -->
                    <div style="float:left;width:100%;" class="button_area_search">
                        <div class="inner_box"> <a onclick="urlPermissionsPackageObj.searchSubmit(); return false;" class="btn2" href="#"><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a onclick="document.getElementById('searchForm').reset(); return false;" class="btn2" href="#"><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                    </div>
                    <input type="submit" style=" position:absolute; left:-1000px; width:0px;">
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('权限列表', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            <div class="content">
                <?php echo $this->urlPermissionsPackagePageTable; ?>
            </div>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
</div>