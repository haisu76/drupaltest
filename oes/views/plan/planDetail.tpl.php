<?php
$this->printHead(
    array(
        'title'=>array('title'=>'计划内容', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/mainindex.css',
        )
        ,'js'=>array(
            '/jquery.progressbar.js',
            '/plan/planDetail.js'
        )
    )
);
?>

<div id="container" class="box block_12">
    <!-- // header -->
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <!-- // header end -->

    <div class="box_inner"> 
        
        <div id="menu" class="none">This is the Menu</div>
        
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <!-- // 侧边列 -->
            <?php index::rightShare(); ?>
            
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div course_detail">
                        <h1 class="main_title">
                            <div class="left"> <span class="icon"></span><?php echo L::getText('计划内容', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                            <div class="right"> <a class="icon_link" href="#" onclick="window.history.back(); return false;"><span class="icon_back"></span><?php echo L::getText('返回', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                        </h1>
                        
                        <!-- // 列表项目 -->
                        <div style="_height:180px;" class="list_item">
                            <div style="padding-bottom:0px;" class="content"> 
                                <!-- // 左边icon -->
                                <div class="l"><a class="icon_list list_thumb_big" href="#" >
                                    <img src="<?php echo ROOT_URL ?>/include/oFileManager/fileExtension.php?fileUrl=<?php echo Of::config('_browseHome'), $this->planAttr['frontCoverImg'] ?>" style="display:none;" onload="this.style.display=''"></img>
                                </a></div>
                                <div class="right_info l"> 
                                    <!-- // 第一行：主标题 -->
                                    <h2 class="title">
                                        <div class="left">
                                            <div class="tt"> <span class="icon"></span><?php echo $this->planAttr['p_name']; ?></div>
                                        </div>
                                    </h2>
                                    <!-- // 第二行 -->
                                    <div class="col_LR sub_title l" style="width:600px;">
                                        <div class="inner"> </div>
                                        <!-- // content -->
                                        <div class="con">
                                            <dl class="dd">
                                                <dt class="l"><?php echo L::getText('讲师：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                <dd title="<?php echo $this->planAttr['teacher_name_list']; ?>" style="text-overflow:ellipsis; white-space:nowrap; overflow:hidden; width:50px; display:block; float:left;"><?php echo $this->planAttr['teacher_name_list']; ?></dd>
                                            </dl>
                                            <dl class="dd" style="float:left; margin-right:150px;">
                                                <dt style="float:left;"><?php echo L::getText('学习时间：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                <dd><div style=" float:left; width:auto ; min-width:250px; "><?php echo $this->planAttr['p_begin_tm'] === '0000-00-00 00:00:00' ? '' : $this->planAttr['p_begin_tm'], '~', $this->planAttr['p_end_tm'] === '0000-00-00 00:00:00' ? '' : $this->planAttr['p_end_tm']; ?></div></dd>
                                            </dl>
                                            <div style="_float:left;_width:700px;_height:auto;">
                                                <dl class="dd">
                                                    <dt><?php echo L::getText('所属分类：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                    <dd class="courseType"><?php echo $this->planAttr['desc_cn']; ?></dd>
                                                </dl>
                                                <dl class="dd">
                                                    <dt><?php echo L::getText('类型：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                    <dd><?php echo L::getText($this->planAttr['p_elective_desc'], array('file'=>__FILE__, 'line'=>__LINE__)); ?></dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // 第三行 -->
                                    <div class="col_LR intro l">
                                        <div class="inner">
                                            <div class="sidebar none"><!-- // 放置内容 --></div>
                                            <div class="con">
                                            <!--add 2012 11 22-->
                                                <div style="height:70px; overflow:auto; overflow-x:hidden" class="intro_detail">
                                                    <h3><?php echo L::getText('介绍：', array('file'=>__FILE__, 'line'=>__LINE__));?></h3>
                                                    <p><?php echo $this->planAttr['p_content']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- // 注意事项 -->
                        <div class="list_item notice">
                            <h3><?php echo L::getText('注意事项：', array('file'=>__FILE__, 'line'=>__LINE__));?></h3>
                            <?php
                                $passCondition = $this->planAttr['userLearnType']['passStatus'];    //计划通过标识
                                $allowLearn = $this->planAttr['userLearnType']['learnStatus'];    //允许学习标识

                                //是否完成计划
                                if($passCondition)
                                {
                                    echo '<p>', L::getText('恭喜!您已通过本计划', array('file'=>__FILE__, 'line'=>__LINE__)), $this->planAttr['userLearnType']['planLearnType'] === '070405_070301' ? L::getText('(免修)', array('file'=>__FILE__, 'line'=>__LINE__)) : '', '</p>';
                                } else {    //隐含条件(!$passCondition && ($allowLearn || !$allowLearn))在未通过课程情况下的相关操作,包括:报名,免修,禁止学习的原因
                                    if(!$this->planAttr['userLearnType']['error'])
                                    {
                                        echo '<p id="planLearnType" style="display:none;"', isset($_GET['p_id']) ? " p_id=\"{$_GET['p_id']}\"" : '', '>', $this->planAttr['userLearnType']['planLearnType'], '</p>';
                                    } else {
                                        echo '<p>', L::getText('禁止学习 : ' . $this->planAttr['userLearnType']['error'], array('file'=>__FILE__, 'line'=>__LINE__)), '</p>';
                                    }
                                }

                                //通过说明
                                $temp = &$this->planAttr['p_pass_condition'];
                                echo '<p>', L::getText('通过条件 : ', array('file'=>__FILE__, 'line'=>__LINE__)), ' ';
                                if(strpos($temp, '1;') !== false) {    //讲师评定
                                    echo L::getText('您的教师决定本计划通过与否', array('file'=>__FILE__, 'line'=>__LINE__));
                                } else if(strpos($temp, '2;') !== false) {
                                    echo L::getText('通过所有课程->参加并通过全部考试', array('file'=>__FILE__, 'line'=>__LINE__));
                                } else {
                                    echo L::getText('课程进度均为100%时便可通过课程', array('file'=>__FILE__, 'line'=>__LINE__));
                                }
                                echo '</p>';

                                //考试相关处理
                                if(isset($this->examList))    //提示完成课件参加考试
                                {
                                    if(!count($this->examList)) {    //考试列表为空
                                        echo '<p>', L::getText('本课程没有设立考试', array('file'=>__FILE__, 'line'=>__LINE__)), '</p>';
                                    } else {    //有考试(允许学习)
                                        foreach($this->examList as &$v)
                                        {
                                            echo '<p>', L::getText('参加考试 : ', array('file'=>__FILE__, 'line'=>__LINE__)), $v['exam_name'];
                                            echo $v['pass_num'] === '0' ? "<a href='" .ROOT_URL. "/exam/examCtl.php?a=displayExam&p_id={$_GET['p_id']}&exam_id={$v['exam_id']}'>" . L::getText('参加考试', array('file'=>__FILE__, 'line'=>__LINE__)) . '</a>' : L::getText(' 通过', array('file'=>__FILE__, 'line'=>__LINE__));
                                            echo '</p>';
                                        }
                                    }
                                } else {
                                    echo '<p>', L::getText('参加考试 : 通过所有课程时可以参加考试', array('file'=>__FILE__, 'line'=>__LINE__)), '</p>';
                                }
                            ?>
                        </div>
                        
                        <!-- // 课程列表 -->
                        <div class="table_con table_dl course_list">
                            <h3><?php echo L::getText('课程列表：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h3>
                            <table width="100%" class="table1">
                                <thead>
                                    <tr>
                                        <th><?php echo L::getText('课程名称', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('所属分类', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('课程长度', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('进度', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('学习状态', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($this->courseList as &$v)
                                    {
                                        if(isset($this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]))
                                        {
                                            $coursePassCondition = $this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]['passStatus'];
                                            $courseAllowLearn = $this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]['learnStatus'];
                                        } else {
                                            $coursePassCondition = false;
                                            $courseAllowLearn = false;
                                        }
                                        $temp = array();
                                        //是否允许学习,是否通过
                                        if($coursePassCondition && $courseAllowLearn)
                                        {
                                            $temp[0] = L::getText('允许学习/已通过', array('file'=>__FILE__, 'line'=>__LINE__));
                                        } else {
                                            if(!$coursePassCondition && !$courseAllowLearn)
                                            {
                                                $temp[0] = L::getText('禁止学习/未通过', array('file'=>__FILE__, 'line'=>__LINE__));
                                            } else if($coursePassCondition) {
                                                $temp[0] = L::getText('禁止学习/已通过', array('file'=>__FILE__, 'line'=>__LINE__));
                                            } else {
                                                $temp[0] = L::getText('允许学习/未通过', array('file'=>__FILE__, 'line'=>__LINE__));
                                            }
                                        }

                                        //计算进度
                                        if(isset($this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]['coursewareTime']['learnedTime']) && $this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]['coursewareTime']['learnedTime'] > 0){
                                            if($this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]['coursewareTime']['totalLength'] > 0)
                                            {
                                                $temp[2] = round($this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]['coursewareTime']['learnedTime'] * 100 / $this->planAttr['userLearnType']['courseLearnTypeList'][$v['c_id']]['coursewareTime']['totalLength'], 0);
                                            } else {
                                                $temp[2] = 100;
                                            }
                                        } else {    //没有学过
                                            $temp[2] = 0;
                                        }
                                        echo "<tr>
                                            <td><a href='", ROOT_URL, "/course.php?a=courseDetail&c_id={$v['c_id']}&p_id={$_GET['p_id']}'>{$v['c_name']}</a></td>
                                            <td>{$v['desc_cn']}</td>
                                            <td>{$v['courseware_total_length']}". L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__)). "</td>
                                            <td><span class='progressbar'>{$temp[2]}%</span></td>
                                            <td>{$temp[0]}</td>
                                        </tr>";
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>

                        <!-- // 问答 -->
                        <?php echo $this->questionPageTable; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
