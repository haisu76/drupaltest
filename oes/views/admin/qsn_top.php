<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('试题', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $addQsn = $setQsnDefaultSetting=$qsnManage=$manageImportQsn  = '';//为导航栏添加css效果
           
			$a = isset($a)?$a:'';
            switch($a){
                case 'addQsn': $addQsn='ihover'; break;
                case 'manageImportQsn': 
                case 'updateImportQsn':
                	$manageImportQsn='ihover'; break;
                case 'setQsnDefaultSetting':$setQsnDefaultSetting='ihover'; break;
                default:  $qsnManage='ihover'; break;
               
                }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/question/questionCtl.php', array('a' => 'addQsn')))
            {
        ?>
            <li>
            <a class='<?php echo $addQsn;?>' href="<?php echo ADMIN_URL;?>/question/questionCtl.php?a=addQsn">
			<?php echo L::getText('添加试题', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
          <?php
            }
            if(admin_user_permissions::urlCheck('/question/questionCtl.php', array('a' => 'index')))
            {
        ?>
            <li>
            <a class='<?php echo $qsnManage;?>' href="<?php echo ADMIN_URL;?>/question/questionCtl.php">
			<?php echo L::getText('试题管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php
            }
            if(admin_user_permissions::urlCheck('/question/questionCtl.php', array('a' => 'manageImportQsn')))
            {
        ?>
             <li>
             <a class='<?php echo $manageImportQsn;?>' href="<?php echo ADMIN_URL;?>/question/questionCtl.php?a=manageImportQsn">
			<?php echo L::getText('导入试题', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php
            }
            if(admin_user_permissions::urlCheck('/question/questionCtl.php', array('a' => 'setQsnDefaultSetting')))
            {
        ?>
            <li>
            <a class='<?php echo $setQsnDefaultSetting;?>' href="<?php echo ADMIN_URL;?>/question/questionCtl.php?a=setQsnDefaultSetting">
			<?php echo L::getText('题库参数设置', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
