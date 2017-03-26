<?php
$this->printHead(
    array(
        'title' => array('title'=>'课程课件-添加课程', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/admin/index/backhead.css',
            '/admin/course/course.css',
            '/editor.css'
        )
        ,'js' => array(
            '/admin/course/courseware/addCourseware.js',
            '/admin/tag/tag.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<script>
window.browseHome = '<?php echo Of::config('_browseHome'); ?>';
window.coursewareAttFolder = '<?php echo Of::config('_att.courseware'); ?>';
</script>
<div class="box block_5"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 

        <!-- // 顶部 -->
        <div class="header">
        <?php 
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/course/header.php';
        ?>
        </div>
        
        <!-- //  -->
        <div class="panel_1 con_input">
            <div class="title"><span><?php echo L::getText('课件数据', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <div class="col_left" style="width:50%;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <colgroup>
                        <col style="width:80px;" />
                        <col style="" />
                        </colgroup>
                        <tr>
                            <td><?php echo L::getText('课件名称：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input3 auto_width" id="w_name" type="text" value="<?php echo $this->coursewareValueArr['w_name']; ?>" />
                                <input type="hidden" id="w_id" value="<?php echo $this->coursewareValueArr['w_id']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课件学分：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input1 auto_width" id="w_point" type="text" value="<?php echo $this->coursewareValueArr['w_point']; ?>" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课件来源：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input1 auto_width" w_source_id="<?php echo $this->coursewareValueArr['w_source']; ?>" id="w_source" type="text" value="<?php echo $this->coursewareValueArr['w_source_name']; ?>" readonly="readonly" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('数据分组：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td><?php echo admin_user_permissions::dataStratifiedHtml(isset($_GET['id']) ? $_GET['id'] : null, 't_courseware'); ?></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="col_right">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <colgroup>
                        <col style="width:110px;" />
                        <col style="" />
                        </colgroup>
                        <tr>
                            <td><?php echo L::getText('所需积分：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input2 ~auto_width" id="w_credit" type="text" value="<?php echo $this->coursewareValueArr['w_credit']; ?>" />
                                <?php echo L::getText('(0代表不要积分即可观看)', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课件学时：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input2" type="text" id="coursewareHours" value="<?php echo $this->coursewareValueArr['w_length']; ?>" /><?php echo L::getText('分钟', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                <!-- JS::点击绑定 /admin/course/courseware/addCourseware.js 计算学时点击按钮 -->
                                <input type="button" value="<?php echo L::getText('计算课件学时', array('file'=>__FILE__, 'line'=>__LINE__)); ?>" id="calculationHours" />
                                <span id="ofPlayerHours" style="width:1px; height:1px; position:absolute; top:0px; left:0px;"><!-- 学时计算播放器 --></span>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课件分类：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <input class="input3 auto_width" w_category_id="<?php echo $this->coursewareValueArr['w_category']; ?>" id="w_category" type="text" value="<?php echo $this->coursewareValueArr['w_category_name']; ?>" readonly="readonly" />
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="clear"></div>
                <div class="col_full" id="tabs_course">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <colgroup>
                        <col style="width:110px;" />
                        <col style="" />
                        </colgroup>
                        <tr>
                            <td style="height:50px;">
                                <a id="addTag" class="icon_link" href="#"><?php echo L::getText('添加标签', array('file'=>__FILE__, 'line'=>__LINE__)); ?>&nbsp;+</a>
                                <div id="qsn_add_tag_a" style="overflow:hidden; margin-top:5px;"></div></td>
                            <td id="tagList">
                                <?php
                                    foreach($this->coursewareValueArr['tabList'] as $k => &$v)
                                    {
                                ?>
                                        <span id="tag_<?php echo $v['tag_id']; ?>"><a href="#" onclick="return false;" ><?php echo $v['tag_name']; ?></a><a class="icon_del" onclick="delQsnAddTag('<?php echo $v['tag_id']; ?>')"></a></span>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?php echo L::getText('课件类型：', array('file'=>__FILE__, 'line'=>__LINE__)); ?></td>
                            <td>
                                <div class="tab_title">
                                    <!-- JS::单选按钮绑定 /admin/course/courseware/addCourseware.js 课件类型单选点击事件 -->
                                    <label>
                                        <input class="radiobox" name="coursewareType" type="radio" value="none" />
                                        <?php echo L::getText('无', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                    </label>
                                    <label>
                                        <input class="radiobox" name="coursewareType" type="radio" value="flv" />
                                        <?php echo L::getText('FLV', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                    </label>
                                    <label>
                                        <input class="radiobox" name="coursewareType" type="radio" value="swf" />
                                        <?php echo L::getText('SWF', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                    </label>
                                    <label>
                                        <input class="radiobox" name="coursewareType" type="radio" value="mp3" />
                                        <?php echo L::getText('MP3', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                    </label>
                                    <?php
                                        if( !getLicenceInfo('Disable', 'customCoursewareYouku') )    //支持youku
                                        {
                                    ?>
                                        <label>
                                            <input class="radiobox" name="coursewareType" type="radio" value="youku" />
                                            <?php echo L::getText('优酷', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                        </label>
                                    <?php
                                        }
                                        if( !getLicenceInfo('Disable', 'customCoursewareImg') )    //支持img
                                        {
                                    ?>
                                        <label>
                                            <input class="radiobox" name="coursewareType" type="radio" value="img" />
                                            <?php echo L::getText('图片', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                        </label>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr >
                            <td colspan="3">
                                <div id="coursewareTypeUploadBlock" class="tab_content" style="display:none;">
                                    <div class="content">
                                        <div class="thumb_default_upload thumb_default_doc none"></div>
                                        <div class="right">
                                            <div><!-- 课件类型对应标题 --></div>
                                            <div style='margin:10px auto;'>
                                                <!-- JS::单选按钮绑定 /admin/course/courseware/addCourseware.js 课件附件本地或远程附件单选点击事件 -->
                                                <label><input class="radiobox" name="localOrRemote" type="radio" value="local" checked="checked" /><?php echo L::getText('本地上传', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label><label><input class="radiobox" name="localOrRemote" type="radio" value="remote" /><?php echo L::getText('指定路径', array('file'=>__FILE__, 'line'=>__LINE__)); ?></label>：
                                                <div id="coursewareUploadProgress" style="width:500px; float:right;"><!-- 上传进度条 -->
                                                </div>
                                                <!-- JS::焦点及失焦绑定 /admin/course/courseware/addCourseware.js 绑定课件类型远程路径的焦点及失焦事件 -->
                                                <input type="text" id="remoteUrl" style="display:none; width:180px; border:1px solid #cccccc;" coursewareType="<?php echo $this->coursewareValueArr['w_type']; ?>" value="<?php echo htmlspecialchars($this->coursewareValueArr['w_video']); ?>" />
                                                <!-- JS::从服务器选择媒体 /admin/course/courseware/addCourseware.js 绑定从服务器选择媒体点击事件 -->
                                                <a id="selectMediaFile" class="btn_txt" href="#"><?php echo L::getText('选择媒体', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                                                <!-- JS::上传组件绑定 /admin/course/courseware/addCourseware.js 初始化课件上传 -->
                                                <input type="file" id="coursewareUpload" style="display:none;" />
                                            </div>
                                            <!-- JS::删除课件绑定 /admin/course/courseware/addCourseware.js 删除课件附件 -->
                                            <a id="delCoursewareAtt" class="btn_txt" href="#"><span class="icon_del"></span><?php echo L::getText('删除课件', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a>
                                        </div>
                                        <div>
                                            <?php echo L::getText('从文档中自动转换的图片：', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                                            <?php echo $this->coursewareImgAttPageTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- // 讲义  -->
        <div class="panel_1 con_input">
            <div class="title"><span>讲义</span></div>
            <div class="content"> 
                <!-- // tab menu -->
                <div class="con_tab" id="tabs1">
                    <div class="tab_title">
                        <a class="current" >
                            <label>
                                <input class="radiobox" name="lectureDiv" type="radio" value="lectureOneDiv" />
                                <?php echo L::getText('图文混合型', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                            </label>
                        </a>
                        <a>
                            <label>
                                <input class="radiobox" name="lectureDiv" type="radio" value="lectureTwoDiv" />
                                <?php echo L::getText('图片型(可创建幻灯片)', array('file'=>__FILE__, 'line'=>__LINE__)); ?>
                            </label>
                        </a>
                    </div>
                    <div class="clear"></div>
                    <div id="lectureOneDiv" class="tab_content"><!-- // tab --> 
                        <!-- // 编辑器 -->
                        <textarea id="lectureText" style="width:960px; height:130px; display:none;" coursewareType="<?php echo $this->coursewareValueArr['lectureType']; ?>"><?php echo htmlspecialchars($this->coursewareValueArr['w_des_h']); ?></textarea>
                    </div>
                    <div id="lectureTwoDiv" class="tab_content" style="display:none;"><!-- // tab --> 
                        <!-- //  -->
                        <div class="toolbar_top">
                            <div class="left">
                                <span class="icon_add no_margin" title=""></span>
                                <!-- JS::上传组件 /admin/course/courseware/addCourseware.js 讲义图片类型上传 -->
                                <input type="file" id="lectureImgAttUpload" style="display:none;" />
                            </div>
                            <div class="right"> 
                                <!-- // 右侧内容 --> 
                            </div>
                        </div>
                        
                        <!-- // 数据 -->
                        <div class="table_content">
                            <?php echo $this->lectureImgAttPageTable; ?>
                            <div id="lectureUploadProgress"><!-- 上传进度条 --></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- // 主按钮区(分左中右) -->
        <div class="button_area_search">
            <div class="center"> <a id="save" href="#" class="btn" ><?php echo L::getText('保存', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a href="#" class="btn" onclick="history.back()" ><?php echo L::getText('关闭', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end -->
</div>
<!-- // box end -->
<script src="<?php echo ROOT_URL; ?>/include/oFileManager/include/player/ofPlayerClass.js"></script>
