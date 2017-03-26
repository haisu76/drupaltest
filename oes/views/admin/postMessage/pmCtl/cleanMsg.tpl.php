<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/postMessage/postMessage.css'
                    )
                   ,'js' => array(
								  '/admin/userApi.js',
								  '/admin/songComm.js'
								  )   
                )
            );
?>
<body>
<div class="box block_12"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		<?php include(VIEW_DIR . "/admin/pm_top.php");?>
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_input">
			<div class="title none"><span><?php echo L::getText('搜索用户', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="col_full">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							<col style="width:90px;" />
							<col style="width:120px;" />
							<col style="width:400px;" />
						</colgroup>
						<tr>
							<td><?php echo L::getText('清除对象', array('file'=>__FILE__, 'line'=>__LINE__))?>：</td>
							<td>
                                <label>
                                	<input class="radiobox" type="radio" name="selectType" value="1" /><?php echo L::getText('所有消息', array('file'=>__FILE__, 'line'=>__LINE__))?>：
                                </label>
                            </td>
							<td>&nbsp;</td>
							<td></td>
						</tr>
						
						<tr>
							<td></td>
							<td>
                                <label>
                                    <input class="radiobox" type="radio" name="selectType" value="2" onClick="user(selectUser)" /><?php echo L::getText('指定用户', array('file'=>__FILE__, 'line'=>__LINE__))?>：
                                </label>
                            </td>
							<td>
								<input class="input3 auto_width" type="text" name="selectType" id="user_name" readonly />
                                <input type="hidden" id="user_id"/>
                            </td>
							<td>
                            	<a class="btn2" href="#" title="<?php echo L::getText('请选择收件人', array('file'=>__FILE__, 'line'=>__LINE__))?>" onClick="user(selectUser)"><?php echo L::getText('选择收件人', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
                            </td>
						</tr>
						
						<tr>
							<td></td>
							<td>
								<label>
                               		<input class="radiobox" type="radio" name="selectType" value="3" /><?php echo L::getText('指定日期', array('file'=>__FILE__, 'line'=>__LINE__))?>：
                                </label>
							</td>
							<td>
                                <input class="input3" type="text" id="dateS" onClick="chkRadio(3);">
								
								<input class="input3" type="text" id="dateE" onClick="chkRadio(3);">
								&nbsp;
								<a class="" href="#" onClick="today()" ><?php echo L::getText('今天', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
								<a class="" href="#" onClick="week()" ><?php echo L::getText('本周', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
								<a class="" href="#" onClick="month()"><?php echo L::getText('本月', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
								
							</td>
							<td>
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td>
                                <label>
                                    <input class="radiobox" type="radio" name="selectType" value="4" checked /><?php echo L::getText('关&nbsp;&nbsp;键&nbsp;&nbsp;字', array('file'=>__FILE__, 'line'=>__LINE__))?>：
                                </label>
                            </td>
							<td>
                            	<input class="input3 auto_width" type="text" name="searchText" id="searchText" onClick="chkRadio(4);" />
                            </td>
							<td><?php echo L::getText('多个关键字请以英文逗号(,)分隔', array('file'=>__FILE__, 'line'=>__LINE__))?></td>
							
						</tr>
						<tr>
							<td></td>
							<td>&nbsp;</td>
							<td>
								<label><input class="radiobox" type="radio" name="searchRadio" value="1" checked /><?php echo L::getText('仅包含标题', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
								&nbsp; &nbsp;
								<label><input class="radiobox" type="radio" name="searchRadio" value="0" /><?php echo L::getText('包含标题与正文', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</div>

				<div class="button_area_search">
					<div class="inner_box">
						<a href="#" class="btn2" onClick="cleanMsg()" ><?php echo L::getText('开始清理', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
						<a href="#" class="btn2" onClick="resetForm()" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
					</div>
				</div>
			  
			</div>
		</div>
		
	
	
		<!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->

<script>


function cleanMsg()
{
	window.L.openCom('oDialogDiv')(
			window.L.getText("确认清理?"), 
	'text:<div>'+window.L.getText('真的要彻底清理这些信息吗？')+'</div>',
	"280", 
	"110", 
	[2,function(s){if(s){	
		var selectType  = $("input[name=selectType]:checked").val();
		var searchRadio = $("input[name=searchRadio]:checked").val();
		var toPost      = '';
		var postType    = ''
		switch(selectType)
		{
			case '1' : postType = 'a' ; toPost = 'all' ; break;
			case '2' : postType = 'b' ; toPost = $("#user_id").val();break;
			case '3' : postType = 'c' ; toPost = $("#dateS").val()+','+$("#dateE").val();break;
			case '4' : postType = 'd' ; toPost = $("#searchText").val()+','+searchRadio;
		}
		$.post("./pmCtl.php?a=cleanPm" , {"t":postType,"v":toPost}
		,function(d){ 
		//alert(d);
		oDialogDivInfo(window.L.getText('清理信息数量')+d+window.L.getText('条'))
		 }
		)
	}}])
}

$(function(){
window.L.openCom(
		'wDate', 
		{
        	'obj' : $('#dateS').get(0),    //需绑定的对象
        	'eventType' : 'click',    //绑定的触发事件,默认click
        	'params' : {'readOnly' : true}    //传递WdatePicker的参数
    	} );
		window.L.openCom(
		'wDate', 
		{
        	'obj' : $('#dateE').get(0),    //需绑定的对象
        	'eventType' : 'click',    //绑定的触发事件,默认click
        	'params' : {'readOnly' : true}    //传递WdatePicker的参数
    	} );
})


function today()
{
	chkRadio(3);
	var myDate=new Date(new Date().getFullYear(),new Date().getMonth(),new Date().getDate());
	$("#dateS").val(formatDate(myDate));
	$("#dateE").val(formatDate(myDate));
}

function month()
{
	chkRadio(3);
	var myDate = new Date();
	var d1 = new Date(myDate.getFullYear(),myDate.getMonth(),'01');
	var d2 = new Date(myDate.getFullYear(),myDate.getMonth()+1,0);
	$("#dateS").val(formatDate(d1));
	$("#dateE").val(formatDate(d2));
}
function week()
{
	chkRadio(3);
	var myDate = new Date();
	var week = myDate.getDay(); //周天是0
	if(week == 0)
	{
		week = 7;
	}
	var weekStartDate = new Date(myDate.getFullYear(), myDate.getMonth(), myDate.getDate() - week +1);
	var weekEndDate   = new Date(myDate.getFullYear(), myDate.getMonth(), myDate.getDate() + 7 - week);
	
	$("#dateS").val(formatDate(weekStartDate));
	$("#dateE").val(formatDate(weekEndDate));
}

function formatDate(myDate)
{
	var myyear    = myDate.getFullYear();   //year
    var mymonth   = myDate.getMonth()+1;   //1-11
    var myweekday = myDate.getDate();    //1-31
      
    if(mymonth < 10){  
        mymonth = "0" + mymonth;  
    }   
    if(myweekday < 10){  
        myweekday = "0" + myweekday;  
    }  
    return (myyear+"-"+mymonth + "-" + myweekday);  
}


function chkRadio(val)
{
	$("input[name=selectType]").each(function(){
		if($(this).val() == val)
		{
			$(this).attr("checked",true);
		}
	})	
}

function selectUser(userData)
{
	chkRadio(2);
	var uname = '';
	var uvale = '';
	for(var user in userData)
	{
		uname += userData[user].name+','
		uvale += userData[user].id+',';
	}
	$("#user_name").val(uname.substr(0,uname.length-1));
	$("#user_id").val(uvale.substr(0,uvale.length-1));
}

function resetForm()
{
	$("#user_name").val("");
	$("#user_id").val("");
	$("#dateS").val("");
	$("#dateE").val("");
	$("#searchText").val("");
	$("input[name=searchRadio]:first").attr("checked",true);
	$("input[name=selectType]:last").attr("checked",true);
}
</script>
</body>
</html>
