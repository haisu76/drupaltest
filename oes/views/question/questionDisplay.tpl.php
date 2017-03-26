<?php
$this->printHead(
    array(
        'title'=>array('title'=>'问答列表', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/mainindex.css',
            '/question_questionDisplay.css',
        )
        ,'js'=>array(
            '/question/questionDisplay.js'
        )
    )
);
?>

<div id="container" class="box block_12">
    <!-- // header -->
    <?php require VIEW_DIR . '/index/head.tpl.php'; ?>
    <!-- // header end -->

    <div class="box_inner"> 

        <div id="menu" class="none">This is the Menu</div>

        <!-- // main：当layout_full_width样式启用时，侧边栏slidbar是隐藏的 -->
        <div id="main_body" class="exam_paper ~layout_full_width"> 
            <!-- // 侧边列 -->
            <?php
                index::rightShare(array(
                    'popularAsk' => true,
                    'relatedAsk' => array('id' => $_GET['id'])
                ));
            ?>
            
            <!-- // main content -->
            <div id="content">
                <div class="inner">
                    <div class="main_div course_detail"> 
                        <!-- // 问答 -->
                        <div class="main_div faq_list"> 
                            <!-- // 问答 -->
                            <div class="main_div faq_list">
                                <h1 class="main_title">
                                    <div class="left"> <span class="icon"></span><?php echo L::getText('问答', array('file'=>__FILE__, 'line'=>__LINE__));?></div>
                                    <div class="right"> <a href="#" class="icon_link" onclick="window.history.back(); return false;" ><span class="icon_back"></span><?php echo L::getText('返回', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                                </h1>
                                
                                <!-- // 列表项目 -->
                                <div class="list_item">
                                    <h1 class="none">TITLE TEXT</h1>
                                    <div class="content"> 
                                        <!-- // Layout_Left -->
                                        <div class="qa_layout_sidebar"> 
                                            <!-- // 左边icon --> 
                                            <a class="icon_list" href="#" title="<?php echo $this->askData['ask_user_name']; ?>"> <img width="48" src="<?php echo ROOT_URL, !isset($this->askData['ask_icon']) ? '/images/avatar/avatar_006.jpg' : '/include/oFileManager/fileExtension.php?fileUrl=' . Of::config('_browseHome') . $this->askData['ask_icon']; ?>"> </a> </div>
                                        
                                        <!-- // Layout_Right -->
                                        <div class="qa_layout_content"> 
                                            
                                            <!-- // 第2行：标题 --> 
                                            <span class="title">
                                            <div class="left">
                                                <h2><?php echo $this->askData['c_title']; ?></h2>
                                            </div>
                                            <div class="right">
                                                <dl class="dd">
                                                    <dt><?php echo L::getText('状态：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                    <dd><span class="q_status_0<?php echo $this->askData['status']; ?>"></span></dd>
                                                </dl>
                                                <dl class="dd">
                                                    <dt><?php echo L::getText('回答数：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                    <dd class="s_info_text"><?php echo $this->askData['answer_num']; ?>人</dd>
                                                </dl>
                                            </div>
                                            </span> 
                                            
                                            <!-- // 第3行 -->
                                            <div class="col_LR sub_title">
                                                <div class="inner">
                                                    <div class="sidebar">
                                                        <h2>
                                                        <?php
                                                            $temp = array(
                                                                'url' => '',    //跳转路径
                                                                'params' => '',    //跳转参数
                                                                'adoptedType' => ''    //关联类型
                                                            );
                                                            if($this->askData['courseware_id'])
                                                            {
                                                                if($temp['adoptedType'] === '')
                                                                {
                                                                    $temp['url'] = 'courseware.php?a=index';
                                                                    $temp['adoptedType'] = '课件';
                                                                }
                                                                $temp['params'] .= '&w_id=' . $this->askData['courseware_id'];
                                                            }
                                                            if($this->askData['course_id'])
                                                            {
                                                                if($temp['adoptedType'] === '')
                                                                {
                                                                    $temp['url'] = ROOT_URL . '/course.php?a=courseDetail';
                                                                    $temp['adoptedType'] = '课程';
                                                                }
                                                                $temp['params'] .= '&c_id=' . $this->askData['course_id'];
                                                            }
                                                            if($this->askData['plan_id'])
                                                            {
                                                                if($temp['adoptedType'] === '')
                                                                {
                                                                    $temp['url'] = ROOT_URL . '/plan.php?a=planDetail';
                                                                    $temp['adoptedType'] = '计划';
                                                                }
                                                                $temp['params'] .= '&p_id=' . $this->askData['plan_id'];
                                                            }
                                                            if($temp['adoptedType'])
                                                            {
                                                                echo '<a class="" href="', $temp['url'], $temp['params'], '">', L::getText($temp['adoptedType'], array('file'=>__FILE__, 'line'=>__LINE__)), ' : ', $this->askData['adopted_name'], '</a>';
                                                            }
                                                        ?></h2>
                                                    </div>
                                                    
                                                    <!-- // content -->
                                                    <div class="con">
                                                        <dl class="dd">
                                                            <dt><?php echo L::getText('提问时间：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                        </dl>
                                                        <dl class="dd">
                                                            <dd><?php echo $this->askData['create_tm']; ?></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- // 问题的详细内容 -->
                                        <div class="q_detail"> <?php echo $this->askData['c_desc']; ?> </div>
                                        
                                        <!-- // 第4行 -->
                                        <div class="col_LR">
                                            <div class="inner">
                                                <div class="textareaHolder"><!-- // 文本框 -->
                                                    <div id="submitAnswer" class="textarea_inner">
                                                        <div style="background-color:#FFC; cursor:pointer;" name="quoteAnswer" title="点击取消引用" onclick="questionDisplayObj.quoteAnswer(this, false); return false;"></div>
                                                        <textarea class="input_default auto_width" rows=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="btn_area btn_autowidth"> <a class="btn3" href="#" onclick="questionDisplayObj.submitAnswer(this, '<?php echo $this->askData['c_id']; ?>'); return false;"><?php echo L::getText('提交回答', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                                            </div>
                                        </div>
                                        
                                        <!-- //  -->
                                        <div class="col_LR intro">
                                            <div class="inner"> 
                                                <!-- // 回答内容 -->
                                                <div class="qa_content">
                                                    <div class="tool">
                                                        <div class="left"></div>
                                                        <div class="right"> <a class="more_block more_qa ~more_qa_down more_qa_up none" href="#" title=""> <span class="more_txt"><?php echo L::getText('隐藏所有回答', array('file'=>__FILE__, 'line'=>__LINE__));?></span> <span class="icon"></span> </a> </div>
                                                    </div>
                                                    <div class="qa_detail ~none">                                                        
                                                        <!-- // 回答item -->
                                                        <?php
                                                            if($this->askData['adopted_id'])
                                                            {
                                                        ?>
                                                                <div class="qa_block qa_yes ~qa_no"><!-- // qa_yes / qa_no属附加样式，定义了对应的颜色 -->
                                                                    <div class="left"></div>
                                                                    <div class="right">
                                                                        <div class="inner">
                                                                            <div class="qa_text">
                                                                                <dl class="dd qa_status">
                                                                                    <dt></dt>
                                                                                    <dd><span class="q_status_01"></span><?php echo L::getText('已解决', array('file'=>__FILE__, 'line'=>__LINE__));?></dd>
                                                                                </dl>
                                                                                <div class="clear"></div>
                                                                                <span style="background-color:#FFC"><?php echo $this->askData['quote_answer_desc']; ?></span>
                                                                                <font style="display:block;"><?php echo $this->askData['adopted_desc']; ?></font>
                                                                            </div>
                                                                            <div class="qa_con">
                                                                                <dl class="dd">
                                                                                    <dt><?php echo L::getText('回答者：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                                                    <dd><?php echo $this->askData['adopted_user_name']; ?></dd>
                                                                                </dl>
                                                                                <dl class="dd">
                                                                                    <dt><?php echo L::getText('回答时间：', array('file'=>__FILE__, 'line'=>__LINE__));?></dt>
                                                                                    <dd><?php echo $this->askData['adopted_create_tm']; ?></dd>
                                                                                </dl>
                                                                                <dl class="dd float_right no_margin">
                                                                                    <dt></dt>
                                                                                    <dd>
                                                                                        <div class="btn_area btn_autowidth"> <a class="btn3 ~no_margin" href="#" key="<?php echo $this->askData['adopted_id']; ?>" onmouseover="questionDisplayObj.answerStatusMouseEffect(this, <?php echo $this->askData['permissions']; ?>, true, true);" onmouseout="questionDisplayObj.answerStatusMouseEffect(this, <?php echo $this->askData['permissions']; ?>, true, false);" onclick="questionDisplayObj.updataAnswerStatus(this, <?php echo $this->askData['permissions']; ?>, true); return false;"><span class="q_status_03"></span><?php echo L::getText('已采纳', array('file'=>__FILE__, 'line'=>__LINE__));?></a> <a class="btn3 ~no_margin" href="#" onclick="questionDisplayObj.quoteAnswer(this, '<?php echo $this->askData['adopted_id']; ?>'); return false;"><?php echo L::getText('引用并回答', array('file'=>__FILE__, 'line'=>__LINE__));?></a> </div>
                                                                                    </dd>
                                                                                </dl>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php
                                                            }
                                                        ?>
                                                        
                                                        <!-- //////////////////////////////////////  --> 
                                                        
                                                        <!-- //  -->
                                                        <div class="title faq_title">
                                                            <div class="left">
                                                                <h2><?php echo L::getText('其它回答', array('file'=>__FILE__, 'line'=>__LINE__));?></h2>
                                                            </div>
                                                            <div class="right"></div>
                                                        </div>
                                                        
                                                        <!-- // 回答item -->
                                                        <?php echo $this->getAnswerPageTable; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- // contnet end --> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- // main_body end --> 
        
    </div>
    <!-- // box_inner -->
    <?php require VIEW_DIR . '/index/foot.tpl.php'; ?>
</div>
