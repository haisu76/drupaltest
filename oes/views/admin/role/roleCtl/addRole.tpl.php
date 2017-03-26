<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array(
								  '/admin/songComm.js',
								  '/admin/role/role.js'//steven
								  )   
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
		<!-- //  -->
		<div class="panel_1 con_input">
			<div class="title"><span>角色资料</span></div>
			<div class="content">
				
				<div class="col_full">
					<div class="search_item">
						<h1>角色名称</h1>
						<input class="input5 ~auto_width" type="text" name="textfield" id="role_name" />
					</div>
					<div class="clear"></div>
					
					<div class="search_item">
						<h1>角色描述</h1>
						<input class="input5 ~auto_width" type="text" name="textfield" id="role_desc" />
					</div>
					
				</div>
				
				<div class="col_left">
					<!-- // 右边内容 -->
				</div>
				
				<div class="col_right">
					<!-- // 右边内容 -->
				</div>
				
				<div class="clear"></div>
				
				<div class="con_tab" id="tabs1">
					<div class="tab_title">
						<?php foreach($this->roleList as $key=>$p1){ ?>
						<a class="" href="#" alt="" ><?php echo $key;?></a>
                        <?php } unset($key);unset($p1);?>
					</div>
					<div class="clear"></div>
					
<style>
body{font-family:tahoma;font-size:12px;}

</style>                    
                    
                   <?php foreach($this->roleList as $key=>$p1){ 
				 		     echo " <div class='tab_content'>";
				   			 foreach($p1 as $key=>$val){ 
                    		 echo "<br/><h1> >>>".$key."</h1>";
							     foreach($val as $opval=>$opname){
					 ?>
                    <input type="checkbox" class="ckbox" onClick="operate_module('<?php echo $opval;?>')" id="<?php echo $opval;?>" > <label for="<?php echo $opval;?>"><?php echo $opname."";?></label>
                    <?php } echo "<br/>";
                  }  echo "</div>";}?>
				
				</div>		  
			</div>
		</div>
		
	
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area_search">
			<div class="center">
				<a href="#" class="btn" onClick="save_role()">保存</a>
				<a href="#" class="btn" onClick="clear_obj()" >清空</a>
			</div>
		</div>
	
	
		<!-- // footer -->
		<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
