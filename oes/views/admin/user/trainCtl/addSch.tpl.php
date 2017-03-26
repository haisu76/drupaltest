<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/user/user.css'
                    )
                   ,'js' => array('/admin/tag/tag.js',
								  '/admin/songComm.js'
								  )   
                )
            );
?>

<body>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/user_top.php');?>
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('机构信息', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content" >
				<div class="col_left"  >
					<table  border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('机构名称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
								<input class="input1 auto_width " type="text" name="name" id="name" onBlur="existName(this.value)" style="width:260px;"/>
							</td>
						</tr>
						<tr>
							<td><?php echo L::getText('地址', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="addr" id="addr" style="width:260px;"/></td>
						</tr>
						<tr>
							<td><?php echo L::getText('法人', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="boss" id="boss" style="width:260px;"/></td>
						</tr>
						<tr>
							<td><?php echo L::getText('联系人', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input3 auto_width" type="text" name="contact" id="contact" style="width:260px;"/></td>
						</tr>
						<tr>
							<td><?php echo L::getText('邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input4 auto_width" type="text" name="mail" id="mail" style="width:260px;"/></td>
						</tr>
					</table>
				</div>
				
				<div class="col_right" >
					<table  border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('机构简称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
								<input class="input1 auto_width" type="text" name="intro" id="intro" style="width:260px;"/>
							</td>
						</tr>
						<tr>
							<td><?php echo L::getText('电话号码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="tel" id="tel" style="width:260px;" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('官方网站', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="url" id="url" style="width:260px;" /></td>
						</tr>
						<tr>
							<td valign="top"><a href="javascript:void(0)" class="icon_link" id="addTag" onClick="addTag()"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;+</a></td>
							<td>
								<div class="search_item">
									
                                    <div id="tagDiv" >&nbsp;</div>
									 <input type="hidden" id="tag_id"/> 
								</div>
							</td>
						</tr>
						
					</table>

				</div>
                <div style="clear:both;"></div>
			</div>
          
		</div>
		
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span><?php echo L::getText('描述', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
		

				<div class="table_content">
					<!-- // 编辑器 -->
					<div class="editor_item" style="">
							<div class="editor_item_inner">
								<!-- // 文本框 -->
								<div class="textareaHolder">
									<div  class="textarea_inner">
                                     <!--2012 11 20 add -->
										<textarea style="border:#CCC 1px solid"  rows="6" cols="153" id="desc"></textarea>
									</div>
								</div>
							
							</div>
										
						</div>
					
				</div>
			</div>
		
	
		</div>
		
	
		<!-- // 主按钮区 -->
		<div class="button_area_search">
			<div class="center">
				<a href="#" class="btn" onClick="submitMsg(save)"><?php echo L::getText('确定', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="#" class="btn" onClick="resetForm()"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>
	
	
		<!-- // footer -->
      
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
<style>
.warning{ border:red 1px solid; background:#FCC}
</style>
<script type="text/javascript">
function getForm(){
	var name    = $("#name").val();
	var addr    = $("#addr").val();
	var boss    = $("#boss").val();
	var contact = $("#contact").val();
	var mail    = $("#mail").val();
	var intro   = $("#intro").val();
	var tel     = $("#tel").val();
	var url     = $("#url").val();
	var desc    = $("#desc").val();
    var popJson = {"name":name,"addr":addr,"boss":boss,"contact":contact,
				   "mail":mail,"intro":intro,"tel":tel,"url":url,"desc":desc};	
	return popJson;
}
function existName(name)
{
	$.get("./trainCtl.php?a=existName&name="+name,'',function(d){
		if(d == '1')
		{
			$("#name").addClass("warning");
			oDialogDivInfo(window.L.getText('机构名称存在!'));
		}
	})
}
function resetForm()
{
	$("#name").val("");
	$("#addr").val("");
	$("#boss").val("");
	$("#contact").val("");
	$("#mail").val("");
	$("#intro").val("");
	$("#tel").val("");
	$("#url").val("");
	$("#desc").val("");
}
function submitMsg(funName)
{
	var td = getForm();
	var st = true;
	if(td.name == "")
	{
		oDialogDivInfo(window.L.getText('机构名称不能为空'));
		st = false;
	}
	//alert(existName(td.name))
	if(st)
	{
		funName(td);
	}
}

function save(jData){
	if(false)
	{
		oDialogDivInfo(window.L.getText('机构名称存在!'));
		return false;
	}else
	{
	$.ajax({
	type:'POST'
	,url:'./trainCtl.php?a=saveTrain'
	,data:jData
	,success:function(d)
			{
				if(d >= '1')
				{
					var tag_option = {
							'objId':d,
							'tagIds':getTagVal(),
							'addOrReplace':'add'}
						tagAddTagObj(tag_option)
					oDialogDivInfo(window.L.getText('信息保存成功'));
					resetForm();
				}else if(d == '0')
				{
					alert(d)
					oDialogDivInfo(window.L.getText('机构名称存在'));
				}else
				{
					oDialogDivInfo(window.L.getText('机构保存失败'));
				}
			}
	})
	}
}
function isTagVal(newId)
{
	var id = $("#tag_id").val().substr(1,$("#tag_id").val().length);
	var idArr = id.split(',');
	for(var t in idArr)
	{
		if(idArr[t] == newId)
		{
			return false;
		}
	}
	return true;
}
function addTag()
{
	var tag_option = {
		'tagType':'10'
		,'callbackFn':'tagCallBackFun'
		,'targetId':'addTag'
	};
	tagDisplayTag(tag_option);
	return false;
}
function tagCallBackFun(id,name)
{
	var newName = '<span id=tp_'+id+'>'+name+'<img src=# class=delImg onClick=delSpan(\''+id+'\')></img></span>';
	if(isTagVal(id))
	{
		$("#tagDiv").append(newName);
		var oldVal = $("#tag_id").val();
		oldVal += (','+id);
		$("#tag_id").val(oldVal);
		addDelClass();
	}
}

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
	var newTagId = '';
	$("#tp_"+id).remove();
	var tagArr = $("#tag_id").val().substr(1).split(",");
	for(var t in tagArr)
	{
		if(tagArr[t] != id)
		{
			newTagId += (','+tagArr[t]);
		}
	}
	$("#tag_id").val(newTagId);
}
function getTagVal()
{
	var id = $("#tag_id").val().substr(1,$("#tag_id").val().length);
	var idArr = id.split(',');
	var returnData = new Array();
	for(var t in idArr)
	{
		returnData.push(idArr[t])
	}
	return returnData;
}
function allDelTag()
{
	$("#tag_id").val("");
	$("#tagDiv").html("&nbsp;");
}
function delClass(name)
{
	
}
$(function(){
	$("#name").click(function(){
		$("#name").removeClass("warning");
	});
})
</script>
