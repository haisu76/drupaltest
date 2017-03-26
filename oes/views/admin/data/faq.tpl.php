<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
					
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
			<div class="title"><span>问答分类</span></div>
			<div class="content">
				
				<!-- //  -->
				<div class="toolbar_top">
					<div class="left">
						<a href="#" class="btn2" title="">复制所选</a>
						<a href="#" class="btn2" >添加所选子项</a>
						<a href="#" class="btn2" >上升到顶级</a>
						<a href="#" class="btn2" >上升一级</a>
						<a href="#" class="btn2" >下降一级</a>
						<a href="#" class="btn2" >下降到未级</a>
					</div>
					
					<div class="right">
					</div>
				</div>
				
				<!-- // 搜索过滤 -->
				<div class="col_left">
					<input name="textfield" type="text" class="input2 ~auto_width search_key" id="textfield" value="关键字搜索"
					onmouseover=this.focus();this.select();  
					onclick="if(value==defaultValue){value='';this.className='search_key_down'}"   
					onblur="if(!value){value=defaultValue;this.className='search_key_out'}" this.classname='search_key_normal'
					 />
					 <div class="clear"></div>
					 选择组：
					<select class="select4" name="select" size="1" id="select">
						<option>请选择</option>
					</select>
				</div>
				
				<!-- ///////////////////////////////////  -->
				<!-- // 中列_box -->
				<div class="col_box">
					<ul id="tree_org_left" class="tree"></ul>
				</div>

				<!-- // 左列 -->
				<div class="col3_left">
				</div>
				
				<!-- // 右列 -->
				<div class="col3_right">
				</div>
				
				<!-- ///////////////////////////////////  -->
				
				<div class="clear"></div>
				
				<!-- //  -->
				<div class="toolbar_bottom">
					<div class="left">
						<a class="iframe" href="dialog_edit_data.html" title="编辑">编辑</a>
						<a class="" href="#">添加子项</a>
						<a class="" href="#">修改名称</a>
						<a class="" href="#">修改编码</a>
						<a class="" href="#">编辑描述</a>
						<a class="" href="#">删除</a>
						<a class="" href="#">全删</a>
					</div>
					
					<div class="right">
						<!-- // page nav -->
						<div class="page_nav">
							<a href="#" class="page_first" ></a>
							<a href="#" class="page_prev" ></a>
							<a href="#" class="page_next" ></a>
							<a href="#" class="page_last" ></a>
							<span class="page_num" >1 / 4</span>
							<select name="select" size="1" id="select" class="select1">
								<option>转到</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>			
						</div><!-- // page nav end -->
						
					</div>
					
				</div>
			</div>
		
	
		</div>
		
	
		<!-- // 主按钮区 -->
		<div class="button_area_search">
			<div class="center">
				<a href="#" class="btn" >保存</a>
				<a href="#" class="btn" >关闭</a>
			</div>
		</div>
	
	
		<!-- // footer -->
        <?php require VIEW_DIR .'/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
