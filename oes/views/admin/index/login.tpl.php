<?php
$this->printHead(
    array(
        'title' => array('title'=>'登入', 'file'=>__FILE__, 'line'=>__LINE__),
        'css' => array(
            '/admin/index/admin_login.css'
        )
    )
);
?>
<table style="width:100%; height:100%;" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width:100%; height:100%; vertical-align:middle;">
            <!-- // 登入 -->
            <div class="admin_login">
                <div class="inner"> 
                    <!-- // 标题 -->
                    <h1> 
                        <!-- //图标：icon_ot / icon_oe  --> 
                        <span class="name_title"><?php echo L::getText('系统管理', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span> </h1>
                    
                    <!-- // 内容 -->
                    <div class="admin_login_con">
                        <form onsubmit="ADMIN_LOGIN.submit(document.getElementById('submit')); return false;">
                            <div class="inner">
                                <dl>
                                    <dt><?php echo L::getText('帐号：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                    <dd>
                                        <input class="input_login" type="text" id="ADMIN_LOGIN_userName" value="" />
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo L::getText('密码：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                    <dd>
                                        <input class="input_login" type="password" id="ADMIN_LOGIN_password" value="" />
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo L::getText('验证码：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                    <dd>
                                        <input class="input_login_cp" type="text" maxlength="4" id="ADMIN_LOGIN_captcha" />
                                    </dd>
                                    <dd class="admin_login_cp">
                                        <img onclick="this.src = (this.backupSrc || (this.backupSrc = this.src)) + '&t=' + new Date().getTime()" style="cursor:pointer; border:1px solid #BBB;" title="<?php echo L::getText('点击刷新', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" src="<?php echo ROOT_URL; ?>/include/Of/Com/CommonPackage.php?a=captcha&bgColor=EDF5FF">
                                    </dd>
                                </dl>
                                <div class="admin_text"></div>
                                <div class="clear"></div>
                                <!-- // 按钮 -->
                                <div class="btn_area align_center"> <a id="submit" class="btn" style="cursor:pointer; width:auto;" onclick="ADMIN_LOGIN.submit(this); return false;"><span style=" margin:auto 15px; color:inherit;"><?php echo L::getText('登入', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></a> </div>
                            </div>
                            <input type="submit" style=" position:absolute; left:-1000px; width:0px;">
                        </form>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
<script>
var ADMIN_LOGIN = {
    'submit' : function(thisObj){
        $.post(window.L._adminUrl + '/?a=login', {'userName' : $('#ADMIN_LOGIN_userName').val(), 'password' : $('#ADMIN_LOGIN_password').val(), 'captcha' : $('#ADMIN_LOGIN_captcha').val()}, function(result){
            if(result == 1)
            {
                if(location.href.substr(location.href.indexOf('/', 8)).indexOf(window.L._adminUrl + '/index.php?a=login') === 0)
                {
                    location.href = window.L._adminUrl + '/index.php';
                } else if(window.oDialogDiv) {    //以ajax弹出层方式加载
                    window.oDialogDiv.dialogClose(window.oDialogDiv.getTreeNode(-1).handle);
                } else {
                    location.reload();
                }
            } else if(result == -1) {
                $('.admin_text', $(thisObj).parents('form')).html("<?php echo L::getText('用户名或密码错误', array('file'=>__FILE__, 'line'=>__LINE__)); ?>");
            } else if(result == -2) {
                $('.admin_text', $(thisObj).parents('form')).html("<?php echo L::getText('验证码输入错误', array('file'=>__FILE__, 'line'=>__LINE__)); ?>");
				$('#ADMIN_LOGIN_captcha').val('').focus();
            }
            $('.admin_login_cp img').click();
        })
        return false;
    }
};
$('form[onsubmit^=ADMIN_LOGIN] input:first').focus();    //第一文本框获得焦点
</script>