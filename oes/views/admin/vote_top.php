<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('投票管理', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $addVote = $voteManage = '';//为导航栏添加css效果
			$a = isset($a)?$a:'';
            switch($a){
                case 'addVote': $addVote='ihover'; break;
                default: $voteManage='ihover'; break;
				
                }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/vote/voteCtl.php', array('a' => 'addVote')))
            {
        ?>
            <li>
            <a class='<?php echo $addVote;?>' href="../vote/voteCtl.php?a=addVote">
			<?php echo L::getText('添加投票', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/vote/voteCtl.php', array('a' => 'index')))
            {
        ?>
            <li>
            <a class='<?php echo $voteManage;?>' href="../vote/voteCtl.php">
			<?php echo L::getText('修改投票', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>
