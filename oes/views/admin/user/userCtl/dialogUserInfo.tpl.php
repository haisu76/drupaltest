<?php
$this->printHead(
                array(
                    'title' => array('title'=>'用户管理-添加用户', 'file'=>__FILE__, 'line'=>__LINE__)
                   ,'css'=>array(
                        '/admin_user_userCtl_dialogUserInfo.css'
                    )
                   ,'js' => array(
                                  '/admin/songComm.js'
                                  )   
                )
            );
?>
<div class="panel_1 con_input" style="float:left;  width:600px;">
    <div class="title"><span><?php echo $this->info['username'], L::getText('的资料', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
    <div class="content" style="margin-bottom:5px;">
        <div class="con_tab" id="tabs1">
            <!--<div class="tab_title">
                <a class="current" href="#" alt="" >用户信息</a>
                <a class="" href="#" alt="" >考试信息</a>
                <a class="" href="#" alt="" >培训信息</a>
                <a class="" href="#" alt="" >问答信息</a>
            </div>
            <div class="clear"></div>-->
            
            <div class="tab_content"><!-- // tab -->
                <div class="col_left" style="width: 48%;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <colgroup>
                            <col style="width:100px;" />
                            <col style="" />
                        </colgroup>
                        <tr>
                            <td width="35%"><?php echo L::getText('所属组：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td colspan="2"><input class="input3 disable auto_width" name="textfield" type="text" id="textfield" value="<?php echo $this->info['group_name'];?>" disabled /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('ID：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td colspan="2"><input class="input3 disable auto_width" name="textfield" type="text" id="textfield" value="<?php echo $this->info['user_id'];?>" disabled="disabled" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('姓名：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td colspan="2"><input name="textfield" type="text" disabled class="input1 disable auto_width" id="textfield" value="<?php echo $this->info['real_name'];?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('用户名：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td colspan="2"><input name="textfield" type="text" class="input3 disable auto_width" id="textfield" value="<?php echo $this->info['username'];?>" disabled /></td>
                        </tr>                   
                        <tr  height="90px">
                            <td><?php echo L::getText('积分：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td width="44%"><?php echo $this->info['credit']==""?0:$this->info['credit'];?></td>
                            <td width="21%" rowspan="4">
                            <?php 
                            if($this->info['photo']!='')
                            {
                                echo '<img src="' .ROOT_URL. '/include/oFileManager/fileExtension.php?fileUrl=' .OF::config('_browseHome') . $this->info['photo']. '" width=90 height=90/>';
                            }else
                            {
                                echo '<img src="' .ROOT_URL. '/images/user_photo_big.jpg" width=90 height=90/>';
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('性别：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td colspan="2">
                            <input class='radiobox' name='radio1' type='radio' id='radio' value='radio' <?php echo $this->info['gender'] === '1' ? 'checked' : '';?> /><?php echo L::getText('男', array('file'=>__FILE__, 'line'=>__LINE__));?>&nbsp; &nbsp;
                            <input class='radiobox' name='radio1' type='radio' id='radio' value='radio' <?php echo $this->info['gender'] === '0' ? 'checked' : '';?> /><?php echo L::getText('女', array('file'=>__FILE__, 'line'=>__LINE__));?>
                            </td>
                        </tr>
                        
                    </table>
                </div>
                
                <div class="col_right">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <colgroup>
                            <col style="width:110px;" />
                            <col style="" />
                        </colgroup>
                        
                        <tr >
                            <td width="35%"><?php echo L::getText('证件号码：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td><input name="textfield" type="text"  disabled class="input3 disable auto_width" id="textfield" value="<?php echo $this->info['idcard'];?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('准考证号：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td><input name="textfield" type="text"  disabled class="input1 disable auto_width" id="textfield" value="<?php echo $this->info['examcard'];?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('电话：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td><input name="textfield" type="text" disabled class="input3 disable auto_width" id="textfield" value="<?php echo $this->info['tel'];?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('手机号码：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td><input name="textfield" type="text" disabled class="input3 disable auto_width" id="textfield" value="<?php echo $this->info['mobiletel'];?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('Email：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td><input name="textfield" type="text" disabled class="input3 disable auto_width" id="textfield" value="<?php echo $this->info['email'];?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('注册时间：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td><input class="input3 disable  auto_width" name="textfield" type="text" disabled="disabled" id="textfield" value="<?php echo $this->info['reg_tm'];?>" alt="" /></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('审核状态：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td>
                                <?php if($this->info['status']=='070102')
                                      echo "<img src='".ROOT_URL."/images/icon/icon_radio_on.gif' />", L::getText('已审核', array('file'=>__FILE__, 'line'=>__LINE__));
                                  else
                                      echo "<img src='".ROOT_URL."/images/icon/icon_off.gif' />", L::getText('未审核', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('是否管理员：', array('file'=>__FILE__, 'line'=>__LINE__));?></td>
                            <td>
                                <?php echo $this->info['isadmin'];?>
                            </td>
                        </tr>
                        
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="title"><span><?php echo L::getText('学习过的课程', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
    <?php echo $this->getCourseInfoPageTable; ?>
    <div class="title"><span><?php echo L::getText('学习过的计划', array('file'=>__FILE__, 'line'=>__LINE__));?></span></div>
    <?php echo $this->getPlanInfoPageTable; ?>
</div>