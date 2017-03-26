<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array(
								  '/admin/user/role.js',
								  '/admin/songComm.js',
								  '/admin/user/bingingCol.js'
								  )   
                )
            );
?>

<body class="dialog_content">
<!-- // 搜索过滤 -->
<div class="panel_1">
	<div class="title"><span><?php echo L::getText('数据绑定', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span><input type="hidden" id="importSelect" value="<?php echo $this->dataSt;?>"/></div>
	<div class="content">
		<div class="">
		<?php echo L::getText('选择要导入的数据文件(CSV格式):', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
		<input  type="text" disabled id="filename" size="35" style="background:#F0F0F0; border:1px #000 solid; color:#F00"/>
        <input name="uploadify" type="file" class="" id="uploadify" size="35" style="display:none" />
        <input type="hidden" id="tempFileName" />
		</div>
		
		<br>
		
		<div class="col_full">
			<?php echo L::getText('必须保留的数据字段：(组名称,用户名)', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
			<hr class="hr_line none" noshade="noshade">		
			<table class="table1" width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:100px;" />
					<col style="width:180px;" />
					<col style="" />
				</colgroup>
				<thead>
				<tr>
					<th><?php echo L::getText('模板列名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></th>
					<th><?php echo L::getText('对应数据库列名称', array('file'=>__FILE__, 'line'=>__LINE__)); ?></th>
					<th><?php echo L::getText('说明', array('file'=>__FILE__, 'line'=>__LINE__)); ?></th>
				</tr>
				</thead>
				<tbody>
                </tbody>	
			</table>	
		</div>
        
        <div style="display:none" id="impportLog">
        	<table class="table1" width="100%" border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:200px;" />
					<col style="width:380px;" />
					<col style="" />
				</colgroup>
				<thead>
				<tr>
					<th><?php echo L::getText('日志类型', array('file'=>__FILE__, 'line'=>__LINE__)); ?></th>
					<th><?php echo L::getText('日志内容', array('file'=>__FILE__, 'line'=>__LINE__)); ?></th>
					<th><?php echo L::getText('状态信息', array('file'=>__FILE__, 'line'=>__LINE__)); ?></th>
				</tr>
				</thead>
				<tbody id="logList">
                </tbody>	
			</table>
        
        
        </div>
		
	</div>
</div>

<!-- // Button -->
<div class="button_area_search">
	<div class="inner_box">
		<a class="btn2" href="<?php echo ROOT_URL, ADMIN_DIR; ?>/user/userCtl.php?a=importUser"><?php echo L::getText('上一步', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> 
		<a class="btn2" href="#" onClick="inportData()"><?php echo L::getText('导入数据', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
	</div>
</div>
</body>
</html>
