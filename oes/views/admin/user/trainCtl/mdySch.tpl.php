<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/user/user.css'
                    )
                   ,'js' => array('/admin/tag/tag.js',
								  '/admin/songComm.js',
                   '/admin/common.js'
                  
								  )   
                )
            );
?>

<body>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/user_top.php');?>
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('搜索机构', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				
				<div class="search_item">
					<h1><?php echo L::getText('机构名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input4 ~auto_width" type="text" name="name" id="name" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('培训机构标签', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input type="text" id="tagName" class="input3" value="" onClick="javascript:this.value=''"/>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('联系人', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="contact" id="contact" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('地址', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input70 ~auto_width" type="text" name="addr" id="addr" />
				</div>
				
				

				<!--add 2013 01 09-->
                <div class="clear"></div>
				<!-- // 搜索按钮 -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="btn2" onClick="searchForm()" id='search'><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="#" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			
		  <div class="content">
				<div class="table_content">
					<?php echo $this->schList;?>
		       </div>
		  </div>
		
	
		</div>
	
<?php include(VIEW_DIR.'/admin/footer.php');?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->

</body>
</html>
<script>
function getForm()
{
	var jsonData = {"name":$("#name").val(),"label":$("#tagName").val(),
				 "contact":$("#contact").val(),"address":$("#addr").val()}
	return jsonData;
}

function searchForm()
{
	window.L.extension.pageTable.classObj.params(
	    $('[_pagetabledataset="admin_user_trainCtl::trainSchPageList"]').get(0), 
		getForm(), 
		true
	);
}


window.L.strVar('L.extension.pageTable.callback.afterLoadList[]', window.L.strVar('L.extension.pageTable.callback.initLoadList[]', function(pageTableObj, pageTableClass)
{
	if($(pageTableObj).attr('_pagetabledataset') === 'admin_user_trainCtl::trainSchPageList')
	{
            var htmlShortCut = '&nbsp;';
            htmlShortCut += '<div class="action_toolbar">';
            htmlShortCut += '<div class="inner">';
            htmlShortCut += '<div class="right"></div>';
            htmlShortCut += '<div class="inner_box">';
            htmlShortCut += '<div class="action_link">';	
            htmlShortCut += '</div>';
            htmlShortCut += '</div>';
            htmlShortCut += '</div>';
            htmlShortCut += '</div>';		
            L.extension.pageTable.classObj.eachTbody(pageTableObj, '*', 7, function(obj){
                $(obj.tdObj).html(htmlShortCut).parent().hover(function(){
				var sId=$(this).find("input").eq(0).val();
				var conn = "<a href='#' onclick='openEditDiv("+sId+")' >"+window.L.getText('编辑机构')+"</a>";
				    conn += "<a href='#' onclick='return sureDel(delData,"+sId+")' >"+window.L.getText('删除机构')+"</a>";
				$(".action_link").html(conn);
            		$(".action_toolbar", this).show().animate({marginLeft:'8px'},{queue:false,duration:200});
            	}, function() {
				
            		$(".action_toolbar", this).hide().animate({marginLeft:'10px'},{queue:false,duration:200});
            	});
            });	
    }//if end
}));

window.L.strVar('L.extension.pageTable.callback.initLoadList[]', function(pageTableObj, pageTableClass)
{
	if($(pageTableObj).attr('_pagetabledataset') === 'admin_user_trainCtl::trainSchPageList')
	{
	
	$(".del").click(function(){//删除
	var strId='';
	$("input[name=sid]:checked").each(function(){
		strId += $(this).val()+",";
	})
	var len = strId.length;
	if(len == 0){
		oDialogDivInfo(window.L.getText("没有选择任何数据!"));
		return false;
	}else{
		strId = strId.substr(0,len - 1);
		sureDel(delData,strId)
	}
	return false;
    })
	
	}//if结束
});	
function sureDel(funName,val)
{
	window.L.openCom('oDialogDiv')(
	window.L.getText("确认操作"), 
	'text:<div>'+window.L.getText('真的要删除吗？')+'</div>',
	"280", 
	"110", 
	[2,function(s){if(s){funName(val);}
	}]) 
	return ;
}
function delData(sid)
{
	$.post(
		'./trainCtl.php?a=delTrainSch',
		{schoolId:sid},
		function(d){
			if(d > 0)
			{
				oDialogDivInfo(window.L.getText('删除成功，所影响')+d+window.L.getText('人'));
				$("#search").trigger("click");
			}
		});
}
function openEditDiv(id)
{
	var callbackFun = {'mouseClickFun':function(returnStatus,windowObj, callBack) {
	if(returnStatus){
		var divNum    = callBack.handle;
		var formObj   = $(window.frames["oDialogDiv_iframe_"+divNum].document);
		var name      = formObj.find('#name').val();
		var sid       = formObj.find('#sid').val();
		var addr      = formObj.find('#addr').val();
		var boss      = formObj.find('#boss').val();
		var contact   = formObj.find('#contact').val();
		var mail      = formObj.find('#mail').val();
		var intro     = formObj.find('#intro').val();
		var tel       = formObj.find('#tel').val();
		var url       = formObj.find('#url').val();
		var desc      = formObj.find('#desc').val();
		var tagId     = formObj.find('#tag_id').val();
		var postData  = {"name":name,"sid":sid,"addr":addr,"boss":boss,"contact":contact,
						 "mail":mail,"intro":intro,"tel":tel,"url":url,"desc":desc}
		
		$.post("./trainCtl.php?a=updateSch",postData,function(d)
		{
			if(d == '1')
			{
				var tag_option = {
							'objId':sid,
							'tagIds':getTagVal(tagId),
							'addOrReplace':'replace'}
				tagAddTagObj(tag_option)
				oDialogDivInfo(window.L.getText('信息修改成功'),2000,-2);
			}else
			{
				alert(d)
				oDialogDivInfo(window.L.getText('信息修改失败'),2000,-2);
			}
		}
	);	
	}}}

function getTagVal(tagId)
{
	var id    = tagId.substr(1,tagId.length);
	var idArr = id.split(',');
	var returnData = new Array();
	for(var t in idArr)
	{
		returnData.push(idArr[t])
	}
	return returnData;
}

	window.L.openCom('oDialogDiv')(
			window.L.getText("修改"), 
	'iframe:./trainCtl.php?a=dialogSch&d='+id,
	"auto", 
	"auto", 
	[2,callbackFun])
	return false;
}
</script>