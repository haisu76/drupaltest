<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin/index/backhead.css',
						'/admin/user/user.css'
                    )
                   ,'js' => array('/admin/tag/tag.js',
								  '/admin/songComm.js'
								  )   
                )
            );
?>

<body>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
	<div class="box_inner">
		
		<!-- // 顶部 -->
		
		<?php include(VIEW_DIR.'/admin/user_top.php');?>
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('讲师信息', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search_item">
					<h1><?php echo L::getText('姓名', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="name" id="name" onBlur="chkName(this.value)" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('出生日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="birthday" id="birthday" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('性别', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<label  style="margin-top:2px;"><input class="radiobox" name="gender" type="radio" value="1" checked /><span><?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__))?></span></label>
					<label  style="margin-top:2px;"><input class="radiobox" type="radio" name="gender" value="0" /><span><?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__))?></span></label>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('讲师级别', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select2 ~auto_width" name="level" size="1" id="level">
                    <option>&nbsp;</option>
                    <?php 
						foreach($this->c_cde['c0803'] as $k => $v)
						{
							echo "<option value='{$k}'>$v</option>";
						}
					?>		
					</select>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('讲师职称', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select2 ~auto_width" name="positional" size="1" id="positional">
                    <option>&nbsp;</option>
                    <?php 
						foreach($this->c_cde['c0805'] as $k => $v)
						{
							echo "<option value='{$k}'>$v</option>";
						}
					?>	
					</select>
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('专业类别', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select2 ~auto_width" name="specializ" size="1" id="specializ">
                    <option>&nbsp;</option>
                    <?php 
						foreach($this->c_cde['c0804'] as $k => $v)
						{
							echo "<option value='{$k}'>$v</option>";
						}
					?>	
					</select>
				</div>
				<div style="clear:both;"></div>
				<div class="search_item">
					<h1><?php echo L::getText('邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="email" id="email" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('电话号码', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="tel" id="tel" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('地址', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="addr" id="addr" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('Blog', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="blog" id="blog" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('微博', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="weibo" id="weibo" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('隶属培训机构', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select4 ~auto_width" name="group" size="1" id="group">      
                    <option value="0">&nbsp;</option>
                    <?php
					foreach($this->group as $g)
					{
						echo "<option value=$g[id]>$g[name]</option>";
					}
                    ?>
                    </select>
				</div>
				
				<div class="search_item">
					<a href="javascript:void(0)" class="icon_link" id="addTag" onClick="addTag()"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;+</a>
                    <div id="tagDiv">
					&nbsp;
					</div>
                         <input type="hidden" id="tag_id"/>
					
				</div>
				
				<!-- // 搜索按钮 -->
				<div class="button_area_search">

				</div>
			  
			</div>
		</div>
		<div class="panel_1 con_table">
			<div class="title"><span><?php echo L::getText('简介', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">	
				<div class="table_content">
					<!-- // 编辑器 -->
					<div class="editor_item" style="">
							<div class="editor_item_inner"><!-- // 文本框 -->
								<div class="textareaHolder">
									<div  class="textarea_inner">
                                    <!--2012 11 20 add -->
										<textarea style="border:#CCC 1px solid" rows="6" cols="155" id="desc" ></textarea>
									</div>
								</div>
							
							</div>					
						</div>	
				</div>
			</div>
	
		</div>
		
		
	
		<!-- // 主按钮区 -->
		<div class="button_area_search">
			<div class="center">
				<a href="#" class="btn" onClick="submitForm()" ><?php echo L::getText('确定', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
				<a href="#" class="btn" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>
			</div>
		</div>
	
	
		<!-- // footer -->
        <?php require VIEW_DIR.'/admin/footer.php'; ?>
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
<style>
.warning{ border:red 1px solid; background:#FCC}
</style>
<script>
function chkName(n)
{
	
}
function getFormData()
{
	var name     = $("#name").val()
	var birthday = $("#birthday").val()
	var gender   = $("input[name=gender]:checked").val()
	var level    = $("#level").val()
	var pol      = $("#positional").val()
	var spz      = $("#specializ").val()
	var email    = $("#email").val()
	var tel      = $("#tel").val()
	var addr     = $("#addr").val()
	var blog     = $("#blog").val()
	var weibo    = $("#weibo").val()
	var group    = $("#group").val()
	var dataJson = {"name":name,"birthday":birthday,"gender":gender,"level":level,"pol":pol,"spz":spz,
				   "email":email,"tel":tel,"addr":addr,"blog":blog,"weibo":weibo,"group":group};
	return dataJson;
}

function submitForm()
{
	var data = getFormData();
	var st = chkForm(data)
	if(st)
	{
		save(data);
	}
}

function chkForm(chkData)
{
	if(chkData.name == "")
	{
		oDialogDivInfo(window.L.getText('姓名不能为空'))
		return false;
	}
	if(chkData.group =="0")
	{
		oDialogDivInfo(window.L.getText('请选择所在的组'))
		return false;
	}
	return true;
}
function save(savaData)
{
	$.ajax({
		type:'POST',
		url:'./trainCtl.php?a=savaTer',
		data:savaData,
		success:function(d)
				{
					if(d >= 1)
					{
						var tag_option = {
							'objId':d,
							'tagIds':getTagVal(),
							'addOrReplace':'add'}
						tagAddTagObj(tag_option)
							
						oDialogDivInfo(window.L.getText('保存成功'));
					}else
					{
						oDialogDivInfo(window.L.getText('保存失败'));
					}
				}
	})
}
$(function(){
window.L.openCom(
		'wDate', 
		{
        	'obj' : $('#birthday').get(0),    //需绑定的对象
        	'eventType' : 'click',    //绑定的触发事件,默认click
        	'params' : {'readOnly' : true}    //传递WdatePicker的参数
    } );
})
function isTagVal(newId)
{
	var id = $("#tag_id").val().substr(1,$("#tag_id").val().length);
	var idArr = id.split(',');
	for(var t in idArr)
	{
		if(idArr[t] == newId)
		{
			return false;
		}
	}
	return true;
}
function addTag()
{
	var tag_option = {
		'tagType':'9'
		,'callbackFn':'tagCallBackFun'
		,'targetId':'addTag'
	};
	tagDisplayTag(tag_option);
	return false;
}
function tagCallBackFun(id,name)
{
	var newName = '<span id=tp_'+id+'>'+name+'<img src=# class=delImg onClick=delSpan(\''+id+'\')></img></span>';
	if(isTagVal(id))
	{
		$("#tagDiv").append(newName);
		var oldVal = $("#tag_id").val();
		oldVal += (','+id);
		$("#tag_id").val(oldVal);
		addDelClass();
	}
}

function addDelClass()
{
  $(".delImg").attr('src',L._rootUrl+'/images/icon/icon_del_normal.png');
  $(".delImg").bind('mouseover',function()
  {
	  $(this).attr('src',L._rootUrl+'/images/icon/icon_del_over.png');
  }).bind('mouseout',function()
  {
	  $(this).attr('src',L._rootUrl+'/images/icon/icon_del_normal.png');	
  })
}

function delSpan(id)
{
	var newTagId = '';
	$("#tp_"+id).remove();
	var tagArr = $("#tag_id").val().substr(1).split(",");
	for(var t in tagArr)
	{
		if(tagArr[t] != id)
		{
			newTagId += (','+tagArr[t]);
		}
	}
	$("#tag_id").val(newTagId);
}
function getTagVal()
{
	var id = $("#tag_id").val().substr(1,$("#tag_id").val().length);
	var idArr = id.split(',');
	var returnData = new Array();
	for(var t in idArr)
	{
		returnData.push(idArr[t])
	}
	return returnData;
}
function allDelTag()
{
	$("#tag_id").val("");
	$("#tagDiv").html("&nbsp");
}

</script>
