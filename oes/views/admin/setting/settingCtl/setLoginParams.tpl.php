<?php
$this->printHead(
                array(
                    'title' => array('title'=>'登录参数设置', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
				   				 '/admin/setting/setting.css')
                    ,'js' => array('/admin/common.js','/admin/setting/setting.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>


<div class="box block_14"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR.'/admin/setting_top.php');?>
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span><?php echo L::getText('登录参数管理', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="con_tab" id="tabs1">
					<div class="clear"></div>
					
					<div class="tab_content">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<colgroup>
								<col style="width:300px;" />
								<col style="" />
							</colgroup>
							<tr>
								<td><?php echo L::getText('登录风格', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<select class="~select ~auto_width" id="display_login_type" name="display_login_type" onchange="" >
								<option value="1" <?php if($this->login_settings['display_login_type']['setting_value'] =="1"){?> selected="selected" <?php }?>><?php echo L::getText('登入后才能看到首页', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<option value="2" <?php if($this->login_settings['display_login_type']['setting_value'] =="2"){?> selected="selected" <?php }?>><?php echo L::getText('先看到首页再登入', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								</select> <label> <?php echo L::getText('请慎重选择登入风格，保存后，客户端浏览器需要删除cookie才能生效', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
								
								</td>
							</tr>
							
							<tr>
								<td><?php echo L::getText('首页显示排行榜的人数', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
									<input class="input1 ~auto_width" id="index_ranking_count" name="index_ranking_count" type="text" value="<?php echo $this->login_settings['index_ranking_count']['setting_value']?>">
								</td>
							</tr>
							
							<tr>
								<td><?php echo L::getText('首次登录系统是否修改密码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<select class="~select ~auto_width" id="login_update_pwd" name="login_update_pwd" onchange="" >
								<option value="yes" <?php if($this->login_settings['login_update_pwd']['setting_value'] =="yes"){?> selected="selected" <?php }?>><?php echo L::getText('是', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<option value="no" <?php if($this->login_settings['login_update_pwd']['setting_value'] =="no"){?> selected="selected" <?php }?>><?php echo L::getText('否', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								</select>
								</td>
							</tr>
							<tr>
								<td><?php echo L::getText('是否允许一个用户同时在不同的计算机上登录', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<select class="~select ~auto_width" id="login_user_multi_pc" name="login_user_multi_pc" onchange="" >
								<option value="yes" <?php if($this->login_settings['login_user_multi_pc']['setting_value'] =="yes"){?> selected="selected" <?php }?>><?php echo L::getText('是', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<option value="no" <?php if($this->login_settings['login_user_multi_pc']['setting_value'] =="no"){?> selected="selected" <?php }?>><?php echo L::getText('否', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								</select>
								</td>
							</tr>
						
							<tr>
								<td><?php echo L::getText('同时在线人数(空表示不限制)', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<input class="input1 ~auto_width" id="online_people_count" name="online_people_count" type="text" value="<?php echo $this->login_settings['online_people_count']['setting_value']?>">
								</td>
							</tr>
							<tr>
								<td><?php echo L::getText('用户是否可以注册', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<select class="~select ~auto_width" id="user_register_flg" name="user_register_flg" onchange="" >
								<option value="yes" <?php if($this->login_settings['user_register_flg']['setting_value'] =="yes"){?> selected="selected" <?php }?>><?php echo L::getText('是', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<option value="no" <?php if($this->login_settings['user_register_flg']['setting_value'] =="no"){?> selected="selected" <?php }?>><?php echo L::getText('否', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								</select>
								</td>
							</tr>
							<tr>
								<td><?php echo L::getText('注册后自动通过审核', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<select class="~select ~auto_width" id="user_auto_register" name="user_auto_register" onchange="" >
								<option value="yes" <?php if(isset($this->login_settings['user_auto_register']['setting_value'] )&&$this->login_settings['user_auto_register']['setting_value'] =="yes"){?> selected="selected" <?php }?>><?php echo L::getText('是', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								<option value="no" <?php if(isset($this->login_settings['user_auto_register']['setting_value'] )&&$this->login_settings['user_auto_register']['setting_value'] =="no"){?> selected="selected" <?php }?>><?php echo L::getText('否', array('file'=>__FILE__, 'line'=>__LINE__))?></option>
								</select>
								</td>
							</tr>
						</table>
						
						
						<div class="button_area_search">
							<div class="center">
								<a href="javascript:settingSaveLogin()" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
								<!-- <a href="#" class="btn" >关闭</a> -->
							</div>
						</div>
						
						
						
					</div>
				</div>
			</div>
		</div>
		
	
	
	
	
		<!-- // footer -->
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->