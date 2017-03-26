<?php
$this->printHead(
    array(
        'title' => array('title'=>'题库/试卷/考试-试卷管理', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array(                  //加载css
            '/main.css'
        )
    )
);
?>

<!--[if IE 6]>
<script type="text/javascript" src="../js/DD_belatedPNG_0.0.8a-min.js" ></script>
<script type="text/javascript">
DD_belatedPNG.fix('button,img,div,input,a,a:hover');
</script>
<![endif]-->

<div class="box block_1"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		 <?php include(VIEW_DIR . "/admin/exam_top.php");?>
		
		<!-- //搜索  -->
		<div class="panel_1 con_input">
			<div class="title"><span>逐题评分</span></div>
			<div class="content">
				
				<!-- // toolbar_top -->
				<div class="toolbar_top none">
					<div class="left none">
						<a href="#" class="btn2" >ITEM</a>
						<a href="#" class="btn2" >ITEM</a>
						<a href="#" class="btn2" >ITEM</a>
					</div>
					
					<div class="right">
						<!-- // 跳转链接 -->
						<a href="#" class="icon_link" ><span class="icon_jump"></span>顶部</a>
					</div>
				</div>
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<colgroup>
						<col style="width:90px;" />
						<col style="" />
					</colgroup>
					<tr>
						<td>试题内容：</td>
						<td><?php echo htmlspecialchars_decode($this->arrQuestion['qsn_content']); ?></td>
					</tr>
				</table>
				
				<div class="clear"></div>
				
				<!-- // Button -->
				<div class="button_area_search">
					<div class="inner_box">
                        <input type="hidden" id="exam_id" value="<?php echo $this->examId; ?>" />
                        <input type="hidden" id="papr_id" value="<?php echo $this->paprId; ?>" />
                        <input type="hidden" id="exam_times" value="<?php echo $this->examTimes; ?>" />
						<a href="#" class="btn2" id="save_1" >保存评分</a>
						<a href="#" class="btn2" id="close_1" >关闭</a>
					</div>
				</div>
				
				
			</div>
		</div>
		
		
		<!-- // 评分试题 -->
		<div class="panel_1 con_table marking">
			<div class="title"><span>试题</span></div>
			<div class="content">
				<!-- // 主按钮区(分左中右) -->
				<div class="button_area">
					<div class="left hidden">
						<a href="#" class="btn" >ITEM</a>
					</div>
					
					<div class="right">
						<a href="#" class="icon_link" ><span class="icon_jump"></span>顶部</a>
					</div>
					
				</div>
				
<?php echo $this->pageTableHtml; ?>
				
			</div>
			
			
			
			<!-- // Button -->
			<div class="button_area_search">
				<div class="inner_box">
					<a href="#" class="btn2" id="save_2" >保存评分</a>
					<a href="#" class="btn2" id="close_2" >关闭</a>
				</div>
			</div>
				
				
		</div>

		<!-- // 主按钮区(分左中右) -->
		<div class="button_area no_margin">
			<div class="left hidden">
				<a href="#" class="btn" >ITEM</a>
			</div>
			
			<div class="right">
				<a href="#" class="icon_link" ><span class="icon_jump"></span>顶部</a>
			</div>
			
		</div>
				
		<!-- // 主按钮区(分左中右) -->
		<div class="button_area none">
			<div class="left">
				<a href="#" class="btn" >全部清除</a>
			</div>
			
			<div class="center">
				<a href="#" class="btn" >保存</a>
				<a href="#" class="btn" >关闭</a>
			</div>
			<div class="right">
				<a href="#" class="btn" >保存并复制</a>
				<a href="#" class="btn" >保存并新建</a>
			</div>
			
		</div>
	
	
		<!-- // footer -->
        <?php include(VIEW_DIR . "/admin/footer.php");?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->

<script type="text/javascript">
$(function(){
    $('input[name^="markingOption_"]').click(function(){
        var tmpId = '', flag = '', point = 0;
        
        tmpId = $(this).attr('name');
        tmpId = tmpId.replace('markingOption_', '');
        flag = $(this).val();
        point = $('#point_'+ tmpId).val();
        
        if(flag == 'right'){
            $('#score_'+ tmpId).val(point);
            $('#answer_status_'+ tmpId).val('1');
            $('#partRight_'+ tmpId).hide();
        }else if(flag == 'wrong'){
            $('#score_'+ tmpId).val(0);
            $('#answer_status_'+ tmpId).val('0');
            $('#partRight_'+ tmpId).hide();
        }else if(flag == 'partRight'){
            $('#answer_status_'+ tmpId).val('2');
            $('#partRight_'+ tmpId).show();
        }
    });
    
    $('a[id^="partRightItem_"]').click(function(){
        var tmp = '';
        var point = 0;
        
        var tmpId = $(this).attr('id');
        tmpId = tmpId.replace('partRightItem_', '');
        tmp = tmpId.substr(0,1);
        tmpId = tmpId.substr(2);
        
        point = $('#point_'+ tmpId).val();
        point = point/tmp;
        point = point.toFixed(2);
        
        $('#score_'+ tmpId).val(point);
    });
    
    $('input[id^="score_"]').blur(function(){
        if($(this).val() == ''){
            window.L.openCom('tip')('请输入分数');
            $(this).focus();
        }
    });
    
    $('a[id^="save_"]').click(function(){
        $(this).attr('href', 'javascript:void(0)');
        
        var param = {};
        var examId = $('#exam_id').val();
        var paprId = $('#papr_id').val();
        var examTimes = $('#exam_times').val();
        param.exam_id = examId;
        param.papr_id = paprId;
        param.exam_times = examTimes;
        
        param.markingParam = getMarkingParam();
        
        $.ajax({
            type:'post',
            url:window.L._adminUrl+'/paper/manualMarkingCtl.php?a=ajaxSaveMarkingByQuestion',
            data:param,
            dataType:'html',
            error:function(){},
            beforeSend:function(){},
            success:function(data){
                if(data == '1'){
                    window.L.openCom('tip')('操作成功');
                }else{
                    window.L.openCom('tip')('操作失败');
                }
                window.location.reload();
            }
        });
    });
    
    $('a[id^="close_"]').click(function(){
        $(this).attr('href', 'javascript:void(0)');
        
        window.close();
    });
});

function getMarkingParam(){
    //定义变量
    var markingParam = {};
    var tmpId = '';
    var qsnType = '', qsnTypePosition = '', qsnId = '', qsnSubId = '', score = '', remark = '', answerStatus = '', userId = '';
    var oScore = $('input[id^="score_"]');
    var oRemark = $('textarea[id^="remark_"]');
    var oAnswerStatus = $('input[id^="answer_status"]');
    for(var i = 0; i < oScore.length; i++){
        score = oScore.eq(i).val();
        remark = oRemark.eq(i).val();
        answerStatus = oAnswerStatus.eq(i).val();
        if(score == ''){
            continue;
        }
        
        tmpId = oScore.eq(i).attr('id');
        tmpId = tmpId.replace('score_', '');
        tmpId = tmpId.split('_');
        
        qsnType = tmpId[0];
        qsnTypePosition = tmpId[1];
        qsnId = tmpId[2];
        qsnSubId = tmpId[3];
        userId = tmpId[4];
        
        markingParam[i] = {};
        markingParam[i].qsn_type = qsnType;
        markingParam[i].qsn_type_position = qsnTypePosition;
        markingParam[i].qsn_id = qsnId;
        markingParam[i].qsn_sub_id = qsnSubId;
        markingParam[i].user_id = userId;
        markingParam[i].score = score;
        markingParam[i].remark = remark;
        markingParam[i].answer_status = answerStatus;
    }
    
    return markingParam;
}
</script>