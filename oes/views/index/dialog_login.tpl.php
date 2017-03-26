<form onsubmit="dialogLogin_7b42f9999c8e9012ee8c32362a6b9dcb.submit(); return false;">
    <table width="300" border="0" cellspacing="0" cellpadding="0" style="margin:5px;">
        <tr>
            <td style="padding:3px;"><?php echo L::getText('帐号：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
            <td><input class="input_login" style="position:static;" type="text" name="textfield" id="username_7b42f9999c8e9012ee8c32362a6b9dcb" /></td>
        </tr>
        <tr>
            <td style="padding:3px;"><?php echo L::getText('密码：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
            <td><input class="input_login" style="position:static;" type="password" name="textfield" id="password_7b42f9999c8e9012ee8c32362a6b9dcb" /></td>
        </tr>
        <tr id="captchaDl_7b42f9999c8e9012ee8c32362a6b9dcb" style="display:none;">
            <td style="padding:3px;"><?php echo L::getText('验证码：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
            <td>
                <input class="input_login_cp" style="position:static; width:144px;" type="text" name="textfield" maxlength="4" id="captcha_7b42f9999c8e9012ee8c32362a6b9dcb" />
                <img id="captchaImg_7b42f9999c8e9012ee8c32362a6b9dcb" src="<?php echo ROOT_URL; ?>/include/Of/Com/CommonPackage.php?a=captcha&bgColor=FCFCFC" title="点击刷新" style="cursor:pointer; border:1px solid #EEE; vertical-align:middle;" onclick="this.src = (this.backupSrc || (this.backupSrc = this.src)) + '&t=' + new Date().getTime()" />
            </td>
        </tr>
        <tr>
            <td style=" padding-bottom:3px;" colspan="2">
                <font id="error_7b42f9999c8e9012ee8c32362a6b9dcb" style="color:#F00; float:right;"></font>
                <label>
                    <input name="checkbox" style="position:static;" type="checkbox" class="checkbox" id="autoLogin_7b42f9999c8e9012ee8c32362a6b9dcb" />
                    <?php echo L::getText('自动登入', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <a class="btn" style="position:static;" href="#" id="submit_7b42f9999c8e9012ee8c32362a6b9dcb" onClick="dialogLogin_7b42f9999c8e9012ee8c32362a6b9dcb.submit(); return false;"><?php echo L::getText('登入', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
            </td>
        </tr>
    </table>
    <input type="submit" style=" position:absolute; left:-1000px; width:0px;">
</form>
<script>
var dialogLogin_7b42f9999c8e9012ee8c32362a6b9dcb = {
    'success' : function(){},    //登入成功回调
    
    'submit' : function(){
        var postData = {
            'username' : $.trim($('#username_7b42f9999c8e9012ee8c32362a6b9dcb').val()),
            'password' : $('#password_7b42f9999c8e9012ee8c32362a6b9dcb').val(),
            'autoLogin' : $('#autoLogin:checked_7b42f9999c8e9012ee8c32362a6b9dcb').val() || '',
            'captcha' : $.trim($('#captcha_7b42f9999c8e9012ee8c32362a6b9dcb').val()) || ''
        };

        if(postData.username && postData.password)
        {
            $.ajax({
                'async'   : false,
                'type'    : 'POST',
                'url'     : window.L._rootUrl + '/index.php?a=requestLogin',
                'data'    : postData,
                'success' : function(response){
                    switch(response)
                    {
                        case '1' :    //成功
                            dialogLogin_7b42f9999c8e9012ee8c32362a6b9dcb.success();
                            if(window.oDialogDiv)    //如果弹出层
                            {
                                window.oDialogDiv.dialogClose(window.oDialogDiv.getTreeNode(-1).handle);
                            } else {
                                location.reload();
                            }
                            break;
                        case '1.1' :    //登入成功,跳转到密码修改
                            window.location.href = window.L._rootUrl + '/user.php?a=changePassword';
                            break;
                        case '2' :    //密码错误
                            $('#error_7b42f9999c8e9012ee8c32362a6b9dcb').html('<?php echo L::getText('账户密码错误', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
                            break;
                        case '3' :    //需要验证码
                            if($('#captchaDl_7b42f9999c8e9012ee8c32362a6b9dcb').css('display') === 'none')
                            {
                                $('#captchaDl_7b42f9999c8e9012ee8c32362a6b9dcb').show();
                                window.L.openCom('oDialogDiv').skinLayout();
                            }
                            $('#error_7b42f9999c8e9012ee8c32362a6b9dcb').html('<?php echo L::getText('请输入验证码', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
                            break;
                        case '4' :    //其他人使用此账号登入
                            $('#error_7b42f9999c8e9012ee8c32362a6b9dcb').html('<?php echo L::getText('账号处于登入状态,请稍后重试', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
                            break;
                        case '5' :    //达到最大登入人数
                            $('#error_7b42f9999c8e9012ee8c32362a6b9dcb').html('<?php echo L::getText('登入人数过多,请稍后重试', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
                            break;
                        default  :
                            window.L.openCom('tip')('<?php echo L::getText('登入发生错误,请联系管理员', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
                    }
                    $('#captchaImg_7b42f9999c8e9012ee8c32362a6b9dcb').click();
                }
            });
        } else {
            $('#error_7b42f9999c8e9012ee8c32362a6b9dcb').html('<?php echo L::getText('账户密码不能为空', array('file'=>__FILE__, 'line'=>__LINE__)); ?>');
        }
    }
};
$('form[onsubmit^=dialogLogin_7b42f9999c8e9012ee8c32362a6b9dcb] input:first').focus();    //第一文本框获得焦点
</script>