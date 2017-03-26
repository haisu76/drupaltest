<?php
$this->printHead(
    array(
        'title' => array('title'=>'测试输出的标题', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/main.css')
    )
);
?>

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		<div id="paperQuestionSort">
		<?php 
		echo $this->pageTableHtml;
		?>
		</div>
        
        <div class="button_area_search">
			<div class="center">
				<a class="btn" href="#" id="savePaperQuestionSort">保存</a>
			</div>
		</div>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
    
<script type="text/javascript">
$(function(){
    //定义上移下移类的配置参数
    var config = {};
    //为上移按钮绑定事件
    $('#paperQuestionSort').find('table tbody').find('a[class^="icon_up"]').click(function(){
        config = {
            'position':-1,
            'elemNameForPos':'qsn_position',
            'flag':0
        };
        $(this).attr('href', 'javascript:void(0)');
        moveTr(config, this);
    });
    //为下移按钮绑定事件
    $('#paperQuestionSort').find('table tbody').find('a[class^="icon_down"]').click(function(){
        config = {
            'position':1,
            'elemNameForPos':'qsn_position',
            'flag':0
        };
        $(this).attr('href', 'javascript:void(0)');
        moveTr(config, this);
    });
    
    //保存试卷试题排序
    $('#savePaperQuestionSort').click(function(){
        var b = true;
        
        b = window.confirm('您确认要重新排列试卷试题的顺序吗？');
        if(!b) return b;
        
        Paper.ajaxPaperQuestionSort();
    });
})
</script>