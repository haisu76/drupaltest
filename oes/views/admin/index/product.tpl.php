<?php
$this->printHead(
    array(
        'title' => array('title'=>'', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array(
            '/main.css',
        )
       ,'js' => array('/admin/common.js')
    )
);
?>
<style type="text/css">
.lanyueW {
    width: 1000px;
    margin: 0 auto;
    overflow: hidden;
}
.lanyueW .item {
    float: left;
    width: 45%;
    margin-right: 5%;
}
.lanyueW div.w1 {
    width: 100%;
}
.lanyueW h3 {
    color: #6d85bf;
    font-size: 15px;
    border-bottom: 1px solid #e9e9e9;
}
.lanyueW h3 img {
    padding-right: 3px;
}
.lanyueW .describe {
    padding-left: 14px;
}
.lanyueW .describe dt {color: #6D85BF; margin-top: 10px;}
.lanyueW .describe dl {margin-top: -10px;}
.lanyueW div.w1 .describe {
    height: 400px;
    overflow: scroll;
    overflow-x: hidden;
}
</style>
<body class="home_page">
<div class="box">
    <div class="box_inner">
        <div class="header">
            <?php include(VIEW_DIR . "/admin/header.php");?>
        </div>
        <div style="margin-bottom:10px"><a href="javascript:void(0);" onClick="checkNewVersion();">检查新版本</a></div>
        <div class="lanyueW">
            <div class="item">
                <h3><img src="<?php echo ROOT_URL; ?>/images/icon/index_icon_001.gif" alt="" />Apache版本</h3>
                <div class="describe"><?php echo function_exists('apache_get_version')?apache_get_version():'';?></div>
            </div>
            <div class="item">
                <h3><img src="<?php echo ROOT_URL; ?>/images/icon/index_icon_001.gif" alt="" />PHP版本</h3>
                <div class="describe"> <?PHP echo PHP_VERSION; ?></div>
            </div>
            <div class="item">
                <h3><img src="<?php echo ROOT_URL; ?>/images/icon/index_icon_001.gif" alt="" />服务器操作系统</h3>
                <div class="describe"><?PHP echo PHP_OS; ?></div>
            </div>
            <div class="item">
                <h3><img src="<?php echo ROOT_URL; ?>/images/icon/index_icon_001.gif" alt="" />MySQL版本</h3>
                <div class="describe"><?php echo $this->mysql_version?></div>
            </div>
            <div class="item">
                <h3><img src="<?php echo ROOT_URL; ?>/images/icon/index_icon_001.gif" alt="" />许可证信息</h3>
                <div class="describe">版本信息：<?php echo $this->edition; ?>&nbsp;&nbsp;技术支持截止：<?php echo $this->expire_date?>&nbsp;&nbsp;注册人数：<?php echo $this->reg_user;?></div>
            </div>
            <div class="item">
                <h3><img src="<?php echo ROOT_URL; ?>/images/icon/index_icon_001.gif" alt="" />产品版本</h3>
                <div class="describe"><?php echo VERSION?></div>
            </div>
            <div class="item w1" style="margin-top:15px;" >
                <h3><img src="<?php echo ROOT_URL; ?>/images/icon/index_icon_001.gif" alt="" />更新日志</h3>
                <!-- oExam -->
                <div class="describe">
                    <dl>
                        <dt>Version 2.2.9 </dt>
                        <dd>&gt;2013-05-31&lt; </dd>
                        <dd>+ 增加强制退出已登入用户功能("后台"->"用户/组/权限"->"用户管理")</dd>
                        <dd>* 优化统计在线人数功能</dd>
                        <dd>* 优化UC接口</dd>
                        <dd>* 优化样式</dd>
                        <dd>* 一处兼容mac上的chrome代码</dd>
                        <dd>* 解决扩展没有恢复报错问题</dd>
                        <dd>* 解决综合题没有删除子试题按钮问题</dd>
                        <dd>* 解决前台无限修改密码问题</dd>
                        <dd>* 修复几处重置按钮无效的问题</dd>
                        <dd>* 解决前台参考数量和实际参考数量不符问题</dd>
                        <dd>* 兼容一类代码 php<5.2.6 的版本</dd>
                        <dd>* 解决提交试卷卡死问题</dd>
                        <dd>* 完善交卷判分功能</dd>
                        <dd>* 解决试题无法导入的问题</dd>
                        <dd>* 修正随机试卷分数计算错误的问题</dd>
                        <dd>* 断电保护现在可以正确的还原已考试时间了</dd>
                        <dd>* 修正逐题模式试卷中弹出层无法正确隐藏的错误</dd>
                        <dd>* 修正编辑完形填空时选项乱码错误</dd>

                        <dt>Version 2.2.8 </dt>
                        <dd>&gt;2013-05-10&lt; </dd>
                        <dd>*&nbsp;<font color='red'>许可证变更,升级新版本前,向我们所要新版许可证(需要提供旧版许可证)</font> </dd>
                        <dd>*&nbsp;简单优化导入试题(初步修正请检查网络连接,编码错误及日志乱码问题) </dd>
                        <dd>*&nbsp;修正已经参加考试的次数显示不符问题 </dd>
                        <dd>*&nbsp;修正问答后台屏蔽之后前台讨论最多的问题中还显示问题 </dd>
                        <dd>*&nbsp;解决IE6备份数据无法下载的问题 </dd>
                        <dd>*&nbsp;在使用播放器与上传前检查是否安装了flash </dd>
                        <dd>*&nbsp;解决修改view或admin路径时部分模板加载错误问题 </dd>
                        <dd>*&nbsp;批量导入用户使用中文地域化(有些服务器没有正确设置地域信息,导致csv中文无法识别) </dd>
                        <dd>*&nbsp;修改 “修改试题”页面样式丢失问题 </dd>
                        <dd>*&nbsp;修复无法备份问题 </dd>
                        <dd>*&nbsp;修改创建临时文件的位置 </dd>
                        <dd>*&nbsp;安装包升级时改成修复模式 </dd>
                        <dd>*&nbsp;完善几处因无权限读取文件导致的死循环(fopen) </dd>
                        <dd>*&nbsp;修改清理数据误删除综合题、问答题子试题的错误 </dd>
                        <dd>*&nbsp;修改添加考试时选择用户高度无法修改的问题 </dd>
                        <dd>*&nbsp;完善课件计算学时功能 </dd>
                        <dd>*&nbsp;找回密码账户无效时添加提示 </dd>
                        <dd>+&nbsp;在几处位置显示积分,学分 </dd>
                        <dd>*&nbsp;更新英文版的语言包</dd>

                        <dt>Version 2.2.7 </dt>
                        <dd>&gt;2013-04-01&lt; </dd>
                        <dd>*&nbsp;修正升级包sql语句出错的问题 </dd>
                        <dd>*&nbsp;修正js脚本指定上传路径不严谨的问题 </dd>
                        <dd>*&nbsp;修正添加默认考试设置参数错误的问题 </dd>
                        <dd>*&nbsp;修正初始化试题参数错误的问题 </dd>
                        <dd>*&nbsp;修正导出试卷不显示图片错误的问题 </dd>
                        <dd>*&nbsp;修正导出成绩造成内存溢出错误的问题 </dd>
                        <dd>*&nbsp;修正实时试卷因临时换卷导致错误的问题 </dd>
                        <dd>*&nbsp;修正前台考试没有按照考试起始时间排序的问题 </dd>
                        <dd>*&nbsp;修正按试卷折算分数显示大题分数错误的问题 </dd>
                        <dd>*&nbsp;修正未交卷考试不能在首页显示的问题 </dd>
                        <dd>*&nbsp;修正达到及格线不算为及格的问题 </dd>
                        <dd>*&nbsp;修正搜索试题、试卷、考试后，点击编辑进入编辑页面，再点击返回后搜索页面的选择条件不保留的问题 </dd>
                        <dd>*&nbsp;修正人工评分后试卷总分没有修改的问题 </dd>
                        <dd>*&nbsp;修正后台教师管理中下拉框无数据问题 </dd>
                        <dd>*&nbsp;将没填考试时长的试卷改成不限时 </dd>
                        <dd>*&nbsp;修正部分媒体文件名无法播放问题 </dd>
                        <dd>*&nbsp;修正基础数据(去掉旧版本演示数据) </dd>
                        <dd>*&nbsp;修正ADMIN_URL后台翻页无法调用的问题 </dd>
                        <dd>*&nbsp;修正一些样式的问题 </dd>
                        <dd>#&nbsp;增强服务器文件管理器 </dd>
                        <dd>#&nbsp;增强一键安装包脚本，适应性更强 </dd>
                        <dd>#&nbsp;增强安装包和升级包并集成修改管理员密码功能 </dd>
                        <dd>+&nbsp;新增前台用户信息密码保护 </dd>
                        <dd>+&nbsp;新增第三方用户注册、退出、修改密码的接口 </dd>
                        <dd>+&nbsp;新增插件架构，现在可以针对我们的系统开发插件。 </dd>
                        <dd>+&nbsp;新增多语言包（英中）并可以实时切换 </dd>
                        <dd>+&nbsp;新增多语言包开发工具，现在可以自由的修改并定制语言了</dd>

                        <dt>Version 2.2.6 </dt>
                        <dd>&gt;2012-12-27&lt; </dd>
                        <dd>*&nbsp;修改因Office2003保存csv文件后导致的导入用户失败问题 </dd>
                        <dd>*&nbsp;修正无法添加基础数据中的分类的问题 </dd>
                        <dd>*&nbsp;修正添加默认考试设置参数的错误 </dd>
                        <dd>*&nbsp;修正随机试卷的小题的分数字段为浮点型 </dd>
                        <dd>#&nbsp;增强批量修改试题的功能 </dd>
                        <dd>*&nbsp;修正一些样式的问题 </dd>
                        <dd>+&nbsp;新增导入试题时可以指定数据分组的功能</dd>

                        <dt>Version 2.2.5 </dt>
                        <dd>&gt;2012-12-19&lt; </dd>
                        <dd>*&nbsp;修改导出文件在某些ie下无法下载的错误 </dd>
                        <dd>*&nbsp;修正评分时特殊符号引起的错误 </dd>
                        <dd>*&nbsp;修正评分时未评不会标记的错误 </dd>
                        <dd>*&nbsp;修正基础数据分类添加数据异常的问题 </dd>
                        <dd>*&nbsp;修正人工评分不显示分数的问题 </dd>
                        <dd>*&nbsp;修正选择题在某些情况下无法评分的问题 </dd>
                        <dd>*&nbsp;修正参加考试人员显示错误的问题 </dd>
                        <dd>*&nbsp;修正多张试卷只能抽取一个的问题 </dd>
                        <dd>*&nbsp;修正一些样式的问题 </dd>
                        <dd>+&nbsp;新增可以导出考试相关人员列表的功能 </dd>
                        <dd>+&nbsp;新增后台菜单导航功能</dd>

                        <dt>Version 2.2.4 </dt>
                        <dd>&gt;2012-12-14&lt; </dd>
                        <dd>*&nbsp;修正修改后台查看试卷可以索引试题的错误 </dd>
                        <dd>*&nbsp;修正统计成绩时显示已删除考试的问题 </dd>
                        <dd>*&nbsp;修正UCenter插件下admin用户同步问题 </dd>
                        <dd>*&nbsp;修正UCenter插件在许可证无效时通信会失败的问题 </dd>
                        <dd>*&nbsp;修正注册人数判断多出一个的问题 </dd>
                        <dd>*&nbsp;修正全屏时因为点击版权信息弹出新页面的问题 </dd>
                        <dd>*&nbsp;修正考试标记的顺序错误的问题 </dd>
                        <dd>*&nbsp;修正导入试题的文字描述问题 </dd>
                        <dd>*&nbsp;修正随机卷试题分类中没有可用试题时无法正常显示的问题 </dd>
                        <dd>*&nbsp;修正数据库表结构，对数据库结构进行全面清理 </dd>
                        <dd>*&nbsp;修正服务器文件管理器oFileManager文件过多时，影响样式的问题 </dd>
                        <dd>*&nbsp;修正导出试卷无法正确带上答案的错误 </dd>
                        <dd>*&nbsp;修正断电保护在某些情况下失败的问题 </dd>
                        <dd>*&nbsp;修正未通过审核用户可以参加考试的问题 </dd>
                        <dd>*&nbsp;修正考试选择用户时,因选择相同用户导致所有用户被选中的问题 </dd>
                        <dd>*&nbsp;修正首页未通过审批用户可以看见考试的问题 </dd>
                        <dd>*&nbsp;修正一个可能引发无法显示审批按钮的问题 </dd>
                        <dd>*&nbsp;修正试卷、试题、考试、导入试题删除后总条数不变的问题 </dd>
                        <dd>*&nbsp;修正练习列表中不允许未审核用户参加的问题 </dd>
                        <dd>*&nbsp;修正练习列表申请提交后不刷新列表的问题 </dd>
                        <dd>*&nbsp;修正IE浏览器中下载导出试题失败的问题 </dd>
                        <dd>*&nbsp;修正导出试题模板的问题 </dd>
                        <dd>*&nbsp;修正预先抽取试题可能抽出已删除题目的错误 </dd>
                        <dd>*&nbsp;修正练习中因问答题造成答案不能提交的错误 </dd>
                        <dd>*&nbsp;修正导入试题无法批量修改的问题 </dd>
                        <dd>*&nbsp;修正误判版权信息被修改的问题 </dd>
                        <dd>*&nbsp;修正后台发送短信息状态提示的问题 </dd>
                        <dd>*&nbsp;修正考试报错文字描述 </dd>
                        <dd>*&nbsp;修正选中答题限时后（不可选）项不能正确显示的问题 </dd>
                        <dd>*&nbsp;修正大量样式的问题 </dd>
                        <dd>+&nbsp;新增清理数据功能，清除已经删除数据的相关信息(不清除相关文件) </dd>
                        <dd>+&nbsp;新增后台菜单导航功能 </dd>
                        <dd>+&nbsp;新增前台我参加的考试中的用户排名显示 </dd>
                        <dd>-&nbsp; 去掉前台信息数量,公告数量的缓存 </dd>
                        <dd>#&nbsp;优化分页样式 </dd>
                        <dd>#&nbsp;后台整合OFM权限管理 </dd>
                        <dd>#&nbsp;优化OFM在IE6下样式计算的算法 </dd>
                        <dd>#&nbsp; 完善用户导入功能 </dd>
                        <dd>#&nbsp;优化弹出层宽高，现在可以更精准的计算</dd>

                        <dt>Version 2.2.3 </dt>
                        <dd>&gt;2012-10-26&lt; </dd>
                        <dd>*&nbsp;修正Chrome浏览器下的样式问题 </dd>
                        <dd>*&nbsp;修正打开多个弹出层后拖拽失效问题 </dd>
                        <dd>*&nbsp;修正IE6不支持min-height导致的页面过低问题 </dd>
                        <dd>*&nbsp;修正添加试卷功能中添加综合题时无法重新设置高度的问题 </dd>
                        <dd>*&nbsp;修正判断题导出答案序号错误的问题 </dd>
                        <dd>*&nbsp;修正选中试题导出错误的问题 </dd>
                        <dd>*&nbsp;修正多选题因答案重复导入失败的问题 </dd>
                        <dd>*&nbsp;修正综合题子试题选项内容乱码的问题 </dd>
                        <dd>*&nbsp;修正一些样式的问题 </dd>
                        <dd>+&nbsp;新增导入试题的帮助 </dd>
                        <dd>#&nbsp;完善后台用户信息页面功能 </dd>
                        <dd>#&nbsp;增强分页控件，支持交互记忆功能 </dd>
                        <dd>#&nbsp;增强验证码输入区校验功能 </dd>
                        <dd>#&nbsp;增强弹出层的功能并且可以换皮肤 </dd>
                        <dd>#&nbsp;增强前台导航条显示功能，现在可以自适应文本长度 </dd>
                        <dd>#&nbsp;增强分页操作区,增加了操作区自定义总数据条数 </dd>
                        <dd>#&nbsp;重写了用户导入功能，速度更快，兼容性更强 </dd>
                        <dd>#&nbsp;优化安装包，现在兼容mysql 5.0.1</dd>

                        <dt>Version 2.2.2 </dt>
                        <dd>&gt;2012-09-30&lt; </dd>
                        <dd>*&nbsp;修改ie插件位置 </dd>
                        <dd>*&nbsp;修正导出试卷无法正确显示扩展名的问题 </dd>
                        <dd>*&nbsp;修正正因填空题大小写和顺序引发的算分失败的问题 </dd>
                        <dd>*&nbsp;修正人工评卷样式错误的问题 </dd>
                        <dd>*&nbsp;修正单选题导入时选项中不能有大写字母的错误 </dd>
                        <dd>*&nbsp;修正导入用户时，对用户数量没有判断的问题 </dd>
                        <dd>*&nbsp;修正单选、判断题导出答案相关问题 </dd>
                        <dd>*&nbsp;修正导出试卷时样式上的问题 </dd>
                        <dd>*&nbsp;修正导出试题时数据量过大导致无法导出的问题 </dd>
                        <dd>*&nbsp;修正多选题导出文本格式错误的问题 </dd>
                        <dd>*&nbsp;修正用户在试题复制、批量修改、导出时，可以修改其他人试题的问题 </dd>
                        <dd>*&nbsp;修正考试列表不能参加考试用户也能看到参与按钮的错误 </dd>
                        <dd>*&nbsp;修正某些情况删除组报错的问题 </dd>
                        <dd>+&nbsp;新增导出试卷增加导出答案功能 </dd>
                        <dd>+&nbsp;新增历史遗留语言包 </dd>
                        <dd>+&nbsp;新增 XXX分钟内禁止交卷功能 </dd>
                        <dd>#&nbsp;完善在线人数限制功能 </dd>
                        <dd>#&nbsp;完善session记录 </dd>
                        <dd>#&nbsp;完善IE9下一处样式 </dd>
                        <dd>#&nbsp;完善语言包 </dd>
                        <dd>#&nbsp;完善语言包 </dd>
                        <dd>#&nbsp;完善UCenter许可证判断方法 </dd>
                        <dd>#&nbsp;完善样式的问题 </dd>
                        <dd>#&nbsp;完善导入或者导出数据功能 </dd>
                        <dd>#&nbsp;完善权限功能 </dd>
                        <dd>#&nbsp;增强服务器文件管理器，支持本地命名规范 </dd>
                        <dd>#&nbsp;增强分页控件功能 </dd>
                        <dd>#&nbsp;增强考试过程中答卷的体验 </dd>
                        <dd>#&nbsp;增强发布公告功能，可以添加附件 </dd>

                        <dt>Version 2.2.1 </dt>
                        <dd>&gt;2012-08-29&lt; </dd>
                        <dd>*&nbsp;修正后台修改用户信息时，在xp sp3下IE 7,8无法激活焦点问题 </dd>
                        <dd>*&nbsp;修正导入试题是因换行导致单选、多选题干不全的问题 </dd>
                        <dd>*&nbsp;修正保存练习文字错误的问题 </dd>
                        <dd>*&nbsp;修正人工评卷样式错误的问题 </dd>
                        <dd>*&nbsp;修正单选题在答案不是大写时，判分错误的问题 </dd>
                        <dd>#&nbsp;增强语言包JS方法 </dd>
                        <dd>#&nbsp;完善版权信息保护 </dd>
                        <dd>#&nbsp;更换验证码的字体 </dd>
                        <dd>#&nbsp;功能权限顺序,样式调整 </dd>
                        <dd>#&nbsp;增强用户管理功能,现支持模糊搜索证件号 </dd>
                        <dd>#&nbsp;删除用户不再显示考试成绩 </dd>

                        <dt>Version 2.2 </dt>
                        <dd>&gt;2012-08-24&lt; </dd>
                        <dd>*&nbsp;修正导入用户数据错误的问题 </dd>
                        <dd>*&nbsp;修正限制视频或者音频文件限制播放次数无效的问题 </dd>
                        <dd>*&nbsp;修正考生查看实时抽取试题的随机卷不显示内容的问题 </dd>
                        <dd>*&nbsp;修正导入用户上传文件后弹出层局部不显示问题的问题 </dd>
                        <dd>*&nbsp;修正后台修改用户在xp sp3下IE 7,8无法激活焦点问题的问题 </dd>
                        <dd>*&nbsp;修正编辑用户时特殊符号导致显示错误的问题 </dd>
                        <dd>*&nbsp;修改登录界面 </dd>
                        <dd>*&nbsp;修改语言包 </dd>
                        <dd>*&nbsp;修正编辑器中上下角标的显示问题 </dd>
                        <dd>*&nbsp;修正前台浏览没有课程的计划时会报错的问题 </dd>
                        <dd>*&nbsp;修正一些样式上的问题 </dd>
                        <dd>#&nbsp;优化树控件代码 </dd>
                        <dd>#&nbsp;完善前台未审核用户不能查看相关信息的问题 </dd>
                        <dd>#&nbsp;增强填空题功能。现在可以设置填空题按大小写或者顺序判分。 </dd>
                        <dd>+&nbsp;增加成绩管理功能。现在可以查看考试中未参加、已参加、实际参加的人员列表。 </dd>

                        <dt>Version 2.1(sp1) </dt>
                        <dd>&gt;2012-08-17&lt; </dd>
                        <dd>*&nbsp;修正监控页面失去响应的问题 </dd>
                        <dd>*&nbsp;修正考试统计页面弹出层高度问题 </dd>
                        <dd>*&nbsp;修正单选题串行的问题 </dd>
                        <dd>*&nbsp;修正可能引起修改判断题时答案显示错误的问题 </dd>
                        <dd>*&nbsp;修正试卷中对试题排序错误的问题 </dd>
                        <dd>*&nbsp;修正无法按试卷分数折算的问题 </dd>
                        <dd>*&nbsp;修正检查新版本时出现的错误 </dd>
                        <dd>*&nbsp;修正填空题不区分顺序时计算错误的问题 </dd>
                        <dd>*&nbsp;修正IIS下缩略图兼容性的问题 </dd>
                        <dd>*&nbsp;修正一些语言描述的问题 </dd>
                        <dd>*&nbsp;修正一些样式上的问题 </dd>
                        <dd>*&nbsp;修正试卷、考试添加失败的问题 </dd>
                        <dd>*&nbsp;修正选择试卷的时可以选择非权限内试卷的问题 </dd>
                        <dd>*&nbsp;修正在mysql5.0数据库下考试保存失败的问题 </dd>
                        <dd>*&nbsp;修正在mysql5.0数据库下计算分数错误的问题 </dd>
                        <dd>#&nbsp;优化UCenter开启的核心代码 </dd>
                        <dd>#&nbsp;完善上传代码 </dd>
                        <dd>#&nbsp;完善前台用户头像缓存 </dd>
                        <dd>+&nbsp;增加未登陆系统直接在浏览器上打开考试试卷的提示语 </dd>
                        <dd>+&nbsp;增加填空题可以对大小写和顺序进行评分的功能 </dd>
                        <dd>+&nbsp;增加几个在练习模式下填空题新的算分方式 </dd>
                        <dd>-&nbsp;取消练习设置练习次数功能 </dd>
                        <dd>-&nbsp;取消考试提交答案失败后自动连续提交的功能 </dd>
                        <dd>-&nbsp;取消通过邮件发送通知的功能 </dd>
                        <dd>-&nbsp;取消ofPlayer播放器的logo </dd>

                        <dt>Version 2.1 </dt>
                        <dd>&gt;2012-08-09&lt; </dd>
                        <dd>*&nbsp;修正试卷因单引号导致无法提交的问题 </dd>
                        <dd>*&nbsp;修正ie下实时随机卷无法选择试题分类的错误问题 </dd>

                        <dt>Version 2.0 (sp1287) </dt>
                        <dd>&gt;2012-08-07&lt; </dd>
                        <dd>-&nbsp;删除无用的图片文件和图片文件夹 </dd>
                        <dd>-&nbsp;取消用户组和数据之间关系 </dd>
                        <dd>#&nbsp;增强某些SQL查询性能 </dd>
                        <dd>#&nbsp;增强登录功能，可以注册后自动登录 </dd>
                        <dd>#&nbsp;增强多维数组排序功能 </dd>
                        <dd>#&nbsp;增强树不可选的功能 </dd>
                        <dd>#&nbsp;增强随机试卷选择试题难度时统计题目数量的功能 </dd>
                        <dd>#&nbsp;增强删除用户组时同步删除组对应数据 </dd>
                        <dd>*&nbsp;修正树不能正确禁用多选框的问题 </dd>
                        <dd>*&nbsp;修正暂停考试弹出层大小的问题 </dd>
                        <dd>*&nbsp;修正某些题型评分错误的问题 </dd>
                        <dd>*&nbsp;修正用户因丢失组而无法修改其用户组的错误 </dd>
                        <dd>*&nbsp;修正导出试卷中试题图片显示错误的问题 </dd>
                        <dd>*&nbsp;修正数据分组无法正确重命名和添加子分组错误的问题 </dd>
                        <dd>*&nbsp;修正随机试卷分类没有试题也能点击的问题 </dd>
                        <dd>*&nbsp;修正一些样式问题 </dd>
                        <dd>+&nbsp;增加用户管理中对用户组的管理权限 </dd>
                        <dd>+&nbsp;增加用户组管理中的数据分类功能 </dd>
                        <dd>+&nbsp;增加检查新版本功能 </dd>
                        <dd>+&nbsp;增加手动关闭显示考试分数功能 </dd>
                        <dd>+&nbsp;增加前台用户默认头像 </dd>

                        <dt>Version 2.0 </dt>
                        <dd>&gt;2012-07-26&lt; </dd>
                        <dd>*&nbsp;更友好的管理界面和用户界面 </dd>
                        <dd>*&nbsp;全新的技术架构和代码使得产品更稳定，更快速，更容易扩展 </dd>
                        <dd>*&nbsp;更强大的记录错误日志功能，让我们解决问题更快速、更精准 </dd>
                        <dd>*&nbsp;全新的试题编辑功能，无需切换，在一个界面中就可以添加任何题型 </dd>
                        <dd>*&nbsp;全新的课件编辑功能，PPT、Word、图片、Flah、MP3、SWF、富文本均可作为课件播放 </dd>
                        <dd>*&nbsp;全新的课件播放页面，不仅可以播放本地服务器的视频，更是唯一可以播放优酷视频的产品 </dd>
                        <dd>*&nbsp;全新的考试试卷界面，支持试题快速跳转、做标记 </dd>
                        <dd>*&nbsp;全新的人工评卷功能，可以按人评分，也可以按题评分 </dd>
                        <dd>*&nbsp;全新的人员分组功能，可以任意包含、排除要学习、考试的人或者所属的组 </dd>
                        <dd>*&nbsp;全新的试卷提交功能，保证在各种极端的计算机和网络环境下，交卷成功 </dd>
                        <dd>*&nbsp;全新的成绩分析功能，拥有更多的图表展示 </dd>
                        <dd>*&nbsp;全新的基础数据管理功能，用拖拽的方式就可以对数据进行任意层次的分组管理 </dd>
                        <dd>*&nbsp;全新的权限管理功能，可以对数据和功能进行任意级别的分层管理 </dd>
                        <dd>*&nbsp;全新的随机卷处理策略，极大的提高了随机卷的稳定性和安全性 </dd>
                    </dl>
                </div>
            </div>
        </div>
        <!-- // footer -->
        <?php include(VIEW_DIR . "/admin/footer.php");?>
    </div>
    <!-- // box_inner end --> 
</div>
<script type="text/javascript">
function checkNewVersion()
{
    var sendurl =window.L._adminUrl+'/index.php?a=submitCustomerLicence';
    var params ='';
    window.L.openCom('oDialogDiv');
    ALERT_DIV_MARK =  oDialogDiv("检查版本", "text:<div style='vertical-align: middle;width:200px;height:60px;' align='center' id='licence_update_res'><img src='"+L._rootUrl+"/images/preload.gif'/></div>", "auto", "auto", [0]);;
    $.ajax({
       type: "POST",
       async:true,
       url: sendurl,
       data: params,
       dataType:"html",
       success: function(data){
           switch(data)
           {
           case '1'://成功
               oDialogDivInfo(window.L.getText('已经是最新版本'));
               $('#licence_update_res').html(window.L.getText('已经是最新版本')+'<br><a href="javascript:void(0)" onclick="alertCloseAlertDiv()" class="btn"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>');
               break;
           case '2'://失败
               oDialogDivInfo(window.L.getText('现在不是最新版本'));
               $('#licence_update_res').html(window.L.getText('现在不是最新版本')+'<br><a href="http://www.orivon.com" target="_blank" class="btn"><?php echo L::getText('去官网下载', array('file'=>__FILE__, 'line'=>__LINE__))?></a><a href="javascript:void(0)" onclick="alertCloseAlertDiv()" class="btn"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>');
               break;
           default://
               oDialogDivInfo(window.L.getText('无法连接到orivon官方网站'));
            $('#licence_update_res').html(window.L.getText('无法连接到orivon官方网站')+'<br><a href="javascript:void(0)" onclick="alertCloseAlertDiv()" class="btn"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>');
               break;
           }
          
       },
       error:function (XMLHttpRequest, textStatus, errorThrown) {
           
           oDialogDivInfo(window.L.getText('无法连接到orivon官方网站'));
           $('#licence_update_res').html(window.L.getText('无法连接到orivon官方网站')+'<br><a href="javascript:void(0)" onclick="alertCloseAlertDiv()" class="btn"><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__))?></a>');
        } 
    });
}
</script>