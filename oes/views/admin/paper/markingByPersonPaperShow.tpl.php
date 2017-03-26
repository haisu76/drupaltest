<?php
$examId = $this->exam_id;
$userId = $this->user_id;
$paperId = $this->paper_id;
$examTimes = $this->exam_times;

$paperObj = new admin_paper_paper();
$paperShowObj = new common_paperShow();
$paperShowObj->setShowAnswer(true);
$paperShowObj->setShowMarkingOption(true);
$paperShowObj->setShowMarkingRemark(true);
$paperShowObj->setShowUserAnswer(true);

//获得试卷相关信息
$paperInfo = $paperObj->getPaperByPaperPk($paperId);
if(!is_array($paperInfo) || empty($paperInfo)) exit('试卷不存在');
//获得试卷试题，每条记录都包含了试卷，试卷题型，试卷试题的信息
$paperQsnTypeQsn = $paperObj->getPaperQuestionByUserExamPk($examId, $userId, $paperId, $examTimes);
?>

<?php
$this->printHead(
    array(
        'title' => array('title'=>'题库/试卷/考试-添加试题-问答', 'file'=>__FILE__, 'line'=>__LINE__)
    )
);
?>
    <div>
        <input type="hidden" id="exam_id" value="<?php echo $examId; ?>" />
        <input type="hidden" id="user_id" value="<?php echo $userId; ?>" />
        <input type="hidden" id="papr_id" value="<?php echo $paperId; ?>" />
        <input type="hidden" id="exam_times" value="<?php echo $examTimes; ?>" />
        <input type="button" value="保存" id="save" />
        <input type="button" value="关闭" id="close" />
    </div>
    
    <h2>试卷</h2>
    <div>
        <ul>
            <li>试卷编号：<?php echo $paperId; ?></li>
            <li>试卷名称：<?php echo $paperInfo['papr_name']; ?></li>
        </ul>
    </div>

    <div>
<?php
$qsnType = '';
$qsnTypeTitle = '';
$qsnTypePosition = 0;

foreach($paperQsnTypeQsn as $v){
    if($qsnTypeTitle == $v['qsn_type_title']){
        //把不同/相同试卷题型的题型标题相同的题型归类为同一题型。此时不导出试卷题型，只导出试卷试题
        echo $paperShowObj->getPaperQuestionTpl($v);
    }else if($qsnType == $v['qsn_type'] && $qsnTypePosition == $v['qsn_type_position']){
        //相同试卷题型时，只导出试卷试题
        echo $paperShowObj->getPaperQuestionTpl($v);
    }else{
        //不同试卷题型时，既导出试卷题型又导出试卷试题
        $paperShowObj->paperQsnTypeNo++;
        $paperShowObj->paperQsnFirstNo = 0;
        echo $paperShowObj->getPaperQuestionTypeTpl($v);
        echo $paperShowObj->getPaperQuestionTpl($v);
    }
    
    //为临时变量试卷题型重新赋值
    $qsnType = $v['qsn_type'];
    //为临时变量试卷题型位置重新赋值
    $qsnTypePosition = $v['qsn_type_position'];
    //为临时变量试卷题型标题重新赋值
    $qsnTypeTitle = $v['qsn_type_title'];
}
?>
    </div>

<script type="text/javascript">
$(function(){
    $('input[name^="markingOption_"]').click(function(){
        var point = '';
        var tmpName = '';
        tmpName = $(this).attr('name');
        tmpName = tmpName.replace('markingOption_', '');
        
        var tmpValue = '';
        tmpValue = $(this).val();
        if(tmpValue == 'partRight'){
            $('#partRight_'+ tmpName).show();
            $('#answer_status_'+ tmpName).val('2');
        }else if(tmpValue == 'right'){
            point = $('#point_'+ tmpName).val();
            $('#partRight_'+ tmpName).hide();
            $('#score_'+ tmpName).val(point);
            $('#answer_status_'+ tmpName).val('1');
        }else if(tmpValue == 'wrong'){
            $('#partRight_'+ tmpName).hide();
            $('#score_'+ tmpName).val(0);
            $('#answer_status_'+ tmpName).val('0');
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
    
    $('#save').click(function(){
        //定义变量
        var param = {};
        var examId = $('#exam_id').val();
        var userId = $('#user_id').val();
        var paprId = $('#papr_id').val();
        var examTimes = $('#exam_times').val();
        
        param.exam_id = examId;
        param.user_id = userId;
        param.papr_id = paprId;
        param.exam_times = examTimes;
        
        param.markingParam = getMarkingParam();
        
        $.ajax({
            type:'post',
            url:window.L._adminUrl+'/paper/manualMarkingCtl.php?a=ajaxSaveMarkingByPerson',
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
    
    $('#close').click(function(){
        window.close();
    });
});

function getMarkingParam(){
    //定义变量
    var markingParam = {};
    var tmpId = '';
    var qsnType = '', qsnTypePosition = '', qsnId = '', qsnSubId = '', score = '', remark = '', answerStatus = '';
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
        
        markingParam[i] = {};
        markingParam[i].qsn_type = qsnType;
        markingParam[i].qsn_type_position = qsnTypePosition;
        markingParam[i].qsn_id = qsnId;
        markingParam[i].qsn_sub_id = qsnSubId;
        markingParam[i].score = score;
        markingParam[i].remark = remark;
        markingParam[i].answer_status = answerStatus;
    }
    
    return markingParam;
}
</script>