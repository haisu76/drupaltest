<?php
require dirname(dirname(__FILE__)) . '/Of.php';
$Of = Of::getInstance();
$Of->boot('../../../config.inc.php');
Of_LanguagePacks_toolBaseClass::init();

//过滤参数
if(get_magic_quotes_gpc())
{
    $addslashesDeep = create_function('&$value, &$addslashesDeep', '
        if(is_array($value))
        {
            $valueBackUp = $value;
            foreach($valueBackUp as $k => &$v)
            {
                unset($value[$k]);
                $value[stripslashes($k)] = &$v;
                $addslashesDeep($v, $addslashesDeep);
            }
        } else {
            $value = stripslashes($value);
        }
    ');
    $addslashesDeep($_POST, $addslashesDeep);
}

//初始化参数
if( is_array($languagePacks = Of_LanguagePacks_toolBaseClass::getDir()) )
{
    unset($languagePacks['/default']);
} else {
    exit($languagePacks);
}

if( count($_POST) )    //请求数据
{
    switch( $_POST['type'] )
    {
        case 'createLanguagePage':    //创建语言包
            $temp = Of_LanguagePacks_toolBaseClass::create($_POST['name']);
            echo json_encode(array(
                'state' => $temp === true,
                'data'   => $temp
            ));
            break;
        case 'getDir':                //获取目录(带状态)
            $dirList = Of_LanguagePacks_toolBaseClass::getDir($_POST['path']);
            if( is_array($dirList) )    //成功
            {
                $temp = array(           //默认类型列表
                    'ignore'  => '',    //忽略列表
                    'key'     => '',    //键级状态
                    'page'    => '',    //页级状态
                    'global'  => '',    //全局状态
                );
                $_POST['discard'] === 'true' && $temp['discard'] = '';
                foreach($dirList as $k => &$v)
                {
                    $v = array(
                        'isDir' => $v,
                        'state' => $_POST['state'] === 'false' ? array() : Of_LanguagePacks_toolBaseClass::dirState($k, $temp)
                    );
                }
            }
            echo json_encode(array(
                'state' => is_array($dirList),
                'data'   => $dirList
            ));
            break;
        case 'getFile':               //获取文件信息
            $temp = &Of_LanguagePacks_toolBaseClass::translation($_POST['path'], null, array('global', 'discard'));
            echo json_encode(array(
                'state' => is_array($temp),
                'data'   => $temp
            ));
            break;
        case 'setFile':               //获取文件信息
            $_POST['data'] = json_decode($_POST['data'], true);
            $temp = &Of_LanguagePacks_toolBaseClass::translation($_POST['path'], $_POST['data'], array('global'));
            echo json_encode(array(
                'state' => ($_POST['data'] === false && is_string($temp)) || ($_POST['data'] !== false && $temp === true),
                'data'  => $temp
            ));
            break;
        case 'optimize':              //优化语言包
            echo json_encode(array(
                'state' => Of_LanguagePacks_toolBaseClass::optimize($_POST['path']) !== false
            ));
            break;
        case 'importDir':             //导入目录
            $temp = Of_LanguagePacks_toolBaseClass::import($_POST['path'], $_POST['data']);
            echo json_encode(array(
                'state' => $temp
            ));
            break;
        case 'textExport':            //导出文本
            $temp = Of_LanguagePacks_toolBaseClass::optimize($_POST['path'], array());
            $export = array();
            foreach($temp['global'] as $k => &$v)
            {
                $export += $v;
            }
            asort($export, SORT_STRING);
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Type: application/download');
            header('Content-Disposition: attachment;filename=' . substr($_POST['path'], 1) . '.txt');
            header('Content-Transfer-Encoding: binary ');
            header('Pragma:no-cache');
            echo '<?php $l = ';
            var_export($export);
            echo ';';
            break;
        case 'textImport':            //文本导入
            $l = null;
            include ROOT_DIR . $_POST['file'];
            if(is_array($l)) {
                $fileName = '/' . pathinfo($_POST['file'], PATHINFO_BASENAME);    //文件名
                $fileDir = ROOT_DIR . Of::config('_language.path') . $fileName;    //文件绝对路径
                file_put_contents($fileDir, serialize($l));
                echo json_encode(array(
                    'state' => Of_LanguagePacks_toolBaseClass::import($_POST['path'], array($fileName))
                ));
                unlink(ROOT_DIR . $_POST['file']);    //删除上传文件
                unlink($fileDir);    //删除临时文件
            } else {
                echo '{"state":false}';
            }
            break;
        case 'merger':                //语言包合并
            Of_LanguagePacks_toolBaseClass::merge($_POST['path'], $_POST['data']);
            echo json_encode(array(
                'state' => Of_LanguagePacks_toolBaseClass::optimize($_POST['path']) !== false    //整理合并包
            ));
            break;
    }
} else {               //显示信息
    $languagePacksOptionHtml = '';    //语言包转换成option标签的html字符串
    foreach($languagePacks as $k => &$v)
    {
        $temp = substr($k, 1);
        $languagePacksOptionHtml .= "<option value='{$k}'>{$temp}</option>";
    }
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
.table{ border:1px solid #CCC; width:100%; margin-top:10px;}
.table tbody tr:hover{ background-color:#EEE; }
.table tbody th{ font-weight:normal;}
.table th{ padding-top:5px;}
.table td{ padding-left:5px;}

/*工具条*/
.tool{ overflow:hidden; width:100%; border:1px solid #CCC; margin-bottom:5px;}
.url{ float:left; word-break:keep-all; white-space:nowrap;}
.url b{ border:solid #CCCCCC; border-width:0 1px; cursor:pointer; padding-left:3px; display:inline-block; margin:3px 0;}
.operating{ position:absolute; right:7px; background-color:#FFFFFF;}
.operating .operating{ right:0px; background-color:transparent;}

/*磁盘区*/
.disk{ border:1px solid #CCC; padding-bottom:10px;}
.dir{ position:relative; overflow:hidden; cursor:pointer; float:left; width:100px; height:100px; border:1px solid; margin:10px 0 0 10px;}
.dir font{ position:absolute; top:25px; left:40px; font-size:40px;}
.dir div{ float:right; display:none; overflow:hidden; width:10px; height:10px; border-width:0px 0px 1px 1px; border-style:solid;}
.dir span{ word-break:break-all; word-wrap:break-word;}
.folder .file{ display:none;}    /*是文件夹*/
.file .folder{ display:none;}    /*是文件*/
.noTr .noTr{ display:block; background-color:#F00;}    /*未翻译*/
.discard .discard{ display:block; background-color:#FF0;}    /*有废弃*/
.ignore .ignore{ display:block; background-color:#999;}    /*有忽略*/

/*合并导入*/
.mergerImport td{ padding:10px;}
.mergerImport font, .mergerImport input{ font-size:36px; font-weight:bold;}

/*合并*/
.merger td{ padding:10px;}
.merger font, .merger .mergerInput{ font-size:36px; font-weight:bold;}

/*浮动条*/
.floatBar {
    display: none;
    position: fixed;
    right: 0;
    top: 200px;
    _position: absolute;
_left:expression(eval(document.documentElement.scrollLeft+document.documentElement.clientWidth-this.offsetWidth)-(parseInt(this.currentStyle.marginLeft, 10)||0)-(parseInt(this.currentStyle.marginRight, 10)||0)-1);
_top:expression(eval(document.documentElement.scrollTop) + 40);
    background: none repeat scroll 0 0 #FFC;
    border: 1px dotted #CCCCCC;
    font-size: 9pt;
    margin-bottom: 10px;
    padding: 6px;
    cursor: pointer;
    text-align: center;
    width: 12px;
    size: 9pt;
    z-index: 2147483647
}
.floatBar span {
    display: block;
}
</style>

<!-- 功能栏 -->
<div>
    <label><input type="radio" onclick="toolObj.tabSwitch(this, 'translation')" checked />翻译</label>
    <label><input type="radio" onclick="toolObj.tabSwitch(this, 'import')" />导入</label>
    <label><input type="radio" onclick="toolObj.tabSwitch(this, 'merger')" />合并</label>
</div>
<!-- 翻译 -->
<div id="translation">
    <!-- 浮动栏 -->
    <div class="floatBar">
        <span><a onclick="toolObj.clickSave()">保存</a>━<a onclick="toolObj.delFile()">删除</a></span>
    </div>
    <!-- 工具条 -->
    <div class="tool">
        <span class="operating">
            <label><input id="getDiscardState" type="checkbox" />废弃检查</label>
            <label><input name="translationLevel" type="radio" onclick="toolObj.getDir('.')" value="key" />键级</label>
            <label><input name="translationLevel" type="radio" onclick="toolObj.getDir('.')" value="page" checked />页级</label>
            <label><input name="translationLevel" type="radio" onclick="toolObj.getDir('.')" value="global" />全局</label>
        </span>
        <span class="url">
            <input type="button" value="新建" onclick="toolObj.createLanguagePage(this)" />
            语言包
            <select id="translationSelectLanguagePage" onchange="toolObj.getDir(this.value)">
                <option value="">请选择</option>
                <?php echo $languagePacksOptionHtml;?>
            </select>
            <input id="translationInputLanguagePage" type="text" style="display:none;" />
            <b onclick="toolObj.getDir('..')">..</b>
            <span class="urlBar"></span>
        </span>
        <div class="clear"></div>
    </div>
    <!-- 目录结构 -->
    <div class="disk">
        <!--<div class="dir folder noTr discard ignore">
            <font class="folder">D</font>
            <font class="file">F</font>
            <div class="noTr" title="未翻译"></div>
            <div class="discard" title="有废弃"></div>
            <div class="ignore" title="有忽略"></div>
            <span>地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地址址地址址地址址地址地址地址地址地址地址地址地址地址地址地址地址地址地址地</span>
        </div>
        <div class="dir file noTr discard ignore">
            <font class="folder">D</font>
            <font class="file">F</font>
            <div class="noTr" title="未翻译"></div>
            <div class="discard" title="有废弃"></div>
            <div class="ignore" title="有忽略"></div>
        </div>-->
        <div class="clear"></div>
    </div>
    <!-- 翻译区 -->
    <table class="translation table" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>类型</th>
                <th>语言</th>
                <th>键值</th>
                <th>翻译</th>
                <th>全局</th>
                <th>信息</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <!--<tr>
                <td>js</td>
                <td>源语言</td>
                <td>key</td>
                <td><input type="text" /></td>
                <td><input type="text" /></td>
                <td>a=viewTest</td>
                <th><label><input type="checkbox" checked="checked" />忽略</label> <a>删除</a></th>
            </tr>
            <tr>
                <td>php</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <th>&nbsp;</th>
            </tr>-->
        </tbody>
    </table>
    <!-- 引用区 -->
    <table class="index table" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>类型</th>
                <th>引用</th>
                <th>信息</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <!--<tr>
                <td>js</td>
                <td>/xxx/index.php</td>
                <td>a=viewTest</td>
                <th><a>删除</a></th>
            </tr>
            <tr>
                <td>js</td>
                <td>/xxx/index.php</td>
                <td>a=viewTest</td>
                <th><a>删除</a></th>
            </tr>-->
        </tbody>
    </table>
</div>
<!-- 导入 -->
<div id="import" style="display:none;">
    <!-- 工具条 -->
    <div class="tool">
        <span class="operating">
            <input type="button" value="导出" onclick="toolObj.textExport()" />
            <input id="importButton" type="button" value="导入" />
            <span class="operating"><input id="uploadify" type="file" style="display:none;" /></span>
        </span>
        <span class="url">
            <input type="button" value="整理" onclick="toolObj.optimize()" />
            语言包
            <select id="importSelectLanguagePage" onchange="toolObj.updateMergerImportSelect();toolObj.getDir(this.value)">
                <option value="">请选择</option>
                <?php echo $languagePacksOptionHtml;?>
            </select>
            <b onclick="toolObj.getDir('..')">..</b>
            <span class="urlBar"></span>
        </span>
        <div class="clear"></div>
    </div>
    <!-- 目录结构 -->
    <div class="disk">
        <!--<div class="dir folder noTr discard ignore">
            <font class="folder">D</font>
            <font class="file">F</font>
            <div class="noTr" title="未翻译"></div>
            <div class="discard" title="有废弃"></div>
            <div class="ignore" title="有忽略"></div>
        </div>
        <div class="dir file noTr discard ignore">
            <font class="folder">D</font>
            <font class="file">F</font>
            <div class="noTr" title="未翻译"></div>
            <div class="discard" title="有废弃"></div>
            <div class="ignore" title="有忽略"></div>
        </div>-->
        <div class="clear"></div>
    </div>
    <!-- 合并导入 -->
    <table class="mergerImport table" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <select id="mergerImportSelect" size="10" multiple><?php echo $languagePacksOptionHtml;?></select>
            </td>
            <td>
                <font>=></font>
            </td>
            <td><input type="button" value="合并导入" onclick="toolObj.mergerImport()" /></td>
        </tr>
    </table>
</div>
<!-- 合并 -->
<div id="merger" style="display:none;">
    <!-- 合并 -->
    <table class="merger table" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <select id="mergerSelect" size="10" multiple><?php echo $languagePacksOptionHtml;?></select>
            </td>
            <td><font>=></font></td>
            <td><input id="mergerInput" type="text" value="" /></td>
            <td><font>=></font></td>
            <td><input class="mergerInput" type="button" value="合并并整理" onclick="toolObj.clickMerger()" /></td>
        </tr>
    </table>
</div>
<script>
var toolObj = {
    //当前翻译数据
    'translationData' : [],

    //切换功能
    'tabSwitch' : function(thisObj, id){
        $(thisObj).parent().siblings().children('input').prop('checked', false)
                  .end().end().end().prop('checked', true);
        $('#' + id).siblings('div[id]').hide()
                   .end().show();
    },

    //获取目录结构
    'getDir' : function(path, thisObj){
        var temp = $('#translation');
        var showPageObj = temp.css('display') === 'none' ? $('#import') : temp;    //当前操作界面
        var urlBarObj = showPageObj.find('.urlBar');                               //地址栏
        var diskObj = showPageObj.find('.disk');                                   //目录显示区
        var onlyDir = true;                                                        //仅查看目录
        var responseFun = function(response){                                      //响应方法
            if(response.state === true)    //创建成功
            {
                var dirName = '';    //目录名
                var trLevel = $('input[name=translationLevel]:checked', showPageObj).val();    //翻译级别
                for(var i in response.data)
                {
                    if( (dirName = i.substr(path.length + 1)) !== '~globalTranslation' )
                    {
                        if( !onlyDir || response.data[i].isDir )    //目录限制
                        {
                            temp = '';
                            if( !onlyDir )
                            {
                                temp += response.data[i].state.ignore ? ' ignore' : '';      //忽略样式
                                temp += response.data[i].state.discard ? ' discard' : '';    //禁用样式
                                temp += response.data[i].state[trLevel] ? ' noTr' : '';      //翻译样式
                            }
                            diskObj.prepend('<div title="' + dirName + '" class="dir' + (response.data[i].isDir ? ' folder' : ' file') + temp + '" onclick="toolObj.dirClick(this)">' +
                                '<font class="folder">D</font>' +
                                '<font class="file">F</font>' +
                                '<div class="noTr" title="未翻译"></div>' +
                                '<div class="discard" title="有废弃"></div>' +
                                '<div class="ignore" title="有忽略"></div>' +
                                '<span>' + dirName + '</span>' +
                            '</div>');
                        }
                    }
                }
                window.L.openCom('tip')('加载完成');
            } else {
                window.L.openCom('tip')(response.data);
            }
        };

        //界面初始化
        diskObj.children('.dir').remove();                //清空目录
        if( showPageObj.attr('id') === 'translation' )    //清空
        {
            onlyDir = false;
            $('.translation tbody tr', showPageObj).remove();
            $('.index tbody tr', showPageObj).remove();
            $('.floatBar', showPageObj).hide();
        }

        //请求数据
        if( $.trim(path) === '' )                 //空目录
        {
            urlBarObj.html('');
        } else if( path.substr(0, 1) === '/' )    //切换语言包
        {
            urlBarObj.html(path);
            window.L.openCom('tip')('正在加载', false);
            $.post('?', {'type' : 'getDir', 'path' : path, 'state' : !onlyDir, 'discard' : document.getElementById('getDiscardState').checked}, responseFun, 'json');
        } else if( path === '..' ) {              //上级目录
            path = urlBarObj.html();
            if( (temp = path.lastIndexOf('/')) > -1 )    //读取上级目录
            {
                window.L.openCom('tip')('正在加载', false);
                temp > 0 && (path = path.substr(0, temp));
                urlBarObj.html(path);
                $.post('?', {'type' : 'getDir', 'path' : path, 'state' : !onlyDir, 'discard' : document.getElementById('getDiscardState').checked}, responseFun, 'json');
            }
        } else if( path === '.' ) {               //刷新目录
            if( (path = $.trim(urlBarObj.html())) !== '' )
            {
                window.L.openCom('tip')('正在加载', false);
                $.post('?', {'type' : 'getDir', 'path' : path, 'state' : !onlyDir, 'discard' : document.getElementById('getDiscardState').checked}, responseFun, 'json');
            }
        } else {                                  //常规目录
            path = urlBarObj.html() + '/' + path;
            urlBarObj.html(path);
            window.L.openCom('tip')('正在加载', false);
            $.post('?', {'type' : 'getDir', 'path' : path, 'state' : !onlyDir, 'discard' : document.getElementById('getDiscardState').checked}, responseFun, 'json');
        }
    },

    //点击目录
    'dirClick' : function(thisObj){
        var temp = $('#translation');
        var showPageObj = temp.css('display') === 'none' ? $('#import') : temp;    //当前操作界面
        var urlBarObj = showPageObj.find('.urlBar');                               //地址栏
        var dirName = (thisObj = $(thisObj)).find('span').html();

        if(thisObj.hasClass('folder'))    //文件夹
        {
            toolObj.getDir(dirName);
        } else {                          //文件
            var translationBlack = $('.translation tbody', showPageObj);    //翻译块
            var indexBlack = $('.index tbody', showPageObj);    //翻译块
            $('.floatBar', showPageObj).hide();
            translationBlack.find('tr').remove();
            indexBlack.find('tr').remove();
            thisObj.siblings('.dir').removeClass('yellowBg');
            thisObj.addClass('yellowBg');
            $.post('?', {'type' : 'getFile', 'path' : urlBarObj.html() + '/' + dirName, 'state' : true}, function(response){
                if(response.state === true)    //成功
                {
                    toolObj.translationData = response.data;    //记录翻译数据
                    $('.floatBar', showPageObj).show();

                    //翻译
                    for(var i in [0,1])
                    {
                        for(var q in response.data[i])
                        {
                            for(var v in response.data[i][q])
                            {
                                for(var k in response.data[i][q][v])
                                {
                                    temp = response.data[i][q][v][k]['other']['discard'] ? ' style="background-color: #FFFFCC;"' : '';
                                    translationBlack.append('<tr>' +
                                        '<td>' + (i === '0' ? 'php' : 'js') + '</td>' +
                                        '<td' + temp + '>' + window.L.strTranscoding.textToHtml(v) + '</td>' +
                                        '<td' + temp + '>' + window.L.strTranscoding.textToHtml(k) + '</td>' +
                                        '<td><input type="text" value="' + window.L.strTranscoding.textToHtml(response.data[i][q][v][k][0]) + '" /></td>' +
                                        '<td><input type="text" value="' + window.L.strTranscoding.textToHtml(response.data[i][q][v][k]['other']['global']) + '" onblur="toolObj.globalInputBlur($(this).parents(\'tr\'))" /></td>' +
                                        '<td>' + window.L.strTranscoding.textToHtml(q) + ', ' + response.data[i][q][v][k][2] + '</td>' +
                                        '<th><label><input type="checkbox"' + (response.data[i][q][v][k]['ignore'] ? ' checked' : '') + ' />忽略</label> <a onclick="toolObj.delTr($(this).parents(\'tr\'))">删除</a></th>' +
                                    '</tr>');
                                }
                            }
                        }
                    }

                    //引用
                    for(var i in [0,1])
                    {
                        temp = parseInt(i) + 2;
                        for(var q in response.data[temp])
                        {
                            for(var v in response.data[temp][q])
                            {
                                indexBlack.append('<tr>' +
                                    '<td>' + (i === '0' ? 'php' : 'js') + '</td>' +
                                    '<td>' + v + '</td>' +
                                    '<td>' + q + '</td>' +
                                    '<th><a onclick="toolObj.delIndex($(this).parents(\'tr\'))">删除</a></th>' +
                                '</tr>');
                            }
                        }
                    }
                } else {
                    window.L.openCom('tip')(response.data);
                }
            }, 'json');
        }
    },

    /***************************************************************** 翻译区 ***********/
    //创建语言包
    'createLanguagePage' : function(thisObj){
        var inputObj = $('#translationInputLanguagePage');
        var selectObj = $('#translationSelectLanguagePage');
        var temp;

        if(inputObj.css('display') === 'none')    //输入创建名
        {
            thisObj.value = '创建';
            inputObj.show().focus();
            selectObj.hide();
        } else {                                  //提交创建名
            if( /^[a-z_]+$/i.test(temp = inputObj.val()) )
            {
                $.post('?', {'type' : 'createLanguagePage', 'name' : temp}, function(response){
                    if(response.state === true)    //创建成功
                    {
                        $('select').append('<option value="/' +temp+ '">' +temp+ '</option>');
                        window.L.openCom('tip')('创建成功');
                    } else {
                        window.L.openCom('tip')(response.data);
                    }
                }, 'json');
            } else {
                window.L.openCom('tip')('语言包名只能包含字母和下划线');
            }
            thisObj.value = '新建';
            inputObj.hide().val('');
            selectObj.show();
        }
    },

    //删除翻译
    'delTr' : function(thisObj){
        var temp = $('td', thisObj);
        delete toolObj.translationData[temp.eq(0).html() === 'js' ? 1 : 0][temp.eq(5).html().split(', ')[0]][temp.eq(1).html()][temp.eq(2).html()];
        thisObj.remove();
    },

    //删除引用
    'delIndex' : function(thisObj){
        var temp = $('td', thisObj);
        delete toolObj.translationData[temp.eq(0).html() === 'js' ? 3 : 2][temp.eq(2).html()][temp.eq(1).html()];
        thisObj.remove();
    },

    //全局翻译失焦
    'globalInputBlur' : function(thisObj){
        var temp = $('td', thisObj);
        var or = temp.eq(1).html();    //源语言
        var tr = $('input', temp.eq(4)).val();    //翻译数据

        thisObj.siblings().each(function(){
            if( (temp = $('td', $(this))).eq(1).html() === or )
            {
                temp.eq(4).find('input').val(tr);
            }
        });
    },

    //点击保存
    'clickSave' : function(){
        var translationObj = $('#translation .translation tbody');
        var indexObj = $('#translation .index tbody');
        var path = $('#translation .urlBar').html() + '/' + $('#translation .disk .dir.yellowBg span').html();
        var timestamp = parseInt((new Date).getTime()/1000);    //时间戳
        var temp;

        translationObj.children('tr').each(function(){
            var tdList = $('td', this);
            temp = toolObj.translationData[tdList.eq(0).html() === 'js' ? 1 : 0][tdList.eq(5).text().split(', ')[0]][tdList.eq(1).text()][tdList.eq(2).text()];
            temp[0] = tdList.eq(3).find('input').val();
            temp[1] = timestamp;
            temp['ignore'] = $('th :checkbox', this).prop('checked');
            temp['other']['global'] = tdList.eq(4).find('input').val();
        });

        $.post('?', {'type' : 'setFile', 'path' : path, 'data' : window.L.JSON.stringify(toolObj.translationData)}, function(response){
            window.L.openCom('tip')(response.state === true ? '保存成功' : response.data);
        }, 'json');
    },

    //删除文件
    'delFile' : function(){
        var path = $('#translation .urlBar').html() + '/' + $('#translation .disk .dir.yellowBg span').html();
        if( window.confirm('是否删除文件' + path) )
        {
            $.post('?', {'type' : 'setFile', 'path' : path, 'data' : false}, function(response){
                window.L.openCom('tip')(response.state === true ? '删除成功' : '删除失败');
                toolObj.getDir(response.state === true ? response.data : '.');
            }, 'json');
        }
    },

    /***************************************************************** 导入区 ***********/
    //更新合并导入列表框并操作上传
    'updateMergerImportSelect' : function(){
        var importObj = $('#importSelectLanguagePage');

        //上传切换
        window.L.openCom('upload').updateSettings('uploadify', function(value){
            var temp = importObj.val();
            $(this).css('visibility', temp === '' ? 'hidden' : 'visible');
            $('#importButton').prop('disabled', temp === '');
        });

        //列表更新
        $('#mergerImportSelect').html('').append(
            $('option:not([value=""]):not([value="' + importObj.val() + '"])', importObj).clone()
        );
    },

    //整理语言包
    'optimize' : function(){
        var temp = $('#importSelectLanguagePage').val();

        if( temp === '' )
        {
            window.L.openCom('tip')('需要选择语言包');
        } else {
            window.L.openCom('tip')('开始整理', false);
            $.post('?', {'type' : 'optimize', 'path' : temp}, function(response){
                window.L.openCom('tip')(response.state === true ? '整理成功' : '整理失败');
            }, 'json');
        }
    },

    //合并导入
    'mergerImport' : function(){
        var path = $('#import .urlBar').html();
        var temp = $('#importSelectLanguagePage').val();
        var dir = path.substr(temp.length);    //追加目录

        if( temp === '' )
        {
            window.L.openCom('tip')('需要选择语言包');
        } else {
            temp = $('#mergerImportSelect option:selected').map(function(){
                return $(this).attr('value') + dir;
            }).get();

            if( temp.length )
            {
                window.L.openCom('tip')('正在导入', false);
                $.post('?', {'type' : 'importDir', 'path' : path, 'data' : temp}, function(response){
                    window.L.openCom('tip')(response.state === true ? '导入成功' : '导入失败');
                }, 'json');
            } else {
                window.L.openCom('tip')('需要选择导入包');
            }
        }
    },

    //文本导出
    'textExport' : function(){
        var path = $('#import .urlBar').html();

        if( $('#importSelectLanguagePage').val() === '' )
        {
            window.L.openCom('tip')('需要选择语言包');
        } else {
            $('<form action="" method="post" target="_blank">' +
                '<input name="type" value="textExport" />' +
                '<input name="path" value="' + window.L.strTranscoding.textToHtml(path) + '" />' +
            '</form>').appendTo(document.body).submit().remove();
        }
    },

    /***************************************************************** 合并区 ***********/
    //点击合并
    'clickMerger' : function(){
        var inputText = $('#mergerInput').val();
        var temp = $('#mergerSelect option:selected').map(function(){
            return this.value;
        }).get();

        if( temp.length )
        {
            if( /^[a-z_]+$/i.test(inputText) )
            {
                window.L.openCom('tip')('正在合并', false);
                $.post('?', {'type' : 'merger', 'path' : '/' + inputText, 'data' : temp}, function(response){
                    window.L.openCom('tip')(response.state === true ? '合并成功' : '合并失败');
                }, 'json');
            } else {
                window.L.openCom('tip')('语言包名只能包含字母和下划线');
            }
        } else {
            window.L.openCom('tip')('需要选择合并包');
        }
    }
};

window.L.openCom('upload')('uploadify',
    {
        'onInit' : function(){
            toolObj.updateMergerImportSelect();
        },
        'onSelectOnce' : function(){
            window.L.openCom('tip')('正在上传');
        },
        'onComplete'   : function(file){
            window.L.openCom('tip')('正在导入', false);
            $.post('?', {'type' : 'textImport', 'path' : $('#import .urlBar').html(), 'file' : file}, function(response){
                response = window.L.JSON.parse(response);
                if( typeof response === 'string' )
                {
                    alert(response);
                } else {
                    window.L.openCom('tip')(response.state === true ? '导入成功' : '导入失败');
                }
            });
        }
    },
    'txt',
    ' ',
    50,
    21,
    {auto:true , queueID:' ', multi:false}
);
</script>
<?php
    Of_View::printHead(false);
}