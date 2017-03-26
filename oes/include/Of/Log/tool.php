<?php
if( !defined('Of_DIR') )
{
    require dirname(dirname(__FILE__)) . '/Of.php';
    $Of = Of::getInstance();
    $Of->boot('../../../config.inc.php');
    new Of_Log_tool;
}

class Of_Log_tool {
    public function __construct()
    {
        Of_Log_toolBaseClass::init();
        $temp = count($_POST) ? 'response' : 'printHtml';
        $this->$temp();
    }

    /**
     * 描述 : 返回日志列表
     * 作者 : Edgar.lee
     */
    public function getLogTable($params = array()) {
        if( isset($params['path']) )
        {
            $totalItems = isset($_POST['_pageTableStarterPrint']) && $_POST['_pageTableStarterPrint'] === '0' ? Of_Log_toolBaseClass::fileS($params['path']) : -1;
            $temp = Of_Log_toolBaseClass::fileS($params['path'], isset($_POST['_pageTableCurPage']) ? $_POST['_pageTableCurPage'] : 1, isset($_POST['_pageTablePageSize']) ? $_POST['_pageTablePageSize'] : 10);

            foreach($temp as $k => &$v)
            {
                $data[$k]['time'] = date('/Y/m/d H:i:m', $v['time']);
                $data[$k]['code'] = isset($v['environment']['code']) ? $v['environment']['code'] : $v['logType'];
                $data[$k]['file'] = $v['environment']['file'];
                $data[$k]['line'] = $v['environment']['line'];
                $data[$k]['message'] = $v['environment']['message'];
                $data[$k]['detaile'] = htmlspecialchars(print_r($v['environment'], true));
            }
        } else {
            $totalItems = -1;
            $data = array();
        }

        $config = array(
            '时间',
            '类型',
            '文件',
            '行数',
            '信息',
            '详细',
            '_attr' => array(
                'tbodyConfig' => array(
                    array(
                        'value' => 'time'
                    ),
                    array(
                        'value' => 'code'
                    ),
                    array(
                        'value' => 'file'
                    ),
                    array(
                        'value' => 'line'
                    ),
                    array(
                        'value' => 'message'
                    ),
                    array(
                        'className' => 'center',
                        'addHtml'   => '<input name="radio" type="radio" /><div style="display:none;">{`detaile`}</div>'
                    )
                ),
                'data' => $data,
                'params' => $params,
                'totalItems' => $totalItems,

                //以下四个变量为高效写法(推荐)
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => __CLASS__,
                'function' => __FUNCTION__,
            )
        );

        return Of_Com_CommonPackage::pageTable($config);
    }

    /**
     * 描述 : 响应请求
     * 作者 : Edgar.lee
     */
    private function response() {
        if( isset($_POST['type']) )
        {
            switch( $_POST['type'] )
            {
                case 'getDir':                //获取目录(带状态)
                    $dirList = Of_Log_toolBaseClass::getDir($_POST['path'], $_POST['logType']);
                    if( is_array($dirList) )    //成功
                    {
                    }
                    echo json_encode(array(
                        'state' => is_array($dirList),
                        'data'   => $dirList
                    ));
                    break;
            }
        }
    }

