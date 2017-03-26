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
			<div class="title"><span><?php echo L::getText('分类数据', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
			<div class="content">
				
				<!-- // 搜索过滤 -->
				<div class="col_left" style="width:1000px;">
					<?php echo L::getText('选择分类：', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
					<select class="select4" name="select" size="1" id="select">
						<option value='0'>&nbsp;</option>
                        <?php
						foreach($this->selectList as $option)
						{
							echo "<option value='{$option['id']}'>", L::getText($option['cn'], array('file'=>__FILE__, 'line'=>__LINE__)), "</option>";
						}
						?>
					</select>
				</div>
                
				<div class="col3_left" style=" border:1px #ccc solid; padding:10px 8px; height:300px; overflow:auto;">
                <ul id="commonTree" class="ztree">
                	<li><?php echo L::getText('请选择分类', array('file'=>__FILE__, 'line'=>__LINE__)); ?></li>
                </ul>
				</div>
                
		
				
				<!-- // 右列 -->
				<div class="col3_right" style=" border:1px #ccc solid; padding:10px; height:300px;">
                    <?php echo L::getText('<p>使用方法</p><p>1、创建分类：</p><p>选择父节点，点击新建图标（程序会自动保存，如果保存失败，会给出提示。反之没有提示）</p><p>2、修改分类：</p><p>选择要修改的节点，点击修改图标，修改完成后点击窗体任意位置，会提示是否保存，点击"是"按钮程序会提示保存结果</p><p>3、删除分类：</p><p>选中要删除的节点，点击删除图标，点击同意删除按钮，即可同步删除数据。</p><p>4、移动节点：</p><p>选择节点，拖动位置，选择保存节点即可。</p>', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
				</div>
							
				<div class="clear"></div>
                
				
				
				<div class="clear"></div>
				

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
				beforeRemove: sureDel,//删除节点前的方法
				beforeRename: sureRename,//当编辑节点前的方法
				onRemove: del,
				onRename: rename,
				beforeDrop:beforeDrop,//移动未松开
				onDrop:dropOk //移动成功后
			}	
		};

		
//方法区域
$(function(){
{
	$("#select").change(createTree)
}})

function createTree()
{
	var id = $('#select').val();
		$.get(window.L._adminUrl+'/data/dataCtl.php?a=getCategoryList',
		      {'id':id},
		      function(jsonData,s)
		      {
				  window.L.openCom('zTree'
				 ,{'expand' : ['excheck', 'exedit']}).init($("#commonTree")
				 ,setting
				 ,jsonData);
				//打开节点 
				 var treeObj = $.fn.zTree.getZTreeObj("commonTree");
				 var nodes   = treeObj.getNodes();
				 if (nodes.length>0) {
					treeObj.expandNode(nodes[0], true, true, true);
				 } 
		    },"JSON")	
}
function moveTypeStr(te)
{
	var str = '';
	switch(te)
	{
		case 'inner' : str = '<?php echo L::getText('中', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'; break;
		case 'next'  : str = '<?php echo L::getText('后', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'; break;
		case 'prev'  : str = '<?php echo L::getText('前', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'; break;
	}
	return str;
}

function beforeDrop(treeId, treeNodes, targetNode, moveType){
	if(targetNode === null ) return false;
	var nodeId   = treeNodes[0].id;
	var nodeName = treeNodes[0].name;
	var pId      = targetNode.id;
	var pName    = targetNode.name;
	if(moveType == 'inner' || targetNode.pId != treeNodes[0].pId)
	return confirm('<?php echo L::getText('是否将【', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+nodeName+'<?php echo L::getText('】移动到【', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+pName+'】'+moveTypeStr(moveType)+'<?php echo L::getText('吗？', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
	else
	return false;
}

function dropOk(eventName, treeId, treeNodes, targetNode, moveType)
{
	if(moveType == null) return false;
	var flg = confirm("<?php echo L::getText('是否保存移动?', array('file'=>__FILE__, 'line'=>__LINE__)); ?>")
	if(flg)
	{
		var p = targetNode.id;
		if(moveType != 'inner')
		{
			var p = targetNode.pId;
			(p == null)?p = $("#select").val():'';
		}
		$.post(window.L._adminUrl+'/data/dataCtl.php?a=moveNode' ,
		       {'p':p,'c':treeNodes[0].id} ,
			   function(d,s)
			   {
				   if(s == 'success')
				   {
					   oDialogDivInfo('<?php echo L::getText('保存成功', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
				   }else
				   {
					   oDialogDivInfo('<?php echo L::getText('保存失败', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
				   }});
	}else
	{
		createTree();
	}
}

function addNode(treeId, treeNode) 
{
	var sObj = $("#" + treeNode.tId + "_span");
	if (treeNode.editNameFlag || $("#addBtn_"+treeNode.id).length>0) return;
	var addStr = "<button type='button' class='add2' id='addBtn_" + treeNode.id
		+ "' title='添加' onfocus='this.blur();'></button>";
	sObj.append(addStr);
	
	var btn = $("#addBtn_"+treeNode.id);
	if (btn) btn.bind("click", function(){
		var zTree = $.fn.zTree.getZTreeObj("commonTree");
		$.ajax({
			   type: "GET",
			   url: window.L._adminUrl+'/data/dataCtl.php?a=getNextId',
			   data: "pid="+treeNode.id+"&t=c",
			   async: false,
			   success: function(d){
				if( d != '0')
				{
					$.post(window.L._adminUrl+'/data/dataCtl.php?a=createNode',
						  {'pid':treeNode.id,'cid':d,'cn':'new category'},
						  function(m,s)
						  {
							  if(s != 'success'||m!='1')
							  {
								oDialogDivInfo('<?php echo L::getText('添加失败', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
							  }else{
								zTree.addNodes(treeNode, {id:d, pId:treeNode.id, name:"new category"});
							  }
						  })
				}
			   }
			});
	
		return false;
	});
};
function removeNode(treeId, treeNode)
{
	$("#addBtn_"+treeNode.id).unbind().remove();
}

function sureDel(treeId, treeNode)
{
	var zTree = $.fn.zTree.getZTreeObj("commonTree");
	var check_res =  checkIsEdit(treeNode.pId);
	if(treeNode.pId == null)
	{
		oDialogDivInfo(check_res.info);
		return false;
	}else
	{
		zTree.selectNode(treeNode);
		return confirm('<?php echo L::getText('真的要删除该选项？', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
	}
	
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
	var check_res =  checkIsEdit(treeNode.pId);
	if(check_res.res == 'failed')
	{
		oDialogDivInfo(check_res.info);
		return false;
	}else
	{
		return true;
		//return confirm('<?php echo L::getText('确认要将[ ', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+treeNode.name+'<?php echo L::getText(' ]更改成[ ', array('file'=>__FILE__, 'line'=>__LINE__)); ?>'+newName+'<?php echo L::getText(' ]吗？', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
	}
	
}

function checkIsEdit(pid)
{
	var return_res = {'res':'success','info':''};
	var base_array =  [null]; //,
	var is_in_base = false;
	$.each(base_array, function(i, n){
	  if(n == pid)
	  {
		  return_res.res = 'failed';
		  return_res.info = window.L.getText('无法操作根节点');
		  return;
	  }
	});
	return return_res;
}
</script>

</body>
</html>
