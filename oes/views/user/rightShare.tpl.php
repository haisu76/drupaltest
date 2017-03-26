<?php
$temp = $_GET['a'];
?>
<div id="sidebar"> 
    <div class="list_block item_name_01">
        <h1 class="main_title">
            <div class="left"> <span class="icon"></span><?php echo L::getText('个人中心', array('file'=>__FILE__, 'line'=>__LINE__)); ?></div>
            <div class="right"> <a class="more_block none" href="#" title="更多"> <span class="more_txt">更多</span> <span class="icon_more"></span> </a> </div>
        </h1>
        <div class="content">
            <div class="inner">
                <ul>
                <?php
                    if(getLicenceInfo('Product', 'OTS'))
                    {
                ?>
                        <li class="<?php echo $temp === 'myCourse' ? 'current' : ''; ?>"><a href="?a=myCourse" title=""><?php echo L::getText('我的课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                        <li class="<?php echo $temp === 'myPlan' ? 'current' : ''; ?>"><a href="?a=myPlan" title=""><?php echo L::getText('我的学习计划', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                        <li class="<?php echo $temp === 'myNote' ? 'current' : ''; ?>"><a href="?a=myNote" title=""><?php echo L::getText('我的笔记', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                        <li class="<?php echo $temp === 'qAndA' && !isset($_GET['type']) ? 'current' : ''; ?>"><a href="?a=qAndA" title=""><?php echo L::getText('我提出的问题', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                        <li class="<?php echo $temp === 'qAndA' && isset($_GET['type']) ? 'current' : ''; ?>"><a href="?a=qAndA&type=a_" title=""><?php echo L::getText('我回答的问题', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                <?php
                    }
                ?>
                    <li class="<?php echo $temp === 'myEnteredExam' ? 'current' : ''; ?>"><a href="?a=myEnteredExam" title=""><?php echo L::getText('我参加的考试', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                    <li class="<?php echo $temp === 'myErrQsn' ? 'current' : ''; ?>"><a href="?a=myErrQsn" title=""><?php echo L::getText('我做过的错题', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                    <li class="<?php echo $temp === 'myMsg' ? 'current' : ''; ?>"><a href="?a=myMsg" title=""><?php echo L::getText('我的短消息', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                    <li class="<?php echo $temp === 'information' ? 'current' : ''; ?>"><a href="?a=information" title=""><?php echo L::getText('修改个人信息', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>