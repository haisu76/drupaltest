<input type="hidden" id="invite_id" name="invite_id" value=""/>
<input type="hidden" id="invite_content_type" name="invite_content_type" value="<?php echo $this->invite_content_type?>"/>
<div class="mar_tb5"><?php echo L::getText('通知内容', array('file'=>__FILE__, 'line'=>__LINE__))?>:<span><?php foreach($this->invite_content as $ic){?>
	<?php echo $ic['content_name']?><input type="hidden" value="<?php echo $ic['content_id']?>" name="invite_content" id="invite_content_<?php echo $ic['content_id']?>" />
<?php }?></span></div>
<input type="hidden" name="invite_type" id="invite_type" value="0"/>
<!-- 
<div class="mar_tb5">发送时间：

   <select class="select2 ~auto_width" style="width: 187px" id="invite_type" name="invite_type" onchange="inviteChangeInviteType()">
<option value="0">现在</option>	
<option value="1">定时发送</option>	
<option value="2">循环发送</option>	
<option value="3">提前发送</option>		
</select>

    <span class="none">发送时间：<input class="input3" name="" type="text" /></span><span class="none">首次发送时间：<input class="input3" name="" type="text" />间隔时间：<input class="input1" name="" type="text" /></span><span class="none">提前发送：<input class="input1" name="" type="text" /></span>

</div><label id="send_tm_lb" name="send_tm_lb" style="display:none;">

<label id="send_tm_1_lb">发送时间
</label>
<label id="send_tm_2_lb">首次发送时间
</label>
	<input  class="input2 ~auto_width" style="width:160px" id="send_tm" name="send_tm" type="text" value="<?php echo date('Y-m-d H:i:s')?>">
</label>	

		
<label id="interval_tm_lb" style="display:none;">

<label id="interval_tm_2_lb">间隔时间
</label>
<label id="interval_tm_3_lb">提前时间
</label>
<input class="input1 ~auto_width" type="text" value="1" name="interval_tm" id="interval_tm">时
</label> -->

<div><?php echo L::getText('是否插入链接', array('file'=>__FILE__, 'line'=>__LINE__))?>：<span><input name="link_flg" type="checkbox" class="checkbox" id="link_flg" /><?php echo L::getText('插入链接', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>

<div class="mar_tb5"><?php echo L::getText('发送对象', array('file'=>__FILE__, 'line'=>__LINE__))?>：
<select class="select2 ~auto_width" style="width: 187px" id="invite_target_type" name="invite_target_type" onchange="inviteChangeInviteTargetType()">
<option value="1"><?php echo L::getText('所有用户', array('file'=>__FILE__, 'line'=>__LINE__))?></option>	
<option value="2"><?php echo L::getText('指定用户', array('file'=>__FILE__, 'line'=>__LINE__))?></option>	
<option value="3"><?php echo L::getText('指定组', array('file'=>__FILE__, 'line'=>__LINE__))?></option>	
<option value="4"><?php echo L::getText('指定邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?></option>		
</select>

<div id="invite_target_type_2_div" style="display:none;">
 <span class="margin_right_15px ">
<a href="javascript:void(0)" onclick="inviteAlertIncludeUser()" id="group_tree_a" ><?php echo L::getText('请选择用户', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
</span>
<div id="invite_target_2_div"></div>
</div>


<div id="invite_target_type_3_div" style="display:none;"> <span class="margin_right_15px ">
<a href="javascript:void(0)" onclick="inviteGroupTreeShow()" id="group_tree_a" ><?php echo L::getText('请选择组', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
</span>
<div id="invite_target_3_div"></div>
</div>

<div id="invite_target_type_4_div" style="display:none;">
 <span class="margin_right_15px "><a href="javascript:void(0)" onclick="inviteAddEmail()"><?php echo L::getText('添加邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
 </span>
<div id="invite_target_4_div"></div>
</div>



</div>

<div class="mar_tb5"><?php echo L::getText('发送内容', array('file'=>__FILE__, 'line'=>__LINE__))?>：<textarea id="invite_content" name="invite_content"></textarea></div>

<div>

<a href="javascript:void(0)" class="btn" onclick="inviteModifyInvite()"><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a> <a href="javascript:void(0)" onclick="alertCloseAlertDiv()" class="btn"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>

</div>

<script language="javascript" charset="UTF-8" src="<?php echo ROOT_URL;?>/js/admin/userApi.js"></script>
