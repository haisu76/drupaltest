<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('练习', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $addExercise = $exerciseManage  = '';//为导航栏添加css效果
			$a = isset($a)?$a:'';
            switch($a){
                case 'addExercise': $addExercise='ihover'; break;
                default:  $exerciseManage='ihover'; break;
               
                }
        ?>
        <ul>
         <?php
            if(admin_user_permissions::urlCheck('/exam/exerciseCtl.php', array('a' => 'addExercise')))
            {
        ?>
            <li>
            <a class='<?php echo $addExercise;?>' href="<?php echo ADMIN_URL;?>/exam/exerciseCtl.php?a=addExercise">
			<?php echo L::getText('添加练习', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
              <?php
            }
            if(admin_user_permissions::urlCheck('/exam/exerciseCtl.php', array('a' => 'index')))
            {
        ?> 
            <li>
            <a class='<?php echo $exerciseManage;?>' href="<?php echo ADMIN_URL;?>/exam/exerciseCtl.php">
			<?php echo L::getText('练习管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
