<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程课件-添加课程', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/admin/index/backhead.css',
			'/admin/course/course.css'
        )
        ,'js'=>array(
            '/admin/course/course/addCourse.js',
            '/admin/tag/tag.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<style>
label{ cursor:pointer;}
</style>
<script>
var attUploadUrlLen = <?php echo strlen(Of::config('_browseHome')) + 10; ?>;
</script>
<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 

        <!-- // 顶部 -->
        <div class="header">
        <?php
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/course/header.php';
        ?>
        </div>

        <!-- //  -->
        <div class="panel_1 con_input">
            <div class="title"><span><?php echo L::getText('课程信息', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <div class="col_left" style="width:50%;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <!--del 2012 12 03
                        <colgroup>
                        <col style="width:80px;" />
                        <col style="" />
                        </colgroup>
                        -->
                        <tr>
                        <!--add 2012 12 03 width="80"-->
                            <td width="75"><?php echo L::getText('课程名称：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td colspan="2">
                                <input id="c_name" class="input3 auto_width" type="text" value="<?php echo $this->courseValue['c_name']; ?>" />
                                <input id="c_id" type="hidden" value="<?php echo $this->courseValue['c_id']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('所需积分：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input readonly="readonly" class="input2 ~auto_width" type="text" value="<?php echo $this->courseValue['w_credit']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课程学分：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input readonly="readonly" class="input2 ~auto_width" name="textfield" type="text" id="textfield" value="<?php echo $this->courseValue['w_point']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课程学时：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input readonly="readonly" class="input2 ~auto_width" name="textfield" type="text" id="textfield" value="<?php echo $this->courseValue['w_length']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('学习时间：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td colspan="2">
                                <input id="c_start_time" class="input3" style="width:155px;" type="text" value="<?php echo $this->courseValue['c_start_time']; ?>" />
                                &nbsp;
                                <input id="c_end_time" class="input3" style="width:155px;" type="text" value="<?php echo $this->courseValue['c_end_time']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课程状态：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input class="radiobox" name="c_status" type="radio" value="1" checked="checked" />
                                    <?php echo L::getText('启用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                &nbsp; &nbsp;
                                <label>
                                    <input class="radiobox" name="c_status" type="radio" value="2" <?php echo $this->courseValue['c_status'] === '2' ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('禁用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('限制IP：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input class="radiobox" name="allowIpRadio" type="radio" value="0" onclick="courseObj.allowIpRadioClickFun(this)" />
                                    <?php echo L::getText('不限制', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                </label>
                                <label>
                                    <input class="radiobox" name="allowIpRadio" type="radio" value="1" onclick="courseObj.allowIpRadioClickFun(this)" />
                                    <?php echo L::getText('指定IP段：', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                </label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr style="display:none;">
                            <td>&nbsp;</td>
                            <td id="allowIp" colspan="2" class="indent_1">
                            <?php
                                if($this->courseValue['c_allow_ip'])
                                {
                                    $temp = explode(',', $this->courseValue['c_allow_ip']);
                                } else {
                                    $temp = array('-');
                                }

                                foreach($temp as &$v)
                                {
                                    $ipPair = explode('-', $v);
                            ?>
                                <div>
                                    <?php echo L::getText('从', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;
                                    <input class="input2" type="text" name="textfield" value="<?php echo $ipPair[0] ?>" onblur="courseObj.inputIpBlurCheckFun(this)" style="position:static;" />
                                    &nbsp;<?php echo L::getText('到', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;
                                    <input class="input2" type="text" name="textfield" value="<?php echo $ipPair[1] ?>" onblur="courseObj.inputIpBlurCheckFun(this)" style="position:static;" />
                                    &nbsp;<a class="icon_add" href="#" title="<?php echo L::getText('添加IP段', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" onclick="courseObj.addIpClickFun(this); return false;"></a>&nbsp;<a class="icon_del" href="#" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" onclick="courseObj.delIpClickFun(this); return false;"></a>
                                </div>
                            <?php
                                }
                            ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col_right">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <colgroup>
                        <col style="width:110px;" />
                        <col style="" />
                        </colgroup>
                        <tr>
                            <td><?php echo L::getText('课程分类：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td><input id="c_category" class="input3 auto_width" type="text" readonly="readonly" value="<?php echo $this->courseValue['desc_cn']; ?>" onclick="courseObj.addCourseCategoryClickFun(this)" key="<?php echo $this->courseValue['c_category']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><a href="#" onclick="courseObj.addCourseTeacherClickFun(); return false;" ><?php echo L::getText('选择讲师', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;+</a></td>
                            <td id="c_teacher">
                            <?php
                                if($this->courseValue['teacherIdAndName'])
                                {
                                    $temp = explode(',,', $this->courseValue['teacherIdAndName']);
                                    foreach($temp as &$v)
                                    {
                                        $teacherArr = explode(',', $v, 2);
                            ?>
                                <span key="<?php echo $teacherArr[0];?>">
                                    <font><?php echo $teacherArr[1];?></font>
                                    <a onclick="courseObj.delTeacher(this); return false;" href="#" class="icon_del"></a>
                                </span>
                            <?php
                                    }
                                }
                            ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('进修选项：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input name="c_elective" type="radio" class="checkbox" value="0" checked="checked" />
                                    <?php echo L::getText('必修', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                <label>
                                    <input name="c_elective" type="radio" class="checkbox" value="1" <?php echo $this->courseValue['c_elective'] === '1' ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('选修', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                <label>
                                    <input name="c_elective" type="radio" class="checkbox" value="2" <?php echo $this->courseValue['c_elective'] === '2' ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('需要审批', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课程通过条件：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input name="c_pass_condition" type="radio" class="checkbox" value="3" checked="checked" />
                                    <?php echo L::getText('达到学时', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                <label>
                                    <input name="c_pass_condition" type="radio" class="checkbox" value="2" <?php echo strpos($this->courseValue['c_pass_condition'], '2;') !== false ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('通过考试', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                <label>
                                    <input name="c_pass_condition" type="radio" class="checkbox" value="1" <?php echo strpos($this->courseValue['c_pass_condition'], '1;') !== false ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('讲师评定', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('数据分组：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td><?php echo admin_user_permissions::dataStratifiedHtml(isset($_GET['courseId']) ? $_GET['courseId'] : null, 't_course'); ?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('改变进度：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input class="radiobox" name="c_isModifyProgress" value="1" checked="checked" type="radio">
                                    <?php echo L::getText('启用', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                </label>
                                &nbsp; &nbsp;
                                <label>
                                    <input class="radiobox" name="c_isModifyProgress" value="0" type="radio" <?php echo $this->courseValue['c_isModifyProgress'] === '0' ? 'checked="checked"' : ''; ?>>
                                    <?php echo L::getText('禁用', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                </label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><a id="getAddTagListButton" onclick="courseObj.getTagList(); return false;" class="icon_link" href="#"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;+</a></td>
                            <td id="tagList">
                            <?php
                                if($this->courseValue['tagIdAndName'])
                                {
                                    $temp = explode(',,', $this->courseValue['tagIdAndName']);
                                    foreach($temp as &$v)
                                    {
                                        $tagArr = explode(',', $v);
                            ?>
                                <span class="icon_link" tagid="<?php echo $tagArr[0] ?>"><a href="#"><?php echo $tagArr[1] ?></a><a onclick="courseObj.delTag(this, '42'); return false;" href="#" class="icon_del"></a></span>
                            <?php
                                    }
                                }
                            ?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- //  -->
        <div class="panel_1 con_input">
            <div class="title"><span><?php echo L::getText('课程描述', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <span style="float:right; margin-right:5px; margin-top:3px; text-align:center;">
                <img id="frontCoverImg" style="width:70px; height:70px;" title="<?php echo L::getText('点击删除封面', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" fileUrl="<?php echo $this->courseValue['frontCoverImg']; ?>" onclick="courseObj.delfrontCoverClick(this);" src="<?php echo ROOT_URL, '/include/oFileManager/fileExtension.php?fileUrl=', $this->courseValue['frontCoverImg']; ?>" onerror="this.src='<?php echo ROOT_URL; ?>/images/icon/icon_thumb_default1.png'" />
                <a id="frontCoverImgProgress" class="icon_link" style="position:relative; display:block; width:78px;" href="#" onclick="return false;"><span style="position:absolute; left:0px;"><input id="frontCoverImgUpload" type="file" style="display:none;" /></span><?php echo L::getText('上传封面图片', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
            </span>
            <textarea id="c_des" style="width:900px; height:100px;"><?php echo trim(strip_tags($this->courseValue['c_des'])); ?></textarea>
        </div>

        <!-- //  -->
        <div class="panel_1 con_input">
            <div class="title"><span><?php echo L::getText('课程附件', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <span id="attList">
                <?php
                    if($this->courseValue['attUrlAndName'])
                    {
                        $temp = explode(',,', $this->courseValue['attUrlAndName']);
                        foreach($temp as &$v)
                        {
                            $attArr = explode(',', $v);
                ?>
                    <span atturl="<?php echo '/' . trim($attArr[0], '\\/'); ?>">
                        <a onclick="courseObj.renameAttClickFun(this); return false;" href="#" title="修改附件名"><?php echo $attArr[1]; ?></a>
                        <a onclick="courseObj.delAtt(this); return false;" href="#" class="icon_del"></a>
                    </span>
                <?php
                        }
                    }
                ?>
                </span>
                <div class="clear"></div>
                <a href="#" class="btn iframe" style="position:relative;" onclick="return false;" ><span style="position:absolute; left:0px;"><input id="uploadAtt" type="file" style="display:none;" /></span><?php echo L::getText('添加附件', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="btn" onclick="courseObj.delAllAtt(); return false;" ><?php echo L::getText('全部删除', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                <span id="uploadAttProgress" style="float:right; width:500px;"></span>
            </div>
        </div>

        <!-- //  -->
        <div class="panel_1 con_input">
            <div class="title"><span><?php echo L::getText('课程管理', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content"> 
                <!-- // tab menu -->
                <div class="con_tab" id="tabs1">
                    <div class="tab_title">
                        <a id="courseManagementTag_1" href="#" class="current" onclick="courseObj.tabSwitch(this); return false;" ><?php echo L::getText('课件', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                        <a id="courseManagementTag_2" href="#" onclick="courseObj.tabSwitch(this); return false;" ><?php echo L::getText('用户/组', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                        <?php
                            if( !getLicenceInfo('Disable', 'customCoursePractice') )
                            {
                        ?>
                            <a id="courseManagementTag_3" href="#" onclick="courseObj.tabSwitch(this); return false;" ><?php echo L::getText('练习', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                        <?php
                            }
                        ?>
                        <a id="courseManagementTag_4" href="#" onclick="courseObj.tabSwitch(this); return false;" ><?php echo L::getText('考试', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                    </div>
                    <div class="clear"></div>
                    <div id="courseManagement_1" class="tab_content"><!-- // tab课件 --> 
                        <!-- // toolbar_top -->
                        <div class="toolbar_top">
                            <div class="left"> <span class="icon_add no_margin" title=""></span><a href="#" onclick="courseObj.addCoursewareClickFun(); return false;"><?php echo L::getText('添加课件', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                            <div class="right"> 
                                <!-- // 右侧内容 --> 
                            </div>
                        </div>
                        
                        <!-- // 表格数据 -->
                        <?php echo $this->coursewareListPageTable; ?>
                    </div>
                    <div id="courseManagement_2" style="display:none;" class="tab_content"><!-- // tab 用户组 --> 
                        <!-- //  -->
                        <div class="toolbar_top">
                            <div class="left">
                                <span class="icon_add no_margin" title=""></span><a id="includeCourseGroupListTree" href="#" onclick="courseObj.getCourseGroupListTreeClickFun(this, true); return false;" ><?php echo L::getText('添加组', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                                <span class="icon_add no_margin" title=""></span><a id="excludeCourseGroupListTree" href="#" onclick="courseObj.getCourseGroupListTreeClickFun(this, false); return false;" ><?php echo L::getText('排除组', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            </div>
                            <div class="right"> 
                                <!-- // 右侧内容 --> 
                            </div>
                        </div>
                        
                        <!-- // 表格数据 -->
                        <?php echo $this->courseGroupListPageTable; ?>
                        <!-- //  -->
                        <div class="toolbar_top">
                            <div class="left">
                                <span class="icon_add no_margin" title=""></span><a id="includeCourseGroupListTree" href="#" onclick="courseObj.getCourseUserListDialogDivClickFun(this, true); return false;" ><?php echo L::getText('添加用户', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                                <span class="icon_add no_margin" title=""></span><a id="excludeCourseGroupListTree" href="#" onclick="courseObj.getCourseUserListDialogDivClickFun(this, false); return false;" ><?php echo L::getText('排除用户', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            </div>
                            <div class="right"> 
                                <!-- // 右侧内容 --> 
                            </div>
                        </div>
                        
                        <!-- // 表格数据 -->
                        <?php echo $this->courseUserListPageTable; ?>
                    </div>
                    <div id="courseManagement_3" style="display:none;" class="tab_content"><!-- // tab 作业 --> 
                        <!-- //  -->
                        <div class="toolbar_top">
                            <div class="left"> <span class="icon_add no_margin" title=""></span><a href="#" onclick="courseObj.getCourseExamListDialogDivClickFun('courseExerciseListPageTable'); return false;"><?php echo L::getText('添加练习', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                            <div class="right"> 
                                <!-- // 右侧内容 --> 
                            </div>
                        </div>
                        
                        <!-- // 表格数据 -->
                        <div class="table_content">
                            <?php echo $this->courseExerciseListPageTable; ?>
                        </div>
                    </div>
                    <div id="courseManagement_4" style="display:none;" class="tab_content"><!-- // tab 练习 --> 
                        <!-- //  -->
                        <div class="toolbar_top">
                            <div class="left"> <span class="icon_add no_margin" title=""></span><a href="#" onclick="courseObj.getCourseExamListDialogDivClickFun('courseExaminationListPageTable'); return false;"><?php echo L::getText('添加考试', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                            <div class="right"> 
                                <!-- // 右侧内容 --> 
                            </div>
                        </div>
                        
                        <!-- // 表格数据 -->
                        <div class="table_content">
                            <?php echo $this->courseExaminationListPageTable; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- // 主按钮区(分左中右) -->
        <div class="button_area_search">
            <div class="center"> <a href="#" class="btn" onclick="courseObj.saveClickFun(); return false;" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="btn" onclick="history.back()" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
    
</div>
