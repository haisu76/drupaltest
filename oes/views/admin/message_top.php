<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('公告管理', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $msgAdd = $msgList = '';//为导航栏添加css效果
            switch($a){
                case 'msgAdd': $$a='ihover'; break;
                case 'msgList': $$a='ihover'; break;
                }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/message/messageCtl.php', array('a' => 'msgAdd')))
            {
        ?>
            <li><a class='<?php echo $msgAdd;?>' href="../message/messageCtl.php?a=msgAdd"><?php echo L::getText('发布公告', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/message/messageCtl.php', array('a' => 'msgList')))
            {
        ?>
            <li><a class='<?php echo $msgList;?>' href="../message/messageCtl.php?a=msgList"><?php echo L::getText('修改公告', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>
