<div class="panel_1 con_input">
	<div class="content">
		<div class="col_full">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<colgroup>
					<col style="width:50px;" />
					<col style="" />
					<col style="" />
				</colgroup>
				<tr>
					<td></td><td><?php echo L::getText('用户当前所在组', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td><?php echo isset($this->userGroupMsg[0]['group_name'])?$this->userGroupMsg[0]['group_name']:'' ;?></td>
					
				</tr>
				<tr>
					<td></td><td class="align_top"><?php echo L::getText('将用户调整至组', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
					<td>  
                    <input class="input3 ~auto_width" type="text" id="select" onClick="showUserGroup2()"/>
                    <input type="hidden" id="select2"/>
                    </td>
				</tr>
			</table>
		</div>	  
	</div>
</div>