<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/main.css'
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
		
		
		<!-- // 搜索过滤 -->
		<div class="panel_1 con_search">
			<div class="title"><span><?php echo L::getText('搜索机构', array('file'=>__FILE__, 'line'=>__LINE__))?></span></div>
			<div class="content">
				<div class="search_item">
					<h1><?php echo L::getText('姓名', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="name" id="name" value="<?php echo $this->teaList[0]['e_name'];?>" />
                    <input type="hidden" id="tid" value="<?php echo $this->teaList[0]['e_id'];?>" />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('出生日期', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="birthday" id="birthday" value="<?php echo $this->teaList[0]['e_birthday'];?>"  />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('性别', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
                    <?php
                    if($this->teaList[0]['e_sex'])
					{
					?>
					<label><input id="gender" class="radiobox" name="gender" type="radio" value="1" checked /><?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__))?></label> &nbsp; &nbsp;
					<label><input id="gender" class="radiobox" type="radio" name="gender" value="0" /><?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
                    <?php } else { ?>
                    <label><input id="gender" class="radiobox" name="gender" type="radio" value="1"  /><?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__))?></label> &nbsp; &nbsp;
					<label><input id="gender" class="radiobox" type="radio" name="gender" value="0" checked /><?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__))?></label>
                    <?php } ?>
				</div>
				<!--        e_level 级别 e_positional 职称  e_specializ 专业  e_group 组      -->
				<div class="search_item">
					<h1><?php echo L::getText('讲师级别', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select2 ~auto_width" name="level" size="1" id="level">
                    <option>&nbsp;</option>
                    <?php 
						foreach($this->c_cde['c0803'] as $k => $v)
						{
							if($this->teaList[0]['e_level'] == $k)
							{
								echo "<option value='{$k}' selected>$v</option>";
							}else{
								echo "<option value='{$k}'>$v</option>";
							}
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
							if($this->teaList[0]['e_positional'] == $k)
							{
								echo "<option value='{$k}' selected>$v</option>";
							}else{
								echo "<option value='{$k}'>$v</option>";
							}
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
							if($this->teaList[0]['e_specializ'] == $k)
							{
								echo "<option value='{$k}' selected>$v</option>";
							}else{
								echo "<option value='{$k}'>$v</option>";
							}
						}
					?>	
					</select>
				</div>
				<div class="search_item">
					<h1><?php echo L::getText('邮箱', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="email" id="email" value="<?php echo $this->teaList[0]['e_email'];?>"  />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('电话号码', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input3 ~auto_width" type="text" name="tel" id="tel" value="<?php echo $this->teaList[0]['e_tel'];?>"  />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('地址', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="addr" id="addr" value="<?php echo $this->teaList[0]['e_addr'];?>"  />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('Blog', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="blog" id="blog" value="<?php echo $this->teaList[0]['e_blog'];?>"  />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('微博', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<input class="input5 ~auto_width" type="text" name="weibo" id="weibo" value="<?php echo $this->teaList[0]['e_weibo'];?>"  />
				</div>
				
				<div class="search_item">
					<h1><?php echo L::getText('隶属培训机构', array('file'=>__FILE__, 'line'=>__LINE__))?></h1>
					<select class="select4 ~auto_width" name="group" size="1" id="group">      
                    <option value="0">&nbsp;</option>
                    <?php
					foreach($this->group as $g)
					{
						if($this->teaList[0]['e_group'] == $g['id'])
						{
							echo "<option value=$g[id] selected>$g[name]</option>";
						}else{
							echo "<option value=$g[id]>$g[name]</option>";
						}
					}
                    ?>
                    </select>
				</div>
                <input type="hidden" id="t_id" value="<?php echo $this->teaList[0]['e_id'];?>"/>
				<div class="search_item">
				<a href="javascript:void(0)" class="icon_link" id="addTag" onclick="addTag()"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__))?>&nbsp;+</a>
                    <div id="tagDiv">
					&nbsp;<?php echo $this->tagName;?>
					</div>
                    <input type="hidden" id="tag_id" value="<?php echo $this->tagVal;?>"/>
						
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
									<div class="textarea_inner">
										<textarea rows="6" cols="155" id="desc" > <?php echo strip_tags($this->teaList[0]['e_des']);?> </textarea>
									</div>
								</div>
							
							</div>					
						</div>	
				</div>
			</div>
	
		</div>	
	
	</div><!-- // box_inner end -->
	
</div><!-- // box end -->


</body>
</html>
<style>
.warning{ border:red 1px solid; background:#FCC}
</style>
<script>
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

$(function(){
window.L.openCom(
		'wDate', 
		{
        	'obj' : $('#birthday').get(0),    //需绑定的对象
        	'eventType' : 'click',    //绑定的触发事件,默认click
        	'params' : {'readOnly' : true}    //传递WdatePicker的参数
    } );
})

$(function(){
	addDelClass();
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
function allDelTag()
{
	$("#tag_id").val("");
	$("#tagDiv").html("&nbsp;");
}
</script>
