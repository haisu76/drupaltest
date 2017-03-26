<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array( '/main.css', '/components/pageTable/pageTable.css' )
                   ,'js' => array('/admin/userApi.js',
								  '/admin/manyTrees.js',
								  '/admin/songComm.js',
								  '/components/pageTable/pageTable.js'
					)   
                ) 
            );
?>
<body>
<div class="box block_11"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span>搜索用户</span></div>
            <div class="content">
                <div class="search">
                    <div class="search_item">
                        <h1>用户组</h1>
                        <input class="input3 ~auto_width" type="text" name="group" id="group_name" value="<?php echo $this->minGroup[0]['group_name'];?>"  onClick="showUserGroup()"/>
                        <input type="hidden" id="group" value="0"/>
                    </div>
                    <div class="search_item">
                        <h1>I D / 用户名 / 姓 名 / E-Mail</h1>
                        <input class="input3 ~auto_width" type="text" name="user" style="width:192px;" id="user" />
                    </div>
                    <div class="search_item">
                        <h1>电话号码</h1>
                        <input class="input3 ~auto_width" type="text" name="tel" id="tel" />
                    </div>
                    <div class="search_item">
                        <h1>手机号码</h1>
                        <input class="input3 ~auto_width" type="text" name="mobiletel" id="mobiletel" />
                    </div>
                    <div class="search_item">
                        <h1>状&nbsp;态</h1>
                        <select class="select2 ~auto_width" size="1" name="status"  id="status">
                            <option value=""><?php echo str_repeat("&nbsp;",12);?></option>
                            <option value="070102">已通过</option>
                            <option value="070101">未通过</option>
                        </select>
                    </div>
                    <div class="search_item">
                        <h1>性别</h1>
                        <select size="1" class="select3" id="gender" name="gender" >
                            <option value=""><?php echo str_repeat("&nbsp;",8);?></option>
                            <option value="1">男</option>
                            <option value="0">女</option>
                        </select>
                    </div>
                    <div class="search_item float_right">
                        <h1></h1>
                        <label>
                            <input name="checkbox" type="checkbox" class="checkbox" id="searchFF" value="1"/>
                            高级搜索</label>
                    </div>
                </div>
                <div class="clear"></div>
                
                <!-- // 高级搜索 -->
                <div class="advance_search">
                    <div class="search_item">
                        <h1>证件号码</h1>
                        <input class="input6 ~auto_width" type="text" name="idcard" id="idcard" />
                    </div>
                    <div class="search_item">
                        <h1>准考证号码</h1>
                        <input class="input6 ~auto_width" type="text" name="examcard" id="examcard" />
                    </div>
                    <div class="search_item"> </div>
                    <div class="search_item">
                        <h1>注册时间</h1>
                        <input type="text" class="input3 ~auto_width" name="time1" id="time1" value=""  style="width:110px;"/>
                        <input type="text" class="input3 ~auto_width" name="time2" id="time2" value="" style="width:110px;"/>
                    </div>
                </div>
                <div class="button_area_search">
                    <div class="inner_box"> <a href="#" class="btn2" id="search" >搜索</a> <a href="#" class="btn2" id="reset" >重置</a> 
                    
            
                    
                    </div>
                </div>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"> <span>用户列表</span> </div>
            <div class="searchList"> </div>
        </div>
       <a href="#" class="btn2" onClick="return getChoose()" >保存</a>    <a href="javascript:void(0)" class="btn2" onClick="closeUserDiv();return false;">关闭</a> 
        <input type="hidden" value="<?php echo $this->v;?>" id="v"/>
    </div>
</div>
<!-- // box_inner end -->

</div>
<!-- // box end -->
</body>
</html>