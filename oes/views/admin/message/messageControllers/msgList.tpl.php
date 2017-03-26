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
	</div>		
			
			<div class="nav">
				<span>信息发布</span>
				<ul>
					<li><a class="" href="messageControllers.php?a=msgAdd">发布公告</a></li>
					<li><a class="ihover" href="messageControllers.php?a=msgList">修改公告</a></li>
				</ul>
			</div>
			
		</div>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_input">
			<div class="title none"><span>搜索用户</span></div>
			<div class="content">
				<div class="col_full">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="width:250px;" />
							<col style="" />
						</colgroup>
						<tr>
							<td>查询公告：</td>
							<td>&nbsp;</td>
							<td>日期范围:</td>
						</tr>
						<tr>
							<td><input class="input5" type="text" name="txt" id="txt" /></td>
							<td>
								<label><input class="radiobox" type="radio" name="txtOp" value="0" checked />仅包含标题</label>
								&nbsp; &nbsp;
								<label><input class="radiobox" type="radio" name="txtOp" value="1" />包含标题与正文</label>
							</td>
							<td>
								<select class="select1" name="time_select" size="1" id="time_select">
									<option value="0">范围</option>
									<option value="gt">大于或等于</option>
									<option value="lt">小于或等于</option>
								</select>
								
								<select class="select2" name="time_start" size="1" id="time_start">
									<option>2011-07-25</option>
								</select>
								
								<select class="select2" name="time_end" size="1" id="time_end">
									<option>2011-07-28</option>
								</select>
							
							</td>
						</tr>
					</table>
				</div>
							
				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="btn2" id="search" >搜索</a>
						<a href="#" class="btn2" id="reset" >重置</a>
					</div>
				</div>
			  	<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
				
				<!-- // 表格 -->
				<div class="table_content">
				<?php echo $this->showMsgList;?>
					
				</div>
		</div>
		
		

	
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area none">
			<div class="left">
				<a href="#" class="btn" >全部清除</a>
			</div>
			
			<div class="center">
				<a href="#" class="btn" >保存</a>
				<a href="#" class="btn" >关闭</a>
			</div>
            
			<div class="right">
				<a href="#" class="btn" >保存并复制</a>
				<a href="#" class="btn" >保存并新建</a>
			</div>
			
		</div>
	
	
		<!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
</body>
</html>
<script>
function goto(){
	alert(sureMsg())
}
function sureMsg(){
	window.L.openCom('oDialogDiv')(
	"操作确认"
	,'text:您真的要这么做吗？<p>&nbsp;</p><p>&nbsp;</p>'
	, "300"
	, "150"
	, [2,
		function(mm) {
			return mm;
		}]);
}


$("#search").click(function(){
	var txt = $("#txt").val();
	var txtOp = $("input[name=txtOp]:checked").val();
	var timeSel = $("#time_select").val();
	var timeS = $("#time_start").val();
	var timeE = $("#time_end").val();
	
	$.post("./messageControllers.php?a=msgSearch",{"t":txt,"txtOp":txtOp,"timeSel":timeSel,"ts":timeS,"te":timeE},showList)
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
	$("#time_start").val("")
	$("#time_end").val("")
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
	"操作确认"
	,'text:您真的要这么做吗？<p>&nbsp;</p><p>&nbsp;</p>'
	, "300"
	, "150"
	, [2,
		function(mm) {
	if(mm){
		
	$.post("./messageControllers.php?a=delMsg",{"val":val},function(d){
		oDialogDivInfo("删除成功",2000,-2)
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
	"操作确认"
	,'text:您真的要这么做吗？<p>&nbsp;</p><p>&nbsp;</p>'
	, "300"
	, "150"
	, [2,
		function(mm) {
	if(mm){
	$.post("./messageControllers.php?a=editMsgStatus",{"val":val,"num":notEnd(num)},function(d){
		oDialogDivInfo("状态修改成功",2000,-2)
		$("#search").trigger("click")
	});
	}
	}]);
}


function editMsgInfo(num){
	
	window.L.openCom('oDialogDiv')(
	window.L.getText("公告修改"), 
	'iframe:./messageControllers.php?a=dialogEditMsg&msgId='+num,
	"720", 
	"auto", 
	[2,
		function(status,win,dialog){
			if(status){
				var divNum    = dialog.handle;
				var formObj   = $(window.frames["oDialogDiv_iframe_"+divNum].document);
				var status   = formObj.find('#status').val();
				var title = formObj.find('#title').val();
				var content =  formObj.find('#msgContent').val();
				$.post("./messageControllers.php?a=editMsg",{"num":num,"status":status,"title":title,"content":content},function(d){
					oDialogDivInfo("状态修改成功",2000,-2)
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

</script>