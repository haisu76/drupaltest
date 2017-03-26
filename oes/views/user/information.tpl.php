<?php
$this->printHead(
    array(
        'title' => array('title'=>'修改个人信息', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/layout.css',
            '/main_front.css',
            '/css.css',
            '/mainindex.css',
        )
        ,'js' => array(
            '/user/information.js'
        )
    )
);
?>
<div id="container" class="box block_12">
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <div class="box_inner">
        
        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <!-- // 侧边列 -->
            <?php index::rightShare(); ?>
            
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div" id="tabs1">
                        <div class="tab">
                            <h1 class="main_title">
                                <div class="left"> <span class="icon"></span><?php echo L::getText('我的个人信息', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                                <div class="right"> <a class="more_block none" href="#" title="更多"> <span class="more_txt">更多</span> <span class="icon_more"></span> </a> </div>
                            </h1>
                            <div class="player_bottom_menu_box1">
                                <ul>
                                    <li onclick="informationObj.tabClickFun(this, 0);" id="player_bottom_menu_btn2"><a href="#" onclick="return false;"><?php echo L::getText('个人信息', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                                    <li onclick="informationObj.tabClickFun(this, 1);"><a href="#" onclick="return false;"><?php echo L::getText('更改邮箱', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                               <?php if(getLicenceInfo('Module','user_credit')){?>     <li onclick="informationObj.tabClickFun(this, 2);"><a href="#" onclick="return false;"><?php echo L::getText('积分充值', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                                <?php }?>
                                    <?php if(!$this->information['question1']){ ?>
                                    <li onclick="informationObj.tabClickFun(this, 3);"><a href="#" onclick="return false;"><?php echo L::getText('密码保护', array('file'=>__FILE__, 'line'=>__LINE__));?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <!-- // tab内容1 -->
                        <div class="tab_content col_list_50 col_slidebar_01">
                            <form>
                                <div class="main_div data_list_h ~data_list_v">
                                    <dl>
                                        <dt><?php echo L::getText('真实姓名：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="textfield" type="text" class="input4" id="realName" value="<?php echo $this->information['realName'] ?>" />
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('昵称：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="textfield" type="text" class="input4" id="nickname" value="<?php echo $this->information['nickname'] ?>" />
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('积分：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd><?php echo $this->information['credit']; ?></dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('学分：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd><?php echo $this->information['point']; ?></dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('注册时间：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd><?php echo $this->information['reg_tm']; ?></dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('登入次数：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd><?php echo $this->information['login_count']; ?></dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('上次登入IP：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd><?php echo $this->information['last_login_ip']; ?></dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('上次登入时间：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd><?php echo $this->information['last_login_tm']; ?></dd>
                                    </dl>
                                    <div class="clear"></div>
                                    
                                    <!-- // 用户头像 -->
                                    <div class="panel_1 con_user_photo">
                                        <h1 class="main_title">
                                            <div class="left"> <span class="icon"></span><?php echo L::getText('用户头像', array('file'=>__FILE__, 'line'=>__LINE__));?> </div>
                                            <div class="right"> <a class="more_block none" href="#" title="更多"> <span class="more_txt">更多</span> <span class="icon_more"></span> </a> </div>
                                        </h1>
                                        <div class="content">
                                            <div class="user_avatar"><img id="userIconPreview" class="~none" src="<?php echo ROOT_URL, empty($this->information['icon']) ? '/images/avatar_male_default.jpg' : (Of::config('_browseHome') . $this->information['icon']); ?>" alt="" /></div>
                                            <div class="right"><?php echo L::getText('上传头像(最佳尺寸：100 x 100 像素)：', array('file'=>__FILE__, 'line'=>__LINE__));?><br />
                                                <input name="file" type="file" class="" id="userIconUpload" size="35" style="display:none;" />
                                                <a class="btn_txt" href="#" onclick="informationObj.defaultIcon(); return false;"><span class="icon_reset"></span><?php echo L::getText('恢复默认头像', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                                                <div id="iconUploadProgress" style="margin-left: 115px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- // 按钮 -->
                                <div class="btn_area align_center"> 
                                    <!-- // 按钮区域默认是横向居中对齐，附加样式align_left / align_right后可以左、右对齐 --> 
                                    <a class="btn" href="#" onclick="informationObj.saveInformation(1); return false;"><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a class="btn" href="#" onclick="$(this).parents('form').get(0).reset(); return false;"><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                            </form>
                        </div>
                        
                        <!-- // tab内容2 -->
                        <div class="tab_content col_list_100 col_slidebar_02" style="display:none;">
                            <form>
                                <div class="main_div data_list_h ~data_list_v"> 
                                    <!-- // data_list_h或v：横或纵向排列 -->
                                    <dl>
                                        <dt><?php echo L::getText('您现在的邮箱：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="textfield" type="text" class="input4 disable_edit" readonly="readonly" id="oldEmail" value="<?php echo $this->information['email']; ?>" />
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('您的新邮箱：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="textfield" type="text" class="input4" id="newEmail" value="" />
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><?php echo L::getText('登入密码：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="textfield" type="password" class="input4" id="password" value="" />
                                        </dd>
                                    </dl>
                                </div>
                                
                                <!-- // 按钮 -->
                                <div class="btn_area align_center"> 
                                    <!-- // 按钮区域默认是横向居中对齐，附加样式align_left / align_right后可以左、右对齐 --> 
                                    <a class="btn" href="#" onclick="informationObj.saveInformation(2); return false;"><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a class="btn" href="#" onclick="$(this).parents('form').get(0).reset(); return false;"><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                            </form>
                        </div>
                        <?php if(getLicenceInfo('Module','user_credit')){?>
                        <!-- // tab内容3 -->
                        <div class="tab_content col_list_100 col_slidebar_03" style="display:none;">
                            <form>
                                <div class="main_div data_list_h ~data_list_v"> 
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><?php echo L::getText('充值卡号：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                                            <td><input name="textfield" type="text" class="input4" id="card_id" value="" /></td>
                                            <td rowspan="2" style="width:50%;"><div id="prepaidInfo"></div></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo L::getText('验证码：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                                            <td>
                                                <input name="textfield" type="text" class="input3" id="prepaidCaptchaInput" value="" maxlength="4" />
                                                <img id="prepaidCaptchaImg" src="<?php echo ROOT_URL; ?>/include/Of/Com/CommonPackage.php?a=captcha&amp;bgColor=FCFCFC" title="<?php echo L::getText('点击刷新', array('file'=>__FILE__, 'line'=>__LINE__));?>" style="cursor:pointer; border:1px solid #EEE; vertical-align: middle;" onclick="this.src = (this.backupSrc || (this.backupSrc = this.src)) + '&amp;t=' + new Date().getTime()">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <!-- // 按钮 -->
                                <div class="btn_area align_center"> 
                                    <!-- // 按钮区域默认是横向居中对齐，附加样式align_left / align_right后可以左、右对齐 --> 
                                    <a class="btn" href="#" onclick="informationObj.saveInformation(3); return false;"><?php echo L::getText('充值', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                                </div>
                            </form>
                        </div>
                        <?php }?>
                        <!-- // tab内容4 -->
                        <div class="tab_content col_list_50 col_slidebar_04" style="display:none;">
                            <form>
                                <div class="main_div data_list_h ~data_list_v"> 
                                    <!-- // data_list_h或v：横或纵向排列 -->
                                    <dl>
                                        <dt><?php echo L::getText('安全问题一：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="question1" type="text" class="input4" id="question1"  />
                                        </dd>
                                    </dl>
                                    
                                    <dl>
                                        <dt><?php echo L::getText('答案一：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="answer1" type="text" class="input4" id="answer1" />
                                        </dd>
                                    </dl>
                                    
                                    <dl>
                                        <dt><?php echo L::getText('安全问题二：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="question2" type="text" class="input4" id="question2" />
                                        </dd>
                                    </dl>
                                    
                                    <dl>
                                        <dt><?php echo L::getText('答案二：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                        <dd>
                                            <input name="answer2" type="text" class="input4" id="answer2"  />
                                        </dd>
                                    </dl>

                                </div>
                                <!-- // 按钮 -->
                                <div class="btn_area align_center"> 
                                    <!-- // 按钮区域默认是横向居中对齐，附加样式align_left / align_right后可以左、右对齐 --> 
                                    <a class="btn" href="#" onclick="informationObj.saveInformation(4); return false;" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a class="btn" href="#" onclick="$(this).parents('form').get(0).reset(); return false;"><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
