<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/group/group.css'
                    )
                   ,'js' => array(
								  '/admin/songComm.js'
								  )   
                )
            );
?>
<body class="dialog_content">

<div class="panel_1 con_tree">
	<div class="title none"><span><?php echo L::getText('用户列表', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
	<div class="content">
		<!-- ///////////////////////////////////  -->
		<!-- // 中列_box -->
		<div class="col_box">
			<!-- // 中列 -->
			<div class="col_middle">
				<div class="button_area">
					<div class="inner_box">
						<a href="#" class="btn2" title="<?php echo L::getText('移动节点 右->左', array('file'=>__FILE__, 'line'=>__LINE__))?>" onFocus="this.blur();"  onclick="moveTreeL2R();"><?php echo L::getText('移到右边 ', array('file'=>__FILE__, 'line'=>__LINE__))?>></a>
						<div class="clear"></div><br />
						<a href="#" class="btn2" title="<?php echo L::getText('移动节点 左->右', array('file'=>__FILE__, 'line'=>__LINE__))?>" onFocus="this.blur();" onClick="moveTreeR2L();">< <?php echo L::getText('移到左边', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<div class="clear"></div><br />
						<a href="#" class="btn2" onFocus="this.blur();" title="<?php echo L::getText('恢复初始状态', array('file'=>__FILE__, 'line'=>__LINE__))?>" onClick="reloadTree();"><?php echo L::getText('恢复默认', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			</div><!-- // 中列 end -->

		</div>

		<!-- // 左列 -->
		<div class="col3_left">
			<div class="title2"><span><?php echo L::getText('要管理的组', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span></div>
			<ul id="tree_org_left" class="tree"></ul>
		</div>
		
		<!-- // 右列 -->
		<div class="col3_right">
			<div class="title2"><span><?php echo L::getText('要管理的角色', array('file'=>__FILE__, 'line'=>__LINE__))?>：</span></div>
			<ul id="tree_org_right" class="tree"></ul>
		</div>
		
		<div class="clear"></div>
		
		<div class="button_area_search">
			<div class="inner_box">
				<a class="btn2" onClick="parent.$.fancybox.close();" href="javascript:;"><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a class="btn2" onClick="parent.$.fancybox.close();" href="javascript:;"><?php echo L::getText('取消', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>
</div>
</div>
</body>
</html>
