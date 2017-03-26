<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
								 '/admin/message/message.css')
                   ,'js' => array(
								  '/admin/songComm.js'
								  )   
                )
            );
?>


<body>
<div class="box block_12"><!-- // block_## 序号对应全局的颜色定义 -->
	<!--add 2012 11 27  div class="box_inner"-->
    <div class="box_inner">

	<?php include(VIEW_DIR . "/admin/message_top.php");?>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_input">
			<div class="title none"><span><?php echo L::getText('搜索用户', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="col_full">
					<table  border="0" cellpadding="0" cellspacing="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="width:250px;" />
							<col style="" />
						</colgroup>
						<tr style="width:1000px; height:25px;">
							<td><?php echo L::getText('查询公告', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>&nbsp;</td>
							<td><?php echo L::getText('日期范围', array('file'=>__FILE__, 'line'=>__LINE__))?>:</td>
						</tr>
						<tr>
						    <td style=""><input class="input5" type="text" name="txt" id="txt" /></td>
						    <td><label>
						        <input class="radiobox"  type="radio" name="txtOp" value="0" checked />
						        <span><?php echo L::getText('仅包含标题', array('file'=>__FILE__, 'line'=>__LINE__))?></span></label>
						        <label>
						            <input class="radiobox" type="radio" name="txtOp" value="1" />
						            <span><?php echo L::getText('包含标题与正文', array('file'=>__FILE__, 'line'=>__LINE__))?></span></label></td>
						    <td ><input class="input3 ~auto_width" type="text" name="txt" id="time1" />
						        <input class="input3 ~auto_width" type="text" name="txt" id="time2" />
						       </td>
					    </tr>
						
					</table>
				</div>
							
				<div class="button_area_search01">
					<div class="inner_box" style="margin-bottom:10px;">
						<a href="#" class="btn2" id="search" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="#" class="btn2" id="reset" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
					<div style="clear:both;"></div>
				</div>
			  	
				
				<!-- // 表格 -->
				<div class="table_content">
				<?php echo $this->showMsgList;?>
					
				</div>
		</div>
		
	
	
		<!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
    </div>
</div><!-- // box end -->
</body>
</html>
<script>
$("#search").click(function(){
	var txt = $("#txt").val();
	var txtOp = $("input[name=txtOp]:checked").val();
	var timeSel = $("#time_select").val();
	var timeS = $("#time1").val();
	var timeE = $("#time2").val();
	
	$.post("./messageCtl.php?a=msgSearch",{"t":txt,"txtOp":txtOp,"ts":timeS,"te":timeE},showList)
	return false;
})

function showList(d,s){
	if(s=='success'){
	$(".table_content").html(d);
	window.L.extension.pageTable.init();
	}else{	
		
	}
}

$("#reset").click(function(){
	resetForm();
})
function resetForm(){
	$("#txt").val("");
	$("#time_select").val("0");
	$("#time1").val("")
	$("#time2").val("")
}

function selectAllChecked(){
	$("input[name=mid]").each(function(){
		$(this).attr("checked","checked");	
	})	
}
function cancelAllSelect(){
	$("input[name=mid]").each(function(){
		$(this).attr("checked",false);	
	})	
}
function getChecked(){
	var str = '';
	$("input[name=mid]:checked").each(function(){
		str+=$(this).val()+',';
		})
	return str;
	}
	
function notEnd(num){
	return num.substr(0,num.length-1);
}

function delNotice(num,s){
	var val='';
	if(s==1) 
	{
		val = notEnd(num);
	}else{
		val = num;
	}
	window.L.openCom('oDialogDiv')(
			window.L.getText("操作确认")
	,'text:'+window.L.getText('您真的要这么做吗？')+'<p>&nbsp;</p><p>&nbsp;</p>'
	, "300"
	, "150"
	, [2,
		function(mm) {
	if(mm){
		
	$.post("./messageCtl.php?a=delMsg",{"val":val},function(d){
		oDialogDivInfo(window.L.getText('删除成功'),2000,-2)
		$("#search").trigger("click")
	});
	}
	}]);
}
function editStatus(num , s){
	var val = '';
	if(s == 1)
	{
		val = '040102';
	}else if(s == 0)
	{
		val = '040101';
	}
	window.L.openCom('oDialogDiv')(
			window.L.getText("操作确认")
	,'text:'+window.L.getText('您真的要这么做吗？')+'<p>&nbsp;</p><p>&nbsp;</p>'
	, "300"
	, "150"
	, [2,
		function(mm) {
	if(mm){
	$.post("./messageCtl.php?a=editMsgStatus",{"val":val,"num":notEnd(num)},function(d){
		oDialogDivInfo(window.L.getText("状态修改成功"),2000,-2)
		$("#search").trigger("click")
	});
	}
	}]);
}


function editMsgInfo(num){
	
	window.L.openCom('oDialogDiv')(
			window.L.getText("公告修改"), 
	'iframe:./messageCtl.php?a=dialogEditMsg&msgId='+num,
	"870", 
	"auto", 
	[2,
		function(status,win,dialog){
			if(status){
				var divNum    = dialog.handle;
				var formObj   = $(window.frames["oDialogDiv_iframe_"+divNum].document);
				var title = formObj.find('#title').val();
				var content =  formObj.find('#msgContent').val();
				$.post("./messageCtl.php?a=editMsg"
				,{"num":num,"title":title,"content":content}
				,function(d){
					oDialogDivInfo(window.L.getText("公告修改成功"),2000,-2)
		            $("#search").trigger("click")
				})	
				}
		}
	]
	);
}


window.L.strVar('L.extension.pageTable.callback.initLoadList[]', function(pageTableObj, pageTableClass)
{	
	

	$(".allSelect").click(function(){
		selectAllChecked();
		});
		
		$(".cancelAllSelect").click(function(){
			cancelAllSelect();
			})
			
			$(".statusOk").click(function(){
				editStatus(getChecked(),1)
				})
			$(".statusNo").click(function(){
				editStatus(getChecked(),0)
				})
			$(".delCont").click(function(){
				delNotice(getChecked(),1)
				})
				
});

$(function(){
window.L.openCom(
		'wDate', 
		{
        	'obj' : $('#time1').get(0),    //需绑定的对象
        	'eventType' : 'click',    //绑定的触发事件,默认click
        	'params' : {'readOnly' : true}    //传递WdatePicker的参数
    	} );
		window.L.openCom(
		'wDate', 
		{
        	'obj' : $('#time2').get(0),    //需绑定的对象
        	'eventType' : 'click',    //绑定的触发事件,默认click
        	'params' : {'readOnly' : true}    //传递WdatePicker的参数
    	} );	
	
})
</script>