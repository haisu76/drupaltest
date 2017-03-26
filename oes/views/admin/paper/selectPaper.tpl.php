<?php
$this->printHead(
    array(
        'title' => array('title'=>'测试输出的标题', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/main.css')
        ,'js' => array(
                '/admin/manyTrees.js','/admin/paper/paper.js','/admin/common.js'
        )
    )
);
?>

<!-- //搜索  -->
<div class="panel_1 con_input">
    <div class="title"><span>试卷搜索</span></div>

    <div class="content">
        <div class="search">
            <div class="search_item">
                <h1>试卷名称</h1>
                <input class="input3 ~auto_width" type="text" name="papr_name" />
            </div>
            
            <div class="search_item">
                <h1>试卷分类</h1>
                <a id="papr_category_name" onclick="paperCategoryTreeShow('papr_category_name','papr_category')" href="javascript:void(0)" name="papr_category_name">请选择</a>
                <input id="papr_category" type="hidden" name="papr_category" value="">
            </div>
            
            <div class="search_item">
                <h1>试卷总分</h1>
                <input class="input1 ~auto_width" type="text" name="papr_point" />
            </div>
            
            <div class="search_item">
                <h1>试题总数</h1>

                <input class="input1 ~auto_width" type="text" name="papr_qsn_count" />
            </div>
            
            <div class="search_item">
                <h1>状态</h1>
                <select class="select2 ~auto_width" name="papr_status" size="1">
                    <option value="0">请选择</option>
                    <option value="020103">编辑</option>
                    <option value="020101">启用</option>
                    <option value="020102">禁用</option>
                </select>
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
                <input type="hidden" id="excludePaperIds" value="<?php echo $this->excludePaperIds; ?>" />
                <a href="#" class="btn2" id="search">搜索</a>
                <a href="#" class="btn2" id="reset">重置</a>
            </div>
        </div>
      
    </div>
</div>


<!-- // 表格数据 -->

<div class="panel_1 con_table">
    <div class="title"><span>试卷列表</span></div>
    <div class="content">
        <div class="table_content" id="paper">
<?php
echo $this->pageTableHtml;
?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
  
    
    window.L.openCom('wDate', {
        'obj' : $('#create_tm_start').get(0), //需绑定的对象
        'params' : {'readOnly' : true} //传递WdatePicker的参数
    }); 
    window.L.openCom('wDate', {
        'obj' : $('#create_tm_end').get(0), //需绑定的对象
        'params' : {'readOnly' : true} //传递WdatePicker的参数
    });
    
    $('#search').click(function(){
        $(this).attr('href', 'javascript:void(0)');
        selectPaperSearch();
    });
    
    $('#reset').click(function(){
        $(this).attr('href', 'javascript:void(0)');
        selectPaperReset();
    });
});


/**
 * 显示分类树，需要manyTrees.js
 *
 * @author     Egbert
 * @date       11.12.26
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function paperCategoryTreeShow(name_id,value_id){
    var is_show_root=arguments[2]?arguments[2]:false;
    var option = {
    'targetNameId':name_id,
    'targetValueId':value_id,
    'dataType':'papr_category',
    'showRoot':is_show_root
    };
    getTree(option);
}


/**
 * 选择试卷页面的搜索
 *
 * @author     Egbert
 * @date       11.12.26
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function selectPaperSearch(){
    var pageTableObj = $('table[_pagetabledataset="admin_paper_paperCtl::selectPaperPageProcess"]');
    var params = getSelectPaperSearchParam();
    window.L.extension.pageTable.classObj.params(pageTableObj.get(0), params, true);
}
/**
 * 重置选择试卷页面的搜索条件
 *
 * @author     Egbert
 * @date       11.12.26
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function selectPaperReset(){
    $('input[name="papr_name"]').val('');
    $('a[name="papr_category_name"]').html('请选择');
    $('input[name="papr_category"]').val('');
    $('input[name="papr_point"]').val('');
    $('input[name="papr_qsn_count"]').val('');
    $('input[name="papr_status"]').val('');
    $('input[name="create_tm_start"]').val('');
    $('input[name="create_tm_end"]').val('');
}


/**
 * 获得选择试卷页面的搜索参数
 *
 * @author     Egbert
 * @date       11.12.26
 * @copyright  Copyright (c) 2007-2012 Orivon Inc. (http://www.orivon.com)
 * @since      Class available since Release 1.5.0
 * @deprecated Class deprecated in Release 2.0.0
 */
function getSelectPaperSearchParam(){
    //定义变量
    var param = {};
    var dateParam = {'create_tm_start':'', 'create_tm_end':''};
    var excludePaperIdsParam = {};
    var excludePaperIdsVal = '';
    
    param.papr_name = $('input[name="papr_name"]').val();
    param.papr_category = $('input[name="papr_category"]').val();
    param.papr_point = $('input[name="papr_point"]').val();
    param.papr_qsn_count = $('input[name="papr_qsn_count"]').val();
    param.papr_status = $('input[name="papr_status"]').val();
    
    //构造搜索的开始日期和结束日期条件
    dateParam.create_tm_start = $('input[name="create_tm_start"]').val();
    dateParam.create_tm_end = $('input[name="create_tm_end"]').val();
    param.dateParam = dateParam;
    
    //构造排除的试卷编号。防止搜索时，将排除掉的试卷编号也搜索出来
    excludePaperIdsVal = $('#excludePaperIds').val();
    if(excludePaperIdsVal != ''){
        excludePaperIdsVal = excludePaperIdsVal.split("','");
        for(var i = 0; i < excludePaperIdsVal.length; i++){
            //防止传参出错，为参数加密。php端使用时必须用urldecode解密
            excludePaperIdsParam[i] = encodeURIComponent(excludePaperIdsVal[i]);
        }
    }
    param.excludePaperIds = excludePaperIdsParam;
    
    return param;
}
</script>