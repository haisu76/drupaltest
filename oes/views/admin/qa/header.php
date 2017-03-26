<div class="nav"> <span><?php echo L::getText('在线问答', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span>
    <ul>
        <?php
            if(admin_user_permissions::urlCheck('/qa/qa.php', array('a' => 'qaSearch')))
            {
        ?>
            <li><a class="ihover" href="<?php echo ADMIN_URL; ?>/qa/qa.php?a=qaSearch"><?php echo L::getText('问答搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a></li>
        <?php
            }
        ?>
    </ul>
</div>