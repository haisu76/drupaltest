EXAM_IS_ANIMATING=!1;
function examDisplsyQsn(a){if(!EXAM_IS_ANIMATING){EXAM_IS_ANIMATING=!0;var c=null,d=null,e=null,b=null;$("#paper_content_div >div[name='qsn_content_div']").each(function(a){if("none"!=$(this).css("display"))return e=a,c=$(this).attr("qsn_id")+$(this).attr("qsn_sub_id"),!1});switch(a){case "prev":d=0<e?$($("#paper_content_div >div[name='qsn_content_div']").get(e-1)).attr("qsn_id")+$($("#paper_content_div >div[name='qsn_content_div']").get(e-1)).attr("qsn_sub_id"):$($("#paper_content_div >div[name='qsn_content_div']").get(0)).attr("qsn_id")+$($("#paper_content_div >div[name='qsn_content_div']").get(0)).attr("qsn_sub_id");
break;case "next":d=e<$("#paper_content_div > div[name='qsn_content_div']").size()-1?$($("#paper_content_div > div[name='qsn_content_div']").get(e+1)).attr("qsn_id")+$($("#paper_content_div > div[name='qsn_content_div']").get(e+1)).attr("qsn_sub_id"):$($("#paper_content_div >div[name='qsn_content_div']").get($("#paper_content_div >div[name='qsn_content_div']").size()-1)).attr("qsn_id")+$($("#paper_content_div >div[name='qsn_content_div']").get($("#paper_content_div >div[name='qsn_content_div']").size()-
1)).attr("qsn_sub_id");break;default:d="number"==typeof a?$($("#paper_content_div >div[name='qsn_content_div']").get(a)).attr("qsn_id")+$($("#paper_content_div >div[name='qsn_content_div']").get(a)).attr("qsn_sub_id"):a}void 0==$("#paper_content_div >#qsn_content_div_"+d).get(0)&&(d=$($("#paper_content_div >div[name='qsn_content_div']").get(0)).attr("qsn_id"));b=$("#qsn_content_absposition_"+d).val();$("#exam_current_qsn_num").html(parseInt(b)+1);if(c!=d)switch($("#paper_content_div >#qsn_content_div_"+
d).height(),"fade"){case "fade":null!=c?$("#qsn_content_div_"+c).fadeOut(150,function(){$("#qsn_content_div_"+d).fadeIn(150,function(){EXAM_IS_ANIMATING=!1;"1"==$("#exam_ie_only_flg").val()&&(EXAM_KEEP_RECOVERY=!0,examRecovery(),EXAM_KEEP_RECOVERY=!1)})}):$("#qsn_content_div_"+d).fadeIn(200,function(){EXAM_IS_ANIMATING=!1})}else EXAM_IS_ANIMATING=!1}}
function examSubmitPapr(a){var a=a?a:!1,c=$("#exam_type").val(),d=$("#exam_mode").val(),e=Math.round((new Date).getTime()/1E3),b=examGetUserExamAnswer(),e=e-EXAM_START_TIME,f=Math.floor(e/3600),g=Math.floor(e%3600/60),k=Math.floor(e%3600%60);b.exam_total_tm=(10>f?"0"+f:f)+":"+(10>g?"0"+g:g)+":"+(10>k?"0"+k:k);b.exam_times=$("#exam_times").val();b.papr_id=$("#papr_id").val();b.exam_id=$("#exam_id").val();EXAM_INFO=b;"1"==c?a?(IS_KEEP_COUNTING_DOWN=!1,examMakeExerciseUserScore(b)):oDialogDiv(window.L.getText("\u4ea4\u5377"),
'text:<div style="width:200px; height:30px;">'+window.L.getText("\u60a8\u786e\u5b9a\u5f00\u59cb\u8ba1\u7b97\u5206\u6570?")+"</div>","270px","170px",[2,function(a){a&&(IS_KEEP_COUNTING_DOWN=!1,examMakeExerciseUserScore(b))}]):"0"==EXAM_DISABLE_SUBMIT||e>60*EXAM_DISABLE_SUBMIT||a?!a&&b.is_unanswered&&"030102"!=d?oDialogDiv(window.L.getText("\u4ea4\u5377"),'text:<div style="width:200px; height:30px;">'+window.L.getText("\u60a8\u8fd8\u6709\u672a\u7b54\u5b8c\u7684\u9898\uff0c\u786e\u5b9a\u4ea4\u5377?")+
"</div>","270px","150px",[2,function(a){a?(IS_KEEP_COUNTING_DOWN=!1,examAddUserAnswer(b)):examDisplayDiv("exam_index_div")}]):a?(a=Math.round(10*Math.random()),""!=EXAM_ALERT_DIV_MARK&&oDialogDiv.dialogClose(EXAM_ALERT_DIV_MARK),EXAM_ALERT_DIV_MARK=oDialogDiv("<label id='exam_alert_info_title'>"+window.L.getText("\u4ea4\u5377\u4e2d")+"</label>",'text:<div id="exam_submit_info"><div class="popup_box_info"><label id="exam_counting_down_lb">'+a+"</label>"+window.L.getText("\u79d2\u540e\u63d0\u4ea4\u7b54\u6848")+
"</div></div>","auto","auto",[0]),setTimeout("examAddUserAnswer(null)",1E3*a),examCountingDown(a,"exam_counting_down_lb")):oDialogDiv(window.L.getText("\u4ea4\u5377"),'text:<div style="width:200px; height:30px;">'+window.L.getText("\u60a8\u786e\u5b9a\u4ea4\u5377?")+"</div>","270px","150px",[2,function(a){a&&(IS_KEEP_COUNTING_DOWN=!1,examAddUserAnswer(b))}]):oDialogDiv(window.L.getText("\u8b66\u544a"),'text:<div style="width:240px; height:50px;">'+window.L.getText("\u8fd8\u672a\u8fbe\u5230\u4ea4\u5377\u65f6\u95f4\uff0c\u8bf7\u5728"+
(60*EXAM_DISABLE_SUBMIT-e)+"\u79d2\u540e\u91cd\u8bd5")+"</div>","250px","100px",[1])}
function examMakeExerciseUserScore(a){window.onbeforeunload=null;var c=0,d=$("#exam_blank_flg").val(),e=$("#exam_cloze_flg").val(),b={};$.each(a.info,function(a,f){var h=null,n=!1,j=0;b[a]={is_correct:!1,is_error:!1};switch(f.qsn_type){case "010101":h=L.JSON.parse($("#exam_qsn_answer_"+a).val());null!=f.user_answer?$.each(h,function(c,d){$.each(f.user_answer,function(c,f){d.qsn_answer==f.user_answer?(b[a].is_correct=!0,j=parseFloat($("#exam_qsn_point_"+a).val())):b[a].is_error=!0})}):b[a].is_error=
!0;break;case "010102":var h=L.JSON.parse($("#exam_qsn_answer_"+a).val()),q=0,p=0;null!=f.user_answer?($.each(h,function(a,b){n=!1;q++;p=0;$.each(f.user_answer,function(a,c){p++;b.qsn_answer==c.user_answer&&(n=!0)});if(!n)return!1}),q!=p||!n?(b[a].is_error=!0,n=!1):(b[a].is_correct=!0,j=parseFloat($("#exam_qsn_point_"+a).val()))):b[a].is_error=!0;break;case "010103":h=L.JSON.parse($("#exam_qsn_answer_"+a).val());null!=f.user_answer?$.each(h,function(c,d){$.each(f.user_answer,function(c,f){d.qsn_answer==
f.user_answer?(b[a].is_correct=!0,j=parseFloat($("#exam_qsn_point_"+a).val())):b[a].is_error=!0})}):b[a].is_error=!0;break;case "010104":var l=0,i=0,o=$("#qsn_option_count_"+a).val(),m="",h=L.JSON.parse($("#exam_qsn_answer_"+a).val()),r=f.user_answer;$.each(h,function(a,b){l++;98==o||99==o?$.each(r,function(a,c){if(void 0!=c&&(m=decodeURIComponent(c.user_answer),99==o&&(m=m.toUpperCase(),b.qsn_answer=b.qsn_answer.toUpperCase()),b.qsn_answer==m))return i++,r[a]=void 0,!1}):(m=decodeURIComponent(f.user_answer[b.qsn_item_id].user_answer),
97==o&&(m=m.toUpperCase(),b.qsn_answer=b.qsn_answer.toUpperCase()),b.qsn_answer==m&&i++)});if("1"==d){if(j=parseFloat($("#exam_qsn_point_"+a).val())*i/l,0<i&&(b[a].is_correct=!0),i<l||0==i)b[a].is_error=!0}else l==i?(b[a].is_correct=!0,j=parseFloat($("#exam_qsn_point_"+a).val())):b[a].is_error=!0;break;case "010105":case "010106":$.each(f.user_answer,function(c,d){b[d.qsn_id+d.qsn_sub_id]={is_correct:!1,is_error:!1};h=L.JSON.parse($("#exam_qsn_answer_"+d.qsn_id+d.qsn_sub_id).val());h[1].qsn_answer==
decodeURIComponent(d.user_answer)?(b[d.qsn_id+d.qsn_sub_id].is_correct=!0,b[a].is_correct=!0,j+=parseFloat($("#exam_qsn_point_"+d.qsn_id+d.qsn_sub_id).val())):(b[d.qsn_id+d.qsn_sub_id].is_error=!0,b[a].is_error=!0)});break;case "010108":if(i=l=0,h=L.JSON.parse($("#exam_qsn_answer_"+a).val()),$.each(h,function(a,b){l++;b.qsn_answer==f.user_answer[b.qsn_item_id-1].user_answer&&i++}),"1"==e){if(j=parseFloat($("#exam_qsn_point_"+a).val())*i/l,0<i&&(b[a].is_correct=!0),i<l||0==i)b[a].is_error=!0}else l==
i?(b[a].is_correct=!0,j=parseFloat($("#exam_qsn_point_"+a).val())):b[a].is_error=!0}if(0!=f.qsn_sub_id&&(void 0==b[$("div[qsn_sub_id='"+f.qsn_id+"']").attr("qsn_id")+f.qsn_id]&&(b[$("div[qsn_sub_id='"+f.qsn_id+"']").attr("qsn_id")+f.qsn_id]={is_correct:!1,is_error:!1}),b[a].is_correct&&(b[$("div[qsn_sub_id='"+f.qsn_id+"']").attr("qsn_id")+f.qsn_id].is_correct=!0),b[a].is_error))b[$("div[qsn_sub_id='"+f.qsn_id+"']").attr("qsn_id")+f.qsn_id].is_error=!0;c+=j});oDialogDiv("<label id='exam_alert_info_title'>"+
window.L.getText("\u5f97\u5206")+"</label>",'text:<div id="exam_submit_info"> <div class="popup_box_text">'+window.L.getText("\u60a8\u7684\u8003\u8bd5\u6210\u7ee9\u4e3a")+":"+c+"</div></div>","auto","auto",[1]);var f=2;$.each(b,function(a,b){f=2;b.is_correct||(f=0);b.is_error||(f=1);examSetExamResult(a,f)});examShowResultInfo();$("#exam_submit_btn").hide()}EXAM_INFO=null;EXAM_ALERT_DIV_MARK="";
function examAddUserAnswer(a){null==a&&(a=EXAM_INFO);var c=L._rootUrl+"/exam/examCtl.php?a=addExamUserAnswer",a="exam_info="+encodeURIComponent(L.JSON.stringify(a));""!=EXAM_ALERT_DIV_MARK&&oDialogDiv.dialogClose(EXAM_ALERT_DIV_MARK);EXAM_ALERT_DIV_MARK=oDialogDiv("<label id='exam_alert_info_title'>"+window.L.getText("\u4ea4\u5377\u4e2d")+"</label>",'text:<div id="exam_submit_info"> <div class="popup_box_text">'+window.L.getText("\u7b54\u6848\u6b63\u5728\u63d0\u4ea4...")+"</div></div>","270px","150px",
[0]);$.ajax({type:"POST",async:!0,url:c,data:a,dataType:"json",success:function(a){"success"==a.res?(a=Math.round(10*Math.random()),$("#exam_submit_info").html('<div class="popup_box_text">'+window.L.getText("\u7b54\u6848\u63d0\u4ea4\u6210\u529f")+'</div><br><div class="popup_box_info"><label id="exam_counting_down_lb">'+a+"</label>"+window.L.getText("\u79d2\u540e\u8ba1\u7b97\u6210\u7ee9")+"</div>"),setTimeout("examMakeUserScore()",1E3*a),examCountingDown(a,"exam_counting_down_lb"),EXAM_KEEP_GET_CMD=
EXAM_KEEP_RECOVERY=!1):$("#exam_submit_info").html('<div class="popup_box_text">'+a.info+'</div><br><div class="popup_box_info"><br><a class="btn" onclick="examAddUserAnswer(null);return false;">'+window.L.getText("\u518d\u6b21\u63d0\u4ea4\u8bd5\u5377")+"</a></div>")},error:function(){$("#exam_submit_info").html('<div class="popup_box_text">'+window.L.getText("\u7b54\u6848\u63d0\u4ea4\u5931\u8d25")+'</div><br><div class="popup_box_info"><label id="exam_counting_down_lb">5</label>'+window.L.getText("\u79d2\u540e\u91cd\u65b0\u63d0\u4ea4...")+
"</div>");setTimeout("examAddUserAnswer(null)",5E3);examCountingDown(5,"exam_counting_down_lb")}})}
function examMakeUserScore(){window.onbeforeunload=null;var a={exam_id:$("#exam_id").val(),papr_id:$("#papr_id").val(),exam_times:$("#exam_times").val()};$("#exam_submit_info").html(window.L.getText("\u6b63\u5728\u8ba1\u7b97\u6210\u7ee9..."));var c=L._rootUrl+"/exam/examCtl.php?a=makeExamUserScore",a="exam_info="+encodeURIComponent(L.JSON.stringify(a));$.ajax({type:"POST",async:!0,url:c,data:a,dataType:"json",success:function(a){"success"==a.res?"1"==$("#exam_submit_display_result").val()?($("#exam_alert_info_title").html(window.L.getText("\u5f97\u5206")),
$("#exam_submit_info").html('<div class="popup_box_text">'+window.L.getText("\u672c\u6b21\u8003\u8bd5\u7684\u5f97\u5206\u662f")+":"+a.info+window.L.getText("\u5206")+'<br><br><a class="btn" href="javascript:void(0)" onclick="examCloseWindow();return false;">'+window.L.getText("\u5173\u95ed\u9875\u9762")+"</a></div>")):($("#exam_alert_info_title").html(window.L.getText("\u4ea4\u5377\u6210\u529f")),$("#exam_submit_info").html('<div class="popup_box_text">'+window.L.getText("\u672c\u6b21\u8003\u8bd5\u7ed3\u675f")+
'</div><br><div class="popup_box_info"><label id="exam_counting_down_lb">5</label>'+window.L.getText("\u79d2\u540e\u5173\u95ed\u7a97\u53e3")+"</div>"),setTimeout("examCloseWindow()",5E3),examCountingDown(5,"exam_counting_down_lb")):($("#exam_submit_info").html('<div class="popup_box_text">'+window.L.getText("\u6210\u7ee9\u8ba1\u7b97\u5931\u8d25")+'<br><label id="exam_counting_down_lb">5</label>'+window.L.getText("\u79d2\u540e\u91cd\u65b0\u63d0\u4ea4...")+"</div>"),setTimeout("examMakeUserScore()",
5E3),examCountingDown(5,"exam_counting_down_lb"))},error:function(){$("#exam_submit_info").html('<div class="popup_box_text">'+window.L.getText("\u6210\u7ee9\u8ba1\u7b97\u5931\u8d25")+'<br><label id="exam_counting_down_lb">5</label>'+window.L.getText("\u79d2\u540e\u91cd\u65b0\u63d0\u4ea4...")+"</div>");examCountingDown(5,"exam_counting_down_lb");setTimeout("examMakeUserScore()",5E3)}})}function examCloseWindow(){examSetFullScreen(!1);window.opener=null;window.close()}
function examGetUserExamAnswer(){var a={res:"success",info:{},is_unanswered:!1,unanswered_qsns:{},answered_qsns:{}},c={},d=null;$("[name='qsn_content_div']").each(function(){d=$(this).attr("qsn_id");c={qsn_id:d,qsn_sub_id:$(this).attr("qsn_sub_id"),qsn_type:$("#exam_qsn_type_"+d+$(this).attr("qsn_sub_id")).val(),qsn_type_position:$("#exam_qsn_type_pos_"+d+$(this).attr("qsn_sub_id")).val(),qsn_position:$("#exam_qsn_pos_"+d+$(this).attr("qsn_sub_id")).val(),qsn_abs_pos:$("#exam_qsn_abs_pos_"+d+$(this).attr("qsn_sub_id")).val(),
user_answer:null};switch(c.qsn_type){case "010101":$("[name='exam_qsn_answer_"+d+c.qsn_sub_id+"']").each(function(a){"checked"==$(this).attr("checked")&&(null==c.user_answer&&(c.user_answer={}),c.user_answer[a]={qsn_item_id:$(this).attr("qsn_item_id"),qsn_item_sub_id:$(this).attr("qsn_item_sub_id"),user_answer:$(this).val()})});null==c.user_answer&&(a.unanswered_qsns[d+c.qsn_sub_id]={qsn_id:d,qsn_sub_id:c.qsn_sub_id},a.is_unanswered=!0);break;case "010102":$("[name='exam_qsn_answer_"+d+c.qsn_sub_id+
"']").each(function(a){"checked"==$(this).attr("checked")&&(null==c.user_answer&&(c.user_answer={}),c.user_answer[a]={qsn_item_id:$(this).attr("qsn_item_id"),qsn_item_sub_id:$(this).attr("qsn_item_sub_id"),user_answer:$(this).val()})});null==c.user_answer&&(a.unanswered_qsns[d+c.qsn_sub_id]={qsn_id:d,qsn_sub_id:c.qsn_sub_id},a.is_unanswered=!0);break;case "010103":$("[name='exam_qsn_answer_"+d+c.qsn_sub_id+"']").each(function(a){"checked"==$(this).attr("checked")&&(null==c.user_answer&&(c.user_answer=
{}),c.user_answer[a]={qsn_item_id:1,qsn_item_sub_id:0,user_answer:$(this).val()})});null==c.user_answer&&(a.unanswered_qsns[d+c.qsn_sub_id]={qsn_id:d,qsn_sub_id:c.qsn_sub_id},a.is_unanswered=!0);break;case "010104":var e=0;$("#user_answer_div_"+d+c.qsn_sub_id+" input[type='text']").each(function(){e=parseInt($(this).attr("id").split("_")[1]);if(!isNaN(e)&&(null==c.user_answer&&(c.user_answer={}),c.user_answer[e]={qsn_item_id:e,qsn_item_sub_id:0,user_answer:encodeURIComponent($(this).val())},""==$.trim($(this).val())))a.unanswered_qsns[d+
c.qsn_sub_id]={qsn_id:d,qsn_sub_id:c.qsn_sub_id},a.is_unanswered=!0});break;case "010105":case "010106":$("textarea[name='exam_qsn_answer_"+d+c.qsn_sub_id+"']").each(function(b){null==c.user_answer&&(c.user_answer={});c.user_answer[b]={qsn_id:$(this).attr("qsn_id"),qsn_sub_id:$(this).attr("qsn_sub_id"),qsn_item_id:1,qsn_item_sub_id:0,user_answer:encodeURIComponent($(this).val())};""==$.trim($(this).val())&&(a.unanswered_qsns[d+c.qsn_sub_id]={qsn_id:d,qsn_sub_id:c.qsn_sub_id},a.is_unanswered=!0)});
break;case "010107":c=null;break;case "010108":e=0,$("#user_answer_div_"+d+c.qsn_sub_id+" select").each(function(b){e=parseInt($(this).attr("id").split("_")[1]);if(!isNaN(e)&&(null==c.user_answer&&(c.user_answer={}),c.user_answer[b]={qsn_item_id:e,qsn_item_sub_id:0,user_answer:$(this).val()},"0"==$(this).val()))a.unanswered_qsns[d+c.qsn_sub_id]={qsn_id:d,qsn_sub_id:c.qsn_sub_id},a.is_unanswered=!0})}null!=c&&(a.info[d+c.qsn_sub_id]=c,void 0==a.unanswered_qsns[d+c.qsn_sub_id]&&(a.answered_qsns[d+c.qsn_sub_id]=
{qsn_id:d,qsn_sub_id:c.qsn_sub_id}))});return a}var IS_KEEP_COUNTING_DOWN=!0;
function examStartCountingDown(){if("unlimited"==EXAM_LAST_TIME)$("#exam_last_time_label").html("\u4e0d\u9650\u5236");else{var a=new Date,a=Math.round(a.getTime()/1E3);EXAM_LAST_TIME=parseInt(EXAM_LAST_TIME);var c=EXAM_LAST_TIME-(a-EXAM_START_TIME);if(0<=c){IS_KEEP_COUNTING_DOWN&&setTimeout("examStartCountingDown()",1E3);var a=Math.floor(c/86400),d=Math.floor(c%86400/3600),e=Math.floor(c%86400%3600/60),c=Math.floor(c%86400%3600%60),b="";0!=a&&(b=a+"D ");$("#exam_last_time_label").html(b+((10>d?"0"+
d:d)+":")+((10>e?"0"+e:e)+":")+(10>c?"0"+c:c))}else examSubmitPapr(!0)}}function examToggleExamNotice(){$("#exam_content_notice_div").toggle();$("#exam_notice_cd_span").html("")}function examNoticeCountingDown(){var a=$("#exam_notice_cd_span").html(),a=a.substring(1,3);"0"==a.substring(0,1)&&(a=a.substring(1,2));a=parseInt(a)-1;if(isNaN(a))return!1;0>=a?examToggleExamNotice():(setTimeout("examNoticeCountingDown()",1E3),10>a&&(a="0"+a),$("#exam_notice_cd_span").html("("+a+")"))}
function examMarkQsn(a){var c=!0,d=0;$("[name='exam_mark_qsn_a']").each(function(){d++;$(this).attr("qsn_id")==a&&(c=!1)});if(c){d++;var e=parseInt($("#exam_qsn_type_pos_"+a).val()),b=$("#exam_qsn_abs_pos_"+a).val(),f=$("#qsn_content_div_"+a+" h1.num").html(),f='<a href="javascript:void(0)" id="exam_mark_qsn_a_'+a+'" name="exam_mark_qsn_a" qsn_id="'+a+'" onclick="examJumpToQsn(\''+a+"');return false;\">"+e+"-"+f+"</a>";if(void 0==$("[name='exam_mark_qsn_a']").attr("qsn_id"))$("#exam_mark_qsn_div").append(f);
else{var g=null;$("[name='exam_mark_qsn_a']").each(function(){var a=$(this).html().split("-");if(e>parseInt(a[0])||e==parseInt(a[0])&&b>parseInt(a[1]))g=$(this)});null==g?(g=$($("[name='exam_mark_qsn_a']").get(0)),g.before(f)):g.after(f)}$("#exam_mark_icon_"+a).removeClass();$("#exam_mark_icon_"+a).addClass("icon_label_on")}else d--,$("#exam_mark_qsn_a_"+a).remove(),$("#exam_mark_icon_"+a).removeClass(),$("#exam_mark_icon_"+a).addClass("icon_label_off");$("#exam_mark_qsn_count_label").html(d)}
function examJumpToQsn(a){switch($("#exam_mode").val()){case "030102":examDisplsyQsn(a);break;default:examScroller(a)}}function examDisplayDiv(a){switch(a){case "exam_index_div":examCreateIndex();break;case "exam_statistics_div":examStatisticsIndex()}$("#"+a).toggle();$("body").bind("mousedown",examOnBodyDown)}
function examStatisticsIndex(){var a={},c={},d={},e="",b="",f="";$("[name='qsn_content_div']").each(function(){if("1"!=$("#is_sub_qsn_"+$(this).attr("qsn_id")+$(this).attr("qsn_sub_id")).val())switch(f=$(this).attr("qsn_id")+$(this).attr("qsn_sub_id"),e=$("#exam_qsn_type_pos_"+f).val(),b=$("#exam_qsn_pos_"+f).val(),$("#exam_qsn_result_div_"+f).attr("class")){case "icon_exam_result icon_exam_result_01":a[f]='<a href="javascript:void(0)" id="exam_answered_qsn_a_'+f+'" name="exam_answered_qsn_a" qsn_id="'+
f+'" onclick="examJumpToQsn(\''+f+"');return false;\">"+e+"-"+b+"</a>";break;case "icon_exam_result icon_exam_result_02":d[f]='<a href="javascript:void(0)" id="exam_answered_qsn_a_'+f+'" name="exam_answered_qsn_a" qsn_id="'+f+'" onclick="examJumpToQsn(\''+f+"');return false;\">"+e+"-"+b+"</a>";break;case "icon_exam_result icon_exam_result_03":c[f]='<a href="javascript:void(0)" id="exam_answered_qsn_a_'+f+'" name="exam_answered_qsn_a" qsn_id="'+f+'" onclick="examJumpToQsn(\''+f+"');return false;\">"+
e+"-"+b+"</a>"}});$("#exam_correct_qsn_div").html("<span>"+window.L.getText("\u6b63\u786e")+"\uff1a</span>");var g=0;$.each(a,function(a,b){$("#exam_correct_qsn_div").append(b);g++});$("#exam_correct_qsn_count_label").html(g);var k=0;$("#exam_error_qsn_div").html("<span>"+window.L.getText("\u9519\u8bef")+"\uff1a</span>");$.each(d,function(a,b){$("#exam_error_qsn_div").append(b);k++});$("#exam_error_qsn_count_label").html(k);var h=0;$("#exam_half_correct_qsn_div").html("<span>"+window.L.getText("\u90e8\u5206\u6b63\u786e")+
"\uff1a</span>");$.each(c,function(a,b){$("#exam_half_correct_qsn_div").append(b);h++});$("#exam_half_correct_qsn_count_label").html(h)}
function examCreateIndex(){var a=examGetUserExamAnswer(),c="",d={},e={},b="",f="";$.each(a.answered_qsns,function(a,e){b=$("#exam_qsn_type_pos_"+a).val();f=$("#exam_qsn_abs_pos_"+a).val();"1"==$("#is_sub_qsn_"+a).val()?(c=$("[name='qsn_content_div'][qsn_sub_id='"+e.qsn_id+"']").attr("qsn_id"),d[c+e.qsn_id]='<a href="javascript:void(0)" id="exam_answered_qsn_a_'+c+e.qsn_id+'" name="exam_answered_qsn_a" qsn_id="'+c+e.qsn_id+'" onclick="examJumpToQsn(\''+c+e.qsn_id+"');return false;\">"+b+"-"+f+"</a>"):
d[a]='<a href="javascript:void(0)" id="exam_answered_qsn_a_'+a+'" name="exam_answered_qsn_a" qsn_id="'+a+'" onclick="examJumpToQsn(\''+a+"');return false;\">"+b+"-"+f+"</a>"});$.each(a.unanswered_qsns,function(a,d){b=$("#exam_qsn_type_pos_"+a).val();f=$("#exam_qsn_abs_pos_"+a).val();"1"==$("#is_sub_qsn_"+a).val()?(c=$("[name='qsn_content_div'][qsn_sub_id='"+d.qsn_id+"']").attr("qsn_id"),e[c+d.qsn_id]='<a href="javascript:void(0)" id="exam_answered_qsn_a_'+c+d.qsn_id+'" name="exam_answered_qsn_a" qsn_id="'+
c+d.qsn_id+'" onclick="examJumpToQsn(\''+c+d.qsn_id+"');return false;\">"+b+"-"+f+"</a>"):e[a]='<a href="javascript:void(0)" id="exam_answered_qsn_a_'+a+'" name="exam_answered_qsn_a" qsn_id="'+a+'" onclick="examJumpToQsn(\''+a+"');return false;\">"+b+"-"+f+"</a>"});$("#exam_answered_qsn_div").html("<span>"+window.L.getText("\u5df2\u7b54")+"\uff1a</span>");var g=0;$.each(d,function(a,b){void 0==e[a]&&($("#exam_answered_qsn_div").append(b),g++)});$("#exam_answered_qsn_count_label").html(g);var k=0;
$("#exam_unanswered_qsn_div").html("<span>"+window.L.getText("\u672a\u7b54")+"\uff1a</span>");$.each(e,function(a,b){$("#exam_unanswered_qsn_div").append(b);k++});$("#exam_unanswered_qsn_count_label").html(k)}function examScroller(a){a=$("#qsn_content_div_"+a).offset().top-60;EXAM_IS_TOOLBAR_MOVE||(a-=50);$("html,body").animate({scrollTop:a},300)}EXAM_IS_TOOLBAR_MOVE=!1;
function examInitToolBar(){var a=$("#exam_toolbar").offset().top;$(window).scroll(function(){var c=$(document).scrollTop();c>=a?(EXAM_IS_TOOLBAR_MOVE=!0,/MSIE (\d+\.\d+);/.test(navigator.userAgent),6==parseFloat(RegExp.$1)?($("#exam_toolbar").css("position","absolute"),$("#exam_toolbar").css("top",c)):($("#exam_toolbar").css("position","fixed"),$("#exam_toolbar").css("top","0px"))):(EXAM_IS_TOOLBAR_MOVE=!1,$("#exam_toolbar").css("position","static"))})}EXAM_KEEP_RECOVERY=!0;
function examRecovery(){if(EXAM_KEEP_RECOVERY){setTimeout("examRecovery()",2E5);var a=Math.round((new Date).getTime()/1E3),c=examGetUserExamAnswer(),d=a-EXAM_START_TIME,a=Math.floor(d/3600),e=Math.floor(d%3600/60),d=Math.floor(d%3600%60);c.exam_total_tm=(10>a?"0"+a:a)+":"+(10>e?"0"+e:e)+":"+(10>d?"0"+d:d);c.exam_times=$("#exam_times").val();c.papr_id=$("#papr_id").val();c.exam_id=$("#exam_id").val();if("030102"==$("#exam_mode").val()){var b=0;$("#paper_content_div > div[name='qsn_content_div']").each(function(a){if("none"!=
$(this).css("display"))return b=a,!1});c.qsn_absposition=b}a=L._rootUrl+"/exam/examCtl.php?a=addExamUserStorageAnswer";c="exam_info="+encodeURIComponent(L.JSON.stringify(c));$.ajax({type:"POST",async:!0,url:a,data:c,dataType:"json",success:function(){},error:function(){}})}}EXAM_KEEP_GET_CMD=!0;EXAM_PAUSE_DIV_ID=null;
function examGetExamCmd(){if(EXAM_KEEP_GET_CMD){var a=L._rootUrl+"/exam/examCtl.php?a=getExamCmd",c="exam_id="+$("#exam_id").val();$.ajax({type:"POST",async:!0,url:a,data:c,dataType:"json",success:function(a){switch(a.res){case "1":null==EXAM_PAUSE_DIV_ID&&(EXAM_PAUSE_DIV_ID=oDialogDiv(window.L.getText("\u6682\u505c\u8003\u8bd5"),"text:"+a.info,"500px","300px",[0]));break;case "2":examSubmitPapr(!0);break;default:null!=EXAM_PAUSE_DIV_ID&&(oDialogDiv.dialogClose(EXAM_PAUSE_DIV_ID),EXAM_PAUSE_DIV_ID=
null)}setTimeout("examGetExamCmd()",1E4)},error:function(){setTimeout("examGetExamCmd()",1E4)}})}}function examSetExamResult(a,c){$("#exam_qsn_result_div_"+a).removeClass();switch(c){case 0:$("#exam_qsn_result_div_"+a).addClass("icon_exam_result icon_exam_result_02");break;case 1:$("#exam_qsn_result_div_"+a).addClass("icon_exam_result icon_exam_result_01");break;case 2:$("#exam_qsn_result_div_"+a).addClass("icon_exam_result icon_exam_result_03")}}
function examHideResultInfo(){$('[name="qsn_answer_info_div"]').hide();$('[name="exam_qsn_result"]').hide()}function examShowResultInfo(){$('[name="qsn_answer_info_div"]').show();$('[name="exam_qsn_result"]').show()}
function examDisplayUserAnswer(a,c){var d=c?c:!1;$.each(a,function(a,b){switch(b.qsn_type){case "010101":d&&$("[name='exam_qsn_answer_"+b.qsn_id+b.qsn_sub_id+"']").each(function(){$(this).val()==b.user_answer&&$(this).attr("checked",!0)});$("#user_answer_"+b.qsn_id+b.qsn_sub_id).append(b.user_answer+" ");break;case "010102":d&&$("[name='exam_qsn_answer_"+b.qsn_id+b.qsn_sub_id+"']").each(function(){$(this).val()==b.user_answer&&$(this).attr("checked",!0)});$("#user_answer_"+b.qsn_id+b.qsn_sub_id).append(b.user_answer+
" ");break;case "010103":d&&$("[name='exam_qsn_answer_"+b.qsn_id+b.qsn_sub_id+"']").each(function(){$(this).val()==b.user_answer&&$(this).attr("checked",!0)});"yes"==b.user_answer?$("#user_answer_"+b.qsn_id+b.qsn_sub_id).append('<img src="'+window._ROOT_URL+'/images/icon/exam_result_01.png" width="24" height="24" />'):$("#user_answer_"+b.qsn_id+b.qsn_sub_id).append('<img src="'+window._ROOT_URL+'/images/icon/exam_result_02.png" width="24" height="24" />');break;case "010104":d&&$("#user_answer_div_"+
b.qsn_id+b.qsn_sub_id+" input[type='text']").each(function(){var a=parseInt($(this).attr("id").split("_")[1]);isNaN(a)||a==parseInt(b.qsn_item_id)&&$(this).val(b.user_answer)});$("#user_answer_"+b.qsn_id+b.qsn_sub_id).append("<b>"+b.qsn_item_id+".</b>"+b.user_answer+" ");break;case "010105":case "010106":d&&$("textarea[qsn_id='"+b.qsn_id+"'][qsn_sub_id='"+b.qsn_sub_id+"']").val(b.user_answer);$("#user_answer_"+b.qsn_id+b.qsn_sub_id).append(b.user_answer);break;case "010108":d&&$("#user_answer_div_"+
b.qsn_id+b.qsn_sub_id+" select").each(function(){qsn_item_id=parseInt($(this).attr("id").split("_")[1]);isNaN(qsn_item_id)||qsn_item_id==parseInt(b.qsn_item_id)&&$(this).val(b.user_answer)}),"0"==b.user_answer&&(b.user_answer=" "),$("#user_answer_"+b.qsn_id+b.qsn_sub_id).append("<b>"+b.qsn_item_id+".</b>"+b.user_answer+" ")}})}
function examDisplayUserExamInfo(a){var c={};$.each(a,function(a,b){"2"==b.answer_status?c[b.qsn_id+b.qsn_sub_id]={is_correct:!0,is_error:!0}:"1"==b.answer_status?c[b.qsn_id+b.qsn_sub_id]={is_correct:!0,is_error:!1}:"0"==b.answer_status&&(c[b.qsn_id+b.qsn_sub_id]={is_correct:!1,is_error:!0});if(0!=b.qsn_sub_id&&(void 0==c[$("div[qsn_sub_id='"+b.qsn_id+"']").attr("qsn_id")+b.qsn_id]&&(c[$("div[qsn_sub_id='"+b.qsn_id+"']").attr("qsn_id")+b.qsn_id]={is_correct:!1,is_error:!1}),c[b.qsn_id+b.qsn_sub_id].is_correct&&
(c[$("div[qsn_sub_id='"+b.qsn_id+"']").attr("qsn_id")+b.qsn_id].is_correct=!0),c[b.qsn_id+b.qsn_sub_id].is_error))c[$("div[qsn_sub_id='"+b.qsn_id+"']").attr("qsn_id")+b.qsn_id].is_error=!0});var d=2;$.each(c,function(a,b){d=2;b.is_correct||(d=0);b.is_error||(d=1);examSetExamResult(a,d)})}
function examDisplayRemark(a){$.each(a,function(a,d){$("#remark_"+d.qsn_id+d.qsn_sub_id).html(d.remark);null==d.marker_id?$("#is_marking_lab_"+d.qsn_id+d.qsn_sub_id).html(window.L.getText("(\u672a\u8bc4)")):$("#is_marking_lab_"+d.qsn_id+d.qsn_sub_id).html(window.L.getText("(\u5df2\u8bc4)"))})}EXAM_QSN_START_TIME=EXAM_QSN_LAST_TIME=0;
function examInitQsnLimit(a){var a=a?a:!0,c=new Date,d=null;$("#paper_content_div > div[name='qsn_content_div']").each(function(){if("none"!=$(this).css("display"))return d=$(this).attr("qsn_id")+$(this).attr("qsn_sub_id"),!1});var e=$("#qsn_limit_tm_"+d).val().split(":");EXAM_QSN_START_TIME=Math.round(c.getTime()/1E3);EXAM_QSN_LAST_TIME=3600*parseInt(e[0])+60*parseInt(e[1])+parseInt(e[2]);a&&examQsnLimitCountingDown();EXAM_KEEP_RECOVERY=!0;examRecovery();EXAM_KEEP_RECOVERY=!1}
function examQsnLimitCountingDown(){var a=new Date,c=Math.round(a.getTime()/1E3);EXAM_QSN_LAST_TIME=parseInt(EXAM_QSN_LAST_TIME);var d=EXAM_QSN_LAST_TIME-(c-parseInt(EXAM_QSN_START_TIME));if(0<=d){setTimeout("examQsnLimitCountingDown()",1E3);var a=Math.floor(d/86400),c=Math.floor(d%86400/3600),e=Math.floor(d%86400%3600/60),d=Math.floor(d%86400%3600%60),b="";0!=a&&(b=a+"D ");$("#exam_last_time_label").html(b+((10>c?"0"+c:c)+":")+((10>e?"0"+e:e)+":")+(10>d?"0"+d:d))}else{var f=null,c=null,g=0;$("#paper_content_div > div[name='qsn_content_div']").each(function(a){if("none"!=
$(this).css("display"))return g=a,f=$(this).attr("qsn_id")+$(this).attr("qsn_sub_id"),!1});c=g<$("#paper_content_div > div[name='qsn_content_div']").size()-1?$($("#paper_content_div > div[name='qsn_content_div']").get(g+1)).attr("qsn_id")+$($("#paper_content_div > div[name='qsn_content_div']").get(g+1)).attr("qsn_sub_id"):$($("#paper_content_div >div[name='qsn_content_div']").get($("#paper_content_div >div[name='qsn_content_div']").size()-1)).attr("qsn_id")+$($("#paper_content_div >div[name='qsn_content_div']").get($("#paper_content_div >div[name='qsn_content_div']").size()-
1)).attr("qsn_sub_id");f==c?examSubmitPapr(!0):(c=$("#qsn_limit_tm_"+c).val().split(":"),EXAM_QSN_START_TIME=Math.round(a.getTime()/1E3),EXAM_QSN_LAST_TIME=3600*parseInt(c[0])+60*parseInt(c[1])+parseInt(c[2]),examDisplsyQsn("next"),examQsnLimitCountingDown())}}
function examOnBodyDown(a){var a=$(a.target),c=a.parent("div"),d=a.parent("div").parent("div"),e=a.parent("div").parent("div").parent("div"),b=!1;"exam_index_div"!=a.attr("id")&&("exam_mark_div"!=a.attr("id")&&"exam_statistics_div"!=a.attr("id")&&"exam_index_div"!=c.attr("id")&&"exam_mark_div"!=c.attr("id")&&"exam_statistics_div"!=c.attr("id")&&"exam_index_div"!=d.attr("id")&&"exam_mark_div"!=d.attr("id")&&"exam_statistics_div"!=d.attr("id")&&"exam_index_div"!=e.attr("id")&&"exam_mark_div"!=e.attr("id")&&
"exam_statistics_div"!=e.attr("id")&&"exam_answered_qsn_a"!=a.attr("name"))&&(b=!0);b&&examHideDiv()}function examHideDiv(){$("[name='exam_ims_div']").hide();$("body").unbind("mousedown",examOnBodyDown)}function examCountingDown(a,c){a=parseInt(a)-1;0<a&&($("#"+c).html(a),setTimeout("examCountingDown("+a+",'"+c+"')",1E3))}
function examSetFullScreen(a){if("undefined"==typeof ie)a&&($("body").html('<div id="tmp_message"><div class="tmp_info"><p>'+window.L.getText("\u672a\u542f\u7528\u6216\u5b89\u88c5\u5168\u5c4f\u63d2\u4ef6\u6216\u672a\u4f7f\u7528IE\u6d4f\u89c8\u5668")+'&nbsp;&nbsp;<br/><br/><strong id="sec"></strong><br/><br/></p></div></div>'),IS_KEEP_COUNTING_DOWN=!1);else{try{ie.IsOk()}catch(c){a&&($("body").html('<div id="tmp_message"><div class="tmp_info"><p>'+window.L.getText("\u672a\u542f\u7528\u6216\u5b89\u88c5\u5168\u5c4f\u63d2\u4ef6\u6216\u672a\u4f7f\u7528IE\u6d4f\u89c8\u5668")+
'&nbsp;&nbsp;<br/><br/><strong id="sec"></strong><br/><br/></p></div></div>'),IS_KEEP_COUNTING_DOWN=!1);return}ie.SetFullScreen(a);ie.SetKeyDisable(!1,!1,!1,112);ie.SetKeyDisable(!0,!1,!1,112);ie.SetKeyDisable(!0,!1,!0,112);ie.SetKeyDisable(!0,!0,!0,112);ie.SetKeyDisable(!1,!1,!1,113);ie.SetKeyDisable(!1,!1,!1,115);ie.SetKeyDisable(!1,!1,!1,117);ie.SetKeyDisable(!1,!1,!1,118);ie.SetKeyDisable(!1,!1,!1,119);ie.SetKeyDisable(!1,!1,!1,120);ie.SetKeyDisable(!1,!1,!1,121);ie.SetKeyDisable(!0,!1,!0,121);
ie.SetKeyDisable(!1,!1,!1,122);ie.SetKeyDisable(!1,!1,!1,123);ie.SetKeyDisable(!0,!1,!1,66);ie.SetKeyDisable(!0,!1,!1,67);ie.SetKeyDisable(!0,!1,!1,68);ie.SetKeyDisable(!0,!1,!1,72);ie.SetKeyDisable(!0,!1,!1,73);ie.SetKeyDisable(!0,!1,!1,74);ie.SetKeyDisable(!0,!1,!1,76);ie.SetKeyDisable(!0,!1,!1,78);ie.SetKeyDisable(!0,!1,!1,79);ie.SetKeyDisable(!0,!1,!1,80);ie.SetKeyDisable(!0,!1,!1,81);ie.SetKeyDisable(!0,!1,!1,82);ie.SetKeyDisable(!0,!1,!1,84);ie.SetKeyDisable(!0,!1,!1,86);ie.SetKeyDisable(!0,
!1,!1,88);ie.SetKeyDisable(!0,!1,!1,89);ie.SetKeyDisable(!0,!1,!0,27);return!1}};