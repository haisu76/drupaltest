<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css',
                    )
                   ,'js' => array(
								  '/admin/songComm.js'
								  ,'/admin/manyTrees.js'
								  )   
                )
            );
?>
</head>

<body class="dialog_content">

<div class="panel_1 con_input">
	<div class="content">
		<div class="col_full">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:90px;" />
					<col style="" />
					<col style="" />
				</colgroup>
				<tr>
					<td><?php echo L::getText('姓名', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><input name="real_name" type="text" class="input1 auto_width" id="real_name" value="<?php echo $this->userInfoMsg['real_name'];?>" /></td>
					<td><?php echo L::getText('请填写真实姓名', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
				</tr>
				<tr>
					<td><?php echo L::getText('用户名', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><span><input name="username" type="text" class="input3 auto_width" id="username" value="<?php echo $this->userInfoMsg['username'];?>" /></span></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo L::getText('密码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><span><input name="pwd" type="text" class="input3 auto_width" id="pwd" value="" /></span></td>
					<td><?php echo L::getText('如果不想修改密码，请不要填写', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
				</tr>
				<tr>
					<td><?php echo L::getText('数据分组', array('file'=>__FILE__, 'line'=>__LINE__)); ?>：</td>
					<td id="user_group_td">
                   <?php echo admin_user_permissions::dataStratifiedHtml($this->userInfoMsg['user_id'],'t_user'); ?>
                    </td>
                    <td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo L::getText('电子邮件', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><input name="email" type="text" class="input3 auto_width" id="email" value="<?php echo $this->userInfoMsg['email'];?>" /></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo L::getText('性别', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td>
                    <?php 
						if($this->userInfoMsg['gender']=='1'){
					?>
						<label><input class="radiobox" name="gender" type="radio" id="gender" value="1" checked="checked" /><?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__))?></label>&nbsp; &nbsp;
						<label><input class="radiobox" name="gender" type="radio" id="gender" value="0" /><?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
                     <?php
						} else { ?>
                        <label><input class="radiobox" name="gender" type="radio" id="gender" value="1"  /><?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__))?></label>&nbsp; &nbsp;
						<label><input class="radiobox" name="gender" type="radio" id="gender" value="0" checked="checked" /><?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
                        <?php }?>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo L::getText('证件号码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><input name="idcard" type="text" class="input3 auto_width" id="idcard" value="<?php echo $this->userInfoMsg['idcard'];?>" /></td>
					<td><?php echo L::getText('号码是唯一的', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
				</tr>
				<tr>
					<td><?php echo L::getText('准考证号', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><input name="examcard" type="text" class="input3 auto_width" id="examcard" value="<?php echo $this->userInfoMsg['examcard'];?>" /></td>
					<td><?php echo L::getText('号码是唯一的', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
				</tr>
				<tr>
					<td><?php echo L::getText('电话号码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><input name="tel" type="text" class="input3 auto_width" id="tel" value="<?php echo $this->userInfoMsg['tel'];?>" /></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo L::getText('手机号码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><input name="mobiletel" type="text" class="input3 auto_width" id="mobiletel" value="<?php echo $this->userInfoMsg['mobiletel'];?>" /></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo L::getText('审核状态', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td>
                    <?php 
						echo $this->userInfoMsg['status']=='070102'?
						"<img src='".ROOT_URL."/images/icon/icon_radio_on.gif'/>".L::getText('已通过', array('file'=>__FILE__, 'line'=>__LINE__)):
						"<img src='".ROOT_URL."/images/icon/icon_off.gif' />".L::getText('未通过', array('file'=>__FILE__, 'line'=>__LINE__));
                     ?>
                    </td>
                    <td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo L::getText('是否管理员', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td>
                        <label><input class="radiobox" name="isadmin" type="radio"  value="0" <?php echo $_GET['id'] === '1' ? 'disabled' : ''; ?> checked onClick="hidDiv()" /><?php echo L::getText('否', array('file'=>__FILE__, 'line'=>__LINE__))?></label>&nbsp; &nbsp;
                        <label><input class="radiobox" name="isadmin" type="radio"  value="1" <?php echo $this->userInfoMsg['isadmin'] ? 'checked' : ''; ?> onClick="adminPanel()" /><?php echo L::getText('是', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
                        <label id="adminPanel" <?php echo $this->userInfoMsg['isadmin'] ? '' : 'style="display:none"'; ?>>
                        <?php
							if($_GET['id'] !== '1')
							{
								echo "<a href='#' onClick='isAdmin(\"{$_GET['id']}\"); return false;'>".L::getText('修改管理权限', array('file'=>__FILE__, 'line'=>__LINE__))."</a>";
							}
						?>  
                        </label>
					</td>
					<td>&nbsp;</td>
				</tr>
				
			<tr><td colspan="3">
            <div id="adminView"></div> 
            <input type="hidden" id="adminGroup" value=""/>
            <input type="hidden" id="tGroupId" value="<?php echo $this->userInfoMsg['admin_id'];?>"/>
            <input type="hidden" id="adminGName" value="<?php echo $this->userInfoMsg['admin_name'];?>"/> 
            </td></tr>
			</table>
            <input type="hidden" id="user_id" value="<?php echo $this->userInfoMsg['user_id'];?>"/>
		</div>
		<?php if($this->userInfoMsg['isadmin'] != ""){
			
		}
		?>
		<div class="col_right">
			<!-- // 右边内容 -->
		</div>
	</div>
</div>
<script>
$(function(){
	var name    = $("#adminGName").val();
	var id      = $("#tGroupId").val();
	var nameArr = name.split(',');
	var idArr   = id.split(',');
	var obj     = {};
	for(var t in nameArr)
	{
		obj.name   = nameArr[t];
		obj.id = idArr[t];
		if(obj.id == "") break;
		viewCon(obj);
	}
})
function hidDiv()
{
	$('#adminPanel').css('display','none');
	$('#adminView').css('display','none');
}
function isAdmin(userId)
{
    var handle = window.L.openCom('oDialogDiv')(window.L.getText('修改管理权限'), 'iframe:' +window.L._adminUrl+ '/user/permissions.php?a=setUserPermissions&userId=' + userId, 'auto', {'maxHeight' : '80%'}, [2, function(callbak){
        if(callbak)
        {
            var temp = oDialogDiv.getAncestorWindow().document.getElementById('oDialogDiv_iframe_' + handle).contentWindow.setUserPermissionsObj;
            if(temp && temp.save() !== '1')
            {
                return false;
            }
        }
    }]);
}
function adminPanel()
{
	$("#adminPanel").css('display','');
	$("#adminView").css('display','');
}
function viewCon(dataObj)
{
	return ;    //BY Edgar.lee 取消无用代码
	$("#adminView").css("display",'');
	var text = window.L.getText('管理组 ')+' : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	var spanStr = $("#adminView").html();
	var spanId  = $("#adminGroup").val();
	
	if(spanStr.length == 0 && dataObj.id != "") $("#adminView").html(text);
	
	$("#adminView").append('<span id=gSpan_'+dataObj.id+'>'+dataObj.name+'&nbsp;&nbsp;</span>');
		$("#adminGroup").val(spanId+','+dataObj.id)
}

function treeOnCLick(event, treeId, treeNode)
{
	var dataObj = {'id':treeNode.id,'name':treeNode.name}
	if(treeNode.checked)
	{
		viewCon(dataObj);
	}else
	{
		delGroupPanel(dataObj.id)
	}
}

function delGroupPanel(id)
{
	var newGroupId = '';
	$("#gSpan_"+id).remove();
	var groupArr = $("#adminGroup").val().substr(1).split(",");
	for(var t in groupArr )
	{
		if(groupArr[t] != id)
		{
			newGroupId += (','+groupArr[t]);
		}
	}
	$("#adminGroup").val(newGroupId);
	$("#treeListgrouptrue_1_check").attr('checked',false)
	if($("#adminGroup").val() == "")
	{
		$("#adminView").css("display",'none');
	}
}
</script>
</body>
</html>