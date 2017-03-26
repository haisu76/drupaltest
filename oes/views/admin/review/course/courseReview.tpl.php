<?php
$this->printHead(
    array(
        'title' => array('title'=>'讲师评定-课程评定', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css' => array(
            '/admin/index/backhead.css',
			'/admin/review/review.css'
        )
        ,'js' => array(
            '/admin/review/course/courseReview.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="box block_3"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        
        <!-- // 顶部 -->
        <div class="header">
        <?php 
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/review/header.php';
        ?>
        </div>
        
        <!-- //  -->
        <div class="panel_1 con_search">
            <h2 class="title">
                <div class="left"> <a href="#" class="icon_link" onclick="window.history.back(); return false;" ><span class="icon_back"></span><?php echo L::getText('返回', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
                <div class="right"></div>
            </h2>
            <div class="content"> 
                <!-- //  -->
                <div class="main_div col_list_50 data_list_h ~data_list_v"> 
                    <!-- // data_list_h或v：横或纵向排列 -->
                    <dl>
                        <dt><?php echo L::getText('课程名称：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php echo $this->courseData['c_name']; ?></dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('课程分类：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php echo $this->courseData['desc_cn']; ?></dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('课程讲师：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php echo $this->courseData['teacher_name_list']; ?></dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('所需积分：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php echo $this->courseData['sum_w_credit']; ?>分</dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('课程学分：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php echo $this->courseData['sum_w_point'], L::getText('分', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('课程学时：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php echo $this->courseData['sum_w_length'], L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('进修选项：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php
                            switch($this->courseData['c_elective'])
                            {
                                case '1' :
                                    echo L::getText('必修', array('file'=>__FILE__, 'line'=>__LINE__));
                                    break;
                                case '2' :
                                    echo L::getText('选修', array('file'=>__FILE__, 'line'=>__LINE__));
                                    break;
                                default :
                                    echo L::getText('需要报名', array('file'=>__FILE__, 'line'=>__LINE__));
                                    break;
                            } ?></dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('学习时间：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd><?php echo $this->courseData['c_start_time']; ?>～<?php echo $this->courseData['c_end_time']; ?></dd>
                    </dl>
                    <dl>
                        <dt><?php echo L::getText('标签：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                        <dd> <?php echo $this->courseData['tag_list']; ?> </dd>
                    </dl>
                </div>
                
                <!-- // 搜索过滤 -->
                <form id="searchForm" onSubmit="courseReviewObj.searchSubmit(); return false;">
                    <div class="panel_1 con_search">
                        <div class="title"><span><?php echo L::getText('筛选', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
                        <div class="content data_list_h2 ~col_list_50 ~dt1">
                            <dl>
                                <dt><?php echo L::getText('用户名/用户姓名/ID/邮箱：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                <dd>
                                    <input class="input4 ~auto_width" type="text" id="user_data" value="" />
                                </dd>
                            </dl>
                            <dl>
                                <dt><?php echo L::getText('所属组：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></dt>
                                <dd>
                                    <input class="input4 ~auto_width" type="text" id="desc_cn" onClick="courseReviewObj.getGroupListTreeClickFun(this)" />
                                </dd>
                            </dl>
                        </div>
                    </div>
                    
                    <!-- // 搜索按钮 -->
                    <div class="btn_area align_center">
                        <div class="inner_box">
                            <a href="#" class="btn2" onclick="courseReviewObj.searchSubmit(); return false;" ><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <a href="#" class="btn2" onclick="document.getElementById('searchForm').reset(); return false;" ><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                            <input type="submit" style=" position:absolute; left:-1000px; width:0px;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('用户列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <?php echo $this->reviewCourseUserPageTable; ?>
            </div>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
    
</div>