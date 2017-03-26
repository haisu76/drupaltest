<?php
$this->printHead(
    array(
        'title' => array('title'=>'题库/试卷/考试-试卷管理', 'file'=>__FILE__, 'line'=>__LINE__)
       ,'css'=>array(                  //加载css
            '/main.css'
        )
        ,'js' => array(
            '/admin/common.js'
            ,'/admin/manyTrees.js'
            ,'/admin/paper/manual_marking.js'
        )//加载js,注:js都将在页面底部加载,默认将加载'jquery.js'
    )
);
?>
试题内容：
<?php
echo htmlspecialchars_decode($this->qsn_info['qsn_content']);
?>
<?php
echo $this->marking_question_list;
?>