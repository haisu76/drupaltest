<?php
$this->printHead(
    array(
        'title' => array('title'=>'学习计划-添加计划', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/admin/index/backhead.css',
            '/admin/plan/plan.css',
            '/admin/plan/plan/addPlan.css'
        )
        ,'js'=>array(
            '/admin/plan/plan/addPlan.js',
            '/admin/tag/tag.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="box block_2"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        
        <!-- // 顶部 -->
        <div class="header">
        <?php 
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/plan/header.php';
        ?>
        </div>
        
        <!-- //  -->
        <div class="panel_1 con_input">
            <div class="title"><span><?php echo L::getText('计划内容', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <div class="col_left" style="width:50%;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                       <!--del 2012 12 03 <colgroup>
                        <col style="width:80px;" />
                        <col style="" />
                        </colgroup>-->
                        <tr>
                        <!--add 2012 12 03 width="80"-->
                            <td width="80"><?php echo L::getText('计划名称：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input id="p_id" value="<?php echo $this->studyPlanData['p_id']; ?>" type="hidden" />
                                <input class="input3 auto_width" type="text" id="p_name" value="<?php echo $this->studyPlanData['p_name']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('学习时间：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input3" type="text" id="p_begin_tm" value="<?php echo $this->studyPlanData['p_begin_tm']; ?>" />
                                <input class="input3" type="text" id="p_end_tm" value="<?php echo $this->studyPlanData['p_end_tm']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('计划状态：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input class="radiobox" name="p_status" type="radio" value="1" checked="checked" />
                                    <?php echo L::getText('启用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                              
                                <label>
                                    <input class="radiobox" name="p_status" type="radio" value="2" <?php echo $this->studyPlanData['p_status'] === '2' ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('编辑', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                              
                                <label>
                                    <input class="radiobox" name="p_status" type="radio" value="4" <?php echo $this->studyPlanData['p_status'] === '4' ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('禁用', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('限制IP：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input type="radio" onclick="addPlanObj.allowIpRadioClickFun(this)" value="0" name="allowIpRadio" class="radiobox" checked="checked" >
                                    <?php echo L::getText('不限制', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                <label>
                                    <input type="radio" onclick="addPlanObj.allowIpRadioClickFun(this)" value="1" name="allowIpRadio" class="radiobox">
                                    <?php echo L::getText('指定IP段：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr style="display: none;">
                            <td>&nbsp;</td>
                            <td class="indent_1" id="allowIp">
                            <?php
                                if(!$this->studyPlanData['p_allow_ip'])
                                {
                                    $this->studyPlanData['p_allow_ip'] = '-';
                                }
                                $temp = explode(',', $this->studyPlanData['p_allow_ip']);
                                foreach($temp as &$v)
                                {
                                    $ipPeriodArr = explode('-', $v);
                            ?>
                                    <div>
                                    <!--2012 12 05 del 从-->
                                        <?php echo L::getText('从', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;
                                        <input type="text" style="position:static;" onblur="addPlanObj.inputIpBlurCheckFun(this)" value="<?php echo $ipPeriodArr[0]; ?>" class="input2">
                                        &nbsp;<?php echo L::getText('到', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;
                                        <input type="text" style="position:static;" onblur="addPlanObj.inputIpBlurCheckFun(this)" value="<?php echo $ipPeriodArr[1]; ?>" class="input2">
                                        &nbsp;<a onclick="addPlanObj.addIpClickFun(this); return false;" title="添加IP段" href="#" class="icon_add"></a>&nbsp;<a onclick="addPlanObj.delIpClickFun(this); return false;" title="删除" href="#" class="icon_del"></a>
                                    </div>
                            <?php
                                }
                            ?>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="col_right">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <colgroup>
                        <col style="width:90px;" />
                        <col style="" />
                        </colgroup>
                        <tr>
                            <td><?php echo L::getText('计划分类：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input3 auto_width" type="text" id="p_category" readonly="readonly" value="<?php echo $this->studyPlanData['desc_cn']; ?>" key="<?php echo $this->studyPlanData['p_category']; ?>" onclick="addPlanObj.getStudyPlanSourceListTreeClickFun(this)" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('进修选项：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input name="p_elective" type="radio" class="checkbox" value="0" checked="checked" />
                                    <?php echo L::getText('必修', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                <label>
                                    <input name="p_elective" type="radio" class="checkbox" value="1" <?php echo $this->studyPlanData['p_elective'] === '1' ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('选修', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                   
                                <label>
                                    <input name="p_elective" type="radio" class="checkbox" value="2" <?php echo $this->studyPlanData['p_elective'] === '2' ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('需要报名', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('通过条件：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <label>
                                    <input name="p_pass_condition" type="radio" class="checkbox" value="3" checked="checked" />
                                    <?php echo L::getText('达到学时', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                    
                                <label>
                                    <input name="p_pass_condition" type="radio" class="checkbox" value="2" <?php echo strpos($this->studyPlanData['p_pass_condition'], '2;') !== false ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('通过考试', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                   
                                <label>
                                    <input name="p_pass_condition" type="radio" class="checkbox" value="1" <?php echo strpos($this->studyPlanData['p_pass_condition'], '1;') !== false ? 'checked="checked"' : ''; ?> />
                                    <?php echo L::getText('讲师评定', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('数据分组：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td><?php echo admin_user_permissions::dataStratifiedHtml(isset($_GET['id']) ? $_GET['id'] : null, 't_study_plan'); ?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding-right:0px;"><a id="getAddTagListButton" onclick="addPlanObj.getTagList(); return false;" class="icon_link" href="#"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;+</a></td>
                            <td id="tagList">
                            <?php
                                foreach($this->studyPlanData['tabList'] as &$v)
                                {
                            ?>
                                <span tagid="<?php echo $v['tag_id']; ?>" class="icon_link">
                                    <a href="#"><?php echo $v['tag_name']; ?></a><a class="icon_del" href="#" onclick="addPlanObj.delTag(this, '42'); return false;"></a>
                                </span>
                            <?php
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
            <div class="title"><span><?php echo L::getText('计划描述', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content"> 
                <span style="float:right; margin-right:5px; margin-top:3px; text-align:center;">
                    <img id="frontCoverImg" style="width:70px; height:70px;" title="<?php echo L::getText('点击删除封面', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" fileUrl="<?php echo $this->studyPlanData['frontCoverImg']; ?>" onclick="addPlanObj.delfrontCoverClick(this);" src="<?php echo ROOT_URL, '/include/oFileManager/fileExtension.php?fileUrl=', $this->studyPlanData['frontCoverImg']; ?>" onerror="this.src='<?php echo ROOT_URL; ?>/images/icon/icon_thumb_default1.png'" />
                    <a id="frontCoverImgProgress" class="icon_link" style="position:relative; display:block; width:78px;" href="#" onclick="return false;"><span style="position:absolute; left:0px;"><input id="frontCoverImgUpload" type="file" style="display:none;" /></span><?php echo L::getText('上传封面图片', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                </span>
                <textarea style="width:900px; height:100px;" id="p_des"><?php echo $this->studyPlanData['p_content']; ?></textarea>
                
                <!-- // button -->
                <div class="button_area_search none">
                    <div class="inner_box"> <a class="btn2" href="#" ><?php echo L::getText('添加课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a class="btn2 iframe" href="dialog_student_set.html" title="学员设置" ><?php echo L::getText('学员设置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a class="btn2 iframe" href="dialog_course_sort.html" title="课程排序" ><?php echo L::getText('课程排序', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a class="btn2 iframe" href="dialog_certificate_set.html" title="结业考试设置" ><?php echo L::getText('结业考试设置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                </div>
            </div>
        </div>
        
        <!-- // 课程内容  -->
        <div class="panel_1 con_input"> 
            <!-- // 主标题 -->
            <h1 class="main_title">
                <div class="left"> <span class="icon"></span><?php echo L::getText('课程内容', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div>
                <div class="right"> <a href="#" onclick="addPlanObj.addCourseBlockClickFun(); return false;"><?php echo L::getText('添加课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;+</a> </div>
            </h1>
            
            <!-- //  -->
            <div id="courseListBlock" class="content add_plan"> 
            <?php
                $courseNameData = array();    //存储课程ID与名称对应数据
                foreach($this->studyPlanData['courseList'] as &$courseData)
                {
                    $courseNameData[$courseData['c_id']] = $courseData['c_name'];
            ?>
                <div id="courseBlock" class="list_item list_item_even data_list_h list_item_current">
                    <div class="col_LR">
                        <div class="sidebar"> 
                            <!-- // btn_link -->
                            <div class="btn_link"> <a href="#" class="icon_link" onclick="addPlanObj.delCourseBlockClickFun(this); return false;" ><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="icon_link" onclick="addPlanObj.slideToggleCourseBlockClickFun(this); return false;" ><?php echo L::getText('缩放', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                        </div>
                        
                        <!-- //  -->
                        <div>
                            <input class="num" value="<?php echo $courseData['c_position']; ?>" onkeypress="addPlanObj.courseBlockSortKeypressFun(event, this);" />
                            <dl style="margin-right: 0px;">
                                <dt><?php echo L::getText('课程名称：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                <dd>
                                    <input id="c_name" type="text" class="input3 disable_edit" key="<?php echo $courseData['c_id']; ?>" value="<?php echo $courseData['c_name']; ?>" onclick="addPlanObj.updateCourseBlockClickFun(this)" readonly="readonly" />
                                </dd>
                            </dl>
                            <dl style="margin-right: 0px;">
                                <dt><?php echo L::getText('通过条件：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                <dd>
                                    <label>
                                        <input name="courseBlockPassCondition<?php echo $courseData['c_id'] ? '_' . $courseData['c_id'] : ''; ?>" type="radio" value="3" class="checkbox"checked="checked"  />
                                        <?php echo L::getText('达到学时', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                </dd>
                                <dd>
                                    <label>
                                        <input name="courseBlockPassCondition<?php echo $courseData['c_id'] ? '_' . $courseData['c_id'] : ''; ?>" type="radio" value="2" class="checkbox" <?php echo strpos($courseData['c_pass_condition'], '2;') !== false ? 'checked="checked"' : ''; ?> />
                                        <?php echo L::getText('通过考试', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                </dd>
                                <dd>
                                    <label>
                                        <input name="courseBlockPassCondition<?php echo $courseData['c_id'] ? '_' . $courseData['c_id'] : ''; ?>" type="radio" value="1" class="checkbox" <?php echo strpos($courseData['c_pass_condition'], '1;') !== false ? 'checked="checked"' : ''; ?> />
                                        <?php echo L::getText('讲师评定', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                </dd>
                            </dl>
                            <dl style="margin-right: 0px;">
                                <dt><?php echo L::getText('辅助选项：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                <dd>
                                    <label>
                                        <input type="checkbox" class="checkbox" value="1" name="c_elective" <?php echo $courseData['c_elective'] === '1' ? 'checked="checked"' : ''; ?>>
                                        <?php echo L::getText('允许选修', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                </dd>
                                <dd>
                                    <label>
                                        <input type="checkbox" class="checkbox" value="1" name="c_isModifyProgress" <?php echo $courseData['c_isModifyProgress'] === '1' ? 'checked="checked"' : ''; ?>>
                                        <?php echo L::getText('改变进度', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                </dd>
                            </dl>
                        </div>
                        <!-- // con end --> 
                        
                    </div>
                    
                    <!-- // sub content子内容 -->
                    <div class="sub_content">
                        <div class="inner">
                            <table style=" margin-bottom:0px; width:100%;">
                                <tr valign="top">
                                    <td>
                                        <div class="whereTitle"><a href="#" onclick="addPlanObj.addStudyWhere(this); return false;" ><?php echo L::getText('添加学习条件', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;+</a><span><?php echo L::getText('学习限制条件：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
                                        <?php
                                            if($courseData['course_condition'] != '')
                                            {
                                                $courseConditionArr = explode(',', $courseData['course_condition']);
                                                for($i = 0, $iL = count($courseConditionArr); $i < $iL; ++$i)
                                                {
                                                    $courseWhereData = explode(' ', $courseConditionArr[$i]);
                                                    if($i === 0)
                                                    {
                                        ?>
                                                        <div class="whereBlock">
                                                            <h1><a title="<?php echo L::getText('删除条件', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" onclick="addPlanObj.delCourseWhere(this);" class="icon_del"></a><a onclick="addPlanObj.addCourseWhere(this);" title="<?php echo L::getText('添加课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" class="icon_add"></a><?php echo L::getText('通过以下课程可学习本课程：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                                                            <div class="whereCourse">
                                        <?php
                                                    } else if($courseWhereData[0] === 'OR') {
                                        ?>
                                                            </div>
                                                        </div>
                                                        <div class="whereBlock">
                                                            <h1><a title="<?php echo L::getText('删除条件', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" onclick="addPlanObj.delCourseWhere(this);" class="icon_del"></a><a onclick="addPlanObj.addCourseWhere(this);" title="<?php echo L::getText('添加课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" class="icon_add"></a><?php echo L::getText('通过以下课程可学习本课程：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                                                            <div class="whereCourse">
                                        <?php
                                                    }
                                        ?>
                                                                <div key="<?php echo $courseWhereData[1]; ?>"><span><?php echo L::getText('必须通过：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span><span><font><?php echo $courseNameData[$courseWhereData[1]]; ?></font><a onclick="addPlanObj.delCourse(this);" class="icon_del"></a></span></div>
                                        <?php
                                                    if($i === $iL - 1)
                                                    {
                                        ?>
                                                            </div>
                                                        </div>
                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td width="500">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                           
                                            <tr>
                                                <td style="color:#6686BD;"><?php echo L::getText('开课日期：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                                                <td name="studyDatePeriod">
                                                <!--add 2012 12 05 style="position:static;"-->
                                                    <input type="text" class="input2 Wdate" value="<?php echo $courseData['opening_begin_tm']; ?>" onClick="WdatePicker({'minDate' : document.getElementById('p_begin_tm').value, 'maxDate' : document.getElementById('p_end_tm').value})" style="position:static;" >
                                                    <input type="text" class="input2 Wdate" value="<?php echo $courseData['opening_end_tm']; ?>" onClick="WdatePicker({'minDate' : document.getElementById('p_begin_tm').value, 'maxDate' : document.getElementById('p_end_tm').value})" style="position:static;" >
                                                </td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" style="color:#6686BD;"><?php echo L::getText('每天学习时间：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                                                <td id="timePeriod">
                                                    <div>
                                                        <input type="text" class="input2 Wdate" name="textfield" value="<?php echo $courseData['s1_begin_tm']; ?>" onClick="WdatePicker({'dateFmt' : 'HH:mm:ss'})" style="position:static;">
                                                        <input type="text" class="input2 Wdate" name="textfield" value="<?php echo $courseData['s1_end_tm']; ?>" onClick="WdatePicker({'dateFmt' : 'HH:mm:ss'})" style="position:static;">
                                                        <a class="icon_add" href="#" onclick="addPlanObj.addStubyTimePeriod(this); return false;"></a><a class="icon_del" href="#" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" onclick="addPlanObj.delStubyTimePeriod(this); return false;"></a>
                                                    </div>
                                                <?php
                                                    if($courseData['s2_begin_tm'] || $courseData['s2_end_tm'])
                                                    {
                                                ?>
                                                    <div>
                                                        <input type="text" class="input2 Wdate" name="textfield" value="<?php echo $courseData['s2_begin_tm']; ?>" onClick="WdatePicker({'dateFmt' : 'HH:mm:ss'})" style="position:static;">
                                                        <input type="text" class="input2 Wdate" name="textfield" value="<?php echo $courseData['s2_end_tm']; ?>" onClick="WdatePicker({'dateFmt' : 'HH:mm:ss'})" style="position:static;">
                                                        <a class="icon_add" href="#" onclick="addPlanObj.addStubyTimePeriod(this); return false;"></a><a class="icon_del" href="#" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" onclick="addPlanObj.delStubyTimePeriod(this); return false;"></a>
                                                    </div>
                                                <?php
                                                    }
                                                    if($courseData['s3_begin_tm'] || $courseData['s3_end_tm'])
                                                    {
                                                ?>
                                                    <div>
                                                        <input type="text" class="input2 Wdate" name="textfield" value="<?php echo $courseData['s3_begin_tm']; ?>" onClick="WdatePicker({'dateFmt' : 'HH:mm:ss'})" style="position:static;">
                                                        <input type="text" class="input2 Wdate" name="textfield" value="<?php echo $courseData['s3_end_tm']; ?>" onClick="WdatePicker({'dateFmt' : 'HH:mm:ss'})" style="position:static;">
                                                        <a class="icon_add" href="#" onclick="addPlanObj.addStubyTimePeriod(this); return false;"></a><a class="icon_del" href="#" title="<?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" onclick="addPlanObj.delStubyTimePeriod(this); return false;"></a>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
                                                </td>
                                                <td> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
        <div class="clear"></div>
        <!-- // 学员列表  -->
        <div class="panel_1 con_input"> 
            <!-- // 主标题 -->
            <h1 class="main_title">
                <div class="left"> <span class="icon"></span><?php echo L::getText('学员列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?> </div>
            </h1>
            
            <!-- // 表格数据 -->
            <?php echo $this->planGroupListPageTable; ?>
            <br/>
            <!-- // 表格数据 -->
            <?php echo $this->planUserListPageTable; ?>
        </div>
        
        <!-- // 考试列表  -->
        <div class="panel_1 con_input"> 
            <!-- // 主标题 -->
            <h1 class="main_title">
                <div class="left"> <span class="icon"></span><?php echo L::getText('考试列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?> </div>
            </h1>

            <!-- //  -->
            <?php echo $this->planExamListPageTable; ?>
        </div>
        
        <!-- // 主按钮区(分左中右) -->
        <div class="button_area_search">
            <div class="center"> <a href="#" class="btn" onclick="addPlanObj.saveClickFun(); return false;" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="btn" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
    
</div>
