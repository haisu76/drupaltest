<?php
$this->printHead(
    array(
        'title' => array('title'=>'修改组数据权限', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array ('/admin/index/backhead.css',
				     '/admin/group/group.css')
        ,'js' => array('/admin/manyTrees.js','/admin/common.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<input type="hidden" name="group_id" id="group_id" value="<?php echo $this->id;?>"/>
<div id= "group_data"></div>
<?php
	echo admin_user_permissions::dataStratifiedHtml($this->id, 't_group','','group_data');
?>
<a href="javascript:void(0)" onclick="groupModifyData()" id="qsn_save_btn" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
<a href="javascript:void(0)" onclick="window.parent.alertCloseAlertDiv()" class="btn" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
<script>
function groupModifyData()
{
	var group_id = $('#group_id').val();
	var sendurl = window.L._adminUrl+'/group/groupCtl.php?a=modifyGroupData';
	var params = "id="+group_id;
	$.ajax({
		   type: "POST",
		   async:true,
		   url: sendurl,
		   data: params,
		   dataType:"json",
		   success: function(data){
			  if(data.res == 'success')
			  {
				  oDialogDivInfo('保存成功');
			  }
		   },
		  	 error:function (XMLHttpRequest, textStatus, errorThrown) {
			   oDialogDivInfo('保存失败');
			//alert("上传数据错误"+textStatus);
			} 
		});
}

</script>