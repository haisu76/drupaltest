<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
                    )
                   ,'js' => array(
								  '/admin/songComm.js'
								  )   
                )
            );
?>

<body class="dialog_content">

<!-- // 搜索过滤 -->
<div class="panel_1">
	<div class="title">&nbsp;&nbsp;<?php echo L::getText('批量修改用户密码', array('file'=>__FILE__, 'line'=>__LINE__))?></div>
	<div class="content">
		<div class="">
			<h1><?php echo L::getText('指定要密码的用户范围', array('file'=>__FILE__, 'line'=>__LINE__))?>：</h1>
			<hr class="hr_line" noshade="noshade">
			<p></p>
			<label class=""><input class="radiobox" type="radio" name="radio" value="c" checked /><?php echo L::getText('选中的数据', array('file'=>__FILE__, 'line'=>__LINE__))?></label>&nbsp;
			<label class=""><input class="radiobox" type="radio" name="radio" value="s" /><?php echo L::getText('查询结果', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
		</div>
		
		<br>
		
		<div class="">
			<h1><?php echo L::getText('生成密码方式', array('file'=>__FILE__, 'line'=>__LINE__))?>：</h1>
			<hr class="hr_line" noshade="noshade">
			<p></p>
			<label><input type="radio" class="radiobox" checked /><?php echo L::getText('人工指定密码', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
			<input class="input3 ~auto_width" type="text" id="newPwd" />
		</div>
		
		<br>
	</div>
</div>
</body>
</html>
