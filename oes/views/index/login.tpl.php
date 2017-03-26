<?php
$this->printHead(
    array(
        'title' => array('title'=>'首页', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/FrontLogin.css'
        )
    )
);
?>
<table style="width:100%; height:100%;" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width:100%; height:100%; vertical-align:middle;">
            <form onsubmit="indexLogin.submit(); return false;">
                <div class="col_login login fore_login">
                    <div class="login_sidebar" style="margin-top:-50px; position:relative;">
                        <img src="images/login_pic.jpg" style=" position:absolute; left:155px; top:70px;"/>
                        <h1> 
                            <!-- //图标：icon_ot / icon_oe  --> 
                           <span class="name_title"><?php echo L::getText('登入', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span> </h1>
                    </div>
                    <div class="login_content"> 
                        <!-- // 登入 -->
                        <div class="login_box ~none">
                            <div class="inner"> 
                                <!-- // 标题 -->
                                <h1> 
                                    <!-- //图标：icon_ot / icon_oe  --> 
                                    <span class="icon_login icon_ot ~icon_ot"></span> <span class="name_product"><?php echo L::getText('oTraining', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span> <span class="name_title"><?php echo L::getText('登入', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span>
                                </h1>
                                <!-- // 内容 -->
                                <div class="login_box_con">
                                    <div class="inner">
                                        <dl>
                                            <dt><?php echo L::getText('帐号：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                            <dd>
                                                <input class="input_login ~auto_width ~input_error" type="text" name="textfield" id="username" />
                                            </dd>
                                            <dd> 
                                                <!-- // 弹出信息框 -->
                                                <div class="popup" style="display:none">
                                                    <div class="inner"> <span class="popup_arrow popup_arrow_left"></span>
                                                        <div class="left" id="error"></div>
                                                        <div class="right"> <a class="close_btn" href="#" title="关闭" onclick="indexLogin.closeError(this); return false;"></a> </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt><?php echo L::getText('密码：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                            <dd>
                                                <input  class="input_login ~auto_width ~input_error" type="password" name="textfield" id="password" />
                                            </dd>
                                        </dl>
                                        <dl class="auto_login">
                                            <dt><?php include ROOT_DIR . '/common/switchLanguage.php'; ?></dt>
                                            <dd>
                                                <label>
                                                    <input style=" *float:left; " name="checkbox" type="checkbox" class="checkbox" id="autoLogin" />
                                                    <?php echo L::getText('自动登入', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
                                            </dd>
                                            <dd class="forget_pwd">
                                                <a href="<?php echo ROOT_URL ?>/index.php?a=retrievePassword"><?php echo L::getText('找回密码', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                                            </dd>
                                        </dl>
                                        <dl class="cp_area ~hidden" id="captchaDl" style="display:none">
                                            <dt><?php echo L::getText('验证码：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                            <dd>
                                                <input class="input_login_cp ~auto_width" type="text" name="textfield" maxlength="4" id="captcha" />
                                            </dd>
                                            <dd class="login_box_cp"><img id="captchaImg" src="<?php echo ROOT_URL; ?>/include/Of/Com/CommonPackage.php?a=captcha&bgColor=FCFCFC" title="<?php echo L::getText('点击刷新', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" style="cursor:pointer; border:1px solid #EEE;" onclick="this.src = (this.backupSrc || (this.backupSrc = this.src)) + '&t=' + new Date().getTime()"></dd>
                                            <dd> 
                                                <!-- // 弹出信息框 -->
                                                <div class="popup">
                                                    <div class="inner"> <span class="popup_arrow popup_arrow_left"></span>
                                                        <div class="left"><?php echo L::getText('您输入的验证码错误！', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div>
                                                        <div class="right"> <a class="close_btn" href="#" title="关闭" onclick="indexLogin.closeError(this); return false;"></a> </div>
                                                    </div>
                                                </div>
                                            </dd>
                                        </dl>
                                        <div class="clear"></div>
                                        
                                        <!-- // 按钮 -->
                                        <div class="btn_area align_center"> <a class="btn" href="#" onclick="indexLogin.submit(); return false;"><?php echo L::getText('登入', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a><?php 
                                            if($_SESSION['system']['userRegisterFlg'] === 'yes')
                                            {
                                        ?>
                                                <a class="btn" href="<?php echo ROOT_URL ?>/index.php?a=registrationUsers"><?php echo L::getText('注册', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                                        <?php
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" style=" position:absolute; left:-1000px; width:0px;">
            </form>
        </td>
    </tr>
</table>
<script>
var indexLogin = {
    'submit' : function(){
        var postData = {
            'username' : $.trim($('#username').val()),
            'password' : $('#password').val(),
            'autoLogin' : $('#autoLogin:checked').val() || '',
            'captcha' : $.trim($('#captcha').val()) || ''
        };

        if(postData.username && postData.password)
        {
            $.post(window.L._rootUrl + '/index.php?a=requestLogin', postData, function(response){
                switch(response)
                {
                    case '1' :    //成功
                        if($('#backtrack').val() === '1' && window.history.length > 1)    //后退
                        {
                            window.history.back();
                        } else {    //刷新
                            window.location.reload();
                        }
                        break;
                    case '1.1' :    //登入成功,跳转到密码修改
                        window.location.href = window.L._rootUrl + '/user.php?a=changePassword';
                        break;
                    case '2' :    //密码错误
                        $('#error').html("<?php echo L::getText('账户密码错误', array('file'=>__FILE__, 'line'=>__LINE__)); ?>").parents('.popup').eq(-1).show();
                        break;
                    case '3' :    //需要验证码
                        $('#captchaDl').show().find('.popup:eq(0)').show();
                        break;
                    case '4' :    //其他人使用此账号登入
                        $('#error').html("<?php echo L::getText('账号处于登入状态,请稍后重试', array('file'=>__FILE__, 'line'=>__LINE__)); ?>").parents('.popup').eq(-1).show();
                        break;
                    case '5' :    //达到最大登入人数
                        $('#error').html("<?php echo L::getText('登入人数过多,请稍后重试', array('file'=>__FILE__, 'line'=>__LINE__)); ?>").parents('.popup').eq(-1).show();
                        break;
                    default  :
                        window.L.openCom('tip')("<?php echo L::getText('登入发生错误,请联系管理员', array('file'=>__FILE__, 'line'=>__LINE__)); ?>");
                }
                $('#captchaImg').click();
            });
        } else {
            $('#error').html("<?php echo L::getText('账户密码不能为空', array('file'=>__FILE__, 'line'=>__LINE__)); ?>").parents('.popup').eq(-1).show();
        }
    },

    'closeError' : function(thisObj){
        $(thisObj.parentNode.parentNode.parentNode).hide();
    }
}
$('input:first').focus();    //第一文本框获得焦点
</script>
