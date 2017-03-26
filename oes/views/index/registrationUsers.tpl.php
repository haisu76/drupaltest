<?php
$this->printHead(
    array(
        'title' => array('title'=>'用户注册', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/style.css'
        )
        ,'js' => array(
            '/index/registrationUsers.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="reg_main">
    <div class="reg_head">
        <div class="reg_headbt"><?php echo L::getText('用户注册', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
    </div>
    <div class="reg_content">
        <form id="reg_form" >
            <div class="reg_sbt01 l">
                <div class="reg_sbt"><?php echo L::getText('登录信息', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="reg_rightinfo"><?php echo L::getText('登录时用的用户名密码', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('用户名：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="username" name="username" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('十个汉字以内', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('密码：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="password" name="password" class="input width160" value="" type="password">
                </div>
                <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('密码至少六位，可以使用英文字母、符号或数字。', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('确认密码：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="repassword" class="input width160" value="" type="password">
                </div>
                <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ></span></div>
            </div>
            <div class="reg_sbt01 l">
                <div class="reg_sbt"><?php echo L::getText('安全问题', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="reg_rightinfo"><?php echo L::getText('找回密码的时候使用，请牢记', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('安全问题一：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="question1" name="question1" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('请认真填写并记录内容，以便密码丢失后找回。', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('答案一：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="answer1" name="answer1" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('安全问题二：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="question2" name="question2" class="input width160" type="text">
                </div>
                <div class="reg_info l"></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('答案二：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="answer2" name="answer2" class="input width160" type="text">
                </div>
                <div class="reg_info l"></div>
            </div>
            <div class="reg_sbt01 l">
                <div class="reg_sbt"><?php echo L::getText('个人资料', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="reg_rightinfo"><?php echo L::getText('请提供详细的个人资料', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('姓名：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="real_name" name="real_name" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('性别：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <label for="radio1" class="pointer" style="cursor:pointer;">
                        <input name="gender" id="radio1" class="gender" value="1" checked="checked" type="radio">
                        <?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__));?>
                    </label>
                    &nbsp;&nbsp;
                    <label for="radio2" class="pointer" style="cursor:pointer;">
                        <input id="radio2" name="gender" class="gender" value="0" type="radio">
                        <?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__));?>
                    </label>
                </div>
                <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('出生年月：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="datebox margin5 l">
                    <input id="birthday" class="input width160" readonly="readonly" type="text" onclick="window.L.openCom('wDate')({'readOnly' : true})">
                </div>
                <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('所在组：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="jgbox margin5 l"><a href="#" id="group_id" onclick="registrationUsersObj.getGroupListTreeClickFun(this); return false;"><?php echo L::getText('选择组', array('file'=>__FILE__, 'line'=>__LINE__));?></a></div>
                <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('邮箱：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="email" name="email" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred">*</span><span class="reg_prompt" ><?php echo L::getText('用来确认您的身份，找回密码。', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('证件号码：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="idcard" name="idcard" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('固定电话：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="tel" name="tel" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
            </div>
            <div class="formitem">
                <div class="reg_bt_width margin5 l"><?php echo L::getText('移动电话：', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                <div class="inputbox margin5 l">
                    <input id="mobiletel" name="mobiletel" class="input width160" type="text">
                </div>
                <div class="reg_info l"><span class="cred"></span><span class="reg_prompt" ></span></div>
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
            <div class="reg_btnbox">
                <div class="l">
                    <input name="btn" type="button" class="reg_btn" value="<?php echo L::getText('提 交', array('file'=>__FILE__, 'line'=>__LINE__));?>" onclick="registrationUsersObj.submit()" />
                </div>
                <div class="l">
                    <input name="resetbtn" type="reset" class="reg_btn1" value="<?php echo L::getText('重 置', array('file'=>__FILE__, 'line'=>__LINE__));?>" />
                </div>
            </div>
        </form>
    </div>
    <div class="reg_bottom"></div>
</div>
