<div class="header">
    <?php include("header.php");?>
    <div class="nav"> <span><?php echo L::getText('用户 / 组 / 权限', array('key'=>'', 'file'=>__FILE__, 'line'=>__LINE__));?></span>
        <?php 
            parse_str($_SERVER['QUERY_STRING']) ;
            $userAddUser = $userManage = $addRole = $roleManage = $group =
            $mdySch = $mdyTer = $addTer = $addSch = '';//为导航栏添加css效果
            
            switch($a){
                case 'userAddUser': $$a='ihover'; break;
                case 'userManage': $$a='ihover'; break;
                case 'addRole': $$a='ihover'; break;
                case 'roleManage': $$a='ihover'; break;
                case 'group': $$a='ihover'; break;
                
                case 'addSch': $$a='ihover'; break;
                case 'addTer': $$a='ihover'; break;
                case 'mdySch': $$a='ihover'; break;
                case 'mdyTer': $$a='ihover'; break;
                
                }
        ?>
        <ul>
        <?php
            if(admin_user_permissions::urlCheck('/user/userCtl.php', array('a' => 'userAddUser')))
            {
        ?>
            <li>
            <a class='<?php echo $userAddUser;?>' href="../user/userCtl.php?a=userAddUser">
            <?php echo L::getText('添加用户', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/user/userCtl.php', array('a' => 'userManage')))
            {
        ?>
            <li>
            <a class='<?php echo $userManage;?>' href="../user/userCtl.php?a=userManage">
            <?php echo L::getText('用户管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/group/groupCtl.php', array('a' => 'group')))
            {
        ?>
            <li>
            <a class='<?php echo $group;?>' href="../group/groupCtl.php?a=group">
            <?php echo L::getText('组管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/user/trainCtl.php', array('a' => 'addTer')))
            {
        ?>
            <li>
            <a class='<?php echo $addTer;?>' href="../user/trainCtl.php?a=addTer">
            <?php echo L::getText('添加讲师', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/user/trainCtl.php', array('a' => 'mdyTer')))
            {
        ?>
            <li>
            <a class='<?php echo $mdyTer;?>' href="../user/trainCtl.php?a=mdyTer">
            <?php echo L::getText('讲师管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/user/trainCtl.php', array('a' => 'addSch')))
            {
        ?>
            <li>
            <a class='<?php echo $addSch;?>' href="../user/trainCtl.php?a=addSch">
            <?php echo L::getText('添加培训机构', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/user/trainCtl.php', array('a' => 'mdySch')))
            {
        ?>
            <li>
            <a class='<?php echo $mdySch;?>' href="../user/trainCtl.php?a=mdySch">
            <?php echo L::getText('培训机构管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/user/permissions.php', array('a' => 'dataStratifiedPermissions')))
            {
        ?>
            <li>
            <a class='<?php echo $a === 'dataStratifiedPermissions' ? 'ihover' : '';?>' href="../user/permissions.php?a=dataStratifiedPermissions">
            <?php echo L::getText('数据权限管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/user/permissions.php', array('a' => 'urlPermissionsPackage')))
            {
        ?>
            <li>
            <a class='<?php echo $a === 'urlPermissionsPackage' ? 'ihover' : '';?>' href="../user/permissions.php?a=urlPermissionsPackage">
            <?php echo L::getText('功能权限管理', array('file'=>__FILE__, 'line'=>__LINE__));?></a>
            </li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>
