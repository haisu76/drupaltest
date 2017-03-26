<div class="nav">
    <span><?php echo L::getText('课程 / 课件', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span>
    <ul>
        <?php
            if(admin_user_permissions::urlCheck('/plan/plan.php', array('a' => 'addPlan')))
            {
        ?>
            <li><a <?php echo $_GET['a'] === 'addPlan' && !isset($_GET['id']) ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/plan/plan.php?a=addPlan"><?php echo L::getText('添加学习计划', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/plan/plan.php', array('a' => 'modfiyPlan')))
            {
        ?>
            <li><a <?php echo $_GET['a']  === 'modfiyPlan' || ($_GET['a'] === 'addPlan' && isset($_GET['id'])) ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/plan/plan.php?a=modfiyPlan"><?php echo L::getText('学习计划管理', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/plan/plan.php', array('a' => 'learningStatistics')))
            {
        ?>
            <li><a <?php echo $_GET['a'] === 'learningStatistics' ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/plan/plan.php?a=learningStatistics"><?php echo L::getText('学习计划监控', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
        <?php
            }
        ?>
    </ul>
</div>