<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/postMessage/postMessage.css'
                    )
                   ,'js' => array(
								  )   
                )
            );
?>

<body class="dialog_content">

<div class="panel_1 con_input">
	<div class="title none"><span>标题文字</span></div>
	<div class="content">
		<div class="col_full">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:90px;" />
					<col style="width:70px;" />
					<col style="width:380px;" />
				</colgroup>
				<tr>
					<td>收件人：</td>
					<td><label><input class="radiobox" name="radio1" type="radio" id="radio" value="radio" />组</label></td>
					<td>
						
						<select name="select" size="1" id="select" class="select3 auto_width">
							<option>请选择</option>
						</select>
					</td>
					<td><?php echo L::getText('组内所有用户都会收到消息', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
				</tr>
				<tr>
					<td></td>
					<td><label><input class="radiobox" name="radio1" type="radio" id="radio" value="radio" />用户</label></td>
					<td>
						<input name="textfield" type="text" class="input3 auto_width" id="textfield" /></td>
					<td><a class="btn2 iframe" href="../user/dialog_modfiy_org.html" title="请选择收件人">选择收件人</a>多个用户时请以逗号(,)分隔</td>
				</tr>
				<tr>
					<td>主题：</td>
					<td colspan="3"><input name="textfield2" type="text" class="input3 auto_width" id="textfield2" /></td>
				</tr>
				<tr>
					<td class="align_top">内容：</td>
					<td colspan="3">
						<!-- // 编辑器 -->
						<div class="editor_item" style="">
							<div class="editor_item_inner">
								<div class="toolbar">
									<a class="" href="#" alt="" ><img src="../images/editor/editor_01.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_02.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_03.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_04.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_05.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_06.png" /></a>
									
									<img class="editor_line_v" src="../images/editor/editor_line_v.png" />
									
									<a class="" href="#" alt="" ><img src="../images/editor/editor_07.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_08.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_09.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_10.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_11.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_12.png" /></a>
									<a class="" href="#" alt="" ><img src="../images/editor/editor_13.png" /></a>
									
									<a class="editor_more" href="#" alt="展开工具栏" ><img src="../images/editor/editor_more.png" /></a>
								</div>
								
								<!-- // 文本框 -->
								<div class="textareaHolder">
									<div class="textarea_inner">
										<textarea rows="6" ></textarea>
									</div>
								</div>
							
							</div>
										
						</div>
					</td>
				</tr>
			</table>
		</div>


		<div class="button_area_search">
			<div class="inner_box">
				<a class="btn2" onClick="parent.$.fancybox.close();" href="javascript:;">保存</a>
				<a class="btn2" onClick="parent.$.fancybox.close();" href="javascript:;">取消</a>
			</div>
		</div>
	  
	</div>
</div>

</body>
</html>
