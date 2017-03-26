<?php
$this->printHead(
                array(
                    'title' => array('title'=>'数据清理', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/data/data.css'
                    )
                   ,'js' => array(
								 '/admin/common.js'
								 ,'/admin/data/cleanup.js'
					)   
                ) 
            );
?>

<div class="box block_15"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR . "/admin/data_top.php");?>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_input">
			<div class="title"><span><?php echo L::getText('数据清理', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">


				<div class="button_area_search">
					<div class="inner_box">
						<a href="javascript:void(0)" onclick="cleanupAlertCleanupDiv()" class="btn2" ><?php echo L::getText('开始清理', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
	
		<!-- // footer -->
	<?php include(VIEW_DIR.'/admin/footer.php');?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->