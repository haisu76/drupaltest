<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
       				,'css'=>array ('/admin/index/backhead.css',
				     '/admin/group/group.css')
                   ,'js' => array(
								  '/admin/songComm.js'
								  )   
                )
            );
?>

	<?php include(VIEW_DIR.'/admin/user_top.php');?>
<body class="dialog_content">

<div class="panel_1 con_tree">
	<div class="content">

		<!-- // 左列 -->
		<div class="col_full">
			<div class="title2 none"><span><?php echo L::getText('请选择目标组', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span></div>
			<ul id="tree_org_left" class="tree"></ul>
		</div>
		
		<div class="button_area_search">
			<div class="inner_box">
				<a class="btn2" onClick="parent.$.fancybox.close();" href="javascript:;"><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a class="btn2" onClick="parent.$.fancybox.close();" href="javascript:;"><?php echo L::getText('取消', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>
		
	</div>
</div>


</div>

</body>
</html>
