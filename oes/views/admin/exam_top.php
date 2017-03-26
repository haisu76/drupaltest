<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('考试', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $addExam = $examManage=$examManage=$manualMarking=$examScoreManage=$examMonitor =$examUserMonitor = '';//为导航栏添加css效果
             $temp = substr($_SERVER['SCRIPT_FILENAME'], strlen(ROOT_DIR));

			$a = isset($a)?$a:'';
            
            switch($temp)
            {
            	 case ADMIN_DIR.'/examscore/examscoreCtl.php': $examScoreManage='ihover'; break;
            	 case ADMIN_DIR.'/paper/manualMarkingCtl.php': $manualMarking='ihover'; break;
            	 case ADMIN_DIR.'/exammonitor/examMonitorCtl.php': 
            	 	switch($a){
            	 		  case 'userMonitor': $examUserMonitor='ihover'; break;
            	 		  default:
            	 		  	$examMonitor='ihover'; break;
            	 		  	break;
            	 	}
            	 	break;
            	 default:
		            switch($a){
		                case 'addExam': $addExam='ihover'; break;
		                case 'manageImportQsn': 
		                case 'updateImportQsn':
		                	$manageImportQsn='ihover'; break;
		                case 'setQsnDefaultSetting':$setQsnDefaultSetting='ihover'; break;
		                default:  $examManage='ihover'; break;
		                }
            	 	break;
            }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/exam/examCtl.php', array('a' => 'addExam')))
            {
        ?>
            <li>
            <a class='<?php echo $addExam;?>' href="<?php echo ADMIN_URL;?>/exam/examCtl.php?a=addExam">
			<?php echo L::getText('添加考试', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
             <?php
            }
            if(admin_user_permissions::urlCheck('/exam/examCtl.php', array('a' => 'index')))
            {
        ?> 
            <li>
            <a class='<?php echo $examManage;?>' href="<?php echo ADMIN_URL;?>/exam/examCtl.php">
			<?php echo L::getText('考试管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
              <?php
            }
            if(admin_user_permissions::urlCheck('/paper/manualMarkingCtl.php', array('a' => 'index')))
            {
        ?> 
             <li>
             <a class='<?php echo $manualMarking;?>' href="<?php echo ADMIN_URL;?>/paper/manualMarkingCtl.php">
			<?php echo L::getText('人工评卷', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
              <?php
            }
            if(admin_user_permissions::urlCheck('/examscore/examscoreCtl.php', array('a' => 'index')))
            {
        ?> 
            <li>
            <a class='<?php echo $examScoreManage;?>' href="<?php echo ADMIN_URL;?>/examscore/examscoreCtl.php">
			<?php echo L::getText('成绩管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
              <?php
            }
            if(admin_user_permissions::urlCheck('/exammonitor/examMonitorCtl.php', array('a' => 'index')))
            {
        ?> 
            <li>
            <a class='<?php echo $examMonitor;?>' href="<?php echo ADMIN_URL;?>/exammonitor/examMonitorCtl.php">
			<?php echo L::getText('考试监控', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
              <?php
            }
            if(admin_user_permissions::urlCheck('/exammonitor/examMonitorCtl.php', array('a' => 'userMonitor')))
            {
        ?> 
            <li>
            <a class='<?php echo $examUserMonitor;?>' href="<?php echo ADMIN_URL;?>/exammonitor/examMonitorCtl.php?a=userMonitor">
			<?php echo L::getText('考生监控', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>
