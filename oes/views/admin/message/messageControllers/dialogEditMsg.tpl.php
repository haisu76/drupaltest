<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array('/admin/user/comm.js'
								  )   
                )
            );
?>
<div class="panel_1 con_input">
	<div class="title none"><span>标题文字</span></div>
	<div class="content">
		<div class="col_full">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:90px;" />

					<col style="width:380px;" />
				</colgroup>
				<tr>
					<td>公告状态：</td>
					
					<td colspan="3">
						
						<select name="status" size="1" id="status" class="select3 auto_width">
							<option>请选择</option>
                            <?php
							if($this->info['status']=='040102'){
								?>
                                <option selected value="040102">已发布</option>
                                <option value="040101">未发布</option>
                                <?php } else { ?>
                                <option value="040102">已发布</option>
                                <option selected value="040101">未发布</option>
                                <?php }?>
						</select>
					</td>
					
				</tr>
				<tr>
					<td>公告标题：</td>
					<td colspan="3"><input name="title" type="text" class="input3 auto_width" id="title" value="<?php echo $this->info['title'];?>" /></td>
				</tr>
				<tr>
					<td class="align_top">公告内容：</td>
					<td colspan="3">
					  	<textarea id="msgContent" name="msgContent" style="width:590px; height:260px; border: 1px solid #000; display:none;"><?php echo $this->info['content'];?></textarea>
                       
                    </td>
				</tr>
			</table>
		</div>

	</div>
</div>
<script>

	if(window.L.openCom('oEditor'))
	{
		var oEditorObj=new oEditor(
			{
				fullPanel : true,maxHeight : 300
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
</script>