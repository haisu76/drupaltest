<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/main.css')
                   ,'js' => array('/admin/songComm.js')   
                )
            );
?>
<style>
body{font-family:tahoma;font-size:12px;}
tfoot{display:none;}
</style>
<body class="dialog_content">
<div class="panel_1 con_tree">
	<div class="content">
		<div class="col_full">
         <input type="hidden" id="dbRoleList" value="<?php echo $this->roleId;?>";/>
		  <?php echo $this->role;?>
		</div>	
	</div>
</div>
<script>
$(function(){
	var rId         =  $("#dbRoleList").val();
	var roleArrList = rId.split(",");
	$("input[name=rid]").each(function(){
			for(var t in roleArrList)
			{
				if(roleArrList[t] == $(this).val())
				{
					$(this).attr('checked','true');
				}
			}
		})
})
</script>
</body>
</html>