$(function(){$(".advance_search").css("display","none")});
function clickDelUser(b){$.get("./userCtl.php?a=getUser",{id:b},function(a){window.L.openCom("oDialogDiv")(window.L.getText("\u786e\u8ba4\u64cd\u4f5c"),"text:<div>"+window.L.getText("\u771f\u7684\u8981\u5220\u9664")+a+window.L.getText("\u5417\uff1f")+"</div>","280","110",[2,function(a){a&&$.post("./userCtl.php?a=userOperating",{userId:b+"&",sts:"del"},function(){oDialogDivInfo(window.L.getText("\u5220\u9664\u6210\u529f"));$("#search").trigger("click")})}])});return!1}
function viewUserInfo(b){window.L.openCom("oDialogDiv")(window.L.getText("\u7528\u6237\u4fe1\u606f\u8be6\u60c5"),"iframe:./userCtl.php?a=dialogUserInfo&uId="+b,"auto",{maxHeight:"80%"},[2]);return!1}function showMsg(b){oDialogDivInfo(window.L.getText("\u5bc6\u7801\u4fee\u6539\u6210\u529f\uff01\u5f71\u54cd\u6570\u91cf")+b+window.L.getText("\u4eba"),2E3,-2)}
$("#searchFF").click(function(){"1"!=$("#searchFF:checked").val()?$(".advance_search").hide(300):($(".advance_search").show(300),window.L.openCom("wDate",{obj:$("#time1").get(0),eventType:"focus",params:{readOnly:!0}}),window.L.openCom("wDate",{obj:$("#time2").get(0),eventType:"focus",params:{readOnly:!0}}))});$("#onlyAdmin").click(function(){$("#search").trigger("click")});$("#reset").click(function(){$("input[type=text]").val("");$("#gender").val("");$("#group").val("0")});
function getFormData(){var b="1"==$(":input[name='onlyAdmin'][checked]").val()?"1":"0",a=$("#group").val(),f=$("#user").val(),c=$("#status").val(),d=$("#gender").val(),e=$("#tel").val(),g=$("#mobiletel").val(),b={isadmin:b,group:a};""!=f&&(b.user=f);""!=e&&(b.tel=e);""!=g&&(b.mobiletel=g);""!=c&&(b.status=c);""!=d&&(b.gender=d);if("1"==$("#searchFF:checked").val()&&(f=$("#idcard").val(),c=$("#examcard").val(),d=$("#time1").val(),e=$("#time2").val(),""!=f&&(b.idcard=f),""!=c&&(b.examcard=c),""!=d&&
(b.time1=d),""!=e))b.time2=e;return b}$("#search").click(function(){var b=getFormData();$.ajax({type:"POST",url:"./userCtl.php?a=userManage",data:b,success:showTable})});function showTable(b){$(".table_content table").remove();$(".table_content").append(b);window.L.extension.pageTable.init()}
function openUserEditGroupDiv(b){window.L.openCom("oDialogDiv")(window.L.getText("\u7528\u6237\u7ec4\u4fee\u6539"),"url:get?./userCtl.php?a=dialogModfiyUserGroup&uId="+b,"350","auto",[2,{mouseClickFun:function(a){a&&(a=$("#select2").val(),$.post("./userCtl.php?a=userEditUserGroup",{val:b+","+a},function(){$("#search").trigger("click");oDialogDivInfo(window.L.getText("\u4fee\u6539\u7528\u6237\u7ec4\u6210\u529f!"),2E3,-2)}))}}]);return!1}
function openedituserpower(b){window.L.openCom("oDialogDiv")(window.L.getText("\u4fee\u6539\u7528\u6237\u6743\u9650"),"iframe:./userCtl.php?a=adminPower&uid="+b,"550","auto",[2,function(a,f,c){if(a){var d="";$(window.frames["oDialogDiv_iframe_"+c.handle].document).find("input[name=rid]:checked").each(function(){d+=","+$(this).val()});$.post("./userCtl.php?a=editUserRole",{rId:d.substr(1),uId:b},function(a){"1"==a&&oDialogDivInfo(window.L.getText("\u89d2\u8272\u4fee\u6539\u6210\u529f!"),2E3,-2)})}}]);
return!1}function getChoose(){var b="";$("input[name=uid]:checked").each(function(){b+=$(this).val()+","});return 0==b.length?!1:b}
function openUserEditDiv(b){window.L.openCom("oDialogDiv")(window.L.getText("\u7528\u6237\u4fee\u6539"),"iframe:./userCtl.php?a=dialogModfiyUserInfo&id="+b,"550","auto",[2,{mouseClickFun:function(a,b,c){if(a){var a=$(window.frames["oDialogDiv_iframe_"+c.handle].document),b=a.find("#user_id").val(),c=a.find("#real_name").val(),d=a.find("#username").val(),e=a.find("#pwd").val(),g=a.find("#email").val(),h=a.find("input[name=gender]:checked").val(),i=a.find("#idcard").val(),j=a.find("#examcard").val(),
k=a.find("#tel").val(),l=a.find("#mobiletel").val(),m=a.find("input[name=isadmin]:checked").val(),n=a.find("#adminGroup").val();window.L.cookie.set({dataStratifiedKey:a.find("#user_group_td input").attr("key")});a=window.L.param.encode({"0":c,1:d,2:e,3:g,4:h,5:i,6:j,7:k,8:l,9:m,10:n,11:b});$.post("./userCtl.php?a=userUpdate",a,function(a){"1"==a?(oDialogDivInfo(window.L.getText("\u7528\u6237\u4fdd\u5b58\u6210\u529f!"),2E3,-2),window.L.extension.pageTable.classObj.load($('table[_pagetabledataset="admin_user_userCtl::userPageList"]').get(0))):
oDialogDivInfo(window.L.getText("\u7528\u6237\u4fdd\u5b58\u5931\u8d25!"),2E3,-2)})}}}]);return!1}
window.L.strVar("L.extension.pageTable.callback.initLoadList[]",window.L.strVar("L.extension.pageTable.callback.afterLoadList[]",function(b){var a="",a=a+'&nbsp;<div class="action_toolbar">',a=a+'<div class="inner">',a=a+'<div class="right"></div>',a=a+'<div class="inner_box">',a=a+'<div class="action_link">',a=a+"</div>",a=a+"</div>",a=a+"</div>",a=a+"</div>";L.extension.pageTable.classObj.eachTbody(b,"*",12,function(b){$(b.tdObj).parent().find("td").eq(10).text()==window.L.getText("\u5df2\u5ba1\u6838")&&
$(b.tdObj).parent().find("td").eq(10).html("<img src = '"+L._rootUrl+"/images/icon/icon_radio_on.gif'>");$(b.tdObj).parent().find("td").eq(10).text()==window.L.getText("\u672a\u5ba1\u6838")&&$(b.tdObj).parent().find("td").eq(10).html("<img src = '"+L._rootUrl+"/images/icon/icon_off.gif'>");$(b.tdObj).html(a).parent().hover(function(){var a=$(this).find("td").eq(1).text(),b="<a href='#' onclick='return openUserEditDiv("+a+")' >"+window.L.getText("\u7f16\u8f91\u7528\u6237")+"</a>",b=b+("<a href='#' onclick='return clickDelUser("+
a+")' >"+window.L.getText("\u5220\u9664\u7528\u6237")+"</a>"),b=b+("<a href='#' onclick='return openUserEditGroupDiv("+a+")' >"+window.L.getText("\u4fee\u6539\u7528\u6237\u7ec4")+"</a>");$(".action_link").html(b)},function(){})})}));
window.L.strVar("L.extension.pageTable.callback.initLoadList[]",function(b){"admin_user_userCtl::userPageList"===$(b).attr("_pagetabledataset")&&($(".del").click(function(){var a=getChoose();if(!a)return oDialogDivInfo(window.L.getText("\u6ca1\u6709\u9009\u62e9\u7528\u6237!")),!1;var b=a.substr(0,a.length-1);$.get("./userCtl.php?a=getUser",{id:b},function(b){window.L.openCom("oDialogDiv")(window.L.getText("\u786e\u8ba4\u64cd\u4f5c"),"text:<div>"+window.L.getText("\u771f\u7684\u8981\u5220\u9664")+
b+window.L.getText("\u5417\uff1f")+"</div>","280","110",[2,function(b){b&&$.post("./userCtl.php?a=userOperating",{userId:a,sts:"del"},function(){oDialogDivInfo(window.L.getText("\u5220\u9664\u6210\u529f"));$("#search").trigger("click")})}])});return!1}),$(".status").click(function(){var a=getChoose(),b=$(this).attr("name");if(!a)return!1;var c=a.substr(0,a.length-1);$.get("./userCtl.php?a=getUser",{id:c},function(c){window.L.openCom("oDialogDiv")(window.L.getText("\u786e\u8ba4\u64cd\u4f5c"),"text:<div>"+
window.L.getText("\u662f\u5426\u6539\u53d8")+c+window.L.getText("\u7684\u5ba1\u6838\u72b6\u6001\uff1f")+"</div>","280","110",[2,function(c){c&&$.post("./userCtl.php?a=userOperating",{userId:a,statusVal:b},function(){oDialogDivInfo(window.L.getText("\u64cd\u4f5c\u6210\u529f"));$("#search").trigger("click")})}])});return!1}),$(".outChk").click(function(){getChoose()?window.location.href="./userCtl.php?a=chkOutputData&postVal="+getChoose():oDialogDivInfo(window.L.getText("\u6ca1\u6709\u9009\u62e9\u7528\u6237"));
return!1}),$(".outSearch").click(function(){var a="",b=getFormData(),c;for(c in b)a+="&"+c+"="+b[c];window.location.href="./userCtl.php?a=searchOutputData"+a;return!1}),$(".importUser").click(function(){window.L.openCom("oDialogDiv")(window.L.getText("\u5bfc\u5165\u7528\u6237"),"iframe:./userCtl.php?a=importUser","700","500",[1]);return!1}),$(".editPwd").click(function(){window.L.openCom("oDialogDiv")(window.L.getText("\u7528\u6237\u5bc6\u7801\u4fee\u6539"),"iframe:./userCtl.php?a=editUserPwd","350",
"290",[2,function(a,b,c){if(a)if(b=$(window.frames["oDialogDiv_iframe_"+c.handle].document),a=b.find("input[name=radio]:checked").val(),b=b.find("#newPwd").val(),"c"==a){var d="";$("input[name=uid]:checked").each(function(){d+=$(this).val()+","});$.post("./userCtl.php?a=editUserPwd",{postVal:d+"&"+b},function(a){oDialogDivInfo(a,2E3,-2)})}else a=getFormData(),a.np=b,$.ajax({type:"POST",url:"./userCtl.php?a=searchEditPwd",data:a,success:function(a){alert(a)}})}]);return!1}))});
function logoutUser(b){window.L.openCom("oDialogDiv")(window.L.getText("\u5f3a\u5236\u9000\u51fa\u4f1a\u5f71\u54cd\u7528\u6237\u5f53\u524d\u64cd\u4f5c,\u786e\u5b9a\u5417?"),"","auto","auto",[2,function(a){a&&$.get("?a=logoutUser",{userId:b},function(){window.L.openCom("tip")(window.L.getText("\u64cd\u4f5c\u6210\u529f"));window.L.extension.pageTable.classObj.load($('table[_pagetabledataset="admin_user_userCtl::userPageList"]').get(0))})}])};