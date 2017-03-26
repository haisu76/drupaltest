<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('审批', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $planVerify = $courseVerify = $examVerify = '';//为导航栏添加css效果
			$a = isset($a)?$a:'';
            switch($a){
                case 'courseVerify': $courseVerify='ihover'; break;
                case 'examVerify': $examVerify='ihover'; break;
                default:  $planVerify='ihover'; break;
               }
        ?>
        <ul>
         <?php
            if(admin_user_permissions::urlCheck('/verify/verifyCtl.php', array('a' => 'index')))
            {
        ?>
            <li>
            <a class='<?php echo $planVerify;?>' href="<?php echo ADMIN_URL;?>/verify/verifyCtl.php">
			<?php echo L::getText('学习计划审批', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
             <?php
            }
            if(admin_user_permissions::urlCheck('/verify/verifyCtl.php', array('a' => 'courseVerify')))
            {
        ?> 
            <li>
            <a class='<?php echo $courseVerify;?>' href="<?php echo ADMIN_URL;?>/verify/verifyCtl.php?a=courseVerify">
			<?php echo L::getText('课程审批', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
             <?php
            }
            if(admin_user_permissions::urlCheck('/verify/verifyCtl.php', array('a' => 'examVerify')))
            {
        ?> 
            <li>
            <a class='<?php echo $examVerify;?>' href="<?php echo ADMIN_URL;?>/verify/verifyCtl.php?a=examVerify">
			<?php echo L::getText('考试审批', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
