<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/user/user.css'
                    )
                   ,'js' => array(
								  '/admin/songComm.js',
								  '/admin/user/userAdd.js',
								  '/admin/manyTrees.js'
								  )   
                )
            );
?>
<link href="../favicon.ico" rel="shortcut icon">
</head>

<body>
<style>
.warning{ border:red 1px solid; background:#FCC}
.hand{cursor:pointer;}
</style>

<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
        <!-- // 顶部 -->

				<?php include(VIEW_DIR.'/admin/user_top.php');?>
		<!-- // 用户资料 -->
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('用户资料', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            	<div class="content">
            	<form action="" id="user_form"></form>
				<div class="col_left" style="width:50%;">
<script>
function showUserGroup(){
	var option = {
		'targetId':'select_target_name',
		'targetNameId':'group_name',
		'targetValueId':'group',
		'dataType':'group', 
		'isCheckBox':false,
		'showRoot':false,
		'allowCheckParent':true,//是否允许选择父菜单
		'expandLevel':2
	};
	getTree(option);
}
</script>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('所属组：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td>
								<input class="input1 auto_width hand" type="text" name="group_name" id="group_name" readonly onClick="showUserGroup()" /> <input type="hidden" id="group"/>
							</td>
						</tr>
					
						<tr>
							<td><?php echo L::getText('用 户 名：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input1 auto_width" type="text" name="username" id="username" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" type="text" name="real_name" id="real_name" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" type="password" name="pwd" id="pwd" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('确认密码：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" type="password" name="repwd" id="repwd" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td>
							<label>
                            <input class="radiobox"  type="radio" name="gender"  value="1" id="gender1" checked/> 
                            </label> 
                            <label for="gender1" class="hand">
							<?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__));?>
                            </label>
                                   
							<label class="hand">
                            <input class="radiobox" type="radio" name="gender" value="0" style="padding-left:31px;"/>
							<?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__));?>
                            </label>
							</td>

						</tr>
						<tr>
							<td><?php echo L::getText('审核状态：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td>
							<label class="hand">
                            <input class="radiobox" name="status" type="radio" checked="checked" value="070102"/>
                            <?php echo L::getText('已通过', array('file'=>__FILE__, 'line'=>__LINE__));?>
                            </label>
							<label class="hand">
                            <input class="radiobox" name="status" type="radio"  value="070101" style="padding-left:5px;"/>
							<?php echo L::getText('未通过', array('file'=>__FILE__, 'line'=>__LINE__));?>
                            </label>
							</td>
						</tr>
						<tr>
							<td><?php echo L::getText('是否管理员：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td>
                            <label class="hand"><input class="radiobox" name="isadmin" type="radio"  value="0"  checked="checked" onClick="hiddDiv()"/><?php echo L::getText('否', array('file'=>__FILE__, 'line'=>__LINE__));?></label>
                            <label class="hand">
                            <input class="radiobox" name="isadmin" type="radio" value="1" onClick="adminPanel()" style="padding-left:35px;"/>
							<?php echo L::getText('是', array('file'=>__FILE__, 'line'=>__LINE__));?>
                            </label>
                            </td></tr>
                        <tr>
                        <td colspan="2">
                        <div id="adminView"></div>
                        <input type="hidden" id="adminGroup"/>
                        </td>
                        </tr>
                        
                        <tr>
                        <td colspan="2">
                        <div id="role" style="display:none"><span style="margin-left:30px;"></span>
                        <input type="hidden" id="role_id"/></div>
                        </td>
                        </tr>
					</table>
				</div>
				<div class="col_right">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:110px;" />
							<col style="" />
						</colgroup>
						
						<tr>
							<td><?php echo L::getText('证件号码：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" name="idcard" type="text" id="idcard" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('准考证号：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input1 auto_width" type="text" name="examcard" id="examcard" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" type="text" name="tel" id="tel" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('手机号码：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" type="text" name="mobiletel" id="mobiletel" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('E-mail：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" type="text" name="email" id="email" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('出生日期：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" name="birthday" type="text"  id="birthday"  readonly /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('职&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位：', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></td>
							<td><input class="input3 auto_width" name="position" type="text" id="position" alt="" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('数据分组', array('file'=>__FILE__, 'line'=>__LINE__)); ?>：</td>
							<td id="user_group_td"><?php echo admin_user_permissions::dataStratifiedHtml(null,'t_user'); ?></td>
						</tr>
						
					</table>
				</div>
				</form>
			</div>
            
		</div>
        <!--add 2012 11 28 <div class="clear"></div>-->
        <div class="clear"></div>
        <iframe style="display:none" name="hiddenifr"></iframe>
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area_search">
			<div class="center">
				<a href="#" class="btn" id="save"><?php echo L::getText('保&nbsp;&nbsp;&nbsp;&nbsp;存', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a>
				<a href="#" class="btn" id="f" onClick="clsSubmitForm()" ><?php echo L::getText('清&nbsp;&nbsp;&nbsp;&nbsp;空', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a>
			</div>
		</div>
        <!-- // footer -->
        <?php require VIEW_DIR .'/admin/footer.php'; ?>
	</div><!-- // box_inner end -->
</div><!-- // box end -->

<script>
function isAdmin()
{
	var option = {
		'targetId':'adminPanel',
		'dataType':'group', 
		'isCheckBox':false,
		'showRoot':false,
		'isCheckBox':true,
		'callbackFn':viewCon,
		'expandLevel':2
		,onCheck: treeOnCLick
		,'chkboxType':{ "Y": "", "N": "" }
		
	};
	getTree(option);
}
function treeOnCLick(event, treeId, treeNode)
{
	var dataObj = {'id':treeNode.id,'name':treeNode.name}
	if(treeNode.checked)
	{
		viewCon(dataObj,'a');
	}else
	{
		delGroupPanel(dataObj.id)
	}
}
function adminPanel()
{
	$("#adminPanel").css('display','');
	$("#adminView").css("display",'');
	$("#role").css("display",'');
}
function viewCon(dataObj,s)
{
	$("#adminView").css("display",'');
	var text = ' 管 理 组 : &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	var spanStr = $("#adminView").html();
	var spanId  = $("#adminGroup").val();
	if(spanStr.length == 0)
		$("#adminView").html(text);
	$("#adminView").append('<span id=gSpan_'+dataObj.id+'>'+dataObj.name+'&nbsp;&nbsp; </span>');
		$("#adminGroup").val(spanId+','+dataObj.id)
		//<img src=# class=delImg onClick=delGroupPanel('+dataObj.id+')></img>
		//$("#imgId").attr('src',L._rootUrl+'/images/icon/icon_del_normal.png');
	    //addDelClass();
}

//"权&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;限："

function addRole(id,name)
{
	
	var oldName = $("#role span").html();
	if(oldName.length == 0)
	{
		$("#role").html("权&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;限："+$("#role").html());
	}
	var chkS = $("#r_"+id).attr('checked')=='checked'?true:false;
	var oldVal  = $("#role_id").val();
	if(chkS)
	{
		$("#role").css('display','');
		var newName = '<span id="rp_'+id+'">'+name+'<img src=# class=delImg onClick=delSpan('+id+')></img></span>';
		oldVal += (','+id);
		$("#role_id").val(oldVal);
		$("#role span").html(oldName+' '+newName);	
	}else
	{
		//删除节点,替换节点成空		
		var str = '<span +id=(\'|"|)rp_' +id+ '\\1 *>.*?<\\/span>';
		var expStr = eval('/'+str+'/ig');
		
		var newName = oldName.replace(expStr,'');
		$("#role span").html(newName);
		var val = oldVal.substr(1);
		var valArr = val.split(',');
		var newVal='';
		for(var t in valArr)
		{
			if(valArr[t] != id)
			{
				newVal += (',' + valArr[t]);
			}
		}
		$("#role_id").val(newVal);
	}
	addDelClass();
	
}
function selRole()
{
	$("#rolePanel").css('display','');
	var obj = $("#adminPanel");
	var objSet = obj.offset();
	
	$("#rolePanel").css('left', (objSet.left+80));
	$("#rolePanel").css('top',objSet.top+20);
	$("#rolePanel").css('zIndex', '500');
	$("body").bind('click',function(){
		document.onmousemove = mouseMove;
	});
	return false;
}

function mouseMove(ev){
	var obj = $("#adminPanel");
	var objSet = obj.offset();
   	ev = ev || window.event;
	//$("#tel").val(x)	
   	var x = ev.pageX;
   	var y = ev.pageY;
	// ||
	if( (x < (objSet.left+80) || x > (objSet.left+370)) || (y <objSet.top || y > (objSet.top+210)))
  		$('#rolePanel').css('display','none');	
   
   
}

/*
function selRole()
{
	var roleNameStr = '';
	var roleId = '';
	var obj = {'mouseClickFun':function(returnStatus,windowObj, callBack) {
	if(returnStatus){
		var divNum    = callBack.handle;
		var formObj   = $(window.frames["oDialogDiv_iframe_"+divNum].document);
		var tr        = formObj.find('table tr');
		tr.each(function()
		{
			var chk = $(this).find('input[name=uid]:checked').val();
			if(chk > 0)
			{
				var name = $(this).find('td:eq(1)').html();
				$("#role").css('display','');
				roleNameStr += ('<span id=span_'+chk+'>'+name+'<img src=# class=delImg onClick=delSpan('+chk+')></img></span>&nbsp;&nbsp;');
				roleId  += (','+chk);
			}
			
		})
		$("#role span").html(roleNameStr);
		$("#role_id").val(roleId);
		addDelClass();
		}
		}}
	
	window.L.openCom('oDialogDiv')("权限选择"
	, 'iframe:./userCtl.php?a=adminPower'
	, "460", "auto"
	, [2,obj]);
	return false;
}
*/


function addDelClass()
{
  $(".delImg").attr('src',L._rootUrl+'/images/icon/icon_del_normal.png');
  $(".delImg").bind('mouseover',function()
  {
	  $(this).attr('src',L._rootUrl+'/images/icon/icon_del_over.png');
  }).bind('mouseout',function()
  {
	  $(this).attr('src',L._rootUrl+'/images/icon/icon_del_normal.png');	
  })
}

function delSpan(id)
{
	var newRoleId = '';
	$("#rp_"+id).remove();
	var roleArr = $("#role_id").val().substr(1).split(",");
	for(var t in roleArr)
	{
		if(roleArr[t] != id)
		{
			newRoleId += (','+roleArr[t]);
		}
	}
	$("#r_"+id).attr('checked',false);
	$("#role_id").val(newRoleId);
	if($("#role_id").val() == "")
	{
		$("#role").css("display",'none');
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
function hiddDiv()
{
	$('#adminPanel').css('display','none');
	$('#adminView').css('display','none');
	$('#role').css('display','none');
}
</script>
</body>
</html>