    /**
     * 描述 : 打印html
     * 作者 : Edgar.lee
     */
    private function printHtml() {
        Of_View::printHead(array());
?>

<style>
body{ background-color:#FFFFFF; font-family:宋体;}
label{ cursor:pointer;}
a:link{ text-decoration:none;}
a:hover{ text-decoration:underline; cursor:pointer;}
.yellowBg{ background-color:#FFFFCC;}
.clear{ clear:both;}
.center{ text-align:center;}

/*工具条*/
.tool{ overflow:hidden; width:100%; border:1px solid #CCC; margin-bottom:5px;}
.url{ float:left; word-break:keep-all; white-space:nowrap;}
.url b{ border:solid #CCCCCC; border-width:0 1px; cursor:pointer; padding-left:3px; display:inline-block; margin:3px 0;}

/*磁盘区*/
.disk{ border:1px solid #CCC; padding-bottom:10px; margin-bottom:5px;}
.dir{ position:relative; overflow:hidden; cursor:pointer; float:left; width:100px; height:100px; border:1px solid; margin:10px 0 0 10px;}
.dir font{ position:absolute; top:25px; left:40px; font-size:40px;}
.dir div{ float:right; display:none; overflow:hidden; width:10px; height:10px; border-width:0px 0px 1px 1px; border-style:solid;}
.dir span{ word-break:break-all; word-wrap:break-word;}
.folder .file{ display:none;}    /*是文件夹*/
.file .folder{ display:none;}    /*是文件*/

/*浮动层*/
.floatPre{ margin:0px; padding:5px; display:none; position:absolute; height:90%; width:95%; background-color:#FFF; z-index:1; overflow:auto; border:1px dashed #000; filter:alpha(opacity=80); opacity:0.8;}
</style>
</head>

<body>
<!-- 功能栏 -->
<div class="nav">
    <label><input type="radio" value="php" onClick="toolObj.tabSwitch(this)" checked />php</label>
    <label><input type="radio" value="sql" onClick="toolObj.tabSwitch(this)" />sql</label>
    <label><input type="radio" value="js" onClick="toolObj.tabSwitch(this)" />js</label>
</div>
<!-- php -->
<div id="php">
    <!-- 浮动层 -->
    <pre class="floatPre"></pre>
    <!-- 工具条 -->
    <div class="tool">
        <span class="url">
            &nbsp;年份
            <select onChange="toolObj.getDir(this.value)">
                <option value="">请选择</option>
                <?php
                    if( is_array($years = Of_Log_toolBaseClass::getDir('', 'php')) )
                    {
                        foreach($years as $k => &$v)
                        {
                            $temp = substr($k, 1);
                            echo "<option value='{$k}'>{$temp}</option>";
                        }
                    }
                ?>
            </select>
            <b onClick="toolObj.getDir('..')">..</b>
            <span class="urlBar"></span>
        </span>
        <div class="clear"></div>
    </div>
    <!-- 目录结构 -->
    <div class="disk">
        <!--<div class="dir folder">
            <font class="folder">D</font>
            <font class="file">F</font>
            <span>地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址址地址址地址址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地</span>
        </div>
        <div class="dir file">
            <font class="folder">D</font>
            <font class="file">F</font>
        </div>-->
        <div class="clear"></div>
    </div>
    <!-- 日志区 -->
    <?php echo $this->getLogTable(); ?>
</div>
<!-- sql -->
<div id="sql" style="display:none;">
    <!-- 浮动层 -->
    <pre class="floatPre"></pre>
    <!-- 工具条 -->
    <div class="tool">
        <span class="url">
            &nbsp;年份
            <select onChange="toolObj.getDir(this.value)">
                <option value="">请选择</option>
                <?php
                    if( is_array($years = Of_Log_toolBaseClass::getDir('', 'sql')) )
                    {
                        foreach($years as $k => &$v)
                        {
                            $temp = substr($k, 1);
                            echo "<option value='{$k}'>{$temp}</option>";
                        }
                    }
                ?>
            </select>
            <b onClick="toolObj.getDir('..')">..</b>
            <span class="urlBar"></span>
        </span>
        <div class="clear"></div>
    </div>
    <!-- 目录结构 -->
    <div class="disk">
        <!--<div class="dir folder">
            <font class="folder">D</font>
            <font class="file">F</font>
            <span>地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址址地址址地址址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地</span>
        </div>
        <div class="dir file">
            <font class="folder">D</font>
            <font class="file">F</font>
        </div>-->
        <div class="clear"></div>
    </div>
    <!-- 日志区 -->
    <?php echo $this->getLogTable(); ?>
</div>
<!-- js -->
<div id="js" style="display:none;">
    <!-- 浮动层 -->
    <pre class="floatPre"></pre>
    <!-- 工具条 -->
    <div class="tool">
        <span class="url">
            &nbsp;年份
            <select onChange="toolObj.getDir(this.value)">
                <option value="">请选择</option>
                <?php
                    if( is_array($years = Of_Log_toolBaseClass::getDir('', 'js')) )
                    {
                        foreach($years as $k => &$v)
                        {
                            $temp = substr($k, 1);
                            echo "<option value='{$k}'>{$temp}</option>";
                        }
                    }
                ?>
            </select>
            <b onClick="toolObj.getDir('..')">..</b>
            <span class="urlBar"></span>
        </span>
        <div class="clear"></div>
    </div>
    <!-- 目录结构 -->
    <div class="disk">
        <!--<div class="dir folder">
            <font class="folder">D</font>
            <font class="file">F</font>
            <span>地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址址地址址地址址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地</span>
        </div>
        <div class="dir file">
            <font class="folder">D</font>
            <font class="file">F</font>
        </div>-->
        <div class="clear"></div>
    </div>
    <!-- 日志区 -->
    <?php echo $this->getLogTable(); ?>
</div>

<script>
var toolObj = {
    //切换功能
    'tabSwitch' : function(thisObj){
        $(thisObj).parent().siblings().children('input').prop('checked', false)
                  .end().end().end().prop('checked', true);
        $('#' + thisObj.value).siblings('div[id]').hide()
                   .end().show();
    },

    //获取目录结构
    'getDir' : function(path, thisObj){
        var logType = $('.nav input:checked').val();
        var showPageObj = $('#' + logType);    //当前操作界面
        var urlBarObj = showPageObj.find('.urlBar');                 //地址栏
        var diskObj = showPageObj.find('.disk');                     //目录显示区
        var responseFun = function(response){                        //响应方法
            if(response.state === true)    //创建成功
            {
                var dirName = '';    //目录名
                for(var i in response.data)
                {
                    dirName = i.substr(path.length + 1);
                    diskObj.children('.clear').before('<div title="' + dirName + '" class="dir' + (response.data[i] ? ' folder' : ' file') + '" onclick="toolObj.dirClick(this)">' +
                        '<font class="folder">D</font>' +
                        '<font class="file">F</font>' +
                        '<span>' + dirName + '</span>' +
                    '</div>');
                }
                window.L.openCom('tip')('加载完成');
            } else {
                window.L.openCom('tip')(response.data);
            }
        };

        //界面初始化
        diskObj.children('.dir').remove();                //清空目录

        //请求数据
        if( $.trim(path) === '' )                 //空目录
        {
            urlBarObj.html('');
        } else if( path.substr(0, 1) === '/' )    //切换语言包
        {
            urlBarObj.html(path);
            window.L.openCom('tip')('正在加载', false);
            $.post('?', {'type' : 'getDir', 'path' : path, 'logType' : logType}, responseFun, 'json');
        } else if( path === '..' ) {              //上级目录
            path = urlBarObj.html();
            if( (temp = path.lastIndexOf('/')) > -1 )    //读取上级目录
            {
                window.L.openCom('tip')('正在加载', false);
                temp > 0 && (path = path.substr(0, temp));
                urlBarObj.html(path);
                $.post('?', {'type' : 'getDir', 'path' : path, 'logType' : logType}, responseFun, 'json');
            }
        } else if( path === '.' ) {               //刷新目录
            if( (path = $.trim(urlBarObj.html())) !== '' )
            {
                window.L.openCom('tip')('正在加载', false);
                $.post('?', {'type' : 'getDir', 'path' : path, 'logType' : logType}, responseFun, 'json');
            }
        } else {                                  //常规目录
            path = urlBarObj.html() + '/' + path;
            urlBarObj.html(path);
            window.L.openCom('tip')('正在加载', false);
            $.post('?', {'type' : 'getDir', 'path' : path, 'logType' : logType}, responseFun, 'json');
        }
    },

    //点击目录
    'dirClick' : function(thisObj){
        var logType = $('.nav input:checked').val();
        var showPageObj = $('#' + logType);    //当前操作界面
        var urlBarObj = showPageObj.find('.urlBar');    //地址栏
        var dirName = (thisObj = $(thisObj)).find('span').html();

        if(thisObj.hasClass('folder'))    //文件夹
        {
            toolObj.getDir(dirName);
        } else {                          //文件
            var pageTableObj = $('table[_pagetabledataset]', showPageObj).get(0);
            var params = window.L.extension.pageTable.classObj.params(pageTableObj);
            thisObj.siblings('.dir').removeClass('yellowBg');
            thisObj.addClass('yellowBg');

            params.path = urlBarObj.html() + '/' + dirName;
            window.L.extension.pageTable.classObj.params(pageTableObj, params, true);
        }
    },

    //鼠标点击TR标签触发
    'clickTr' : function(){
        var floatPreObj = $('#' + $('.nav input:checked').val() + ' .floatPre');    //当前浮动层
        if( this.getElementsByTagName('td').length > 1 )
        {
            floatPreObj.html($('td:last input', this).prop('checked', true).siblings('div').html()).show();
        }
    },

    //隐藏浮动层
    'hidePre' : function(){
        $('#' + $('.nav input:checked').val() + ' .floatPre').hide();
    },
};

$(document).keypress(function(event){
    event.keyCode === 27 && toolObj.hidePre();
});
window.L.strVar('L.extension.pageTable.callback.initLoadList[]', window.L.strVar('L.extension.pageTable.callback.afterLoadList[]', function(pageTableObj, pageTableClass){
    $('tbody > tr', pageTableObj).click(toolObj.clickTr).each(function(){
        $(this).css('cursor', 'pointer');
    });
}));
</script>
<?php
        Of_View::printHead(false);
    }
}