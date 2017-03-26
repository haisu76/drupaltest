<?php
$this->printHead(
                array(
                    'title' => array('title'=>'添加试题', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array('/main.css')
                    ,'js' => array('/admin/question/question.js','/admin/common.js','/admin/manyTrees.js','/admin/tag/tag.js','/order_data.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
                )
            );
?>
<script>
//页面加载完毕后初始化试题
$(document).ready(function(){
	qsnInitEditPage();
});
/**
 * 插入弹出层的添加试题
 * 
 * @author	Dai
 * @date		11.12.2
 * @Copyright (c) 2007-2010 Orivon.Inc
 * @since    	
 * @param 
 * @return 	
 */
function qsnAlertAddOrUpdateQsn()
{
	qsnAddOrUpdateQsn(true);
}

function qsnAlertReturnResult(result)
{
	if(result.res=='success')
	{
		oDialogDivInfo(window.L.getText('添加成功'));
		window.parent.<?php echo $this->alert_option['insert_success']?>(result.info);
	}else{
		oDialogDivInfo(result.info);
	}
}
</script>


<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
<input type="hidden" id="is_alert_qsn" name="is_alert_qsn" value="true" />
<div id="qsn_params_div">
		<?php
			include VIEW_DIR.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'question'.DIRECTORY_SEPARATOR.'questionCtl'.DIRECTORY_SEPARATOR.'editQsnTpl.tpl.php';
		?>
		</div>
	<!-- // 主按钮区(分左中右) -->
		<div class="button_area_search">
		
			<div class="center">
				<a href="javascript:void(0)" onclick="qsnAlertAddOrUpdateQsn()" id="qsn_save_btn" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="javascript:void(0)" onclick="window.parent.qsnCloseSubQsn()" class="btn" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		
		</div>
	

	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
