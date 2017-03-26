<?php
$this->printHead(
    array(
        'title' => array('title'=>'数据权限管理', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/user/user.css'
        )
        ,'js' => array(
            '/admin/user/permissions/dataStratifiedPermissions.js'
        )
    )
);
?>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        <?php include VIEW_DIR . '/admin/user_top.php'; ?>
        <!-- // 表格数据 -->
        <div class="panel_1 con_tree">
            <div class="title"><span><?php echo L::getText('数据权限', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            <div class="content"> 
                
                <!-- // 左列 -->
                <div style="border:1px #CCCCCC solid; width:450px; float:left; height:300px; overflow: auto;">
                    <ul id="dataStratifiedPermissions" class="ztree">
                    </ul>
                </div>
                
                <!-- // 右列 -->
                <div class="" style="border:1px solid #CCC; height:300px; float:left; margin-left:100px; width:400px; padding:0 15px;">
                    <h4 style="text-align:center; font-size:18px;"><?php echo L::getText('注意', array('file'=>__FILE__, 'line'=>__LINE__));?></h4>
                    <p><?php echo L::getText('添加组', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('选中要创建组的上一级节点，点击添加按钮', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('修改组名', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('选中要修改的组，点击编辑按钮', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('删除组', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('选中要删除的组，点击删除按钮', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('移动组', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('选中要移动的组，拖动到合适的位置即可。', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p><?php echo L::getText('最后点击保存按钮。', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                    <p style="color:red;"><?php echo L::getText('以上操作影响整站数据的所属范围,要慎重操作', array('file'=>__FILE__, 'line'=>__LINE__));?></p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <!-- // 主按钮区 -->
        <div class="button_area_search">
            <div class="center"> <a href="#" class="btn" onClick="dataStratifiedPermissionsObj.submit(); return false;" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a href="#" class="btn" onClick="window.location.reload(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
        </div>
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end -->
</div>
<script>
$(function(){
    dataStratifiedPermissionsObj.zTreeInit(<?php echo $this->dataStratifiedJson; ?>);
});
</script>