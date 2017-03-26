<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('系统数据', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $basic = $category = '';//为导航栏添加css效果
            switch($a){
                case 'basic': $basic='ihover'; break;
                case 'category': $category='ihover'; break;
                case 'cleanUp': $cleanup='ihover'; break;
             //   case 'faq': $$a='ihover';
                }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/data/dataCtl.php', array('a' => 'basic')))
            {
        ?>
            <li><a class='<?php echo $basic;?>' href="../data/dataCtl.php?a=basic"><?php echo L::getText('基础数据管理', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>
             <?php
            }
            if(admin_user_permissions::urlCheck('/data/dataCtl.php', array('a' => 'category')))
            {
        ?> 
         <li><a class='<?php echo $category;?>' href="../data/dataCtl.php?a=category"><?php echo L::getText('分类数据管理', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>
            <?php
            }
            /*if(admin_user_permissions::urlCheck('/data/dataCtl.php', array('a' => 'cleanUp')))
            {
        ?> 
         <li><a class='<?php echo $cleanup;?>' href="../data/dataCtl.php?a=cleanUp"><?php echo L::getText('数据清理', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></a></li>
        <?php }*/?>
      
        </ul>
    </div>
</div>
