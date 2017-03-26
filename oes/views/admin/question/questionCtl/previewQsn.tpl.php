<?php
$this->printHead(
    array(
        'title' => array('title'=>'预览试题', 'file'=>__FILE__, 'line'=>__LINE__)
         ,'css'=>array('/paper/main.css','/paper/layout.css')
        ,'js' => array('/admin/common.js')    //加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
<?php
$qsn_display = new qsnDisplay_qsnDisplayCtl();
$options = array('is_show_guide'=>true,'is_show_answer'=>true);
$qsn_display->displaySingleQuestion($this->qsn_info,$options);
?>