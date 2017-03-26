<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array(
								  '/admin/user/role.js',
								  '/admin/songComm.js'
								  )   
                )
            );
?>
<body class="dialog_content">

<div class="panel_1 con_tree">
	<div class="title none"><span>标题</span></div>
	<div class="content">

		<!-- // 左列 -->
		<div class="col_full">
			<div>
               <div class="search_item">
					<h1>角色名称</h1>
					<input class="input3 ~auto_width" type="text" name="role_name" value="<?php echo $this->rid['role_name'];?>" />
				</div>
				
				<div class="search_item">
					<h1>角色描述</h1>
					<input class="input4 ~auto_width" type="text" name="role_desc" value="<?php echo $this->rid['role_desc'];?>"/>
				</div>
                <div class="clear"></div>
            </div>
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
                    <?php $roleValArr=explode(",",$this->rid['role_value']); //print_r($roleValArr);?>
                   <input type="hidden" value="<?php echo $this->rid['role_id'];?>" name="role_id"/>
				   <?php foreach($this->roleList as $key=>$p1){ 
				 		     echo " <div class='tab_content'>";
				   			 foreach($p1 as $key=>$val){ 
                    		 echo "<h1> >>>".$key."</h1>";
							     foreach($val as $opval=>$opname){
									if(in_array($opval,$roleValArr)){
										 
					 ?>
                    <input type="checkbox" class="ckbox" onClick="operate_module('<?php echo $opval;?>')" id="<?php echo $opval;?>" checked > <label for="<?php echo $opval;?>"><?php echo $opname."";?></label>
                    <?php }
					else{ ?>
                     <input type="checkbox" class="ckbox" onClick="operate_module('<?php echo $opval;?>')" id="<?php echo $opval;?>" > <label for="<?php echo $opval;?>"><?php echo $opname."";?></label>
                    <?php }
					} echo "<br/>";
                  }  echo "</div>";}?>
				</div>		
		</div>	
	</div>
</div>


</div>

</body>
</html>
