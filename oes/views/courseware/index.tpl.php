<?php
$this->printHead(
    array(
        'title'=>array('title'=>'课程', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/main_front.css',
            '/css.css'
        )
        ,'js' => array(
            '/courseware/index.js'
        )
    )
);

$indexConfigObj = array(
    'imgSrcRootUrl' => Of::config('_browseHome') . Of::config('_att.courseware'),    //幻灯片图片存储路径
    'coursewareType' => $this->coursewareData['w_type'],    //课件类型
    'coursewareId' => $_GET['w_id'],    //课件ID
    'auxiliaryConfig' => $this->auxiliaryConfig,    //当前课件辅助配置
    'uc_length' => $this->coursewareData['uc_length'] * 60,    //当前课件已播放长度(s)
    'w_length' => $this->coursewareData['w_length'] * 60,    //当前课件总长度(s)
);
?>
<div id="container" class="block_12">
    <div id="content">
        <div class="player_box">
            <div class="player_top">
                <div class="player_left">
                    <div class="player_title"><?php echo $this->coursewareData['w_name']; ?></div>
                    <div class="player_title_info"><?php echo L::getText('讲师：', array('file'=>__FILE__, 'line'=>__LINE__));?><span><?php echo $this->teacherNameList; ?></span><?php echo L::getText('课程:', array('file'=>__FILE__, 'line'=>__LINE__));?><span><?php echo $this->coursewareData['w_length']; ?><?php echo L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__));?></span><?php echo L::getText('发布时间:', array('file'=>__FILE__, 'line'=>__LINE__));?><span><?php echo $this->coursewareData['create_tm']; ?></span></div>
                </div>
                <div class="player_right">
                    <?php
                        if($_GET['p_id'])
                        {
                            $temp = "<a href='plan.php?a=planDetail&p_id={$_GET['p_id']}'>计划</a>><a href='course.php?a=courseDetail&c_id={$_GET['c_id']}&p_id={$_GET['p_id']}'>课程</a>>";
                        } else {
                            $temp = "<a href='course.php?a=courseDetail&c_id={$_GET['c_id']}'>课程</a>>";
                        }
                    ?>
                    <div class="yourplace"><?php echo L::getText('您的位置：', array('file'=>__FILE__, 'line'=>__LINE__));?><a href="index.php"><?php echo L::getText('首页', array('file'=>__FILE__, 'line'=>__LINE__));?></a>><?php echo $temp, $this->coursewareData['w_name']; ?></div>
                    <div class="player_btn">
                        <a href="#" class="icon_link" onclick="window.history.back(); return false;" ><span class="icon_jump"></span><?php echo L::getText('返回', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                        <?php
                            if($indexConfigObj['coursewareType'] === 'img')
                            {
                                echo '<a class="icon_link" href="#" onclick="indexObj.coursewareListTab(this); return false;"><span class="icon_nail"></span>课件列表</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="player_con">
                <div name="imgDragLocate" class="play_box">
                <?php
                    $coursewareList = '';
                    $paramUrl = "?c_id={$_GET['c_id']}" . ($_GET['p_id'] ? "&p_id={$_GET['p_id']}" : '');
                    foreach($this->coursewareList as &$v)
                    {
                        $temp = array('', '', $v['deduction_credit']);
                        if($v['w_id'] === $this->coursewareData['w_id'])
                        {
                            $temp[0] = ' class="current"';    //当前学习的课件标识
                        } else if($v['deduction_credit'] > $this->coursewareData['surplus_credit']) {
                            $temp[1] .= ' style="color:#999"';    //由于积分不足该课件不可学
                            $temp[2] = '_';    //标识该课件不可学
                        }
                        $coursewareList .= "<li{$temp[0]}><a href='{$paramUrl}&w_id={$v['w_id']}'{$temp[1]} onclick='indexObj.locationCourseware(this, \"{$temp[2]}\"); return false;'>{$v['w_name']}</a></li>";
                    }
                    if($indexConfigObj['coursewareType'] === 'img')    //图片课件
                    {
                ?>
                    <div name="imgDragBlock" class="player_bottom_con_left"><img style="cursor:move; height:100%;" alt="<?php echo L::getText('加载中...', array('file'=>__FILE__, 'line'=>__LINE__));?>" /></div>
                    <div coursewareListTab class="player_list" style=" top:-1000px; left:-1000px; position:absolute;">
                        <div class="player_list_title">
                            <div class="player_list_title_box"><span class="player_list_title_icon"></span><?php echo L::getText('课件列表', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                        </div>
                        <div name="mainScrollBlock" class="player_list_gd_box">
                            <div name="contentScrollBlock" class="player_list_box">
                                <ul><?php echo $coursewareList; ?></ul>
                            </div>
                            <div class="player_bottom_list_gd_linebox">
                                <div class="player_bottom_list_gd_line">
                                    <div name="scrollBarBlock" class="player_bottom_list_gd_dot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div coursewareListTab class="player_bottom_con_right">
                        <div class="player_list_title">
                            <div class="player_list_title_box"><span class="player_list_title_icon"></span><?php echo L::getText('图片列表', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                        </div>
                        <div name="mainScrollBlock" class="player_bottom_list_bg_box">
                            <div name="contentScrollBlock" class="player_bottom_list_box">
                            <?php
                                $i = 0;
                                $imgJsonArr = json_decode($this->coursewareData['w_video'], true);    //图片讲义列表
                                foreach($imgJsonArr as &$v)
                                {
                                    if($v['disabled'] === true)
                                    {
                            ?>
                                        <div class="player_bottom_list_psbox"><a href="#" progressMemoryPoint="<?php echo ++$i; ?>" onclick="indexObj.slideTabFun(this, '<?php echo $v['src']; ?>'); return false;"><img src="<?php echo ROOT_URL, '/include/oFileManager/fileExtension.php?fileUrl=', $indexConfigObj['imgSrcRootUrl'], $v['src']; ?>" width="60" height="60" /></a><div class="player_bottom_list_numbg"><?php echo $i; ?></div>
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                            </div>
                            <div class="player_bottom_list_gd_linebox">
                                <div class="player_bottom_list_gd_line">
                                    <div name="scrollBarBlock" class="player_bottom_list_gd_dot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    } else {
                ?>
                    <div id="playerBlock" class="player"></div>
                    <div class="player_list">
                        <div class="player_list_title">
                            <div class="player_list_title_box"><span class="player_list_title_icon"></span><?php echo L::getText('课件列表', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                        </div>
                        <div name="mainScrollBlock" class="player_list_gd_box">
                            <div name="contentScrollBlock" class="player_list_box">
                                <ul><?php echo $coursewareList; ?></ul>
                            </div>
                            <div class="player_bottom_list_gd_linebox">
                                <div class="player_bottom_list_gd_line">
                                    <div name="scrollBarBlock" class="player_bottom_list_gd_dot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                </div>
            </div>
            <div class="player_con">
                <div class="player_botoom_box">
                    <div class="player_bottom_menu_box1">
                        <ul>
                            <li onclick="indexObj.tabClickFun(this, 0)" id="player_bottom_menu_btn2"><a href="#" onclick="return false"><?php echo L::getText('讲义', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                            <li onclick="indexObj.tabClickFun(this, 1)"><a href="#" onclick="return false"><?php echo L::getText('笔记', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                            <li onclick="indexObj.tabClickFun(this, 2)"><a href="#" onclick="return false"><?php echo L::getText('问答', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                        </ul>
                        <div class="player_btn">
                            <a href="#" class="icon_link" onclick="indexObj.saveProgress(true); return false;" ><span class="icon_save"></span><?php echo L::getText('保存进度', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                            <a onclick="getQuestionPageTableObj.submitQuestion(<?php echo "{'course_id':'{$_GET['c_id']}','plan_id':'{$_GET['p_id']}','courseware_id':'{$_GET['w_id']}'}"; ?>); return false;" class="more_block" href="#" ><span class="icon_edit"></span><?php echo L::getText('提问', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                        </div>
                    </div>
                    <div name="imgDragLocate" class="tab_content player_bottom_con">
                    <?php
                        if($this->coursewareData['lecture_type'] === 'img')    //幻灯片的讲义
                        {
                    ?>
                        <div name="imgDragBlock" class="player_bottom_con_left"><img style="cursor:move; height:100%;" alt="<?php echo L::getText('加载中...', array('file'=>__FILE__, 'line'=>__LINE__));?>" /></div>
                        <div class="player_bottom_con_right">
                            <div class="player_list_title">
                                <div class="player_list_title_box"><span class="player_list_title_icon"></span><?php echo L::getText('图片列表', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                            </div>
                            <div name="mainScrollBlock" class="player_bottom_list_bg_box">
                                <div name="contentScrollBlock" class="player_bottom_list_box">
                                    <?php
                                        $i = 0;
                                        $imgJsonArr = json_decode($this->coursewareData['w_des'], true);    //图片讲义列表
                                        foreach($imgJsonArr as &$v)
                                        {
                                            if($v['disabled'] === true)
                                            {
                                    ?>
                                                <div class="player_bottom_list_psbox"><a href="#" onclick="indexObj.slideTabFun(this, '<?php echo $v['src']; ?>'); return false;"><img src="<?php echo ROOT_URL, '/include/oFileManager/fileExtension.php?fileUrl=', $indexConfigObj['imgSrcRootUrl'], $v['src']; ?>" width="60" height="60" /></a><div class="player_bottom_list_numbg"><?php echo ++$i; ?></div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="player_bottom_list_gd_linebox">
                                    <div class="player_bottom_list_gd_line">
                                        <div name="scrollBarBlock" class="player_bottom_list_gd_dot"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        } else {    //文本讲义
                            echo '<div style="height: 350px; overflow: auto;">', $this->coursewareData['w_des'], '</div>';
                        }
                    ?>
                    </div>
                    <div class="tab_content player_bottom_con" style="display:none;">
                        <div id="noteOperat" class="link_area">
                            <a class="icon_link" href="#" onclick="indexObj.showReplyNote(); return false;"><span class="icon_edit"></span><font style="color: inherit;"><?php echo L::getText('编辑', array('file'=>__FILE__, 'line'=>__LINE__));?></font></a>
                            <a class="icon_link" href="#" key="<?php echo $_GET['w_id']; ?>" onclick="indexObj.submitNote(this); return false;" style="display:none;"><span class="icon_save"></span><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                            <a class="icon_link" href="#" key="<?php echo $_GET['w_id']; ?>" onclick="indexObj.delNote(this); return false;"><span class="icon_del2"></span><?php echo L::getText('删除', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                        </div>
                        <div id="notePreview" class="layout_full_width"><?php echo $this->coursewareData['content']; ?></div>
                        <div style="display:none;">
                            <textarea id="noteTextarea" onkeyup="indexObj.keyupNote(this); return false;" style="overflow:hidden; height:50px;" class="input_default auto_width"></textarea>
                        </div>
                    </div>
                    <div class="tab_content player_bottom_con" style="display:none;"><?php echo $this->questionPageTable; ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
<script>
var indexConfigObj = <?php echo json_encode($indexConfigObj); ?>
</script>