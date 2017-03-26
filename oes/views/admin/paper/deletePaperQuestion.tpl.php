<?php
$this->printHead(
    array(
        'title' => array('title'=>'测试输出的标题', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/main.css')
        ,'js' => array(
                '/admin/manyTrees.js'
                ,'/admin/question/question.js'
        )
    )
);
?>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
			<!-- //搜索  -->
				<div class="panel_1 con_input">
			<div class="title"><span>试题搜索</span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1>试题编号</h1>
						<input class="input3 ~auto_width" id="qsn_id" name="qsn_id" type="text" value="">
					</div>

					<div class="search_item">
						<h1>子试题编号</h1>
						<input class="input3 ~auto_width" id="qsn_sub_id" name="qsn_sub_id" type="text" value="">
					</div>
					
					<div class="search_item">
						<h1>试题来源</h1>
                        <a id="qsn_source_name" name="qsn_source_name" href="javascript:qsnSourceTreeShow('qsn_source_name','qsn_source',true)">请选择试题来源</a>
                        <input id="qsn_source" type="hidden" value="" name="qsn_source">
					</div>
					
					<div class="search_item">
						<h1>难度</h1>
						<select class="select2 ~auto_width" id="qsn_level" name="qsn_level">
						<option value="0">请选择难度</option>
						</select>
					</div>
					
					<div class="search_item">
						<h1>状态</h1>
						<select class="select2 ~auto_width" id="qsn_status" name="qsn_status">
						<option value="0">请选择状态</option>
						</select>
					</div>
					
					<div class="search_item">
						<h1>试题标签(用“,” 分割多个标签)</h1>
						<input class="input4 ~auto_width" type="text" name="textfield" id="textfield" />
					</div>
					
					<div class="search_item">
						<h1>创建人</h1>
						<input class="input2 ~auto_width" id="create_user_name" name="create_user_name" type="text" value="">
	
					</div>
					
					
					<div class="search_item">
						<h1>创建日期</h1>
                        <input id="create_tm_start" class="input2 ~auto_width Wdate" type="text" value="" name="create_tm_start" readonly="">
                        <input id="create_tm_end" class="input2 ~auto_width Wdate" type="text" value="" name="create_tm_end" readonly="">
					</div>
					
				</div>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
						<input type="hidden" id="paper_id" value="<?php echo $this->paperId; ?>" />
						<input type="hidden" id="qsn_type" value="<?php echo $this->qsnType; ?>" />
						<input type="hidden" id="qsn_type_position" value="<?php echo $this->qsnTypePosition; ?>" />
						<a href="#" id="deletePaperQuestionSearch" class="btn2" >搜索</a>
						<a href="#" id="deletePaperQuestionReset" class="btn2" >重置</a>
					</div>
				</div>
			
			</div>
		</div>
		
		<div id="deletePaperQuestion">
<?php
echo $this->pageTableHtml;
?>
		</div>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->

<script type="text/javascript">
$(function(){
    $('#deletePaperQuestionSelectSwitch').click(function(){
        var b = $(this).attr('checked') == 'checked' ? true : false;
        $('input[id^="paper_qsn_pk_"]').attr('checked', b);
    });
    
    $('#deletePaperQuestionSearch').click(function(){
        var pageTableObj = $('table[_pagetabledataset="admin_paper_paperCtl::deletePaperQuestionPageProcess"]');
        var params = getSearchPaperQuestionParam();
        window.L.extension.pageTable.classObj.params(pageTableObj.get(0), params, true);
    });
    
    $('#deletePaperQuestionReset').click(function(){
        $('#qsn_id').val('');
        $('#qsn_sub_id').val('');
        $('#qsn_source_name').html('请选择试题来源');
        $('#qsn_source').val('');
        $('#qsn_level').val('');
        $('#qsn_status').val('');
        $('#create_user_name').val('');
        $('#create_tm_start').val('');
        $('#create_tm_end').val('');
    });
    
    window.L.openCom('wDate', {
        'obj' : $('#create_tm_start').get(0), //需绑定的对象
        'params' : {'readOnly' : true} //传递WdatePicker的参数
    }); 
    window.L.openCom('wDate', {
        'obj' : $('#create_tm_end').get(0), //需绑定的对象
        'params' : {'readOnly' : true} //传递WdatePicker的参数
    });
})

function getSearchPaperQuestionParam(){
    //定义变量
    var paperQuestionParam = {};
    var dateParam = {'create_tm_start':'', 'create_tm_end':''};

    paperQuestionParam.paper_id = $('#paper_id').val();
    paperQuestionParam.qsn_type = $('#qsn_type').val();
    paperQuestionParam.qsn_type_position = $('#qsn_type_position').val();
    paperQuestionParam.qsn_id = $('#qsn_id').val();
    paperQuestionParam.qsn_sub_id = $('#qsn_sub_id').val();
    paperQuestionParam.qsn_source = $('#qsn_source').val();
    paperQuestionParam.qsn_level = $('#qsn_level').val();
    paperQuestionParam.qsn_status = $('#qsn_status').val();
    paperQuestionParam.create_user_name = $('#create_user_name').val();
    
    dateParam.create_tm_start = $('#create_tm_start').val();
    dateParam.create_tm_end = $('#create_tm_end').val();
    
    paperQuestionParam.dateParam = dateParam;

    return paperQuestionParam;
}
</script>