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
			<div class="title"><span><?php echo L::getText('搜索讲师', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search_item">
					<h1><?php echo L::getText('培训机构名称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select4 ~auto_width" name="group" size="1" id="group">
                    <option value="">&nbsp;</option>
                    <?php
					foreach($this->group as $g)
					{
						echo "<option value=$g[id]>$g[name]</option>";
					}
                    ?>
                    </select>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('讲师标签', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input type="text" id="label" class="input3" value="" onClick="javascript:this.value=''"/>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('讲师姓名', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="name" id="name" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('讲师级别', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select2 ~auto_width" name="level" size="1" id="level">
						<option value="">&nbsp;</option>
                    <?php 
						foreach($this->c_cde['c0803'] as $k => $v)
						{
							echo "<option value='{$k}'>$v</option>";
						}
					?>	
					</select>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('讲师职称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select2 ~auto_width" name="pos" size="1" id="pos">
						<option value="">&nbsp;</option>
                    <?php 
						foreach($this->c_cde['c0805'] as $k => $v)
						{
							echo "<option value='{$k}'>$v</option>";
						}
					?>
					</select>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('专业类别', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select2 ~auto_width" name="spz" size="1" id="spz">
						<option value="">&nbsp;</option>
                    <?php 
						foreach($this->c_cde['c0804'] as $k => $v)
						{
							echo "<option value='{$k}'>$v</option>";
						}
					?>
					</select>
				</div>

				
				<!-- // 搜索按钮 -->
				<div class="button_area_search" style="float:left;width:100%;">
					<div class="inner_box">
						<a href="#" class="btn2" onClick="searchForm()" id="search"><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="#" class="btn2" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title none"><span><?php echo L::getText('数据列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">

				<div class="table_content">
				    <?php echo $this->searchHtml;?>
				</div>
				
			</div>
		
	
		</div>
	

        <?php require VIEW_DIR.'/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
<script>


window.L.strVar('L.extension.pageTable.callback.afterLoadList[]', window.L.strVar('L.extension.pageTable.callback.initLoadList[]', function(pageTableObj, pageTableClass)
{
	if($(pageTableObj).attr('_pagetabledataset') === 'admin_user_trainCtl::trainPageList')
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
				var tId=$(this).find("input").eq(0).val();				
				var conn = "<a href='#' onclick='openEditDiv("+tId+")' >"+window.L.getText('编辑讲师')+"</a>";
				    conn += "<a href='#' onclick='return sureDel(delData,"+tId+")' >"+window.L.getText('删除讲师')+"</a>";
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
	if($(pageTableObj).attr('_pagetabledataset') === 'admin_user_trainCtl::trainPageList')
	{
		
	<!--为角色添加表格底部删除按钮事件-->
	$(".del").click(function(){//删除
	var strId='';
	$("input[name=uid]:checked").each(function(){
		strId+=$(this).val()+",";
	})
	var len = strId.length;
	if(len == 0){
		oDialogDivInfo(window.L.getText("请选择角色!"));
		return false;
	}else
	{
		strId = strId.substr(0,len - 1);
		sureDel(delData,strId);
	}
	return false;
    })
	
	}//if结束
});	
	
	
	
function getForm()
{
	var group = $("#group").val();
	var label = $("#label").val();
	var name  = $("#name").val();
	var level = $("#level").val();
	var pos   = $("#pos").val();
	var spz   = $("#spz").val();
	var jData = {};
	jData.group = group;
	jData.label = label;
	jData.name  = name;
	jData.level = level;
	jData.pos   = pos;
	jData.spz   = spz;
	return jData;
}

function clsForm()
{
	var group = $("#group").val("0");
	var label = $("#label").val("");
	var name  = $("#name").val("");
	var level = $("#level").val("");
	var pos   = $("#pos").val("");
	var spz   = $("#spz").val("");
}

function searchForm()
{
	$.ajax({
		type:'POST',
		url:'./trainCtl.php?a=mdyTer',
		data:getForm(),
		success:updateHtml
		})
}
function updateHtml(h)
{
	$(".table_content").html("");
	$(".table_content").html(h);
	window.L.extension.pageTable.init();
}


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
		'./trainCtl.php?a=delTrainTea',
		{TeaId:sid},
		function(d){
			if(d > 0)
			{
				window.L.extension.pageTable.init();
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
		var tid       = formObj.find('#tid').val();
		var name      = formObj.find('#name').val();
		var birthday  = formObj.find('#birthday').val();
		var gender    = formObj.find('input[name=gender]:checked').val();
		var level     = formObj.find('#level').val();
		var positional = formObj.find('#positional').val();
		var specializ  = formObj.find('#specializ').val();
		var email      = formObj.find('#email').val();
		var tel        = formObj.find('#tel').val();
		var addr       = formObj.find('#addr').val();
		var blog       = formObj.find('#blog').val();
		var weibo      = formObj.find('#weibo').val();
		var group      = formObj.find('#group').val();		
		var desc       = formObj.find('#desc').val();
		var tagId      = formObj.find('#tag_id').val();
		
		var postData  = {"tid":tid,"name":name,"birthday":birthday,"gender":gender,"level":level,
						 "positional":positional,"specializ":specializ,"email":email,"tel":tel,"addr":addr,
						 "blog":blog,"weibo":weibo,"group":group,"desc":desc};			 
		
		$.post("./trainCtl.php?a=updateTea",postData,function(d)
		{
			if(d == '1')
			{
				var tag_option = {
							'objId':tid,
							'tagIds':getTagVal(tagId),
							'addOrReplace':'replace'}
				tagAddTagObj(tag_option)
				oDialogDivInfo(window.L.getText('信息修改成功'),3000,-2);
			}else
			{
				oDialogDivInfo(window.L.getText('信息修改失败'),5000,-2);
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
	'iframe:./trainCtl.php?a=dialogTea&d='+id,
	"auto", 
	"auto", 
	[2,callbackFun]
	)
	return false;
}
</script>