<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('系统参数', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $setLoginParams = $setInviteParams  = '';//为导航栏添加css效果
			$a = isset($a)?$a:'';
            switch($a){
                case 'setLoginParams': $setLoginParams='ihover'; break;
                default:  $setInviteParams='ihover'; break;
               
                }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/setting/settingCtl.php', array('a' => 'setLoginParams')))
            {
        ?>
            <li>
            <a class='<?php echo $setLoginParams;?>' href="<?php echo ADMIN_URL;?>/setting/settingCtl.php?a=setLoginParams">
			<?php echo L::getText('登录参数', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
             <?php
            }
            if(admin_user_permissions::urlCheck('/setting/settingCtl.php', array('a' => 'setInviteParams')))
            {
        ?> 
            <li>
            <a class='<?php echo $setInviteParams;?>' href="<?php echo ADMIN_URL;?>/setting/settingCtl.php?a=setInviteParams">
			<?php echo L::getText('通知参数', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
