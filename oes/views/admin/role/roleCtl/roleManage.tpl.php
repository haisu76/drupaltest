<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array(
								  '/admin/songComm.js',
								  '/admin/role/roleManager.js',
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
			<div class="title"><span>搜索角色</span></div>
			<div class="content">
				
				<div class="search_item">
					<h1>角色名称</h1>
					<input class="input3 ~auto_width" type="text" name="role_name" />
				</div>
				
				<div class="search_item">
					<h1>角色描述</h1>
					<input class="input4 ~auto_width" type="text" name="role_desc" />
				</div>

				
				<!-- // 搜索按钮 -->
				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="search btn2"  >搜索</a>
						<a href="#" class="reset btn2" >重置</a>
					</div>
				</div>
			  
			</div>
		</div>
		
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span>角色列表</span></div>
			<div class="content">
				
				
				<div class="table_content">
					<?php echo $this->pageTableHtml;?>
				</div>
				
			</div>
		
	
		</div>
	
		<!-- // footer -->
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
</body>
</html>
