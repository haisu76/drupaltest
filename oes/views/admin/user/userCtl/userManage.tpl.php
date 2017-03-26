<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/user/user.css'
                    )
                   ,'js' => array(
								  '/admin/songComm.js',
								  '/admin/user/userManager.js',
								  '/admin/manyTrees.js',
								   '/admin/common.js'
								  )   
                ) 
            );
?>
<link href="/favicon.ico" rel="shortcut icon">
</head>
<body>
<script>
function showUserGroup(){
	var option = {'targetId':'select_target_name',
			'treeMark':'st1',
	'targetNameId':'group_name',
	'targetValueId':'group',
	'dataType':'group', 
	'isCheckBox':false,
	'showRoot':false,
	'allowCheckParent':true//是否允许选择父菜单
	,'expandLevel':2
	};
	getTree(option);
}

function showUserGroup2(){
	var option = {
	'targetId':'select',
	'treeMark':'st2',
	'targetNameId':'select',
	'targetValueId':'select2',
	'dataType':'group', 
	'isCheckBox':false,
	'showRoot':false,
	'allowCheckParent':true//是否允许选择父菜单
	,'expandLevel':2
	};
	getTree(option);
}

</script>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
    
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/user_top.php');?>
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('搜索用户', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1><?php echo L::getText('用户组', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="group" id="group_name" value="<?php echo $this->minGroup[0]['group_name'];?>"  onClick="showUserGroup()"/>
                        <input type="hidden" id="group"/>
					</div>
					
					<div class="search_item">
						<h1><?php echo L::getText('ID / 用户名 / 姓 名 / E-Mail', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="user" style="width:192px;" id="user" />
					</div>
					
                    <div class="search_item">
						<h1><?php echo L::getText('电话号码', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="tel" id="tel" />
					</div>		
                    		
					<div class="search_item">
						<h1><?php echo L::getText('手机号码', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input3 ~auto_width" type="text" name="mobiletel" id="mobiletel" />
					</div>
                    
					<div class="search_item">
						<h1><?php echo L::getText('状&nbsp;态', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<select class="select2 ~auto_width" size="1" name="status"  id="status">
                           <option value=""><?php echo str_repeat("&nbsp;",12);?></option>
							<option value="070102"><?php echo L::getText('已审核', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
							<option value="070101"><?php echo L::getText('未审核', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						</select>
					</div>
					
					<div class="search_item" style="width: 100px;">
						<h1><?php echo L::getText('', array('file'=>__FILE__, 'line'=>__LINE__))?>性别</h1>
						 <select size="1" class="select2 ~auto_width" id="gender" name="gender" >
							<option value=""><?php echo str_repeat("&nbsp;",8);?></option>
                            <option value="1"><?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
                            <option value="0"><?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
						</select>
					</div>
					
					<div class="search_item float_right">
						<h1></h1>
						<label><input name="checkbox" type="checkbox" class="checkbox" id="searchFF" value="1"/><?php echo L::getText('高级搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
					</div>
				
				</div>
				<!--add 2013 01 10-->
				<div class="clear"></div>
				
				<!-- // 高级搜索 -->
				<div class="advance_search">
					<div class="search_item">
						<h1><?php echo L::getText('证件号码', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input5 ~auto_width" type="text" name="idcard" id="idcard" />
					</div>
					
					
					<div class="search_item">
						<h1><?php echo L::getText('准考证号码', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						<input class="input5 ~auto_width" type="text" name="examcard" id="examcard" />
					</div>
					
					<div class="search_item">
						
					</div>
					
					
					<div class="search_item">
						<h1><?php echo L::getText('注册日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
						
						<input type="text" class="input3 ~auto_width" name="time1" id="time1" value="" />
						
						<input type="text" class="input3 ~auto_width" name="time2" id="time2" value=""/>
					</div>
					
				</div>
				
				<div class="clear"></div>
				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="btn2" id="search" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="#" class="btn2" id="reset" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title">
                <span style="float:left;"><?php echo L::getText('用户列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span>
                <label style="float:right; color:#000; float: left; margin-left: 5px;">	<input name="onlyAdmin" type="checkbox" class="checkbox" id="onlyAdmin" value="1" /><?php echo L::getText('仅显示管理员', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
            </div>
            
			<div class="content">
				<!--   <div class="toolbar_top">
					<div class="right">
					
					</div>
				</div>   -->
				
				
				<div class="table_content">
				<?php echo $this->pageTableHtml;?>		
				</div>
			</div>		
		</div>
	
	</div>
		
		<!-- // footer -->
        <?php require VIEW_DIR .'/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->

</body>
</html>
