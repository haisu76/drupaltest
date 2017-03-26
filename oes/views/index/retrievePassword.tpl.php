<?php
$this->printHead(
    array(
        'title' => array('title'=>'找回密码', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/style.css'
        )
        ,'js' => array(
            //'/index/registrationUsers.js',
            '/admin/manyTrees.js'
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
            <div class="safe_questionbox">
                <div class="reg_sbt01 l">
                    <div class="reg_sbt"><?php echo L::getText('找回账号', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="reg_rightinfo"></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('用户名：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox margin5 l"><input id="username" name="username" class="input width160" onfocus="retrievePasswordObj.hideFrom()" type="text"></div>
                    <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('丢失密码的账户', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
                </div>
            </div>
            <div id="securityIssue" class="safe_questionbox" style="display: none;">
                <div class="reg_sbt01 l">
                    <div class="reg_sbt"><?php echo L::getText('安全问题', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="reg_rightinfo"></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('安全问题一：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox fontcol9 margin5 paddingtop2 l" id="question1"></div>
                    <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('答案一：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox margin5 l"><input id="answer1" name="answer1" class="input width160" type="text"></div>
                    <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('填写注册时设置的问题答案', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('安全问题二：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox fontcol9 margin5 paddingtop2 l" id="question2"></div>
                    <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
                </div>
                <div class="formitem">
                    <div class="reg_bt_width margin5 l"><?php echo L::getText('答案二：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="inputbox margin5 l"><input id="answer2" name="answer2" class="input width160" type="text"></div>
                    <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('同上', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
                </div>
            </div>
            <div id="changePassword" class="change_password" style="display: none;">
                <div class="reg_sbt01 l">
                    <div class="reg_sbt"><?php echo L::getText('密码修改', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="reg_rightinfo"></div>
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
                <div class="l"><input name="btn" type="button" class="reg_btn" value="<?php echo L::getText('提 交', array('file'=>__FILE__, 'line'=>__LINE__));?>" onclick="retrievePasswordObj.submit();" /></div>
                <div class="l"><input name="resetbtn" type="reset" class="reg_btn1" value="<?php echo L::getText('重 置', array('file'=>__FILE__, 'line'=>__LINE__));?>" /></div>
            </div>
        </form>
    </div>
    <div class="reg_bottom"></div>
</div>
<script>
var retrievePasswordObj = {
    'submit' : function(){
        var postData = {
            'username' : $('#username').val()
        };
        if(postData.username === '')
        {
            window.L.openCom('tip')(window.L.getText('以"*"结尾的均不能为空'));
            return false;
        }

        if($('#changePassword').css('display') === 'none')    //查询安全问答
        {
            $.post('?a=retrievePassword', postData, function(jsonObj){
                if(jsonObj.question1)
                {
                    $('#securityIssue').show();
                    $('#changePassword').show();
                    $('#question1').html(jsonObj.question1);
                } else {
                    window.L.openCom('tip')(window.L.getText('该账户不存在密码保护,无法找回'));
                }
                if(jsonObj.question2)
                {
                    $('#answer2').parents('.formitem').show();
                    $('#question2').html(jsonObj.question2).parent()
                                   .show();
                } else {
                    $('#answer2').parents('.formitem').hide();
                    $('#question2').html('').parent()
                                   .hide();
                }
            }, 'json');
        } else {    //提交找回信息
            postData.answer1 = $('#answer1').val();
            postData.answer2 = $('#answer2').val();
            postData.newpassword = $('#newpassword').val();
            postData.validatecode = $.trim($('#validatecode').val());
            
            if(postData.answer1 === '' || (postData.answer2 === '' && $('#question2').html()) || postData.newpassword === '' || postData.validatecode === '')
            {
                window.L.openCom('tip')(window.L.getText('以"*"结尾的均不能为空'));
                return false;
            } else if(
                postData.newpassword !== $('#repassword').val()) {
                window.L.openCom('tip')(window.L.getText('两次密码不同'));
                return false;
            } else {
                $.post('?a=retrievePassword', postData, function(response){
                    if(response === '4')
                    {
                        window.L.openCom('tip')(window.L.getText('验证码不正确'));
                    } else if(response === '1') {
                        window.location.href = window.L._rootUrl + '/index.php';
                        return false;
                    } else if(response === '0') {
                        window.L.openCom('tip')(window.L.getText('安全问题验证失败'));
                    } else {
                        window.L.openCom('tip')(window.L.getText('操作失败,请联系管理员'));
                    }
                    $('#validatecode').val('');
                    $('#captchaImg').click();
                });
            }
        }
    },
    
    //隐藏安全问题及密码区
    'hideFrom' : function(){
        $('#securityIssue').hide();
        $('#changePassword').hide();
    }
};
</script>