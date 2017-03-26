<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
       				,'css'=>array ('/admin/index/backhead.css',
				     '/admin/group/group.css',
					 '/tree.css')
                   ,'js' => array('/admin/songComm.js','/admin/manyTrees.js','/admin/common.js')
                )
            );
?>
<link href="/favicon.ico" rel="shortcut icon">
</head>
<body>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/user_top.php');?>
		<!-- // 表格数据 -->
		<div class="panel_1 con_tree">
			<div class="title"><span><?php echo L::getText('组管理', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<!-- // 左列 -->
				<div style="border:1px #CCCCCC solid; width:450px; float:left; height:300px; overflow: auto;">
					<ul id="groupTree" class="ztree"></ul>
                    <input type="text" id="delId" style="display:none"/>
				</div>
				
				<!-- // 右列 -->
				<div class="" style="border:1px solid #CCC; height:300px; float:left; margin-left:100px; width:400px; padding:0 15px;">
					<p><?php echo L::getText('使用说明', array('file'=>__FILE__, 'line'=>__LINE__))?> </p>
					<p><?php echo L::getText('添加组', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
					<p><?php echo L::getText('选中要创建组的上一级节点，点击添加按钮', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
					<p><?php echo L::getText('修改组名', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
					<p><?php echo L::getText('选中要修改的组，点击编辑按钮', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
					<p><?php echo L::getText('删除组', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
					<p><?php echo L::getText('选中要删除的组，点击删除按钮', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
					<p><?php echo L::getText('移动组', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
					<p><?php echo L::getText('选中要移动的组，拖动到合适的位置即可。', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
                    <p><?php echo L::getText('最后点击保存按钮。', array('file'=>__FILE__, 'line'=>__LINE__))?></p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!-- // 主按钮区 -->
		<div class="button_area_search">
			<div class="center">
				<a href="#" class="btn" onClick="save()" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="#" class="btn" onClick="return createTree()" ><?php echo L::getText('取消', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>

    
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->

<script type="text/javascript">
var maxId = 0;

$(function(){createTree()})

var setting = {
			view: {
				addHoverDom: addNode, //新节点添加
				removeHoverDom: removeNode,//新节点删除
				selectedMulti: false
			},
			edit: {
				enable: true,
				removeTitle: window.L.getText("删除"),
				renameTitle: window.L.getText("编辑")
			},
			data: {
				simpleData: {
					enable: true
				}
			},
			callback: {
				beforeRemove: sureDel,//删除节点前的方法
				beforeRename: sureRename,//当编辑节点前的方法
				beforeDrop:beforeDrop//移动未松开
				//,onDrop:dropOk //移动成功后
				//,onRemove: del
				//,onRename: rename
			}
		};

		function addNode(treeId, treeNode) {
			var sObj = $("#" + treeNode.tId + "_span");
			if ($("#addBtn_"+treeNode.id).length>0){
				return false;
			}
			if ($("#diyBtn_"+treeNode.id).length>0){
				return false;
			}
			var addStr = "<span class='button add2' id='addBtn_" 
				+ treeNode.id
				+ "' title='"+window.L.getText('添加组')+"' onfocus='this.blur();'></span>";
		/*	var diyBt  = "<span class='button diyBt' id='diyBtn_" 
				+ treeNode.id
				+ "' title='"+window.L.getText('数据权限')+"' onfocus='this.blur();'></span>";*/
			sObj.append(addStr);
		/*	sObj.append(diyBt);*/
			
			
			//添加组事件
			var btn = $("#addBtn_"+treeNode.id);
			if (btn) btn.bind("click" , 
									function()
									{
										var zTree = $.fn.zTree.getZTreeObj("groupTree");
										zTree.addNodes(treeNode
														, {id: ++maxId, pId : treeNode.id, name: window.L.getText("新建组") + maxId});
			});
				
					  
			//diy bt事件
/*			var btn = $("#diyBtn_"+treeNode.id);
			if (btn) btn.bind("click"
							, function(){
									//这里为组添加数据管理
									if(treeNode.id!=0)
									{
										window.L.openCom('oDialogDiv');
										var sendurl = window.L._adminUrl+'/group/groupCtl.php?';
										ALERT_DIV_MARK = oDialogDiv(window.L.getText("选择数据权限"),"iframe:"+sendurl+"{'get':{'a':'getGroupDataLimit'}, 'post' : {'id':'"+treeNode.id+"'}}","300px", "250px", [1],10,true);
									}else{
										oDialogDivInfo(window.L.getText('无法修改根节点'));
									}
								}
						  );		*/	  
						  
		};


		//删除dom
		function removeNode(treeId, treeNode) {
			$("#addBtn_"+treeNode.id).unbind().remove();
			$("#diyBtn_"+treeNode.id).unbind().remove();
		};

		

		function createTree()
		{
			$.post(window.L._adminUrl+"/user/getTree.php"
			,{}
			,function(jsonData)
			{	
				for(var t in jsonData)
				{
					if(maxId < jsonData[t].id)
					{
						maxId = jsonData[t].id;
					}
				}
				window.L.openCom('zTree'
				,{'expand' : ['excheck', 'exedit']}).init($("#groupTree")
				, setting
				,jsonData);
			}
			,"JSON")
			return false;
		}
		
		function moveTypeStr(te)
		{
			var str = '';
			switch(te)
			{
				case 'inner' : str = window.L.getText('中'); break;
				case 'next'  : str = window.L.getText('后'); break;
				case 'prev'  : str = window.L.getText('前'); break;
			}
			return str;
		}

		function beforeDrop(treeId, treeNodes, targetNode, moveType){
			
			
			if(targetNode === null ) return false;
			var nodeId   = treeNodes[0].id;
			var nodeName = treeNodes[0].name;
			var pId      = targetNode.id;
			var pName    = targetNode.name;
			//alert(targetNode.pId);
			var ztree_obj = $.fn.zTree.getZTreeObj(treeId);
			var ztree_nodes = ztree_obj.getNodes();
			//alert(L.JSON.stringify(ztree_obj.getNodes()));
			if(targetNode.pId != ztree_nodes[0].pId)
			{
				return true;
				//return confirm(window.L.getText('是否将【')+nodeName+window.L.getText('】移动到【')+pName+'】'+moveTypeStr(moveType)+window.L.getText('吗？'));
			}else{
				return false;
			}
		}
		
		//拖拽前的方法
		function beforeDrag(treeId, treeNodes) {
			for (var i=0,l=treeNodes.length; i<l; i++) {
				if (treeNodes[i].drag === false) {
					return false;
				}
			}
			return true;
		}
		
		function sureDel(treeId, treeNode)
		{
			if(treeNode.id!=0)
			{
				var zTree = $.fn.zTree.getZTreeObj("groupTree");
				zTree.selectNode(treeNode);
				return confirm(window.L.getText('真的要删除该选项？'));
			}else{
				oDialogDivInfo(window.L.getText('无法修改根节点'));
				return false;
			}
		}		
		
		function sureRename(treeId, treeNode, newName)
		{
			if(treeNode.id!=0)
			{
				if(newName == treeNode.name)
					return;
				return confirm(window.L.getText('确认要将[ ')+treeNode.name+window.L.getText(' ]更改成[ ')+newName+window.L.getText(' ]吗？'));
			}else{
				if(newName != treeNode.name)
				{
					oDialogDivInfo(window.L.getText('无法修改根节点'));
					return false;
				}
			}
		}	
		
			
		
		function dropOk(eventName, treeId, treeNodes, targetNode, moveType)
		{
			if(moveType == null) return false;
			var flg = confirm(window.L.getText("是否保存移动?"))
			if(flg)
			{
				var p = targetNode.id;
				if(moveType != 'inner')
				{
					var p = targetNode.pId;
					(p == null) ? p = '0' : '';
				}
				$.post(window.L._adminUrl+'/group/groupCtl.php?a=savaGroup' ,
					   {'pId':p,'id':treeNodes[0].id,'name':treeNodes[0].name} ,
					   function(d,s)
					   {
						   if(s == 'success')
						   {
							   oDialogDivInfo(window.L.getText('保存成功'));
						   }else
						   {
							   oDialogDivInfo(window.L.getText('保存失败'));
						   }});
			}else
			{
				//重置树
				createTree();
			}
		}
		
		function del(treeId, treeNode,node)
		{
			$.post(window.L._adminUrl+'/group/groupCtl.php?a=delGroup',
					{'id':node.id},
					function(d)
					{
						oDialogDivInfo(window.L.getText('删除成功,影响')+d+window.L.getText('条信息'));
					})
		}
		function rename(treeId, treeNode,node)
		{
			$.post(window.L._adminUrl+'/group/groupCtl.php?a=savaGroup',
					{'id':node.id,'pId':node.pId,'name':node.name},
					function(d)
					{
						if(d != '0')
						oDialogDivInfo(window.L.getText('修改成功,影响')+d+window.L.getText('条信息'));
					})
		}
		function save()
		{
			var tree  = $.fn.zTree.getZTreeObj("groupTree")
			var nodes = tree.transformToArray(tree.getNodes());
			var saveJson = {};
			var i = 0;
			for(var obj in nodes)
			{
				var tempObj = {};
				var id      = nodes[obj]['id'];
				var pid     = nodes[obj]['pId'];
				var name    = nodes[obj]['name'];
				if(id == 0) continue;
				tempObj.id  = id;
				tempObj.pid = pid;
				tempObj.xm  = name;
				saveJson[i++] = tempObj;
			}
			$.ajax(
				{
					type:'POST',
					url:window.L._adminUrl+'/group/groupCtl.php?a=updateGroup',
					data:saveJson,
					success:function(d){
								if(d >= 1)
								{
									oDialogDivInfo(window.L.getText('修改成功！'));
								}else
								{
									oDialogDivInfo(window.L.getText('修改失败！'));
								}}
				})
			
		}
</script>
</body>
</html>
