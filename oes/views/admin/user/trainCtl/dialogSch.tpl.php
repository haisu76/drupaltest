<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
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
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('机构信息', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="col_left">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('机构名称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
								<input class="input1 auto_width" type="text" name="name" id="name" onBlur="existName(this.value)" value="<?php echo $this->schList[0]['t_name'];?>"/><input type="hidden" id="sid" value="<?php echo $this->schList[0]['t_id'];?>">
							</td>
						</tr>
						<tr>
							<td><?php echo L::getText('地址', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="addr" id="addr" value="<?php echo $this->schList[0]['t_address'];?>" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('法人', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="boss" id="boss" value="<?php echo $this->schList[0]['t_company_lawer'];?>" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('联系人', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input3 auto_width" type="text" name="contact" id="contact" value="<?php echo $this->schList[0]['t_contact'];?>"/></td>
						</tr>
						<tr>
							<td><?php echo L::getText('邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input4 auto_width" type="text" name="mail" id="mail" value="<?php echo $this->schList[0]['t_email'];?>" /></td>
						</tr>
					</table>
				</div>
				<div class="col_right">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('机构简称', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
								<input class="input1 auto_width" type="text" name="intro" id="intro" value="<?php echo $this->schList[0]['t_intro'];?>" />
							</td>
						</tr>
						<tr>
							<td><?php echo L::getText('电话号码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="tel" id="tel" value="<?php echo $this->schList[0]['t_tele_phone'];?>" /></td>
						</tr>
						<tr>
							<td><?php echo L::getText('官方网站', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><input class="input1 auto_width" type="text" name="url" id="url" value="<?php echo $this->schList[0]['t_web_site'];?>" /></td>
						</tr>
						<tr>
							<td valign="top"><a href="javascript:void(0)" class="icon_link" id="addTag" onclick="addTag()"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;+</a></td>
							<td>
					<div class="search_item">
					<div id="tagDiv">&nbsp;<?php echo $this->tagName;?></div>
					   <input type="hidden" id="tag_id" value="<?php echo $this->tagVal;?>"/>
				
			        </div>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>

				</div>
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
									<div class="textarea_inner">
										<textarea rows="6" cols="153" id="desc" >
<?php echo strip_tags($this->schList[0]['t_des']);?>
                                        </textarea>
									</div>
								</div>
							
							</div>
										
						</div>
					
				</div>
			</div>	
		</div>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
<style>
.warning{ border:red 1px solid; background:#FCC}
</style>
<script type="text/javascript">
function existName(name)
{
	$.get("./trainCtl.php?a=existName&name="+name,'',function(d){
		if(d == '1')
		{
			$("#name").addClass("warning");
			oDialogDivInfo(window.L.getText('机构名称存在'));
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

$(function(){
	$("#name").click(function(){
		$("#name").removeClass("warning");
	});
})

$(function(){
	addDelClass();
})

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
	var newName = '<span id=tp_'+id+'>'+name+'<img src=# class=delImg 	onClick=delSpan(\''+id+'\')></img></span>';
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
function allDelTag()
{
	$("#tag_id").val("");
	$("#tagDiv").html("&nbsp;");
}

</script>
