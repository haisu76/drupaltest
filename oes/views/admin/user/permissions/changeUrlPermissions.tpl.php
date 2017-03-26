<table border="0" cellpadding="0">
    <tr>
        <td align="right"><?php echo L::getText('描述 :', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
        <td style="padding-left:5px;"><input id="urlPermissionsDescribe" class="input4" value="<?php echo $this->permissionsList['describe']; ?>" /><input type="hidden" id="urlPermissionsId" value="<?php echo $this->permissionsList['id']; ?>" /></td>
    </tr>
    <tr>
        <td align="right"><?php echo L::getText('路径 :', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
        <td style="padding-left:5px;"><input id="urlPermissionsPath" class="input4" value="<?php echo $this->permissionsList['path']; ?>" /></td>
    </tr>
    <tr>
        <td rowspan="2" align="right"><?php echo L::getText('包含 :', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
        <td style="padding-left:5px;"><input id="urlPermissionsConG" class="input4" value="<?php echo $this->permissionsList['matchParams']['G']['C']['T']; ?>" />GET</td>
    </tr>
    <tr>
        <td style="padding-left:5px;"><input id="urlPermissionsConP" class="input4" value="<?php echo $this->permissionsList['matchParams']['P']['C']['T']; ?>" />POST</td>
    </tr>
    <tr>
        <td rowspan="2" align="right" style="word-break:keep-all; white-space:nowrap;"><?php echo L::getText('排除 :', array('file'=>__FILE__, 'line'=>__LINE__));?><br /><font style="color:red;"><?php echo L::getText('(优先)', array('file'=>__FILE__, 'line'=>__LINE__));?></font></td>
        <td style="padding-left:5px;"><input id="urlPermissionsExcG" class="input4" value="<?php echo $this->permissionsList['matchParams']['G']['E']['T']; ?>" />GET</td>
    </tr>
    <tr>
        <td style="padding-left:5px; word-break:keep-all; white-space:nowrap;"><input id="urlPermissionsExcP" class="input4" value="<?php echo $this->permissionsList['matchParams']['P']['E']['T']; ?>" />POST</td>
    </tr>
</table>
