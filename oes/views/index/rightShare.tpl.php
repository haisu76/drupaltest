<?php
if(empty($rightShareParams))
{
    //默认列表
    $rightShareParams = array(    //其中右侧的true可变为数组给对应的键值传递依赖参数
        'myDynamic' => true,    //我的动态
        'popularCourses' => true,    //受欢迎的课程
        'popularTest' => true,    //最热的练习
        'popularAsk' => true    //最热的问题
        //'relatedAsk' => array('id' => '问题ID')    //相关问题,在问题详细页出现
    );
}
if(!$product = getLicenceInfo('Product', 'OTS'))
{
    unset($rightShareParams['popularCourses'], $rightShareParams['popularAsk']);
}

if(!$rightShareData = &Of_Com_CommonPackage::cache('view_index_rightShare,1'))
{
    $db = new Of_Model;

    //最受欢迎课程
    $sql = 'SELECT
        `t_course`.c_id,    /*课程ID*/
        `t_course`.c_name    /*课程名称*/
    FROM
        `t_course_appraise`
            LEFT JOIN `t_course` ON
                `t_course`.c_id = `t_course_appraise`.c_id
    WHERE
        `t_course`.c_id IS NOT NULL
    GROUP BY 
        `t_course_appraise`.c_id
    ORDER BY 
        AVG(`t_course_appraise`.score) DESC
    LIMIT 5';
    $rightShareData['popularCourse'] = $db->sql($sql);

    //讨论最多的问题
    $sql = 'SELECT
        `t_study_cmut_ask`.c_id,    /*问题ID*/
        `t_study_cmut_ask`.c_title    /*问题标题*/
    FROM
        `t_study_cmut_answer`
            LEFT JOIN `t_study_cmut_ask` ON
                `t_study_cmut_ask`.c_id = `t_study_cmut_answer`.c_id
    WHERE
        `t_study_cmut_ask`.c_id IS NOT NULL
    AND `t_study_cmut_ask`.shielded = "0"    /*未屏蔽的问题*/
    GROUP BY
        `t_study_cmut_ask`.c_id
    ORDER BY 
        COUNT(`t_study_cmut_answer`.c_a_id) DESC
    LIMIT 5';
   
    $rightShareData['concernedProblem'] = $db->sql($sql);
}
?>

