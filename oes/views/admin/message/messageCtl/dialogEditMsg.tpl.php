<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array('/admin/songComm.js'
					)   
                )
            );
?>
<div class="panel_1 con_input">
	<div class="title none">
    	<span>标题文字</span>
	</div>
	<div class="content" style="margin:5px 20px; width:820px; vertical-align:top">
		<table width="820" border="0" cellspacing="0" cellpadding="0">
        	<colgroup>
            	<col width="100" />
                <col width="700" />
            </colgroup>
        	<tr>
            	<td><?php echo L::getText('公告标题', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                <td><input name="title" type="text" class="input3 auto_width" id="title" value="<?php echo $this->info['title'];?>" /></td>
            </tr>
        	<tr>
            	<td><?php echo L::getText('公告内容', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                <td>
                <textarea id="msgContent" style="width:700px; height:260px; border: 1px solid #000; display:none;">
					<?php echo $this->info['content'];?>
                </textarea>
                </td>
            </tr>
        </table>
	</div>
</div>
<script>
	if(window.L.openCom('oEditor'))
	{
		var oEditorObj=new oEditor(
			{
				buttonList : ['bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','image','forecolor','bgcolor','table','subscript','superscript','strikethrough','removeformat','hr','media','link','unlink'],
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
</script>