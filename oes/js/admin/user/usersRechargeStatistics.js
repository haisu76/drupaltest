var usersRechargeStatisticsObj = {
    //生成充值卡
    'searchSubmit' : function(){
        var postData = {
            'username'         : $.trim($('#username').val()),    //用户名称
            'active_time_min'  : $.trim($('#active_time_min').val()),    //最小使用时间
            'active_time_max'  : $.trim($('#active_time_max').val()),    //最大使用时间
            'create_tm_min'    : $.trim($('#create_tm_min').val()),    //最小生成时间
            'create_tm_max'    : $.trim($('#create_tm_max').val()),    //最大生成时间
            'service_time_min' : $.trim($('#service_time_min').val()),    //最小过期时间
            'service_time_max' : $.trim($('#service_time_max').val()),    //最大过期时间
        };

        for(var i in postData)
        {
            if(!postData[i])
            {
                delete postData[i];
            }
        }

        var paramsObj = L.extension.pageTable.classObj.params(document.getElementById('usersRechargeStatisticsPageTable'));
        paramsObj.searchVar = postData;
        L.extension.pageTable.classObj.params(document.getElementById('usersRechargeStatisticsPageTable'), paramsObj, true);
    }
}

$(function(){
    $('input.input2').each(function(){
        window.L.openCom('wDate', {
            'obj' : this, //需绑定的对象
            'eventType' : 'click', //绑定的触发事件,默认click
            'params' : {'readOnly' : true, 'maxDate' : '2038-01-19'} //传递WdatePicker的参数
        });
    })
}); 