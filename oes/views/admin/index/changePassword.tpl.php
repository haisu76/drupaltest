<?php
$this->printHead(
    array(
        'title' => array('title'=>'修改密码', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/style.css'
        )
    )
);
?>
<div class="reg_main">
    <div class="reg_head">
        <div class="reg_headbt"><?php echo Of::config('_custom.title'); ?></div>
    </div>
    <div class="reg_content">
        <form id="reg_form" >
            <div class="change_password">
                <div class="reg_sbt01 l">
                    <div class="reg_sbt"><?php echo L::getText('密码修改', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="reg_rightinfo"><?php echo L::getText('输入您现在的密码，以便更改新密码', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('原密码：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox margin5 l"><input id="oldpassword" name="oldpassword" class="input width160" type="password"></div>
                    <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('您现在正在使用的密码', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('新密码：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox margin5 l"><input id="newpassword" name="password" class="input width160" value="" type="password"></div>
                    <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('您想要更改的密码', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('再输入一次：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox margin5 l"><input id="repassword" class="input width160" value="" type="password"></div>
                    <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('再输入一次确定密码', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('验证码：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="validatecodebox margin5 l">
                        <input id="validatecode" name="validatecode" class="input1 width60" maxlength="4" type="text">
                    </div>
                    <div class="reg_info l">
                        <span class="cred">*</span>
                        <img onclick="this.src = (this.backupSrc || (this.backupSrc = this.src)) + '&amp;t=' + new Date().getTime()" style="cursor:pointer; border:1px solid #EEE;" title="<?php echo L::getText('点击刷新', array('file'=>__FILE__, 'line'=>__LINE__));?>" src="<?php echo ROOT_URL; ?>/include/Of/Com/CommonPackage.php?a=captcha&amp;bgColor=FCFCFC" id="captchaImg">
                    </div>
                </div>
            </div>
            <div class="reg_btnbox">
                <div class="l"><input name="btn" type="button" class="reg_btn" value="<?php echo L::getText('修 改', array('file'=>__FILE__, 'line'=>__LINE__));?>" onclick="changePasswordObj.submit();" /></div>
                <div class="l"><input name="resetbtn" type="reset" class="reg_btn1" value="<?php echo L::getText('重 置', array('file'=>__FILE__, 'line'=>__LINE__));?>" /></div>
          </div>
      </form>
    </div>
    <div class="reg_bottom"></div>
</div>
<script>
var changePasswordObj = {
    'submit' : function(){
        var postData = {
            'oldpassword' : $('#oldpassword').val(),
            'newpassword' : $('#newpassword').val(),
            'validatecode' : $.trim($('#validatecode').val())
        };

        if(postData.oldpassword === '' || postData.newpassword === '' || postData.validatecode === '')
        {
            window.L.openCom('tip')(window.L.getText('以"*"结尾的均不能为空'));
            return false;
        } else if(postData.newpassword !== $('#repassword').val()) {
            window.L.openCom('tip')(window.L.getText('两次密码不同'));
            return false;
        } else if(postData.oldpassword === postData.newpassword) {
            window.L.openCom('tip')(window.L.getText('原密码与新密码相同'));
        } else {
            $.post('?a=changePassword', postData, function(response){
                if(response === '4')
                {
                    window.L.openCom('tip')(window.L.getText('验证码不正确'));
                } else if(response === '1') {
                    window.location.href = window.L._adminUrl + '/index.php';
                    return false;
                } else if(response === '0') {
                    window.L.openCom('tip')(window.L.getText('原密码错误'));
                } else {
                    window.L.openCom('tip')(window.L.getText('操作失败,请联系管理员'));
                }
                $('#validatecode').val('');
                $('#captchaImg').click();
            });
        }
    }
};
</script>