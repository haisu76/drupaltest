<?php
$this->printHead(
    array(
        'title'=>array('title'=>'课程内容', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/mainindex.css',
        )
        ,'js'=>array(
            '/jquery.progressbar.js',
            '/course/courseDetail.js'
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
                            <div class="left"> <span class="icon"></span><?php echo L::getText('课程内容', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                            <div class="right"> <a href="#" class="icon_link" onclick="window.history.back(); return false;" ><span class="icon_back"></span><?php echo L::getText('返回', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                        </h1>
                        
                        <!-- // 列表项目 -->
                        <div style="_height:180px;" class="list_item">
                            <div style="padding-bottom:0px;" class="content"> 
                                <!-- // 左边icon -->
                                <div class="l"><a class="icon_list list_thumb_big" href="#" > <img class="none" src="images/list_thumb_pic1.jpg">
                                    <img src="<?php echo ROOT_URL ?>/include/oFileManager/fileExtension.php?fileUrl=<?php echo Of::config('_browseHome'), $this->courseAttr['frontCoverImg'] ?>" style="display:none;" onload="this.style.display=''"></img>
                                </a></div>
                                <div class="right_info l"> 
                                    <!-- // 第一行：主标题 -->
                                    <h2 class="title">
                                        <div class="left">
                                            <div class="tt"> <span class="icon"></span><?php echo $this->courseAttr['c_name']; ?></div>
                                        </div>
                                    </h2>
                                    <!-- // 第二行 -->
                                    <div class="col_LR sub_title l" style="width:600px;">
                                        <div class="inner"> </div>
                                        <!-- // content -->
                                        <div class="con">
                                            <dl class="dd">
                                                <dt class="l"><?php echo L::getText('讲师：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                <dd title="<?php echo $this->courseAttr['teacher_name_list']; ?>" style="text-overflow:ellipsis; white-space:nowrap; overflow:hidden; width:50px; display:block; float:left;"><?php echo $this->courseAttr['teacher_name_list']; ?></dd>
                                            </dl>
                                            <dl class="dd" style="float:left; margin-right:150px;">
                                                <dt style="float:left;"><?php echo L::getText('学时：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                <dd><div style=" float:left; width:auto ; min-width:250px; color:#888888; "><?php echo round($this->courseAttr['courseware_total_length']/60, 1), L::getText('小时', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div></dd>
                                            </dl>
                                            <div style="_float:left;_width:700px;_height:auto;">
                                                <dl class="dd">
                                                    <dt><?php echo L::getText('学习进度：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                    <dd class="courseType"><?php echo $this->courseAttr['learnProgress']; ?>%</dd>
                                                </dl>
                                                <dl class="dd">
                                                    <dt><?php echo L::getText('类型：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                    <dd><?php
                                                        $temp = $this->courseAttr['c_elective'];
                                                        if($temp === '0')
                                                        {
                                                            echo L::getText('必修', array('file'=>__FILE__, 'line'=>__LINE__));
                                                        } else if($temp === '1') {
                                                            echo L::getText('选修', array('file'=>__FILE__, 'line'=>__LINE__));
                                                        } else {
                                                            echo L::getText('需要报名', array('file'=>__FILE__, 'line'=>__LINE__));
                                                        }
                                                    ?></dd>
                                                </dl>
                                                <dl class="dd">
                                                    <dt><?php echo L::getText('评价：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                    <dd>
                                                        <div class="rating_area">
                                                            <ul class="rating <?php 
                                                                $temp = array('', 'one', 'two', 'three', 'four', 'five');
                                                                echo $temp[$this->courseAttr['avg_score']];
                                                             ?>star"><!-- //默认的星级数：onestar / twostar / threestar / fourstar / fivestar  -->
                                                                <li class="one"><a title="1 Star" href="#" onclick="courseDetailObj.courseRating(1, '<?php echo $_GET['c_id']; ?>'); return false;">1</a></li>
                                                                <li class="two"><a title="2 Stars" href="#" onclick="courseDetailObj.courseRating(2, '<?php echo $_GET['c_id']; ?>'); return false;">2</a></li>
                                                                <li class="three"><a title="3 Stars" href="#" onclick="courseDetailObj.courseRating(3, '<?php echo $_GET['c_id']; ?>'); return false;">3</a></li>
                                                                <li class="four"><a title="4 Stars" href="#" onclick="courseDetailObj.courseRating(4, '<?php echo $_GET['c_id']; ?>'); return false;">4</a></li>
                                                                <li class="five"><a title="5 Stars" href="#" onclick="courseDetailObj.courseRating(5, '<?php echo $_GET['c_id']; ?>'); return false;">5</a></li>
                                                            </ul>
                                                        </div>
                                                    </dd>
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
                                                    <p><?php echo $this->courseAttr['c_des']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- // contnet end --> 
                        </div>
                        
                        <!-- // 注意事项 -->
                        <div class="list_item notice">
                            <h3><?php echo L::getText('注意事项：', array('file'=>__FILE__, 'line'=>__LINE__));?></h3>
                            <?php
                                $passCondition = $this->courseAttr['userLearnType']['passStatus'];    //课程通过标识
                                $allowLearn = $this->courseAttr['userLearnType']['learnStatus'];    //允许学习标识

                                //判断是否完成该课程
                                if($passCondition)
                                {
                                    echo '<p>', L::getText('恭喜!您已通过本课程', array('file'=>__FILE__, 'line'=>__LINE__)), $this->courseAttr['userLearnType']['planLearnType'] === '070405_070301' || $this->courseAttr['userLearnType']['courseLearnType'] === '070401_070301' ? '(免修)' : '', '</p>';
                                } else {    //隐含条件(!$passCondition && ($allowLearn || !$allowLearn))在未通过课程情况下的相关操作,包括:报名,免修,禁止学习的原因
                                    if(!$this->courseAttr['userLearnType']['error'])
                                    {
                                        if(!$this->courseAttr['userLearnType']['courseConditionLearnStatus'])
                                        {
                                            echo '<p>', L::getText('禁止学习 : 需要先通过以下课程才能学习本课程, ', array('file'=>__FILE__, 'line'=>__LINE__)), $this->courseAttr['userLearnType']['courseConditionList']['nameList'], '</p>';
                                        }
                                        echo '<p id="planLearnType" style="display:none;" c_id="', $_GET['c_id'], '"', isset($_GET['p_id']) ? " p_id=\"{$_GET['p_id']}\"" : '', '>', $this->courseAttr['userLearnType']['planLearnType'], '</p>';
                                        if($allowLearn || !$this->courseAttr['userLearnType']['p_id'])
                                        {
                                            echo '<p id="courseLearnType" style="display:none;" c_id="', $_GET['c_id'], '"', isset($_GET['p_id']) ? " p_id=\"{$_GET['p_id']}\"" : '', '>', $this->courseAttr['userLearnType']['courseLearnType'], '</p>';
                                        }
                                    } else {
                                        echo '<p>', L::getText('禁止学习 : ' . $this->courseAttr['userLearnType']['error'], array('file'=>__FILE__, 'line'=>__LINE__)), '</p>';
                                    }
                                }

                                //通过说明
                                $temp = &$this->courseAttr['c_pass_condition'];
                                echo '<p>', L::getText('通过条件 : ', array('file'=>__FILE__, 'line'=>__LINE__)), ' ';
                                if(strpos($temp, '1;') !== false) {    //讲师评定
                                    echo L::getText('您的教师决定本课程通过与否', array('file'=>__FILE__, 'line'=>__LINE__));
                                } else if(strpos($temp, '2;') !== false) {
                                    echo L::getText('课件进度均为100%时->参加并通过全部考试', array('file'=>__FILE__, 'line'=>__LINE__));
                                } else {
                                    echo L::getText('课件进度均为100%时便可通过课程', array('file'=>__FILE__, 'line'=>__LINE__));
                                }
                                echo '</p>';

                                //考试相关处理
                                if(isset($this->examList))    //提示完成课件参加考试
                                {
                                    if(!count($this->examList)) {    //考试列表为空
                                        echo '<p>', L::getText('本课程没有设立考试'), '</p>';
                                    } else {    //有考试(允许学习)
                                        foreach($this->examList as &$v)
                                        {
                                            echo '<p>', L::getText('参加考试 : '), $v['exam_name'];
                                            echo $v['pass_num'] === '0' ? "<a href='" .ROOT_URL. "/exam/examCtl.php?a=displayExam&c_id={$v['c_id']}{$v['p_id_param']}&exam_id={$v['exam_id']}'>" . L::getText('参加考试', array('file'=>__FILE__, 'line'=>__LINE__)) . '</a>' : L::getText('通过', array('file'=>__FILE__, 'line'=>__LINE__));
                                            echo '</p>';
                                        }
                                    }
                                } else {
                                    echo '<p>', L::getText('参加考试 : 课件进度均为100%时可以参加考试'), '</p>';
                                }
                            ?>
                        </div>
                        
                        <!-- // 课件列表 -->
                        <div class="table_con table_dl course_list">
                            <h3><?php echo L::getText('课件列表：', array('file'=>__FILE__, 'line'=>__LINE__));?></h3>
                            <table width="100%" class="table1">
                                <thead>
                                    <tr>
                                        <th><?php echo L::getText('课件名称', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('所属分类', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('课件长度', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('进度', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('获得学分', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                        <th><?php echo L::getText('扣除积分', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $temp = array(isset($_GET['p_id']) ? "&p_id={$_GET['p_id']}" : '');
                                    foreach($this->coursewareList as &$v)
                                    {
                                        //扣除积分提示处理
                                        if($v['deduction_credit'] > $v['credit'])
                                        {
                                            $temp[2] = ' style="color:red;"';
                                            $temp[3] = '_';
                                        } else {
                                            $temp[2] = '';
                                            $temp[3] = $v['deduction_credit'];
                                        }
                                        //生成跳转地址
                                        $temp[1] = $allowLearn ? "<a href='courseware.php?c_id={$v['c_id']}{$temp[0]}&w_id={$v['w_id']}' key='{$temp[3]}' onclick='courseDetailObj.locationCourseware(this, \"{$temp[3]}\"); return false;'>{$v['w_name']}</a>" : $v['w_name'];
                                        echo "<tr>
                                            <td>{$temp[1]}</td>
                                            <td>{$v['desc_cn']}</td>
                                            <td>{$v['w_length']}". L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__)). "</td>
                                            <td><span class='progressbar'>{$v['learn_progress']}%</span></td>
                                            <td>{$v['deduction_point']}</td>
                                            <td{$temp[2]}>{$v['deduction_credit']}</td>
                                        </tr>";
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        
                        <!-- // 课后练习 -->
                        <?php
                            if(count($this->testList))
                            {
                        ?>
                                <div class="table_con table_dl course_list">
                                    <h3><?php echo L::getText('课后练习：', array('file'=>__FILE__, 'line'=>__LINE__));?></h3>
                                    <table width="100%" class="table1">
                                        <colgroup>
                                        <col style="width:50%;" />
                                        <col style="width:80px;" />
                                        <col style="width:80px;" />
                                        <col style="width:110px;" />
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th><?php echo L::getText('练习名称', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                                <th><?php echo L::getText('所属分类', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                                <th><?php echo L::getText('及格分数', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                                <th><?php echo L::getText('练习总分', array('file'=>__FILE__, 'line'=>__LINE__));?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach($this->testList as &$v)
                                            {
                                                $temp = $allowLearn ? "<a href='" .ROOT_URL. "/exam/examCtl.php?a=displayExam&c_id={$v['c_id']}{$v['p_id_param']}&exam_id={$v['exam_id']}'>{$v['exam_name']}</a>" : $v['exam_name'];
                                                echo "<tr>
                                                    <td>{$temp}</td>
                                                    <td>{$v['desc_cn']}</td>
                                                    <td>{$v['exam_passing_grade']}</td>
                                                    <td>{$v['exam_point']}</td>
                                                </tr>";
                                            }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                        <?php
                            }

                            if(isset($this->courseAtt) && count($this->courseAtt))
                            {
                                echo '<div class="list_item notice"><h3>', L::getText('资源下载：', array('file'=>__FILE__, 'line'=>__LINE__)), '</h3>';
                                $temp = array(
                                    L::getText('点击下载', array('file'=>__FILE__, 'line'=>__LINE__)),
                                    Of::config('_browseHome')
                                );
                                foreach($this->courseAtt as &$v)
                                {
                                    $v['c_att_old_name'] = ltrim($v['c_att_old_name'], '/');
                                    echo "<p>{$v['c_att_name']} <a href='", ROOT_URL, $temp[1], "/enclosure/{$v['c_att_old_name']}'><span class='icon_download'></span>{$temp[0]}</a></p>";
                                }
                                echo '</div>';
                            }
                        ?>
                        
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