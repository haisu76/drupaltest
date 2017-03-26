<?php 
//目录列表
$dirList = array(
    '题库' => array(
        'personalized' => array('icon' => '../images/index_icon_001.gif'),
        'list' => array(
            '添加试题' => '/question/questionCtl.php?a=addQsn',
            '试题管理' => '/question/questionCtl.php',
            '导入试题' => '/question/questionCtl.php?a=manageImportQsn',
            '题库参数设置' => '/question/questionCtl.php?a=setQsnDefaultSetting',
        )
    ),
    '试卷' => array(
        'personalized' => array('icon' => '../images/index_icon_001.gif'),
        'list' => array(
            '添加试卷' => '/paper/paperCtl.php?a=addPaper',
            '试卷管理' => '/paper/paperCtl.php',
        )
    ),
    '考试' => array(
        'personalized' => array('icon' => '../images/index_icon_001.gif'),
        'list' => array(
            '添加考试' => '/exam/examCtl.php?a=addExam',
            '考试管理' => '/exam/examCtl.php',
            '人工评卷' => '/paper/manualMarkingCtl.php',
            '成绩管理' => '/examscore/examscoreCtl.php',
            '考试监控' => '/exammonitor/examMonitorCtl.php',
            '考生监控' => '/exammonitor/examMonitorCtl.php?a=userMonitor',
        )
    ),
    '练习 / 作业' => array(
        'personalized' => array('icon' => '../images/index_icon_001.gif'),
        'list' => array(
            '添加练习' => '/exam/exerciseCtl.php?a=addExercise',
            '练习管理' => '/exam/exerciseCtl.php',
        )
    ),
    '课件 / 课程' => array(
        'personalized' => array('icon' => '../images/index_icon_002.gif'),
        'list' => array(
            '添加课件' => '/course/courseware.php?a=addCourseware',
            '课件管理' => '/course/courseware.php?a=modfiyCourseware',
            '添加课程' => '/course/course.php?a=addCourse',
            '课程管理' => '/course/course.php?a=modfiyCourse',
            '课程监控' => '/course/course.php?a=learningStatistics',
        )
    ),
    '学习计划' => array(
        'personalized' => array('icon' => '../images/index_icon_002.gif'),
        'list' => array(
            '添加学习计划' => '/plan/plan.php?a=addPlan',
            '学习计划管理' => '/plan/plan.php?a=modfiyPlan',
            '学习计划监控' => '/plan/plan.php?a=learningStatistics',
        )
    ),
    '报名审批' => array(
        'personalized' => array('icon' => '../images/index_icon_002.gif'),
        'list' => array(
            '学习计划审批' => '/verify/verifyCtl.php',
            '课程审批' => '/verify/verifyCtl.php?a=courseVerify',
            '考试审批' => '/verify/verifyCtl.php?a=examVerify',
        )
    ),
    '讲师评定' => array(
        'personalized' => array('icon' => '../images/index_icon_002.gif'),
        'list' => array(
            '课程评定' => '/review/course.php?a=modifyCourse',
            '学习计划评定' => '/review/plan.php?a=modifyPlan',
        )
    ),
    '信息发布' => array(
        'personalized' => array('icon' => '../images/index_icon_003.gif'),
        'list' => array(
            '公告添加' => '/message/messageCtl.php?a=msgAdd',
            '修改公告' => '/message/messageCtl.php?a=msgList',
            '发送消息' => '/postMessage/pmCtl.php?a=addMsg',
            '清理消息' => '/postMessage/pmCtl.php?a=cleanMsg',
            //'添加投票' => '/vote/voteCtl.php?a=addVote',    //前台没有,暂时屏蔽
            //'投票管理' => '/vote/voteCtl.php',    //前台没有,暂时屏蔽
        )
    ),
    '在线问答' => array(
        'personalized' => array('icon' => '../images/index_icon_003.gif'),
        'list' => array(
            '问答搜索' => '/qa/qa.php?a=qaSearch',
        )
    ),
    '用户 / 组 / 权限' => array(
        'personalized' => array('icon' => '../images/index_icon_003.gif'),
        'list' => array(
            '添加用户' => '/user/userCtl.php?a=userAddUser',
            '用户管理' => '/user/userCtl.php?a=userManage',
            '组管理' => '/group/groupCtl.php?a=group',
            '数据权限管理' => '/user/permissions.php?a=dataStratifiedPermissions',
            '功能权限管理' => '/user/permissions.php?a=urlPermissionsPackage',
            '用户积分管理' => '/user/userCtl.php?a=userCreditManagement'
        )
    ),
    '培训机构 / 培训讲师' => array(
        'personalized' => array('icon' => '../images/index_icon_003.gif'),
        'list' => array(
            '添加培训讲师' => '/user/trainCtl.php?a=addTer',
            '培训讲师管理' => '/user/trainCtl.php?a=mdyTer',
            '添加培训机构' => '/user/trainCtl.php?a=addSch',
            '培训机构管理' => '/user/trainCtl.php?a=mdySch',
        )
    ),
    '统计分析' => array(
        'personalized' => array('icon' => '../images/index_icon_004.gif'),
        'list' => array(
            '考试成绩分析' => '/statistics/statisticsCtl.php',
    		'试题正确率分析' => '/statistics/statisticsCtl.php?a=qsnAccuracy',
   			'试题明细分析' => '/statistics/statisticsCtl.php?a=qsnDetail',
        )
    ),
    '系统数据' => array(
        'personalized' => array('icon' => '../images/index_icon_004.gif'),
        'list' => array(
            '基础数据管理' => '/data/dataCtl.php?a=basic',
            '分类数据管理' => '/data/dataCtl.php?a=category',
            //'数据清理' => '/data/dataCtl.php?a=cleanUp',    //有bug,会清理掉综合题的'子试题,答案,选项'
        )
    ),
    '系统参数' => array(
        'personalized' => array('icon' => '../images/index_icon_004.gif'),
        'list' => array(
            '通知参数' => '/setting/settingCtl.php?a=setInviteParams',
            '登录参数' => '/setting/settingCtl.php?a=setLoginParams',
        )
    ),
    '系统工具' => array(
        'personalized' => array('icon' => '../images/index_icon_004.gif'),
        'list' => array(
            '数据备份' => '/backup/backupCtl.php',
            '数据恢复' => '/backup/backupCtl.php?a=manageBackup',
            '扩展管理' => '/extension/extensionManager.php?a=manager',
        )
    ),
);
?>
<div class="header_top">
        <div style="position:fixed; top:0px; left:45%;_position:absolute;_left:28%; display:none" id="msg"><div class="info"><span class="info_icon_1"></span>
