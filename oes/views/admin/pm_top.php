<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('短消息管理', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $addMsg = $searchMsg = $cleanMsg = '';//为导航栏添加css效果
            switch($a){
                case 'addMsg': $$a='ihover'; break;
                case 'searchMsg': $$a='ihover'; break;
                case 'cleanMsg': $$a='ihover'; break;
                }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/postMessage/pmCtl.php', array('a' => 'addMsg')))
            {
        ?>
            <li><a class='<?php echo $addMsg;?>' href="../postMessage/pmCtl.php?a=addMsg"><?php echo L::getText('发送消息', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/postMessage/pmCtl.php', array('a' => 'cleanMsg')))
            {
        ?>
            <li><a class='<?php echo $cleanMsg;?>' href="../postMessage/pmCtl.php?a=cleanMsg"><?php echo L::getText('清理消息', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>
        <?php
            }
        ?>
            <!--<li><a class='<?php echo $searchMsg;?>' href="../postMessage/pmCtl.php?a=searchMsg"><?php echo L::getText('搜索消息', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>-->
        </ul>
    </div>
</div>
