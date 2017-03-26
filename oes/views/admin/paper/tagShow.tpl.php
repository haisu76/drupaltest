<?php
$this->printHead(
    array(
        'title' => array('title'=>'选择试卷题型标签', 'file'=>__FILE__, 'line'=>__LINE__)
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
			<div class="title"><span>标签搜索</span></div>
			<div class="content">
				<div class="search">
					<div class="search_item">
						<h1>标签名称</h1>
						<input class="input3 ~auto_width" id="tag_name" name="tag_name" type="text" value="">
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
						<a href="#" id="tagSearch" class="btn2" >搜索</a>
						<a href="#" id="tagReset" class="btn2" >重置</a>
					</div>
				</div>
			
			</div>
		</div>
		
		<div id="tag">
<?php
echo $this->pageTableHtml;
?>
		</div>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->
<input type="hidden" id="tag_ids" value="<?php echo $this->tagIds; ?>" />
<input type="hidden" id="tag_names" value="<?php echo $this->tagNames; ?>" />

<script type="text/javascript">
$(function(){
    //注册分页初始化(init)调用的方法
    window.L.strVar('L.extension.pageTable.callback.initLoadList[]', function(pageTableObj, pageTableClassObj, index, type){
    	rememberSelectedTag();
        tagItemBindClick();
    	//L.extension.pageTable.callback.initLoadList.splice(index, 1)
    });
    //注册分页后(after)调用的方法
    window.L.strVar('L.extension.pageTable.callback.afterLoadList[]', function(pageTableObj, pageTableClassObj, index, type){
    	rememberSelectedTag();
        tagItemBindClick();
    	//L.extension.pageTable.callback.initLoadList.splice(index, 1)
    });
    //搜索标签
    $('#tagSearch').click(function(){
        var pageTableObj = $('table[_pagetabledataset="admin_paper_paperCtl::tagShowPageProcess"]');
        var params = getSearchTagParam();
        window.L.extension.pageTable.classObj.params(pageTableObj.get(0), params, true);
    });
    //重置标签
    $('#tagReset').click(function(){
        $('#tag_name').val('');
        $('#create_user_name').val('');
        $('#create_tm_start').val('');
        $('#create_tm_end').val('');
    });
    
    //绑定日期控件
    window.L.openCom('wDate', {
        'obj' : $('#create_tm_start').get(0), //需绑定的对象
        'params' : {'readOnly' : true} //传递WdatePicker的参数
    });
    //绑定日期控件
    window.L.openCom('wDate', {
        'obj' : $('#create_tm_end').get(0), //需绑定的对象
        'params' : {'readOnly' : true} //传递WdatePicker的参数
    });
    
    tagItemBindClick();
    rememberSelectedTag();
});


/**
 * 为标签项绑定点击事件
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function tagItemBindClick(){
    $('input[id^="tag_item_"]').click(function(){
        var checked = $(this).attr('checked') == 'checked' ? true : false;
        if(checked){
            addTags(this);
        }else{
            delTags(this);
        }
    });
}


/**
 * 记录已选择的标签
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function rememberSelectedTag(){
    var oTagIds = $('#tag_ids');
    var arrIds = oTagIds.val().split(',');
    var oTagItem = $('input[id^="tag_item_"]');
    var bol = false;
    
    for(var i = 0; i < oTagItem.length; i++){
        bol = false;
        
        for(var j = 0; j < arrIds.length; j++){
            if(arrIds[j] == ''){
                continue;
            }
            if(oTagItem.eq(i).val() == arrIds[j]){
                bol = true;
                break;
            }
        }
        
        if(bol){
            oTagItem.eq(i).attr('checked', 'checked');
        }else{
            oTagItem.eq(i).removeAttr('checked');
        }
    }
}


/**
 * 获取搜索标签的参数
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function getSearchTagParam(){
    var tagParam = {};
    var dateParam = {'create_tm_start':'', 'create_tm_end':''};
    
    tagParam.tag_name = $('#tag_name').val();
    tagParam.create_user_name = $('#create_user_name').val();
    
    dateParam.create_tm_start = $('#create_tm_start').val();
    dateParam.create_tm_end = $('#create_tm_end').val();
    tagParam.dateParam = dateParam;
    
    return tagParam;
}


/**
 * 添加标签到记录tag id, tag name 的隐藏域
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function addTags(elem){
    var oTagIds = $('#tag_ids');
    var oTagNames = $('#tag_names');
    
    var oTagIdsValue = oTagIds.val() + $(elem).val() + ',';
    var oTagNamesValue = oTagNames.val() + $(elem).attr('tag_name') + ',';
    
    oTagIds.val(oTagIdsValue);
    oTagNames.val(oTagNamesValue);
}


/**
 * 删除已选中的标签
 *
 * @author     Egbert
 * @date       11.12.16
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function delTags(elem){
    var oTagIds = $('#tag_ids');
    var oTagNames = $('#tag_names');
    
    var oTagIdsValue = oTagIds.val();
    var oTagNamesValue = oTagNames.val();
    
    elemTagId = $(elem).val();
    elemTagName = $(elem).attr('tag_name');
    
    oTagIdsValue = oTagIdsValue.replace(elemTagId +',', '');
    oTagNamesValue = oTagNamesValue.replace(elemTagName +',', '');
    
    oTagIds.val(oTagIdsValue);
    oTagNames.val(oTagNamesValue);
}
</script>