</div></div>
        <div class="header_left">
            <div class="header_title" >
			<div style="float:left; margin-top:1px;">
			<img src="<?php echo ROOT_URL; ?>/images/<?php if(getLicenceInfo('Product', 'OTS')){?>ots_logo.png<?php }else{?>oes_logo.png<?php }?>"/></div><?php echo Of::config('_custom.title');?>&nbsp;<?php echo VERSION;?></div>
            <div class="top_link">
                <a href="<?php echo ADMIN_URL ?>/index.php"><?php echo L::getText('首页', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a>
                <a href="<?php echo ROOT_URL ?>/index.php"><?php echo L::getText('前台首页', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a>
                <a href="<?php echo ADMIN_URL ?>/index.php?a=product"><?php echo L::getText('产品信息', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a>
                <?php include ROOT_DIR . '/common/switchLanguage.php'; ?>
            </div>
        </div>
        <div class="header_right">
            <div class="user_info" style="float: right;"> <?php echo $_SESSION['admin']['userName'], L::getText('，欢迎使用本系统', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?><br />
                <a href="<?php echo ADMIN_URL; ?>/index.php?a=changePassword" target="_blank"><?php echo L::getText('修改密码', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a>
                <a href="<?php echo ADMIN_URL . '/index.php?a=logout' ?>"><?php echo L::getText('退出', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
        </div>
    </div>
   <div id="exp_div" class="exp" onmouseover="document.getElementById('expmenu').style.display='block'" 
             onmouseout="document.getElementById('expmenu').style.display='none'">
			 <a class="t1" href="#"><?php echo L::getText('导航菜单', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
         <div id="expmenu" style="display: none">
          <?php
          		$item_count = 0;
                foreach($dirList as $titleK => &$titleV)
                {
                    $titleV['itemsHtml'] = '';
                    foreach($titleV['list'] as $itemK => &$itemV)
                    {
                        $temp = array(parse_url($itemV), array());
                        if(isset($temp[0]['query']))
                        {
                            parse_str($temp[0]['query'], $temp[1]);
                        }
                        if(admin_user_permissions::urlCheck($temp[0]['path'], $temp[1]))
                        {
                            $titleV['itemsHtml'] .= '<dd><a href="'.ADMIN_URL.$itemV.'">'.L::getText($itemK, array('file'=>__FILE__, 'line'=>__LINE__)).'</a></dd>';
                        }
                    }
                    if($titleV['itemsHtml'] !== '')
                    {
                    	$item_count++;
                    	if($item_count%4 == 1)//第一个
                    	{
                    		echo '<div class="subcon">';
                    	}
                        echo "<dl> <dt>" .L::getText($titleK, array('file'=>__FILE__, 'line'=>__LINE__)). "</dt> ". $titleV['itemsHtml']." </dl>";
                    	if($item_count%4 == 0)
                    	{
                    		echo '</div>';
                    	}
                    }
                }
                if($item_count%4 != 0)
                {
                		echo '</div>';
                }
                
            ?>
            <script type="text/javascript">
           		$('div.subcon:last').css("border-bottom","none");
            </script>
            	<iframe></iframe>            
         </div>
       </div>