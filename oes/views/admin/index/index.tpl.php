<?php
$this->printHead(
    array(
        'title' => array('title'=>'首页', 'file'=>__FILE__, 'line'=>__LINE__)
        ,'css'=>array(
			'/admin/index/backhead.css',
			'/admin/index/backindex.css',
        )
        ,'js' => array()
    )
);
?>

<body class="home_page">
<div class="box">
    <div class="box_inner"> 
        <!-- // 顶部 -->
        <div class="header">
            <?php 
            require VIEW_DIR . '/admin/header.php';
        ?>
        </div>
        <div id="grid-content" class="panel_2 style_2">
            <?php
                foreach($dirList as $titleK => &$titleV)
                {
                    $titleV['itemsHtml'] = '';
                    foreach($titleV['list'] as $itemK => &$itemV)
                    {
                        $temp = array(parse_url($itemV), array());
                        if(isset($temp[0]['query']))
                        {
                            parse_str($temp[0]['query'], $temp[1]);
                        }
                        if(admin_user_permissions::urlCheck($temp[0]['path'], $temp[1]))
                        {
                            $titleV['itemsHtml'] .= '<a href="' . ADMIN_URL . $itemV . '">' .L::getText($itemK, array('file'=>__FILE__, 'line'=>__LINE__)). '</a>';
                        }
                    }
                    if($titleV['itemsHtml'] !== '')
                    {
                        echo "<div class='item_block block_1'>
                            <div class='block_inner'>
                                <div class='content'>
                                    <h1><span class='index_icon_1'><img src='{$titleV['personalized']['icon']}' /></span>" .L::getText($titleK, array('file'=>__FILE__, 'line'=>__LINE__)). "</h1>
                                    <div class='menu_inner'>{$titleV['itemsHtml']}</div>
                                </div>
                            </div>
                        </div>";
                    }
                }
            ?>
        </div>
        
        <!-- // footer -->
        <?php require VIEW_DIR . '/admin/footer.php'; ?>
    </div>
    <!-- // box_inner end --> 
    
</div>
<!-- // box end --> 

<script type="text/javascript">
	$('#exp_div').hide();
    $("#additem").click(function(e){
        var _item = $('<div>\
                <h3>New Item</h3>\
                <p>Foo</p>\
                <p><a href="#">DELETE</a></p>\
            </div>')
            .hide()
            .addClass(Math.random() > 0.3 ? 'wn' : 'wl')
            .addClass(Math.random() > 0.3 ? 'hn' : 'hl');
        vg.prepend(_item);
        vg.vgrefresh(null, null, null, function(){
            _item.fadeIn(300);
        });
        hsort_flg = true;
    });

//]]>
</script> 
