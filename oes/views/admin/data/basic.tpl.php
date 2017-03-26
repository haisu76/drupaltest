<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/data/data.css',
						'/tree.css'
                    )
                   ,'js' => array(
								  '/admin/songComm.js',
								  '/admin/user/userManager.js',
								  '/admin/manyTrees.js'
								  )   
                ) 
            );
?>
<body>
<div class="box block_10"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
    
		<!-- // 顶部 -->
		<?php include(VIEW_DIR . "/admin/data_top.php");?>
        
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_tree">
			<div class="title"><span><?php echo L::getText('基础数据', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
			<div class="content">
				
				
				
				<!-- ///////////////////////////////////  -->
				<!-- // 中列_box -->


				<!-- // 左列 -->
				<div class="col3_left" style=" border:1px #ccc solid; padding:10px; height:260px;  overflow:auto">
                <ul id="commonTree" class="ztree"></ul>
				</div>
                
		
				
				<!-- // 右列 -->
				<div class="col3_right" style=" border:1px #ccc solid; padding:10px; height:260px;">
                	<?php echo L::getText('<p>使用方法</p><p>1、创建分类：</p><p>选择父节点，点击新建图标（程序会自动保存，如果保存失败，会给出提示。反之没有提示）</p><p>2、修改分类：</p><p>选择要修改的节点，点击修改图标，修改完成后点击窗体任意位置，会提示是否保存，点击"是"按钮程序会提示保存结果</p><p>3、删除分类：</p><p>选中要删除的节点，点击删除图标，点击同意删除按钮，即可同步删除数据。</p>', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
				</div>
							
				<div class="clear"></div>
				
				<!-- //  -->
				
			</div>
		
	
		</div>
		
	
		<!-- // 主按钮区 -->
		<div class="button_area_search none">
			<div class="center">
				<a href="#" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
				<a href="#" class="btn" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
			</div>
		</div>
	<br/>
	
		<!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
<script>

var setting = {
			view: {
				addHoverDom: addNode, //新节点添加
				removeHoverDom: removeNode,//新节点删除
				selectedMulti: false
			},
			edit: {
				enable: true,
				removeTitle: "<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__)); ?>",
				renameTitle: "<?php echo L::getText('编辑', array('file'=>__FILE__, 'line'=>__LINE__)); ?>"
			},
			data: {
				simpleData: {
					enable: true
				}
			},
			callback: {
				beforeDrag: drag,
				beforeRemove: sureDel,//删除节点前的方法
				beforeRename: sureRename,//当编辑节点前的方法
				onRemove: del,
				onRename: rename
			}	
		};
		
	
$.get(window.L._adminUrl+"/data/dataCtl.php?a=getcommondata"
		,{"pid":"00"}
		,function(jsonData)
		{
			window.L.openCom('zTree'
			,{'expand' : ['excheck', 'exedit']}).init($("#commonTree")
			, setting
			,jsonData);
		}
		,"JSON");

		
//方法区域

function sureDel(treeId, treeNode)
{
	var zTree = $.fn.zTree.getZTreeObj("commonTree");
	
	var check_res = checkIsEdit(treeNode.pId);
	if(check_res.res == 'failed')
	{
		oDialogDivInfo(check_res.info);
		return false;
	}else
	{
		zTree.selectNode(treeNode);
		return confirm( window.L.getText('<?php echo L::getText('真的要删除该选项？', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'));
	}
}

function checkIsEdit(pid)
{
	var return_res = {'res':'success','info':''};
	var base_array =  [null,"01","02","03","04","05","06","07","08","09"]; //,
	var is_in_base = false;
	$.each(base_array, function(i, n){
	  if(n == pid)
	  {
		  return_res.res = 'failed';
		  return_res.info = window.L.getText('<?php echo L::getText('无法操作根节点', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
		  return;
	  }
	});
	return return_res;
}

function del(treeId, treeNode,node)
{
	$.post(window.L._adminUrl+'/data/dataCtl.php?a=delNode',
			{'id':node.id},
			function(d)
			{
				oDialogDivInfo('<?php echo L::getText('删除成功,影响', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+d+'<?php echo L::getText('条信息', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
			})
}
function rename(treeId, treeNode,node)
{
	$.post(window.L._adminUrl+'/data/dataCtl.php?a=updateNode',
			{'id':node.id,'name':node.name},
			function(d)
			{
				if(d != '0')
				oDialogDivInfo('<?php echo L::getText('修改成功,影响', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+d+'<?php echo L::getText('条信息', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
			})
}
function sureRename(treeId, treeNode, newName)
{
	if(newName == treeNode.name)
		return;
	var zTree = $.fn.zTree.getZTreeObj("commonTree");
	var check_res = checkIsEdit(treeNode.pId);
	if(check_res.res == 'failed')
	{
		oDialogDivInfo(check_res.info);
		return false;
	}else
	{
		return confirm('<?php echo L::getText('确认要将[ ', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+treeNode.name+'<?php echo L::getText(' ]更改成[ ', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+newName+'<?php echo L::getText(' ]吗？', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
	}
	
}


function addNode(treeId, treeNode) 
{
	var check_res = checkIsEdit(treeNode.id);
	if(check_res.res == 'success'){
		var sObj = $("#" + treeNode.tId + "_span");
		if (treeNode.editNameFlag || $("#addBtn_"+treeNode.id).length>0) return;
		var addStr = "<button type='button' class='add2' id='addBtn_" + treeNode.id
			+ "' title='添加' onfocus='this.blur();'></button>";
		sObj.append(addStr);
		var btn = $("#addBtn_"+treeNode.id);
		if (btn) btn.bind("click", function(){
			var zTree = $.fn.zTree.getZTreeObj("commonTree");
			$.get(window.L._adminUrl+'/data/dataCtl.php?a=getNextId',{"pid":treeNode.id},function(d,s)
			{//ajax回调
				if(s == 'success' && d != '0')
				{
					zTree.addNodes(treeNode, {id:d.substr(1), pId:treeNode.id, name:"new common"});
					$.post(window.L._adminUrl+'/data/dataCtl.php?a=createNode',
						  {'pid':treeNode.id,'cid':d.substr(1),'cn':'new Common'},
						  function(d,s)
						  {
							  if(s != 'success')
							  {
								oDialogDivInfo('<?php echo L::getText('添加失败', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
							  }
						  })
				}
			})	
			return false;
		});
	}
};
function removeNode(treeId, treeNode)
{
	$("#addBtn_"+treeNode.id).unbind().remove();
}
function drag()
{
	return false;
}

</script>

</body>
</html>
