<div id="head">
    <div class="head_top">
        <div class="logo"><img src="<?php echo ROOT_URL; ?>/images/<?php if(getLicenceInfo('Product', 'OTS')){?>ots_logo.png<?php }else{?>oes_logo.png<?php }?>"/></div>
        <div class="company_title"><?php 
            echo Of::config('_custom.title');
            $temp = new user;
            $_SESSION['user']['_pageHead'] = $temp->getUserData(false);
        ?></div>
        <div class="head_right">
            <div class="user_photo"><a href="<?php echo ROOT_URL; ?>/user.php?a=information"><img src="<?php echo ROOT_URL, empty($_SESSION['user']['_pageHead']['icon']) ? '/images/user_photo.jpg' : '/include/oFileManager/fileExtension.php?fileUrl=' . $_SESSION['user']['_pageHead']['icon']; ?>" width="42" height="42" /></a></div>
            <div class="user_information">
                <div id="userLoginBlock" class="user_information_top">
                    <h1><a href="<?php echo ROOT_URL; ?>/user.php?a=information"><?php echo isset($_COOKIE['user']['username']) ? $_COOKIE['user']['username'] : '' ?></a> <?php echo L::getText('欢迎使用本系统', array('file'=>__FILE__, 'line'=>__LINE__));?></h1>
                    <ul class="user_menu" <?php echo isset($_SESSION['user']['login']) ? 'style="display:none;"' : ''; ?>>
                        <li><a href="#" onclick="window.L.extension.injectLogin(<?php echo $_SERVER['SCRIPT_FILENAME'] === ROOT_DIR . '/index.php' ? '' : 'function(retrunObj){
                            var temp;
                            var userLoginBlockObj = $(\'#userLoginBlock\');
                            userLoginBlockObj.find(\'h1 > font\').html(retrunObj.userName);
                            userLoginBlockObj.find(\'ul:eq(0) a:eq(0)\').prop(\'onclick\', null);
                            $.get(window.L._rootUrl + \'/user.php?a=getUserData\', null, function(jsonObj){
                                var loginLiList = userLoginBlockObj.find(\'ul\')
                                                                   .eq(0).hide().end()
                                                                   .eq(1).show()
                                                                   .find(\'li\');

                                //显示头像
                                if(jsonObj.icon)
                                {
                                    userLoginBlockObj.parents(\'.head_right\').find(\'> .user_photo img\').prop(\'src\', window.L._rootUrl + \'/include/oFileManager/fileExtension.php?fileUrl=\' + jsonObj.icon);
                                }

                                //显示公告
                                if(jsonObj.notice_num === \'0\')
                                {
                                    loginLiList.eq(0).html(\'<a href=\\\'#\\\'>' .L::getText('全部公告', array('file'=>__FILE__, 'line'=>__LINE__)). '</a>\');
                                } else {
                                    loginLiList.eq(0).html(\'<a href=\\\'#\\\'>' .L::getText('公告', array('file'=>__FILE__, 'line'=>__LINE__)). '\' + \'(\' +jsonObj.notice_num+ \')</a>\');
                                }

                                //显示短消息
                                loginLiList.eq(1).html(\'<a href=\\\'#\\\'>' .L::getText('短消息', array('file'=>__FILE__, 'line'=>__LINE__)). '\' + \'(\' +jsonObj.msg_num+ \')</a>\');
                                if(jsonObj.msg_num > 0)
                                {
                                    window.L.openCom(\'tip\')(\'' .L::getText('您有', array('file'=>__FILE__, 'line'=>__LINE__)). '\' + jsonObj.msg_num + \'' .L::getText('条新消息,', array('file'=>__FILE__, 'line'=>__LINE__)). '<a href=\\\'#\\\'>' .L::getText('点击查看', array('file'=>__FILE__, 'line'=>__LINE__)). '</a>\');
                                }
                            }, \'json\')
                        }'; ?>); return false;"><?php echo L::getText('登入', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li><?php 
                            if($_SESSION['system']['userRegisterFlg'] === 'yes')
                            {
                        ?>
                                <li><a href="<?php echo ROOT_URL ?>/index.php?a=registrationUsers" target="_blank"><?php echo L::getText('注册', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                        <?php
                            }
                        ?>
                        <li><a href="<?php echo ROOT_URL ?>/index.php?a=retrievePassword" target="_blank"><?php echo L::getText('找回', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                    </ul>
                    <?php
                        if(isset($_SESSION['user']['login']))
                        {
                    ?>
                            <ul class="user_menu">
                                <li><a href="<?php echo ROOT_URL; ?>/user.php?a=notice"><?php echo $_SESSION['user']['_pageHead']['notice_num'] === '0' ? L::getText('全部公告', array('file'=>__FILE__, 'line'=>__LINE__)) : L::getText('公告', array('file'=>__FILE__, 'line'=>__LINE__)) . '(' . $_SESSION['user']['_pageHead']['notice_num'] . ')'; ?></a></li>
                                <li><a href="<?php echo ROOT_URL; ?>/user.php?a=myMsg"><?php echo L::getText('短消息', array('file'=>__FILE__, 'line'=>__LINE__)), '(', $_SESSION['user']['_pageHead']['msg_num'], ')'; ?></a></li>
                    <?php
                        } else {
                    ?>
                            <ul class="user_menu" style="display:none;">
                                <li></li>
                                <li></li>
                    <?php
                        }
                    ?>
                                <li><a href="<?php echo ROOT_URL; ?>/user.php?a=changePassword" target="_blank"><?php echo L::getText('修改密码', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                                <li><a href="#" onclick="window.location.href=window.L._rootUrl + '/user.php?a=logout'; return false;"><?php echo L::getText('退出', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class=" cl"></div>
    <div class="nav">
        <div class="navbox">
            <div class="nav_menu">
                <ul>
                    <?php
                        $temp = strtr(substr($_SERVER['SCRIPT_FILENAME'], strlen(ROOT_DIR)), '\\', '/');
                    ?>
                    <li <?php echo $temp === '/index.php' ? 'class="nav_stay_bg"' : 'onmouseover="style.background=\'#599aac\'" onmouseout="style.background=\'#9fcbd6\'"'; ?>><a href="<?php echo ROOT_URL ?>/index.php"><?php echo L::getText('首页', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                   <?php if(getLicenceInfo('Product', 'OTS')){?>
                    <li <?php echo $temp === '/course.php' ? 'class="nav_stay_bg"' : 'onmouseover="style.background=\'#599aac\'" onmouseout="style.background=\'#9fcbd6\'"'; ?>><a href="<?php echo ROOT_URL ?>/course.php"><?php echo L::getText('课程', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                    <li <?php echo $temp === '/plan.php' ? 'class="nav_stay_bg"' : 'onmouseover="style.background=\'#599aac\'" onmouseout="style.background=\'#9fcbd6\'"'; ?>><a href="<?php echo ROOT_URL ?>/plan.php"><?php echo L::getText('计划', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                   <?php }?>
                    <li <?php echo $temp === '/exam/examCtl.php' ? 'class="nav_stay_bg"' : 'onmouseover="style.background=\'#599aac\'" onmouseout="style.background=\'#9fcbd6\'"'; ?>><a href="<?php echo ROOT_URL ?>/exam/examCtl.php"><?php echo L::getText('考试', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                    <li <?php echo $temp === '/exam/exerciseCtl.php' ? 'class="nav_stay_bg"' : 'onmouseover="style.background=\'#599aac\'" onmouseout="style.background=\'#9fcbd6\'"'; ?>><a href="<?php echo ROOT_URL ?>/exam/exerciseCtl.php"><?php echo L::getText('练习', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                    <?php if(getLicenceInfo('Product', 'OTS')){?>
                    <li <?php echo $temp === '/question.php' ? 'class="nav_stay_bg"' : 'onmouseover="style.background=\'#599aac\'" onmouseout="style.background=\'#9fcbd6\'"'; ?>><a href="<?php echo ROOT_URL ?>/question.php"><?php echo L::getText('问答', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                	<?php }?>
                </ul>
            </div>
            <div class="searchbox">
                <form onsubmit="window.L.extension.fastSearch(this); return false;">
                    <ul>
                        <?php
                            if(isset($_GET['searchValue']) && isset($_GET['searchType']))
                            {
                                $temp = array(
                                    'searchValue' => $_GET['searchValue'],
                                    'searchType' => $_GET['searchType']
                                );
                            } else {
                                $temp = array(
                                    'searchValue' => '',
                                    'searchType' => ''
                                );
                            }
                        ?>
                        <li class="search_text"></li>
                        <li class="search_selectbox"><span>
                            <select class="search_select">
                            <?php if(getLicenceInfo('Product', 'OTS')){?>
                                <option value="coursePageTable" <?php echo $temp['searchType'] === 'coursePageTable' ? 'selected' : ''; ?>><?php echo L::getText('课程', array('file'=>__FILE__, 'line'=>__LINE__));?></option>
                                <option value="planPageTable" <?php echo $temp['searchType'] === 'planPageTable' ? 'selected' : ''; ?>><?php echo L::getText('计划', array('file'=>__FILE__, 'line'=>__LINE__));?></option>
	                           <?php }?> 
	                            <option value="examPageTable" <?php echo $temp['searchType'] === 'examPageTable' ? 'selected' : ''; ?>><?php echo L::getText('考试', array('file'=>__FILE__, 'line'=>__LINE__));?></option>
	                            <option value="exercisePageTable" <?php echo $temp['searchType'] === 'exercisePageTable' ? 'selected' : ''; ?>><?php echo L::getText('练习', array('file'=>__FILE__, 'line'=>__LINE__));?></option>
                            </select>
                            </span></li>
                        <li class="search_inputbox">
                            <input class="search_input" type="text" value="<?php echo $temp['searchValue']; ?>" />
                        </li>
                        <li class="search_btn"><a href="#" onclick="window.L.extension.fastSearch(this); return false;"><img src="<?php echo ROOT_URL; ?>/images/search_btn.gif" width="14" height="14" /></a></li>
                        <li class="search_btn"><?php include ROOT_DIR . '/common/switchLanguage.php'; ?></li>
                    </ul>
                    <input type="submit" style="position:absolute; left:-10000px; top:-50px;" />
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<script>
window.L.extension.injectLogin(function(){
    $('#userLoginBlock ul:eq(0) a:eq(0)').click();
}, 'loginAfter');

window.L.extension.fastSearch = function(thisObj){
    thisObj = $(thisObj).parents('.searchbox');
    var selectIdStr = $('select.search_select', thisObj).val();
    var selectValue = $('input.search_input', thisObj).val();
    var pageTableObj = document.getElementById(selectIdStr);
    
    if(pageTableObj)    //刷新分页列表
    {
        var pageTableClassObj = window.L.extension.pageTable.classObj;
        var pageTableParamsObj = pageTableClassObj.params(pageTableObj);

        pageTableParamsObj.search = selectValue;
        pageTableClassObj.params(pageTableObj, pageTableParamsObj, true);
    } else {    //跳转页面
        if(selectIdStr === 'coursePageTable')
        {
            pageTableObj = '/course.php?';
        } else if(selectIdStr === 'examPageTable'){
        	 pageTableObj = '/exam/examCtl.php?';
        }else if(selectIdStr === 'exercisePageTable'){
        	pageTableObj = '/exam/exerciseCtl.php?';
        }else {
            pageTableObj = '/plan.php?';
        }
        window.location.href = window.L._rootUrl + pageTableObj + $.param({'searchValue' : selectValue, 'searchType' : selectIdStr});
    }
}
</script>
