"undefined"==typeof oFileManagerMainDir&&(oFileManagerMainDir="");"function"!=typeof oDialogDiv&&document.write('<script src="'+_ROOT_URL+oFileManagerMainDir+'/js/oDialogDiv.js"><\/script>');
function jsCalloEditorUploadify(f,d,b,j,k,m,a,p){var e=window,c=[window],r=null,n=null,o=null,g=null,s=null,t=null,u=null,q,l={},v=null,h=null;null==k&&(k=25);null==m&&(m=14);"function"===typeof d&&(d={onComplete:d});if("string"===typeof f&&"function"===typeof d.onComplete){h=$("#"+f);try{version=Boolean(null!=navigator.plugins&&0<navigator.plugins.length?navigator.plugins["Shockwave Flash 2.0"]||navigator.plugins["Shockwave Flash"]:new ActiveXObject("ShockwaveFlash.ShockwaveFlash"))}catch(w){version=
!1}if(!1===version)b=['<img src="'+_ROOT_URL+oFileManagerMainDir+'/images/flashInstall.jpg" style="width:'+k+"px; height:"+m+'px" />',h.parents("a")],b[1].length?b[1].attr({target:"_blank",href:"http://get.adobe.com/flashplayer/",onclick:null}).unbind("click").html(b[0]):h.hide().after('<a target="_blank" href="http://get.adobe.com/flashplayer/">'+b[0]+"</a>");else{for(;e.parent!=e;)e=e.parent,c[c.length]=e;for(g=c.length-1;-1<g;g--)if(null!=c[g]&&"function"==typeof c[g].oDialogDiv){e=c[g];c[g]=null;
break}else if(null==c[g])break;null==b&&(b="*");null==j&&(j='<font color="#000000" size="12" >\u4e0a\u4f20</font>');null==p&&(p=!0);h.attr("fileCount",0);"object"==typeof a||(a={});null==a.queueID&&(a.queueID=!0);null==a.auto&&(a.auto=!0);null==a.multi&&(a.multi=!1);null==a.folder&&(a.folder="/..quickUpload");c=j.match(/^<img [^<>]*?src *?= *?('|")([^<>]*?)\1[^<>]*?\/>$/i);null!==c&&"string"===typeof c[2]&&(j=null,r=c[2]);$.ajax({url:_ROOT_URL+oFileManagerMainDir+"/include/uploadify/echoUploadMaxFilesize.php",
async:!1,success:function(d){v=d}});o=function(a,b){$(e).find("#"+f).uploadifyClearQueue();n&&e.oDialogDiv.dialogClose(n);var c="",i;for(i in l)c=c+(l[i].join(" , ")+" - "+i+" Error ");l={};c===""||oDialogDiv.tip(c,5E3);if(typeof d.onAllComplete==="function")d.onAllComplete(b,a)};g=function(c,b,e,i){a.queueID===true&&q.eq(0).html(i.percentage+"% / "+$("#"+f).attr("fileCount"));if(typeof d.onProgress==="function")d.onProgress(i,e,b,c)};s=function(c,b){h.attr("fileCount",b.fileCount).attr("fileTotal",
b.fileCount);if(b.fileCount===0)o();else{if(a.queueID===true){n=e.oDialogDiv("\u4e0a\u4f20\u8fdb\u5ea6",'<div style="margin:0px; padding:0px; height:20px;"><font style="float:left;">0%</font> <font style="float:right; cursor:pointer;" >\u53d6\u6d88\u4e0a\u4f20</font></div>',200,null,[0]);q=$(e.document.body).find("#oDialogDiv_"+n+" > .scroll > .content div font");q.eq(1).click(o)}if(typeof d.onSelectOnce==="function")d.onSelectOnce(b,c)}};t=function(b,c,a,i,e){h.attr("fileCount",e.fileCount);d.onComplete(i,
{fileCount:e.fileCount,fileObj:a})};u=function(b,d,c,a){typeof l[a.type]==="undefined"&&(l[a.type]=[]);l[a.type][l[a.type].length]=c.name};h.uploadify({uploader:_ROOT_URL+oFileManagerMainDir+"/include/uploadify/scripts/uploadify.swf?v="+(new Date).getTime(),script:_ROOT_URL+oFileManagerMainDir+"/include/uploadify/uploadify.php?folderUploadType=relative",cancelImg:_ROOT_URL+oFileManagerMainDir+"/include/uploadify/cancel.png",folder:a.folder,queueID:a.queueID,auto:a.auto,multi:a.multi,sizeLimit:v,fileExt:"*."+
b.replace(/;/g,";*."),fileDesc:"\u652f\u6301\u683c\u5f0f(*."+b.replace(/;/g,";*.")+")",wmode:"transparent",width:k,height:m,buttonText:j,buttonImg:r,hideBackground:p,onSelectOnce:s,onProgress:g,onComplete:t,onAllComplete:o,onError:u,onCancel:function(a,b,c,e){if(typeof d.onCancel==="function"){h.attr("fileCount",e.fileCount);d.onCancel(e,c,b,a)}},onInit:function(){if(typeof d.onInit==="function")d.onInit()}})}}}
jsCalloEditorUploadify.updateSettings=function(f,d,b){var j=arguments.callee,k;document.getElementById(f)&&((k=document.getElementById(f+"Uploader"))&&document.getElementById(f+"Uploader").updateSettings?"function"===typeof d?d.call(k,b):$("#"+f).uploadifySettings(d,b):window.setTimeout(function(){j(f,d,b)},100))};