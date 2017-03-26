<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array(
								  '/admin/user/role.js',
								  '/admin/songComm.js',
								  '/admin/user/importUsers.js',
								  '/admin/manyTrees.js'
								  )   
                )
            );
?>

<body class="dialog_content">

<!-- // 搜索过滤 -->
<div class="panel_1">
	<div class="title"><span><?php echo L::getText('', array('file'=>__FILE__, 'line'=>__LINE__))?>导入用户</span></div>
	<div class="content">
		<div class="">
			<?php echo L::getText('将要导入的文件名必须是CSV后辍的文件，系统不支持Excel文件，您可以将Excel文件另存为CSV格式后再导入。', array('file'=>__FILE__, 'line'=>__LINE__))?><br>
			<?php echo L::getText('导入数据格式文件模板', array('file'=>__FILE__, 'line'=>__LINE__))?>：<a class="icon_link" href="<?php echo ROOT_URL."/data/csvTemp/import_user.csv";?>" target="_blank" ><span class="icon_download"></span><?php echo L::getText('下载模板', array('file'=>__FILE__, 'line'=>__LINE__))?></a><?php echo L::getText('(状态字段设置为空时表示未审核，否则是已审核)', array('file'=>__FILE__, 'line'=>__LINE__))?>
		</div>
		
		<br>
		
		<div class="">
			<h1><?php echo L::getText('选择导入模式', array('file'=>__FILE__, 'line'=>__LINE__))?>：</h1>
			<hr class="hr_line" noshade="noshade">
			<p></p>
			<label class="" onClick="showUserGroup()"><input class="radiobox" name="model" type="radio" value="1"/><?php echo L::getText('指定目标组', array('file'=>__FILE__, 'line'=>__LINE__))?>——(&nbsp;&nbsp;<label id="groupName"></label>)</label>
            <input type="hidden" id="group_id">
			<p></p>
			<span class="tip_txt padding_text1"><?php echo L::getText('指定要导入的组，用户数据将直接导入该组下面，数据模板中指定的组代码将被忽略。', array('file'=>__FILE__, 'line'=>__LINE__))?></span>
			<p>&nbsp;</p>
			<label class=""><input class="radiobox" name="model" type="radio" value="0" checked /><?php echo L::getText('按数据文件指定的组导入', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
			<p></p>
			<span class="tip_txt padding_text1"><?php echo L::getText('用户数据将按照数据模板中指定的组代码导入所属组中。', array('file'=>__FILE__, 'line'=>__LINE__))?></span>
			
		</div>
		
		<br>
		
		<div class="">
			<h1><?php echo L::getText('指定数据处理方式：', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
			<hr class="hr_line" noshade="noshade">
			<p></p>
			<label class=""><input type="radio" class="radiobox" name="del" value="a" checked /><?php echo L::getText('如果用户已经存在于数据库，不导入这个用户', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
			<p></p>
			<label class=""><input type="radio" class="radiobox" name="del" value="b" /><?php echo L::getText('如果用户已经存在于数据库，删除数据库中用户信息，用当前文件中的用户信息替换', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
		</div>
		

	</div>
</div>

<!-- // Button -->
<div class="button_area_search">
	<div class="inner_box">
		<a class="btn2" onClick="return getHrefConn()" href="#"><?php echo L::getText('下一步', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
	</div>
</div>
<script>
function showUserGroup(){
	var option = {
		'targetId':'select_target_name',
		'targetNameId':'groupName',
		'targetValueId':'group_id',
		'dataType':'group', 
		'isCheckBox':false,
		'showRoot':false,
		'allowCheckParent':true,//是否允许选择父菜单
		'expandLevel':2
	};
	getTree(option);
}

</script>
</body>
</html>
