<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array('/admin/songComm.js')   
                )
            );
?>
<?php include("user_top.php");?>
<body class="dialog_content">

<div class="panel_1 con_input">
	<div class="title none"><span>标题文字</span></div>
	<div class="content">
		<div class="col_full">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:90px;" />
					<col style="" />
					<col style="" />
				</colgroup>
				<tr>
					<td>组名称：</td>
					<td><input name="textfield" type="text" class="input5 ~auto_width" id="textfield" /></td>
					<td></td>
				</tr>
				<tr>
					<td class="align_top">描述：</td>
					<td><textarea class="auto_width" name="" cols="" rows="4"></textarea></td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</div>
		
		<div class="col_right">
			<!-- // 右边内容 -->
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
