<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/postMessage/postMessage.css'
                    )
                   ,'js' => array(
								  )   
                )
            );
?>
<body>
<div class="box block_12"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR . "/admin/pm_top.php");?>
		
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
							<td>消息关键字：</td>
							<td>&nbsp;</td>
							<td>日期范围:</td>
						</tr>
						<tr>
							<td><input class="input5" type="text" name="textfield" id="textfield" /></td>
							<td>
								<label><input class="radiobox" type="radio" name="radio" id="radio" value="radio" />仅包含标题</label>
								&nbsp; &nbsp;
								<label><input class="radiobox" type="radio" name="radio" id="radio2" value="radio" />包含标题与正文</label>
							</td>
							<td>
								<select class="select1" name="select" size="1" id="select">
									<option>范围</option>
									<option>大于或等于</option>
									<option>小于或等于</option>
								</select>
								
								<select class="select2" name="select" size="1" id="select">
									<option>2011-07-25</option>
								</select>
								
								<select class="select2" name="select" size="1" id="select">
									<option>2011-07-28</option>
								</select>
							
							</td>
						</tr>
					</table>
				</div>
							
				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="btn2" >搜索</a>
						<a href="#" class="btn2" >重置</a>
					</div>
				</div>
			  	
				
				<!-- // 表格 -->
				<div class="table_content">
					<table width="100%" class="table1">
						<thead>
							<tr>
								<th class="align_center"><input name="checkbox" type="checkbox" class="checkbox" id="checkbox" /></th>
								<th>ID</th>
								<th>用户名</th>
								<th>所属组</th>
								<th>管理组</th>
								<th>电子邮箱</th>
								<th class="align_center">性别</th>
								<th>手机号码</th>
								<th>注册日期</th>
								<th class="align_center">管理员</th>
								<th>审核状态</th>
								<th class="action"></th>
							</tr>
						</thead>
						
						<tbody>
							
						</tbody>
						
						<tfoot>
						</tfoot>
					</table>
					
				</div>
				
				<!-- //  -->
				<div class="toolbar_bottom">
					<div class="left">
						<a href="#" class="" >删除</a>
						<a href="#" class="" >全删</a>
						<a href="#" class="" >标为已读</a>
						<a href="#" class="" >全部设为已读</a>
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

</div>
</body>
</html>
