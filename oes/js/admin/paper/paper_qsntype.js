/**
 * 试卷相关操作的封装
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType = {};


 /**
 * 设置配置参数
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.setConfig = function(config){
    this.config = {
        'flag':1,//标记是否试卷功能调用此方法：1，是试卷功能调用; 0，不是试卷功能调用。
        'elemNameForSwap':'',//需要换行区域的元素的名称，
        'position':1,//position的取值范围：-1，向上移动; 1，向下移动。
        'elemNameForPos':'qsn_type_position_new',//标记行所在位置的html元素的名称。
    };
    for(i in config){
        if(typeof this.config[i] != undefined){
            this.config[i] = config[i];
        }
    }
}


 /**
 * 获得qsn_type_position的最大值
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.getMaxQsnTypePosition = function(){
    //定义变量
    var arrQsnTypePosition = [];
    var maxQsnTypePosition = '', tmpQsnTypePosition = '';
    var paperQuestionTypeId = '';
    var flag = '';
    var qsnTypeSelf = Paper.QsnType;
    
    if(qsnTypeSelf.config.flag == 1){
        //判断是普通试卷还是随机试卷的标记
        flag = $('input[name="paper_type"]:checked').val();
    }
    switch(flag){
        case '0':
            paperQuestionTypeId = 'generalPaperQuestionType';
            break;
        case '1':
            paperQuestionTypeId = 'randomPaperQuestionType';
            break;
        default:
            paperQuestionTypeId = qsnTypeSelf.config.elemNameForSwap;
            break;
    }
    //查找到所有qsn_type_position值，并将这些值存到数组中
    $('#'+paperQuestionTypeId).find('tbody').find('tr').each(function(){
        tmpQsnTypePosition = parseInt($(this).find('input[name="'+ qsnTypeSelf.config.elemNameForPos +'"]').val());
        arrQsnTypePosition.push(tmpQsnTypePosition);
    });
    
    //找到qsn_type_position的最大值
    for(i in arrQsnTypePosition){
        tmpQsnTypePosition = arrQsnTypePosition[i];
        if(maxQsnTypePosition == ''){
            maxQsnTypePosition = tmpQsnTypePosition;
        }else{
            if(tmpQsnTypePosition > maxQsnTypePosition){
                maxQsnTypePosition = tmpQsnTypePosition;
            }
        }
    }
    
    //返回qsn_type_position的最大值
    return maxQsnTypePosition;
}


 /**
 * 试卷题型向上/下移动
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.move = function(config, elem){
    //向上移动
    if(this.config.position == -1){
        this.moveUp(elem);
    }
    
    //向下移动
    if(this.config.position == 1){
        this.moveDown(elem);
    }
}


 /**
 * 试卷题型向上移动
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.moveUp = function(elem){
    //定义变量
    var tmp_qsn_type_position = '';
    var elem_cur_tr = '';
    var elem_prev_tr = '';
    var tmp_class = '';
    
    //当前tr
    elem_cur_tr = $(elem).parents('tr');
    //当前tr的上一个兄弟tr
    elem_prev_tr = $(elem).parents('tr').prev();
    
    //如果当前tr的上一个tr不存在则禁止当前tr向上移动
    if(elem_prev_tr.html() == null) return;
    
    //将上移按钮的href属性由#改为javascript:void(0),这样就不会自动跳到html文档的顶端
    $(elem).attr('href', 'javascript:void(0)');
    
    //当前tr的qsn_type_position_new与上一个tr的qsn_type_position_new互换
    tmp_qsn_type_position = elem_cur_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val();
    elem_cur_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val(elem_prev_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val());
    elem_prev_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val(tmp_qsn_type_position);
    
    //当前tr的class与上一个tr的class互换
    tmp_class = elem_cur_tr.attr('class');
    elem_cur_tr.attr('class', elem_prev_tr.attr('class'));
    elem_prev_tr.attr('class', tmp_class);
    
    //当前tr的位置与上一个tr的位置互换
    elem_prev_tr.before(elem_cur_tr);
    
    //判断当前tr向上移动后，是否移至第一行，如果移至第一行，应该只显示下移按钮
    if(this.isFirst(elem)){
        this.showMoveDownBtn(elem);
    }else{
        this.showBothBtn(elem, 1);
    }
    
    //判断当前tr向上移动后的下一个tr，是否移至最后一行，如果移至最后一行，应该只显示上移按钮
    elem = $(elem).parents('tr').next().find('.icon_down');
    if(this.isLast(elem)){
        this.showMoveUpBtn(elem);
    }else{
        this.showBothBtn(elem, -1);
    }
}


 /**
 * 试卷题型向下移动
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.moveDown = function(elem){
    //定义变量
    var tmp_qsn_type_position = '';
    var elem_cur_tr = '';
    var elem_next_tr = '';
    var tmp_class = '';
    
    //当前tr
    elem_cur_tr = $(elem).parents('tr');
    //当前tr的下一个兄弟tr
    elem_next_tr = $(elem).parents('tr').next();
    
    //如果当前tr的下一个tr不存在则禁止当前tr向下移动
    if(elem_next_tr.html() == null) return;
    
    //将下移按钮的href属性由#改为javascript:void(0),这样就不会自动跳到html文档的顶端
    $(elem).attr('href', 'javascript:void(0)');
    
    //当前tr的qsn_type_position_new与下一个tr的qsn_type_position_new互换
    tmp_qsn_type_position = elem_cur_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val();
    elem_cur_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val(elem_next_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val());
    elem_next_tr.find('input[name="'+ this.config.elemNameForPos +'"]').val(tmp_qsn_type_position);
    
    //当前tr的class与下一个tr的class互换
    tmp_class = elem_cur_tr.attr('class');
    elem_cur_tr.attr('class', elem_next_tr.attr('class'));
    elem_next_tr.attr('class', tmp_class);
    
    //当前tr的位置与下一个tr的位置互换
    elem_next_tr.after(elem_cur_tr);
    
    //判断当前tr向下移动后，是否移至最后一行，如果移至最后一行，应该只显示上移按钮
    if(this.isLast(elem)){
        this.showMoveUpBtn(elem);
    }else{
        this.showBothBtn(elem, -1);
    }
    
    //判断当前tr向下移动后的上一个tr，是否移至第一行，如果移至第一行，应该只显示下移按钮
    elem = $(elem).parents('tr').prev().find('.icon_up');
    if(this.isFirst(elem)){
        this.showMoveDownBtn(elem);
    }else{
        this.showBothBtn(elem, 1);
    }
}


 /**
 * 判断是否题型区域(tbody区域)的第一行(第一个tr)
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.isFirst = function(elem){
    return $(elem).parents('tr').prev().html() == null ? true : false;
}


 /**
 * 判断是否题型区域(tbody区域)的最后一行(最后一个tr)
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.isLast = function(elem){
    return $(elem).parents('tr').next().html() == null ? true : false;
}


 /**
 * 既显示上移按钮又显示下移按钮
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.showBothBtn = function(elem, flag){
    //定义变量
    var tmp_class = '';
    var elem_cur = '';
    var elem_tmp = '';
    
    //flag的取值：{1:向上移， -1:向下移}
    flag = parseInt(flag);
    elem_cur = $(elem);
    
    //如果elem_cur元素不存在，终止此次操作
    if(elem_cur.html() == null) return;
    
    if(flag == 1){
        elem_tmp = $(elem).next();
    }else if(flag == -1){
        elem_tmp = $(elem).prev();
    }else{
        elem_tmp = $(elem).next();
    }
    
    //如果elem_tmp元素不存在，终止此次操作
    if(elem_tmp.html() == null) return;
    
    //显示一个按钮
    tmp_class = elem_cur.attr('class');
    tmp_class = tmp_class.replace(' hidden', '');
    elem_cur.attr('class', tmp_class);
    
    //显示另一个按钮
    tmp_class = elem_tmp.attr('class');
    tmp_class = tmp_class.replace(' hidden', '');
    elem_tmp.attr('class', tmp_class);
}


 /**
 * 只显示上移按钮
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.showMoveUpBtn = function(elem){
    //定义变量
    var tmp_class = '';
    var elem_cur = '';
    var elem_tmp = '';
    
    //如果elem元素不存在，终止此次操作
    if($(elem).html() == null) return;
    
    //隐藏下移按钮
    elem_cur = $(elem);
    tmp_class = elem_cur.attr('class');
    tmp_class = tmp_class.replace(' hidden', '');
    tmp_class += ' hidden';
    elem_cur.attr('class', tmp_class);
    
    //显示上移按钮
    elem_tmp = $(elem).prev();
    tmp_class = elem_tmp.attr('class');
    tmp_class = tmp_class.replace(' hidden', '');
    elem_tmp.attr('class', tmp_class);
}


 /**
 * 只显示下移按钮
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
Paper.QsnType.showMoveDownBtn = function(elem){
    //定义变量
    var tmp_class = '';
    var elem_cur = '';
    var elem_tmp = '';
    
    //如果elem元素不存在，终止此次操作
    if($(elem).html() == null) return;
    
    //隐藏上移按钮
    elem_cur = $(elem);
    tmp_class = elem_cur.attr('class');
    tmp_class = tmp_class.replace(' hidden', '');
    tmp_class += ' hidden';
    elem_cur.attr('class', tmp_class);
    
    //显示下移按钮
    elem_tmp = $(elem).next();
    tmp_class = elem_tmp.attr('class');
    tmp_class = tmp_class.replace(' hidden', '');
    elem_tmp.attr('class', tmp_class);
}