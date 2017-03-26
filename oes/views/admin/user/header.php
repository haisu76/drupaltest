<div class="nav"> <span><?php echo L::getText('用户 / 组 / 权限', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span>
    <ul>
        <?php
            if(admin_user_permissions::urlCheck('/user/userCtl.php', array('a' => 'userCreditManagement')))
            {
        ?>
            <li>
                <a <?php echo !isset($_GET['id']) && $_GET['a']  === 'userCreditManagement' ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/user/userCtl.php?a=userCreditManagement">
                    <?php echo L::getText('用户积分管理', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                </a>
            </li>
        <?php
            }
        ?>
    </ul>
</div>