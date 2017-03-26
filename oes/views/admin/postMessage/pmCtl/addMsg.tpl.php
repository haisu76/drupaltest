<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/postMessage/postMessage.css'
                    )
                   ,'js' => array(
								  '/admin/manyTrees.js',
								  '/admin/userApi.js',
								  '/admin/songComm.js'
								  )   
                )
            );
?>

<body>
<script>
function showUserGroupList(){
	var option = {
		'targetNameId':'group_name',
		'targetValueId':'group_id',
		'dataType':'group', 
		'isCheckBox':false,
		'showRoot':false,
		'allowCheckParent':true//是否允许选择父菜单
		,'expandLevel':2
	};
	getTree(option);
}

function showUserList(getData)
{	
	var userName = '';
	var userId = ''
	for(var user in getData)
	{
		userName += getData[user].name + ',' ;
		userId   += getData[user].id   + ',' ;
	}
	$("#user_name").attr("value",userName.substring(0,userName.length-1));
	$("#user_id").attr("value",userId.substr(0,userId.length-1));
}
</script>

<div class="box block_12"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR . "/admin/pm_top.php");?>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_input">
			<div class="title none"><span><?php echo L::getText('搜索用户', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="col_full">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="width:70px;" />
							<col style="width:400px;" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('收件人', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td><label><input class="radiobox" type="radio" name="group" value="1" checked onClick="showUserGroupList()" /><?php echo L::getText('组', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
							<td>
								
							<input type="text" id="group_name" class="input3 auto_width" readonly onClick="showUserGroupList(),chkRadio(1)">
                            <input type="hidden" id="group_id" value="0">
							</td>
							<td><?php echo L::getText('组内所有用户都会收到消息', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
						</tr>
						<tr>
							<td></td>
							<td><label><input class="radiobox" type="radio" name="group" value="0" onClick="user(showUserList)"/><?php echo L::getText('用户', array('file'=>__FILE__, 'line'=>__LINE__))?></label></td>
							<td>
								<input name="user_name" type="text" class="input3 auto_width" id="user_name" readonly  onClick="chkRadio(0)"/>
                                <input type="hidden" id="user_id">
                                
                                </td>
							<td><a class="btn2" onClick="user(showUserList,$('#user_id').val())" href="#" title="<?php echo L::getText('请选择收件人', array('file'=>__FILE__, 'line'=>__LINE__))?>"><?php echo L::getText('选择收件人', array('file'=>__FILE__, 'line'=>__LINE__))?></a><?php echo L::getText('多个用户请以英文逗号(,)分隔', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
						</tr>
						<tr>
							<td class="align_top"><?php echo L::getText('内容', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td colspan="3">
							<!-- // 编辑器 -->
                            	<textarea id="msgContent" name="msgContent" style="width:870px; height:300px; border: 1px solid #000;"></textarea>
                            </td>
						</tr>
					</table>
				</div>

				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="btn2" onClick="save()" ><?php echo L::getText('发送', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="#" class="btn2" onClick="resetForm()" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
		

	
	
	
		<!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
<script>

	if(window.L.openCom('oEditor'))
	{
		var oEditorObj=new oEditor(
			{
				buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','image','forecolor','bgcolor','table','subscript','superscript','strikethrough','removeformat','hr','media']
								,
				maxHeight : 300
				,CustomConfig:
					{
						AnswerSelect:
							{
								AnswerType:"textbox"
							}
						,oFileManager:                                            //oFileManager配置文件
							{
								quickUploadDir:{                                  //各类型的文件快速上传路径
									img         : '/pictures/..quickUpload'       //图片快速上传文件夹
									,media      : '/media/..quickUpload'          //媒体快速上传文件夹
									,attachment : '/attachment/..quickUpload'     //媒体快速上传文件夹
								}
								,browseDir:{                                      //各类型文件预览文件夹
									img         : '/pictures'                     //图片预览文件夹
									,media      : '/media'                        //媒体预览文件夹
									,attachment : '/attachment'                   //附件上传文件夹
								}
							}
					}
			}
		).panelInstance('msgContent');
	}

function save(){
	var radio     = $("input[name=group]:checked").val();
	
    var title     = '';
	var msgCont   = $("#msgContent").val();
	
	var user      = $("#user_id").val();
	var group     = $("#group_id").val();
	var val       = 'u'+user;
	
	if((radio == '1' && group == '0') || (radio == '0' && user == ''))
	{
		oDialogDivInfo(window.L.getText('没有数据'));
		return false;
	}
	if(radio == '1')
	{
		val       = 'g'+ group;
	}
	$.post(
		"./pmCtl.php?a=sendMsg"
		,{"radioType":val,"title":title,"content":msgCont}
		,function(num)
		{
			if(num > 0)
			{
				oDialogDivInfo(window.L.getText('发送成功！共发出')+num+window.L.getText('条'))
			}
		}
		);
}

function resetForm(){
	$("#select").val(0);
	$("#msgTitle").val("");
	$("#msgContent").val("");
	$("#msgContent_Editer > p").html(" ");
}

function chkRadio(val)
{
	$("input[name=group]").each(function(){
		if($(this).val() == val)
		{
			$(this).attr("checked",true);
		}
	})	
}
</script>