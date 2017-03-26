<?php
$this->printHead(
                array(
                    'title' => array('title'=>'邀请参数设置', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/admin/index/backhead.css',
				   				 '/admin/setting/setting.css')
                    ,'js' => array('/admin/common.js','/admin/setting/setting.js','/admin/invite/invite.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>

<script>
$(document).ready(function(){
	settingInitInvite();
	});
</script>
<div class="box block_14"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		
		<?php include(VIEW_DIR.'/admin/setting_top.php');?>
		<!-- // 表格数据 -->
		<div class="panel_1 con_table">
			<div class="title"><span><?php echo L::getText('通知参数管理', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="con_tab" id="tabs1">
					<div class="clear"></div>
					
					<div class="tab_content">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<colgroup>
								<col style="width:250px;" />
								<col style="" />
							</colgroup>
							<tr>
								<td><?php echo L::getText('通知模板(注：%content%表示内容，%link%表示链接)', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<textarea style="width:98%" id="invite_tpl" name="invite_tpl"><?php echo $this->invite_settings['invite_tpl']['setting_value'];?></textarea>
								</td>
							</tr>
							
							<tr>
								<td><?php echo L::getText('寄信人', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
									<input class="input7 ~auto_width" id="mail_from_name" name="mail_from_name" type="text" value="<?php echo $this->invite_settings['mail_from_name']['setting_value'];?>">
								</td>
							</tr>
							
							<tr>
								<td><?php echo L::getText('邮箱host', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<input class="input7 ~auto_width" id="mail_host" name="mail_host" type="text" value="<?php echo $this->invite_settings['mail_host']['setting_value'];?>">
								</td>
							</tr>
							<tr>
								<td><?php echo L::getText('邮箱地址', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<input class="input7 ~auto_width" id="mail_from" name="mail_from" type="text" value="<?php echo $this->invite_settings['mail_from']['setting_value'];?>">
								</td>
							</tr>
							<tr>
								<td><?php echo L::getText('邮箱用户名', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<input class="input7 ~auto_width" id="mail_username" name="mail_username" type="text" value="<?php echo $this->invite_settings['mail_username']['setting_value'];?>">
								</td>
							</tr>
							<tr>
								<td><?php echo L::getText('邮箱密码', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<input class="input7 ~auto_width" id="mail_password" name="mail_password" type="text" value="<?php echo $this->invite_settings['mail_password']['setting_value'];?>">
								</td>
							</tr>
							<tr>
								<td><?php echo L::getText('服务器域名', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
								<td>
								<input class="input7 ~auto_width" id="server_domain" name="server_domain" type="text" value="<?php echo $this->invite_settings['server_domain']['setting_value'];?>">
								</td>
							</tr>
							<!-- 
							<tr>
								<td>启用自动通知：</td>
								<td>
								<label id="auto_remind_lb"><?php if($this->invite_settings['last_auto_remind_tm']['setting_value']>=date('Y-m-d H:i:s',time()-60*5)&&$this->invite_settings['is_auto_remind']['setting_value']=='1'){?>
								已启动[<a href="javascript:void(0)" onclick="inviteStartOrStopAutoSending()">停止</a>]
								<?php }else{?>
								未启动[<a href="javascript:void(0)" onclick="inviteStartOrStopAutoSending()">启动</a>]
								<?php }?></label>
								
								</td>
							</tr> -->
						</table>
						
						
						<div class="button_area_search">
							<div class="center">
								<a href="javascript:void(0)" onclick="settingSaveInvite()" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
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