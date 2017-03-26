<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
								 '/admin/message/message.css')
                   ,'js' => array(
								  '/admin/songComm.js',
								  '/admin/user/role.js'//steven
								  )   
                )
            );
?>


<body>
<div class="box block_12"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR . "/admin/message_top.php");?>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_input">
			<div class="content">
				<div class="col_full">
                <!--2012 11 27 del width="100%"-->
					<table border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="width:70px;" />
							<col style="width:400px;" />
						</colgroup>
						
						<tr>
							<td><?php echo L::getText('主题', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td colspan="3"><input name="msgTitle" type="text" class="input3 auto_width" id="msgTitle"  style="width:870px"/></td>
						</tr>
						<tr>
							<td class="align_top"><?php echo L::getText('内容', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td colspan="3">
								<textarea id="msgContent" name="msgContent" style="width:870px; height:300px; border: 1px solid #000;"></textarea>
							</td>
						</tr>
					</table>
                   
				</div>
				<div class="button_area_search">
					<div class="right">
				<a href="#" class="btn" onClick="save('040102')"><?php echo L::getText('保存并发布', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="#" class="btn" onClick="save('040101')"><?php echo L::getText('保存公告', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
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
				buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','image','forecolor','bgcolor','table','subscript','superscript','strikethrough','removeformat','hr','media','link','unlink']
				,maxHeight : 300
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

function save(status){
	var msgTime = $("#select").val();
	var msgTitle= $("#msgTitle").val();
	var msgCont= $("#msgContent").val();
	
	if(msgTitle==''){
	oDialogDivInfo(window.L.getText("公告标题不能为空"));
	return false;		
	}else{
		$.post("messageCtl.php?a=saveMsg"
		,{"s":status,"t":msgTitle,"c":msgCont}
		,function(d){
			oDialogDivInfo(d);
			resetForm();
			})	
	}
}

function resetForm(){
	$("#select").val(0);
	$("#msgTitle").val("");
	$("#msgContent").val("");
	$("#msgContent_Editer > p").html(" ");
}
</script>