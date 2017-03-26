<?php
$this->printHead(
    array(
        'title' => array('title'=>'用户权限', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/main.css',
            '/components/pageTable/pageTable.css'
        )
        ,'js' => array(
            '/admin/manyTrees.js',
            '/admin/user/permissions/setUserPermissions.js'
        )
    )
);
?>
<div style="height:250px; width:1px; position:absolute; top:0px; left:-1px;"><!-- IE6下最小高度250px --></div>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
    <div id="tabs1" class="con_tab">
        <div class="tab_title">
            <a style="font-weight: bold;" class="current">
                <label><input type="radio" value="lectureOneDiv" name="lectureDiv" onclick="setUserPermissionsObj.tabPermissions(this);" checked class="radiobox"><?php echo L::getText('数据管理', array('file'=>__FILE__, 'line'=>__LINE__));?></label>
            </a>
            <a style="font-weight: normal;" class="">
                <label><input type="radio" value="lectureTwoDiv" name="lectureDiv" onclick="setUserPermissionsObj.tabPermissions(this);" class="radiobox"><?php echo L::getText('功能管理', array('file'=>__FILE__, 'line'=>__LINE__));?></label>
            </a>
            <a style="font-weight: normal;" class="">
                <label><input type="radio" value="lectureThrDiv" name="lectureDiv" onclick="setUserPermissionsObj.tabPermissions(this);" class="radiobox"><?php echo L::getText('组管理', array('file'=>__FILE__, 'line'=>__LINE__));?></label>
            </a>
        </div>
        <div class="clear"></div>
        <div style="min-height: 200px;" class="tab_content" id="lectureOneDiv">
            <table class="pageTable" id="stratifiedListTable">
                <thead>
                    <tr>
                        <th><span class="l"> <span class="icon_add no_margin"></span><a id="addStratifiedTree" onclick="setUserPermissionsObj.addStratifiedClickFun(this); return false;" href="#"><?php echo L::getText('添加数据分组', array('file'=>__FILE__, 'line'=>__LINE__));?></a></span><?php echo L::getText('分组名称', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                        <th><?php echo L::getText('当前状态', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                        <th><?php echo L::getText('包含下级组', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                        <th><?php echo L::getText('操作', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div style="display: none; min-height: 200px; position:relative;" class="tab_content" id="lectureTwoDiv">
            <div style="margin-left:80px; margin-top:-15px; position:absolute; left:15px; top:15px;">
                <label style="cursor:pointer;"><input type="checkbox" onclick="setUserPermissionsObj.urlPermissionsSelectAll(this)" /><?php echo L::getText('全选', array('file'=>__FILE__, 'line'=>__LINE__));?></label>
                <label style="cursor:pointer;"><input type="checkbox" onclick="setUserPermissionsObj.urlPermissionsInvertSelect()" /><?php echo L::getText('反选', array('file'=>__FILE__, 'line'=>__LINE__));?></label>
            </div>
            <?php
                foreach($this->urlPermissionsList as &$v)
                {
            ?>
                <div style="width:230px; margin:5px 5px 0px; overflow:hidden; word-break:keep-all; white-space:nowrap; float:left;"><label><input id="urlPermissionsId_<?php echo $v['id'] ?>" type="checkbox" <?php echo $v['checked'] ?> /><?php echo $v['describe']; ?></label></div>
            <?php
                }
            ?>
        </div>
        <div style="display: none; min-height: 200px;" class="tab_content" id="lectureThrDiv">
            <table class="pageTable" id="groupListTable">
                <thead>
                    <tr>
                        <th><span class="l"> <span class="icon_add no_margin"></span><a id="addGroupTree" onclick="setUserPermissionsObj.addStratifiedClickFun(this); return false;" href="#"><?php echo L::getText('添加组', array('file'=>__FILE__, 'line'=>__LINE__));?></a></span><?php echo L::getText('分组名称', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                        <th><?php echo L::getText('当前状态', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                        <th><?php echo L::getText('包含子机构', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                        <th><?php echo L::getText('操作', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(function(){
    setUserPermissionsObj.init(<?php echo "'{$_GET['userId']}', {$this->stratifiedListJson}, {$this->groupListJson}"; ?>);
});
</script>