<div class="nav"> <span><?php echo L::getText('讲师评定', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span>
    <ul>
        <?php
            if(admin_user_permissions::urlCheck('/review/course.php', array('a' => 'modifyCourse')))
            {
        ?>
            <li><a <?php echo $_GET['a'] === 'modifyCourse' || isset($_GET['c_id']) ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL ?>/review/course.php?a=modifyCourse"><?php echo L::getText('课程评定', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/review/plan.php', array('a' => 'modifyPlan')))
            {
        ?>
            <li><a <?php echo $_GET['a'] === 'modifyPlan' || isset($_GET['p_id']) ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL ?>/review/plan.php?a=modifyPlan"><?php echo L::getText('学习计划评定', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
        <?php
            }
        ?>
    </ul>
</div>