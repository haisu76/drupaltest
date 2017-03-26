<div class="nav"> <span><?php echo L::getText('课件 / 课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span>
    <ul>
        <?php
            if(admin_user_permissions::urlCheck('/course/courseware.php', array('a' => 'addCourseware')))
            {
        ?>
            <li>
                <a <?php echo !isset($_GET['id']) && $_GET['a']  === 'addCourseware' ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/course/courseware.php?a=addCourseware">
                    <?php echo L::getText('添加课件', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                </a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/course/courseware.php', array('a' => 'modfiyCourseware')))
            {
        ?>
            <li>
                <a <?php echo $_GET['a'] === 'modfiyCourseware' || (isset($_GET['id']) && $_GET['a']  === 'addCourseware') ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/course/courseware.php?a=modfiyCourseware">
                    <?php echo L::getText('课件管理', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                </a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/course/course.php', array('a' => 'addCourse')))
            {
        ?>
            <li>
                <a <?php echo $_GET['a'] === 'addCourse' && !isset($_GET['courseId']) ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/course/course.php?a=addCourse">
                    <?php echo L::getText('添加课程', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                </a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/course/course.php', array('a' => 'modfiyCourse')))
            {
        ?>
            <li>
                <a <?php echo $_GET['a']  === 'modfiyCourse' || ($_GET['a'] === 'addCourse' && isset($_GET['courseId'])) ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/course/course.php?a=modfiyCourse">
                    <?php echo L::getText('课程管理', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                </a>
            </li>
        <?php
            }
            if(admin_user_permissions::urlCheck('/course/course.php', array('a' => 'learningStatistics')))
            {
        ?>
            <li>
                <a <?php echo $_GET['a']  === 'learningStatistics' ? 'class="ihover"' : ''; ?> href="<?php echo ADMIN_URL; ?>/course/course.php?a=learningStatistics">
                    <?php echo L::getText('课程监控', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                </a>
            </li>
        <?php
            }
        ?>

        <!--<li>
            <a <?php echo $_GET['a']  === '111' ? 'class="ihover"' : ''; ?> href="course_approver.html">
                <?php echo L::getText('课程审批', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
            </a>
        </li>-->
    </ul>
</div>