<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('系统工具', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php
            $backup = $manageBackup = '';    //为导航栏添加css效果
            $a = isset($_GET['a']) ? $_GET['a'] : 'index';
            switch($a){
                case 'manageBackup':
                    $manageBackup = 'ihover';
                    break;
                case 'index'       :
                    $backup='ihover';
                    break;
               }
        ?>
        <ul>
            <?php
            if(admin_user_permissions::urlCheck('/backup/backupCtl.php', array('a' => 'index')))
            {
            ?>
                <li>
                    <a class='<?php echo $backup;?>' href="<?php echo ADMIN_URL;?>/backup/backupCtl.php">
                    <?php echo L::getText('数据备份', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                </li>
            <?php
            }
            if(admin_user_permissions::urlCheck('/backup/backupCtl.php', array('a' => 'manageBackup')))
            {
            ?> 
                <li>
                    <a class='<?php echo $manageBackup;?>' href="<?php echo ADMIN_URL;?>/backup/backupCtl.php?a=manageBackup">
                    <?php echo L::getText('数据恢复', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                </li>
            <?php
            }
            if(admin_user_permissions::urlCheck('/extension/extensionManager.php', array('a' => 'manager')))
            {
            ?> 
                <li>
                    <a class='<?php echo $a === 'manager' ? 'ihover' : ''; ?>' href="<?php echo ADMIN_URL;?>/extension/extensionManager.php?a=manager">
                    <?php echo L::getText('扩展管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>
