<?php
$this->printHead(
    array(
        'title' => array('title'=>'在线问答-问答搜索', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
            '/admin/index/backhead.css',
			'/admin/qa/qa.css'
        )
        ,'js'=>array(
            '/admin/qa/qaSearch.js',
            '/admin/tag/tag.js',
            '/admin/manyTrees.js'
        )
    )
);
?>
<div class="box block_4"><!-- // block_## 序号对应全局的颜色定义 -->
    <div class="box_inner"> 
        
        <!-- // 顶部 -->
        <div class="header">
        <?php 
            require VIEW_DIR . '/admin/header.php';
            require VIEW_DIR . '/admin/qa/header.php';
        ?>
        </div>
        
        <!-- // 搜索过滤 -->
        <div class="panel_1 con_search">
            <div class="title"><span><?php echo L::getText('搜索问答', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content">
                <form onsubmit="qaSearchObj.searchSubmit(); return false;" id="searchForm">
                    <div class="search">
                    
                        <div class="search_item">
                            <h1><?php echo L::getText('用户名', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input3 ~auto_width" type="text" name="textfield" id="username" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('包含内容', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input3 ~auto_width" type="text" name="textfield" id="contentLike" />
                        </div>
                        <div class="search_item">
                            <h1><?php echo L::getText('提交时间', array('file'=>__FILE__, 'line'=>__LINE__)); ?></h1>
                            <input class="input3 ~auto_width" type="text" name="textfield" id="min_create_tm" />
                        </div>
                        <div class="search_item">
                            <h1>&nbsp;</h1>
                            <input class="input3 ~auto_width" type="text" name="textfield" id="max_create_tm" />
                        </div>
                    </div><div style=" clear:both;"></div>
                    
                    <!-- // 高级搜索 -->
                    <div class="button_area_search" style="float:left;">
                        <div class="inner_box"> <a onclick="qaSearchObj.searchSubmit(); return false;" class="btn2" href="#"><?php echo L::getText('搜索', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> <a onclick="document.getElementById('searchForm').reset(); return false;" class="btn2" href="#"><?php echo L::getText('重置', array('file'=>__FILE__, 'line'=>__LINE__)); ?></a> </div>
						<div style="clear:both;"></div>
                    </div>
                    <input type="submit" style=" position:absolute; left:-1000px; width:0px;">
                </form>
            </div>
        </div>
        
        <!-- // 表格数据 -->
        <div class="panel_1 con_table">
            <div class="title"><span><?php echo L::getText('问题列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content"> 
                <?php echo $this->questionListPageTable; ?>
            </div>
            <div class="title"><span><?php echo L::getText('答案列表', array('file'=>__FILE__, 'line'=>__LINE__)); ?></span></div>
            <div class="content"> 
                <?php echo $this->answerListPageTable; ?>
            </div>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
    
</div>