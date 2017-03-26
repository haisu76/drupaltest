<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
					
                    )
                   ,'js' => array(
								  '/admin/user/comm.js',
								  '/admin/user/role.js'//steven
								  )   
                )
            );
?>


<body>
<div class="box block_12"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<div class="header">
			<div class="header_top">
				<div class="header_left">
					<div class="logo">oTraining在线培训系统</div>
					<div class="top_link">
						<a class="no_margin" href="../index.html">首页</a>
						<a href="#">更新日志</a>
						<a href="#">前台首页</a>
						<a href="#">个人中心</a>
						<a href="#">收藏</a>
					</div>
				</div>
				<div class="header_right">
					<div class="user_info">
						starry360，欢迎使用本系统<br />
						<a href="#">修改密码</a>
						<a href="../login.html">退出</a>
					</div>
					<div class="user_photo"><img src="../images/user_photo.jpg" /></div>
				</div>
			</div>
			
			
			<div class="nav">
				<span>信息发布</span>
				<ul>
					<li><a class="ihover" href="messageControllers.php?a=msgAdd">发布公告</a></li>
					<li><a class="" href="messageControllers.php?a=msgList">修改公告</a></li>
				</ul>
			</div>
			
		</div>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_input">
			<div class="content">
				<div class="col_full">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="width:70px;" />
							<col style="width:400px;" />
						</colgroup>
						<tr>
							<td>公告状态：</td>
							
							<td  colspan="3">
								
								<select name="msgTime" size="1" id="select" class="select3 auto_width">
									<option value="0">请选择</option>
                                    <option value="040102">立即发布</option>
                                    <option value="040101">稍后发布</option>
								</select>
							</td>
							
						</tr>
						
						<tr>
							<td>主题：</td>
							<td colspan="3"><input name="msgTitle" type="text" class="input3 auto_width" id="msgTitle" /></td>
						</tr>
						<tr>
							<td class="align_top">内容：</td>
							<td colspan="3">
								<textarea id="msgContent" name="msgContent" style="width:100%; height:300px; border: 1px solid #000;"></textarea>
							</td>
						</tr>
					</table>
                   
				</div>

				<div class="button_area_search">
					<div class="right">
				<a href="#" class="btn" id="saveMsg">保存公告</a>
				<a href="#" class="btn"  id="resetMsg">清空表单</a>
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
				buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','image','forecolor','bgcolor','table','subscript','superscript','strikethrough','removeformat','hr','media'],
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

$("#saveMsg").click(function(){
	var msgTime = $("#select").val();
	var msgTitle= $("#msgTitle").val();
	var msgCont= $("#msgContent").val();
	
	if(msgTime=='0'){
		oDialogDivInfo("请选择公告状态");
	}
		else if(msgTitle==''){
	oDialogDivInfo("公告标题不能为空");		
	}else{
		$.post("messageControllers.php?a=saveMsg",{"s":msgTime,"t":msgTitle,"c":msgCont},function(d){
			oDialogDivInfo(d);
			resetForm();
			})	
	}
})

$("#resetMsg").click(function(){resetForm()})

function resetForm(){
	$("#select").val(0);
	$("#msgTitle").val("");
	$("#msgContent").val("");
	$("#msgContent_Editer > p").html(" ");
}


</script>