<div id="sidebar"> 
    <?php
        //我的动态
        if(isset($rightShareParams['myDynamic']) && isset($_SESSION['user']['login']))
        {
            if(!$myDynamic = &Of_Com_CommonPackage::cache('view_index_rightShare,myDynamic', array('userId' => $_SESSION['user']['userId'])))
            {
                isset($db) || $db = new Of_Model;

                if($product)
                {
                    $temp = array(
                        array(
                            'associatePassUserType' => 3
                        )
                    );
                    //参加的学习课程
                    Of_Com_CommonPackage::pageTable('course::getCoursePageTable', $temp[0], $temp[1]);
                    $myDynamic['myCourse'] = $temp[1]['_config']['_attr']['totalItems'];

                    //参加的学习计划
                    Of_Com_CommonPackage::pageTable('plan::getPlanPageTable', $temp[0], $temp[1]);
                    $myDynamic['myPlan'] = $temp[1]['_config']['_attr']['totalItems'];

                    //我提出的问题
                    $sql = "SELECT
                        COUNT(*) c
                    FROM
                        `t_study_cmut_ask`
                    WHERE
                        `t_study_cmut_ask`.user_id = '{$_SESSION['user']['userId']}'
                    AND `t_study_cmut_ask`.shielded = '0'";

                    $temp = $db->sql($sql);
                    $myDynamic['myQuestion'] = $temp[0]['c'];

                    //我回答的问题
                    $sql = "SELECT
                        COUNT(`data`.c) c
                    FROM (
                        SELECT
                            1 c
                        FROM
                            `t_study_cmut_answer`,
                            `t_study_cmut_ask`
                        WHERE
                            `t_study_cmut_answer`.user_id = '{$_SESSION['user']['userId']}'
                        AND `t_study_cmut_answer`.c_id = `t_study_cmut_ask`.c_id
                        AND `t_study_cmut_ask`.shielded = '0'
                        GROUP BY
                            `t_study_cmut_ask`.c_id
                    ) `data`";

                    $temp = $db->sql($sql);
                    $myDynamic['myAnswer'] = $temp[0]['c'];
                }

                //我参加的考试
                $temp = array(null);
                Of_Com_CommonPackage::pageTable('user::getEnteredExamPageTable', $temp[0], $temp[1]);
                $myDynamic['myExam'] = $temp[1]['_config']['_attr']['totalItems'];
            }
    ?>
            <div class="list_block item_name_01">
                <h1 class="main_title">
                    <div class="left"> <span class="icon"></span><?php echo L::getText('我的动态', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                </h1>
                <div class="content">
                    <div class="inner">
                        <ul>
                            <li><a title="" href="<?php echo ROOT_URL; ?>/user.php?a=myEnteredExam" class=""><?php echo L::getText('已参加过的考试：', array('file'=>__FILE__, 'line'=>__LINE__));?><span class=""><?php echo $myDynamic['myExam'] ?></span></a></li>
                            <?php
                            if($product)
                            {
                            ?>
                                <li><a title="" href="<?php echo ROOT_URL; ?>/user.php?a=myCourse" class=""><?php echo L::getText('参加学习的课程：', array('file'=>__FILE__, 'line'=>__LINE__));?><span class=""><?php echo $myDynamic['myCourse'] ?></span></a></li>
                                <li><a title="" href="<?php echo ROOT_URL; ?>/user.php?a=myPlan" class=""><?php echo L::getText('参加的学习计划：', array('file'=>__FILE__, 'line'=>__LINE__));?><span class=""><?php echo $myDynamic['myPlan'] ?></span></a></li>
                                <li><a title="" href="<?php echo ROOT_URL; ?>/user.php?a=qAndA" class=""><?php echo L::getText('我提出的问题：', array('file'=>__FILE__, 'line'=>__LINE__));?><span class=""><?php echo $myDynamic['myQuestion'] ?></span></a></li>
                                <li><a title="" href="<?php echo ROOT_URL; ?>/user.php?a=qAndA&type=a_" class=""><?php echo L::getText('我回答的问题：', array('file'=>__FILE__, 'line'=>__LINE__));?><span class=""><?php echo $myDynamic['myAnswer'] ?></span></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
    <?php
        }
        //热门课程
        if(isset($rightShareParams['popularCourses']))
        {
    ?>
            <div class="list_block item_name_01">
                <h1 class="main_title">
                    <div class="left"> <span class="icon"></span><?php echo L::getText('最受欢迎课程', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                </h1>
                <div class="content">
                    <div class="inner">
                        <ul>
                        <?php
                            foreach($rightShareData['popularCourse'] as &$v)
                            {
                        ?>
                            <li><a title="<?php echo $v['c_name']; ?>" href="<?php echo ROOT_URL; ?>/course.php?a=courseDetail&c_id=<?php echo $v['c_id']; ?>" class=""><?php echo Of_Com_CommonPackage::cutLenStr($v['c_name'], 24); ?></a></li>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
    <?php
        }
        //热门练习
        /*if(isset($rightShareParams['popularTest']))
        {
            <div class="list_block item_name_01">
                <h1 class="main_title">
                    <div class="left"> <span class="icon"></span>做得最多的练习(没做)</div>
                </h1>
                <div class="content">
                    <div class="inner">
                        <ul>
                            <li><a title="" href="#" class="">企业文化培训：<span class="">4</span></a></li>
                            <li><a title="" href="#" class="">产品售后服务：<span class="">2</span></a></li>
                            <li><a title="" href="#" class="">内部文档设计与编写规范：<span class="">5</span></a></li>
                            <li><a title="" href="#" class="">oTraining产品使用指南：<span class="">12</span></a></li>
                            <li><a title="" href="#" class="">oExam产品使用指南：<span class="">6</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        }*/
        //热门问题
        if(isset($rightShareParams['popularAsk']))
        {
    ?>
            <div class="list_block item_name_01">
                <h1 class="main_title">
                    <div class="left"> <span class="icon"></span><?php echo L::getText('讨论最多的问题', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                </h1>
                <div class="content">
                    <div class="inner">
                        <ul>
                        <?php
                            foreach($rightShareData['concernedProblem'] as &$v)
                            {
                        ?>
                            <li style="overflow:hidden"><a title="<?php echo $v['c_title']; ?>" href="<?php echo ROOT_URL; ?>/question.php?a=questionDisplay&id=<?php echo $v['c_id']; ?>" class=""><?php echo Of_Com_CommonPackage::cutLenStr($v['c_title'], 20); ?></a></li>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
    <?php
        }
        //相关问题
        if(isset($rightShareParams['relatedAsk']) && isset($rightShareParams['relatedAsk']['id']))
        {
            $sql = "(SELECT
                `t_study_cmut_ask`.c_id,    /*当前问题ID*/
                IF(
                    `t_study_cmut_ask`.courseware_id <> '' AND (!@related_ask_key := 'courseware_id'),
                    `t_study_cmut_ask`.courseware_id,
                    IF(
                        `t_study_cmut_ask`.course_id <> '' AND (!@related_ask_key := 'course_id'),
                        `t_study_cmut_ask`.course_id,
                        IF(
                            `t_study_cmut_ask`.plan_id <> '' AND (!@related_ask_key := 'plan_id'),
                            `t_study_cmut_ask`.plan_id,
                            IFNULL(@related_ask_key := 'user_id' OR NULL, `t_study_cmut_ask`.user_id)    /*关联提问者ID*/
                        )
                    )
                ) related_ask_id
            FROM
                `t_study_cmut_ask`
            WHERE
                `t_study_cmut_ask`.c_id = '{$rightShareParams['relatedAsk']['id']}') `data`";

            $sql = "SELECT
                `t_study_cmut_ask`.c_id,    /*问题ID*/
                `t_study_cmut_ask`.c_title    /*问题标题*/
            FROM
                {$sql}, `t_study_cmut_ask`
            WHERE
                IF(
                    `data`.related_ask_id = '',
                    FALSE,
                    IF(
                        @related_ask_key = 'courseware_id',
                        `t_study_cmut_ask`.courseware_id = `data`.related_ask_id,
                        IF(
                            @related_ask_key = 'course_id',
                            `t_study_cmut_ask`.course_id = `data`.related_ask_id,
                            IF(
                                @related_ask_key = 'plan_id',
                                `t_study_cmut_ask`.plan_id = `data`.related_ask_id,
                                `t_study_cmut_ask`.user_id = `data`.related_ask_id
                            )
                        )
                    )
                )
            AND `t_study_cmut_ask`.c_id <> `data`.c_id    /*排除当前问题*/
            ORDER BY
                `t_study_cmut_ask`.create_tm DESC
            LIMIT 5";

            isset($db) || $db = new Of_Model;
            $temp = $db->sql($sql);
    ?>
            <div class="list_block item_name_01">
                <h1 class="main_title">
                    <div class="left"> <span class="icon"></span><?php echo L::getText('其它问题', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                    <div class="right"> <a title="<?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?>" href="<?php echo ROOT_URL; ?>/question.php" class="more_block ~none"> <span class="more_txt"><?php echo L::getText('更多', array('file'=>__FILE__, 'line'=>__LINE__));?></span> <span class="icon_more"></span> </a> </div>
                </h1>
                <div class="content">
                    <div class="inner">
                        <ul>
                        <?php
                            foreach($temp as &$v)
                            {
                        ?>
                            <li><a title="<?php echo $v['c_title']; ?>" href="<?php echo ROOT_URL; ?>/question.php?a=questionDisplay&id=<?php echo $v['c_id'] ?>" class=""><?php echo Of_Com_CommonPackage::cutLenStr($v['c_title'], 24); ?></a></li>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>
</div>
<script>
window.L.extension.injectLogin(function(){
    $.post(window.L._rootUrl + '/index.php?a=rightShare', {'rightShareParams' : <?php echo json_encode($rightShareParams); ?>}, function(response){
        $('#sidebar').html($(response).html());
    });
}, 'loginAfter');
</script>