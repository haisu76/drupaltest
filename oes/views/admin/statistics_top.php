<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('统计分析', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $statistics =  '';//为导航栏添加css效果
			$a = isset($a)?$a:'';
            switch($a){
            	case 'qsnAccuracy':  $qsnAccuracy='ihover'; break;
            	case 'qsnDetail':  $qsnDetail='ihover'; break;
                default:  $statistics='ihover'; break;
               }
        ?>
        <ul>
         <?php
            if(admin_user_permissions::urlCheck('/statistics/statisticsCtl.php', array('a' => 'index')))
            {
        ?>
            <li>
            <a class='<?php echo $statistics;?>' href="<?php echo ADMIN_URL;?>/statistics/statisticsCtl.php">
			<?php echo L::getText('考试成绩分析', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
           <?php }?>
               <?php
            if(admin_user_permissions::urlCheck('/statistics/statisticsCtl.php', array('a' => 'qsnAccuracy')))
            {
        ?>
            <li>
            <a class='<?php echo $qsnAccuracy;?>' href="<?php echo ADMIN_URL;?>/statistics/statisticsCtl.php?a=qsnAccuracy">
			<?php echo L::getText('试题正确率分析', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
           <?php }?>
               <?php
            if(admin_user_permissions::urlCheck('/statistics/statisticsCtl.php', array('a' => 'qsnDetail')))
            {
        ?>
            <li>
            <a class='<?php echo $qsnDetail;?>' href="<?php echo ADMIN_URL;?>/statistics/statisticsCtl.php?a=qsnDetail">
			<?php echo L::getText('试题明细分析', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
           <?php }?>
         
        </ul>
    </div>
</div>
