var learningStatisticsObj={searchSubmit:function(){var a={c_name:$.trim($("#c_name").val()),desc_cn:$.trim($("#desc_cn").val()),min_study_tm:$.trim($("#min_study_tm").val()),max_study_tm:$.trim($("#max_study_tm").val())};""===a.c_name&&delete a.c_name;""===a.desc_cn||!$("#desc_cn").attr("key")?delete a.desc_cn:a.desc_cn=$("#desc_cn").attr("key");""===a.min_study_tm&&delete a.min_study_tm;""===a.max_study_tm&&delete a.max_study_tm;var b=window.L.extension.pageTable.classObj,c=document.getElementById("learningStatisticsListPageTable"),
d=b.params(c);d.searchData=a;b.params(c,d,!0)},getGroupListTreeClickFun:function(a){getTree({targetId:"desc_cn",callbackFn:function(b){window.L.each(b,function(a,b){idList[a]=b[a].id;nameList[a]=b[a].name},idList=[],nameList=[]);$(a).attr("key",idList.join(",")).val(nameList.join(","))},dataType:"course_category",isExpand:!1,showRoot:!1,isCheckBox:!0,chkboxType:{Y:"s",N:"ps"}})},getDetailedClickFun:function(a,b){"actual"===a?window.L.openCom("oDialogDiv")(window.L.getText("\u5f53\u524d\u5b66\u4e60\u4eba\u6570"),
"iframe:"+window.L._adminUrl+"/course/course.php?a=learningStatisticsDetailed&type=actual&key="+b):"should"===a&&window.L.openCom("oDialogDiv")(window.L.getText("\u5e94\u8be5\u5b66\u4e60\u4eba\u6570"),"iframe:"+window.L._adminUrl+"/course/course.php?a=learningStatisticsDetailed&type=should&key="+b)}};$(function(){window.L.openCom("wDate",{obj:document.getElementById("min_study_tm"),params:{readOnly:!0}});window.L.openCom("wDate",{obj:document.getElementById("max_study_tm"),params:{readOnly:!0}})});