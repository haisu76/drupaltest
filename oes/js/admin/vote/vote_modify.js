var VOTE_SELECTION_LOADED_COUNT=0,VOTE_RESET_AREA_MARK="";
function voteInitEditPage(){VOTE_RESET_AREA_MARK=initResetArea({selection:"#vote_info_div"});window.L.openCom("oEditor")&&(new oEditor({buttonList:"bold italic underline left center right justify ol ul fontSize fontFamily fontFormat image forecolor bgcolor table subscript superscript strikethrough removeformat hr media".split(" "),maxHeight:300,CustomConfig:{AnswerSelect:{AnswerType:"textbox"},oFileManager:{quickUploadDir:{img:img_quick_upload_dir,media:media_quick_upload_dir,attachment:attachment_quick_upload_dir},
browseDir:{img:img_browse_upload_dir,media:media_browse_upload_dir,attachment:attachment_browse_upload_dir}}}})).panelInstance("vote_content");window.L.openCom("wDate",{obj:$("#start_tm").get(0),params:{readOnly:!0,dateFmt:"yyyy-MM-dd HH:mm:ss"}});window.L.openCom("wDate",{obj:$("#end_tm").get(0),params:{readOnly:!0,dateFmt:"yyyy-MM-dd HH:mm:ss"}});voteSelectionNumChange()}
function voteSelectionNumChange(){var b=parseInt($("#selection_num").val());if(parseInt(VOTE_SELECTION_LOADED_COUNT)<b){for(i=VOTE_SELECTION_LOADED_COUNT;i<b;i++){var c=parseInt(i)+1;(new oEditor({buttonList:"bold italic underline left center right justify ol ul fontSize fontFamily fontFormat image forecolor bgcolor table subscript superscript strikethrough removeformat hr media".split(" "),maxHeight:300,CustomConfig:{AnswerSelect:{AnswerType:"textbox"},oFileManager:{quickUploadDir:{img:img_quick_upload_dir,
media:media_quick_upload_dir,attachment:attachment_quick_upload_dir},browseDir:{img:img_browse_upload_dir,media:media_browse_upload_dir,attachment:attachment_browse_upload_dir}}}})).panelInstance("selection_content_"+c)}VOTE_SELECTION_LOADED_COUNT=b}$("[name='selection_mark_li']").hide();for(a=1;a<=b;a++)$("#selection_mark_li_"+a).show()}function voteResetArea(){resetArea(VOTE_RESET_AREA_MARK)}
function voteAddOrUpdateVote(){var b=voteModifyVote();"success"==b.res?(oDialogDivInfo(window.L.getText("\u4fdd\u5b58\u6210\u529f")),""==$("#vote_id").val()&&(voteResetArea(),VOTE_SELECTION_LOADED_COUNT=0,voteInitEditPage())):oDialogDivInfo(b.info)}
function voteModifyVote(){var b=voteValidateVoteInfo();if("success"==b.res){var c=voteFormatVoteInfo(),d=window.L._adminUrl+"/vote/voteCtl.php?a=modifyVote",c="vote_info="+encodeURIComponent(L.JSON.stringify(c));$.ajax({type:"POST",async:!1,url:d,data:c,dataType:"json",success:function(c){b=c},error:function(){}})}return b}
function voteFormatVoteInfo(){return{vote_id:$("#vote_id").val(),vote_title:$("#vote_title").val(),vote_content:$("#vote_content").val(),vote_type:$("#vote_type").val(),vote_status:$("#vote_status").val(),start_tm:$("#start_tm").val(),end_tm:$("#end_tm").val(),allow_anonymous:$("#allow_anonymous").val(),allow_review:$("#allow_review").val(),vote_selection:voteGetVoteSelection()}}
function voteGetVoteSelection(){var b={},c=parseInt($("#selection_num").val());for(i=1;i<=c;i++)b[i]={selection_content:$("#selection_content_"+i).val(),selection_mark:$("#selection_mark_"+i).val()};return b}
function voteValidateVoteInfo(){var b={res:"success",info:""};""==$.trim($("#vote_title").val())&&(b.res="failed",b.info=window.L.getText("\u8bf7\u6dfb\u52a0\u6295\u7968\u6807\u9898"));""==$("#start_tm").val()&&(b.res="failed",b.info=window.L.getText("\u8bf7\u9009\u62e9\u6295\u7968\u8d77\u59cb\u65f6\u95f4"));""==$("#end_tm").val()&&(b.res="failed",b.info=window.L.getText("\u8bf7\u9009\u62e9\u6295\u7968\u7ed3\u675f\u65f6\u95f4"));$("#end_tm").val()<=$("#start_tm").val()&&(b.res="failed",b.info=window.L.getText("\u8bf7\u9009\u62e9\u6295\u7968\u7ed3\u675f\u65f6\u95f4\u5fc5\u987b\u5927\u4e8e\u8d77\u59cb\u65f6\u95f4"));
return b};