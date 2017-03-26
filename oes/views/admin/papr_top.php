<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('试卷', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $addPaper = $paprManage  = '';//为导航栏添加css效果
			$a = isset($a)?$a:'';
            switch($a){
                case 'addPaper': $addPaper='ihover'; break;
                default:  $paprManage='ihover'; break;
               
                }
        ?>
        <ul>
         <?php
            if(admin_user_permissions::urlCheck('/paper/paperCtl.php', array('a' => 'addPaper')))
            {
        ?>
            <li>
            <a class='<?php echo $addPaper;?>' href="<?php echo ADMIN_URL;?>/paper/paperCtl.php?a=addPaper">
			<?php echo L::getText('添加试卷', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php
            }
            if(admin_user_permissions::urlCheck('/paper/paperCtl.php', array('a' => 'index')))
            {
        ?> 
            <li>
            <a class='<?php echo $paprManage;?>' href="<?php echo ADMIN_URL;?>/paper/paperCtl.php">
			<?php echo L::getText('试卷管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
