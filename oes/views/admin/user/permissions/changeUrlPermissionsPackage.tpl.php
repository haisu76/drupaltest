<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="right" style="word-break:keep-all; white-space:nowrap;"><?php echo L::getText('描述 :', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
        <td style="padding:4px;"><input style="position:static;" id="urlPermissionsPackageDescribe" value="<?php echo $this->describe; ?>" class="input4" /><input type="hidden" id="urlPermissionsPackageId" value="<?php echo $this->permissionsId; ?>" /></td>
    </tr>
    <tr>
        <td align="right" style="word-break:keep-all; white-space:nowrap; vertical-align: middle;"><?php echo L::getText('权限 :', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
        <td><div style="width:730px;">
        <?php
            foreach($this->urlPermissionsBasicData as &$v)
            {
                if(!admin_user_permissions::shieldedUrlPermissions($v['path'] . '?a=' . $v['getA']))
                {
        ?>
                <div style="width:230px; margin:5px 5px 0px; overflow:hidden; word-break:keep-all; white-space:nowrap; float:left;"><label><input id="urlPermissionsId_<?php echo $v['id'] ?>" type="checkbox" style="position:static;" <?php echo $v['checked'] ?> /><?php echo L::getText($v['describe'], array('file'=>__FILE__, 'line'=>__LINE__)); ?></label></div>
        <?php
                }
            }
        ?>
        </div></td>
    </tr>
</table>