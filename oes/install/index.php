<?php
$iRootDir = dirname(__FILE__);
require $iRootDir . '/include/install_var.php';
require $iRootDir . '/include/install_lang.php';
isset($_GET['step']) || $_GET['step'] = '0';
$installed = strpos(file_get_contents(ROOT_PATH . '/config.inc.php'), '/*不要删除该注释,安装后自动删除*/') === false;    //true=已安装,false=未安装
$prevHtml = '<a href="javascript:history.back();"><img src="' .ROOT_URL. '/install/images/button_3.gif" style="cursor: pointer;"></a>';    //上一步按钮
$nextState = true;    //是否允许下一步
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>oTraining 升级向导</title>
<link type="text/css" rel="stylesheet" href="<?php echo ROOT_URL; ?>/install/images/style.css">
</head>

<body>
<div class="box">
    <div class="top">
        <div class="clear"></div>
    </div>
    <div class="main">
        <div class="left">
            <div class="left_1">
                <p id="step1" <?php echo $_GET['step'] === '0' ? 'class="hover"' : ''; ?>><b>1</b><span><?php echo $lang['step_show_license_title']; ?></span></p>
            </div>
            <div class="left_2">
                <p id="step2" <?php echo $_GET['step'] === '1' || $_GET['step'] === '2' ? 'class="hover"' : ''; ?>><span><?php echo $lang['env_check']; ?></span><b>2</b></p>
            </div>
            <div class="left_1" style="top:280px;">
                <p id="step3" <?php echo $_GET['step'] === '3' ? 'class="hover"' : ''; ?>><b>3</b><span><?php echo $lang['fill_config']; ?></span></p>
            </div>
            <div class="left_2" style="top:350px;">
                <p id="step4" <?php echo $_GET['step'] === '4' ? 'class="hover"' : ''; ?>><span><?php echo $lang['step_env_check_title']; ?></span><b>4</b></p>
            </div>
        </div>
        <div class="right">
            <div class="right_1">
                <p><span class="span_title"><?php echo $lang['title_welcome']; ?>&nbsp;</span><b><?php echo $lang[IS_INSTALL ? 'title_install' : 'title_update']; ?></b><br>
                    <span><?php echo $lang['version'], ' ', VERSION, ' ', $lang['SC_UTF8']; ?>&nbsp;</span></p>
            </div>
            <div class="right_2">
                <p><?php
                    switch( $_GET['step'] )
                    {
                        case '0':    //声明
                            echo $lang['step_show_license_title'];
                            break;
                        case '1':    //ionCube
                            echo $lang['shared_server1'];
                        case '2':    //环境检查
                            echo $lang['env_check'];
                            break;
                        case '3':    //填写配置
                            echo $lang['fill_config'];
                            break;
                        case '4':    //填写配置
                            echo $lang['step_env_check_title'];
                            break;
                    }
                ?></p>
            </div>
            <div class="right_3">
            <?php
                if( is_file(ROOT_PATH . $config['_browseHome'] . '/update.lock') )    //禁止安装更新
                {
                    echo '<div id="notice"><div><b>' .$lang['update_locked']. '</b></div>
<p><span class="red">您必须解决以上问题，才可以继续</span></p></div>';
                    $prevHtml = '';
                    $nextState = false;
                } elseif( $_GET['step'] === '0' )    //声明
                {
                    $prevHtml = '';
                    echo $lang['license'];
                } elseif( $_GET['step'] === '1' ) {    //ionCube
                    echo '<iframe src="', ROOT_URL, '/install/include/loader-wizard.php" hspace="0" vspace="0" style="height:100%; width:100%;overflow: visible;" name="loader_frame" align="top" frameborder="0"></iframe>';
                } elseif( $_GET['step'] === '2' ) {
                    dependence($dependence);
                    foreach($dependence as $title => &$value)
                    {
                        echo '<h2 class="title">' .$title. '</h2><table class="env_check">';
                        foreach($value as $k => $v)
                        {
                            if( $k === 0 )
                            {
                                echo '<tr><th>', join('</th><th>', $v), '</th></tr>';
                            } else {
                                if($temp = array_pop($v))
                                {
                                    $temp = '<td class="w"></td>';
                                } else {
                                    $temp = '<td class="nw"></td>';
                                    $nextState = false;    //禁止下一步
                                }
                                echo '<tr><td>', join('</td><td>', $v), "</td>{$temp}</tr>";
                            }
                        }
                        echo '</table>';
                    }
                } elseif( $_GET['step'] === '3' ) {
                    $prevHtml = '<a href="#" onclick="indexObj.onsubmit() && document.getElementById(\'stepThreeForm\').submit(); return false;"><img src="' .ROOT_URL. '/install/images/button_2.gif" style="cursor: pointer;"></a>';
                    $nextState = false;
?>
<form id="stepThreeForm" action="index.php?step=4" method="post" onsubmit="return indexObj.onsubmit();">
    <table class="tb2">
        <tbody>
            <tr>
                <th class="tbopt">&nbsp;<!-- 数据库服务器 --><?php echo $lang['dbhost']; ?>:</th>
                <td><input type="text" class="txt" size="35" value="<?php echo $config['_db']['params']['host']; ?>" name="dbinfo[dbhost]"></td>
            </tr>
            <tr>
                <td></td>
                <td><!-- 数据库服务器地址, 一般为 127.0.0.1 --><?php echo $lang['dbhost_comment']; ?></td>
            </tr>
            <tr>
                <th class="tbopt">&nbsp;<!-- 数据库端口号 --><?php echo $lang['dbport']; ?>:</th>
                <td><input type="text" class="txt" size="35" value="<?php echo $config['_db']['params']['port']; ?>" name="dbinfo[dbport]"></td>
            </tr>
            <tr>
                <td></td>
                <td><!-- 数据库服务器端口号一般为 3306，注意端口号只能为1～65535之间的整数值 --><?php echo $lang['dbport_comment']; ?></td>
            </tr>
            <tr>
                <th class="tbopt">&nbsp;<!-- 数据库名 --><?php echo $lang['dbname']; ?>:</th>
                <td><input type="text" class="txt" size="35" value="<?php echo $config['_db']['params']['database']; ?>" name="dbinfo[dbname]"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="tbopt">&nbsp;<!-- 数据库用户名 --><?php echo $lang['dbuser']; ?>:</th>
                <td><input type="text" class="txt" size="35" value="<?php echo $config['_db']['params']['user']; ?>" name="dbinfo[dbuser]"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="tbopt">&nbsp;<!-- 数据库密码 --><?php echo $lang['dbpw']; ?>:</th>
                <td><input type="text" class="txt" size="35" value="<?php echo $config['_db']['params']['password']; ?>" name="dbinfo[dbpw]"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="tbopt">&nbsp;<!-- 管理员账号 --><?php echo $lang['username']; ?>:</th>
                <td><input type="text" class="txt" size="35" value="" name="admininfo[username]"></td>
            </tr>
            <tr>
                <td></td>
                <td><!-- 修改或找回超级管理员帐号,密码时使用 --><?php echo $lang['resetAdmin']; ?></td>
            </tr>
            <tr>
                <th class="tbopt">&nbsp;<!-- 管理员密码 --><?php echo $lang['password']; ?>:</th>
                <td><input id="password" type="password" class="txt" size="35" value="" name="admininfo[password]"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="tbopt">&nbsp;<!-- 重复密码 --><?php echo $lang['password2']; ?>:</th>
                <td><input id="password2" type="password" class="txt" size="35" value="" name="admininfo[password2]"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table class="tb2" <?php echo IS_INSTALL ? '' : 'style="display:none;"'; ?>>
        <tbody>
            <tr style="color:red;<?php echo $installed ? '' : ' display:none;'; ?>" >
                <th class="tbopt">&nbsp;<!-- 产品已安装 --><?php echo $lang['products_installed']; ?>:</th>
                <td><label style="cursor: pointer;">
                        <input type="checkbox" style="border: 0" value="1" name="admininfo[reinstall]" onclick="document.getElementById('admininfoDemodataTr').style.display = this.checked ? '' : 'none'; document.getElementById('admininfoDemodata').checked = false;">
                        <!-- 选中复选框"重新安装",否则"产品升级" --><?php echo $lang['products_installed_label']; ?></label></td>
            </tr>
            <tr id="admininfoDemodataTr" <?php echo $installed ? 'style="display:none;"' : ''; ?>>
                <th class="tbopt">&nbsp;<!-- 演示数据 --><?php echo $lang['demodata']; ?>:</th>
                <td><label style="cursor: pointer;">
                        <input id="admininfoDemodata" type="checkbox" style="border: 0" value="1" name="admininfo[demodata]">
                        <!-- 安装演示数据 --><?php echo $lang['demodata_check_label']; ?></label></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</form>
            <?php
                } elseif( $_GET['step'] === '4' ) {
                    echo '<div id="notice"></div>';
                    $nextState = false;
                    $prevHtml = '<input id="gotoHome" type="button" style="cursor: pointer;background:url(' .ROOT_URL. '/install/images/button_install_finished.gif);background-repeat:no-repeat;border-style:none; display:none; width:196px; height:29px;" onclick="indexObj.gotoHome()">';    //上一步按钮
                }
            ?>
            </div>
            <div class="right_4">
                <p>
                    <?php echo $prevHtml; ?>
                    <?php if($nextState){ ?><a href="index.php?step=<?php echo $_GET['step'] + 1; ?>"><img src="<?php echo ROOT_URL; ?>/install/images/button_2.gif" style="cursor: pointer;"></a><?php } ?>
                </p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="bottom">Copyright © 2007-2013 Orivon All Rights Reserved.</div>
</div>
<script>
var indexObj = {
    'noticeObj'   : document.getElementById('notice'),
    'showMessage' : function(message){
        indexObj.noticeObj.innerHTML += message + '<br />';
        indexObj.noticeObj.scrollTop = 100000000; 
    },
    'gotoHome'    : function(){
        window.location.href = '<?php echo strtr(dirname(dirname($_SERVER['SCRIPT_NAME'])), '\\', '/'); ?>';
    },
    'onsubmit'    : function(){
        var temp = document.getElementById('password').value === document.getElementById('password2').value;
        temp || alert('两次密码不相同');
        return temp;
    }
}
</script>
</body>
</html>
<?php
/**
 * 描述 : 开始升级数据库
 * 作者 : Edgar.lee
 */
if( $prevHtml && $_GET['step'] === '4' ) {
    require ROOT_PATH . '/include/Of/Com/MysqlStructureUpdate.php';
    $temp = ob_get_clean();    //读取并关闭缓存数据
    ob_implicit_flush(1);
    echo $temp;

    //修改配置文件
    $config['_db']['adapter'] = $config['_db']['adapter'] !== 'Mysql' && !class_exists('PDO') ? 'Mysql' : 'Pdo_Mysql';
    $config['_db']['params']['host'] = $_POST['dbinfo']['dbhost'];
    $config['_db']['params']['port'] = $_POST['dbinfo']['dbport'];
    $config['_db']['params']['user'] = $_POST['dbinfo']['dbuser'];
    $config['_db']['params']['password'] = $_POST['dbinfo']['dbpw'];
    $config['_db']['params']['database'] = $_POST['dbinfo']['dbname'];
    $config['_path']['rootDir'] = strtr(dirname(dirname(__FILE__)), '\\', '/');    // 磁盘根路径
    $config['_path']['rootUrl'] = ROOT_URL;    //计算网络根路径
    isset($config['_path']['adminDir']) || $config['_path']['adminDir'] = '/admin';    //计算网络根路径

    //纠正配置文件
    unset($config['_log']['debug']);    //关闭debug模式
    if($config['_language']['defaultLanguage'] === 'default' || $config['_language']['defaultLanguage'] === '')    //关闭语言包开发模式
    {
        $config['_language']['defaultLanguage'] = 'zh_CN';
        $config['_language']['path'] = $config['_browseHome'] . '/language';
    }
    (!isset($config['_extension']) || !is_string($config['_extension']) || $config['_extension'] === '/docTools/extensions') && $config['_extension'] = $config['_browseHome'] . '/extensions';
    SOFT_NAME === 'oExam' && $config['_db']['params']['database'] === 'ots' && $config['_db']['params']['database'] = 'oes';
    SOFT_NAME === 'oExam' && $config['_custom']['title'] === 'oTraining 在线培训系统' && $config['_custom']['title'] = 'oExam 在线考试系统';
    $config['_log']['sqlLog'] === '/../error/sqlLog' && $config['_log']['sqlLog'] = $config['_browseHome'] . '/error/sqlLog';
    $config['_log']['phpLog'] === '/../error/phpLog' && $config['_log']['phpLog'] = $config['_browseHome'] . '/error/phpLog';
    $config['_log']['jsLog'] === '/../error/jsLog' && $config['_log']['jsLog'] = $config['_browseHome'] . '/error/jsLog';

    //写回配置文件
    file_put_contents(ROOT_PATH . '/config.inc.php', '<?php $config = ' . var_export($config, true) . ';');

    //开始更新数据库
    if( Of_Com_MysqlStructureUpdate::init(array(
        'callDb'   => array(
            'server'   => $config['_db']['params']['host'] . ':' . $config['_db']['params']['port'],
            'username' => $config['_db']['params']['user'],
            'password' => $config['_db']['params']['password']
        ),
        'callMsg'  => 'callBackMsg',
        'database' => $config['_db']['params']['database'],
        'matches'  => array(
            'table'    => array(
                'include' => array('@^t_@')    //备份以t_开头的表
            )
        )
    )) ) {
        //重新安装
        if( isset($_POST['admininfo']['reinstall']) )
        {
            Of_Com_MysqlStructureUpdate::restoreStructure($temp = tempnam(sys_get_temp_dir(), ''));    //删除原始结构
            unlink($temp);                                                                             //删除临时文件
        }

        //更新结构
        Of_Com_MysqlStructureUpdate::restoreStructure(ROOT_PATH . '/install/data/structure.sql');

        //导入数据
        if( isset($_POST['admininfo']['demodata']) )    //导入演示数据
        {
            Of_Com_MysqlStructureUpdate::restoreData(ROOT_PATH . '/install/data/demo.sql', array(       //导入演示数据
                'disableTriggers' => true,    //关闭触发器
                'showProgress'    => true     //显示进度
            ));
            copyPath(ROOT_PATH . '/install/data/demoData', ROOT_PATH . $config['_browseHome']);
        } else {                                                                                        //导入基础数据(修复)
            Of_Com_MysqlStructureUpdate::restoreData(ROOT_PATH . '/install/data/default.sql', array(    //导入基础数据
                'disableTriggers' => true,    //关闭触发器
                'showProgress'    => true     //显示进度
            ));
        }

        //修改密码
        if( !empty($_POST['admininfo']['username']) && !empty($_POST['admininfo']['password']) )
        {
            if( !get_magic_quotes_gpc() )
            {
                $_POST['admininfo']['username'] = addslashes($_POST['admininfo']['username']);
                $_POST['admininfo']['password'] = addslashes($_POST['admininfo']['password']);
            }
            Of_Com_MysqlStructureUpdate::sql("REPLACE INTO `t_admin` (`user_id`, `username`, `pwd`) VALUES ('1', '{$_POST['admininfo']['username']}', PASSWORD('{$_POST['admininfo']['password']}'))");
        }

        //删除无用文件夹
        if( is_dir(($temp = ROOT_PATH . $config['_browseHome']) . '/extensions') )
        {
            deletePath($temp . '/extensionadmin');    //删除错误文件夹
            deletePath($temp . '/extensionhes');    //删除错误文件夹
            deletePath($temp . '/extensions/admin');    //删除错误扩展
            deletePath($temp . '/extension');    //删除旧版扩展文件夹
            deletePath($temp . '/extensionx.php');    //删除错误文件
            deletePath($temp . '/demolock.lock');    //删除演示数据锁
            deletePath($temp . '/install.lock');    //删除安装数据锁
            deletePath($temp . '/restore.lock');    //删除找回密码锁
            deletePath(ROOT_PATH . $config['_language']['path'] . '/dai');    //删除无用语言包
            deletePath(ROOT_PATH . $config['_language']['path'] . '/Don');    //删除无用语言包
            deletePath(ROOT_PATH . $config['_language']['path'] . '/Edgar');    //删除无用语言包
            deletePath(ROOT_PATH . $config['_language']['path'] . '/Steven');    //删除无用语言包
            deletePath(ROOT_PATH . '/resetap.php');    //删除找回密码
        }
        

        //升级加锁
        file_put_contents(ROOT_PATH . $config['_browseHome'] . '/update.lock', '');
        echo '<script type="text/javascript">document.getElementById("gotoHome").style.display="";</script>';
    }
}

/**
 * 描述 : 判断文件(夹)读写权限
 * 作者 : Edgar.lee
 */
function isRW($path) {
    $state = false;
    if( file_exists($path) )
    {
        if( is_dir($path) )
        {
            $temp = $path . '/' . uniqid(true);
            $state = @scandir($path) && (@file_put_contents($temp, '') !== false);
            @unlink($temp);
        } else {
            $state = ($temp = @file_get_contents($path)) && (@file_put_contents($path, $temp) !== false);
        }
    }
    return $state;
}

/**
 * 描述 : 消息回调
 * 作者 : Edgar.lee
 */
function callBackMsg($msg) {
    unset($msg['type']);
    if(!$msg['info']) unset($msg['info']);
    echo '<script type="text/javascript">indexObj.showMessage("' .htmlspecialchars(join(' : ', $msg)). '");</script>';
}

/**
 * 描述 : 复制指定文件或文件夹
 * 参数 :
 *      source : 指定源路径
 *      dest   : 指定目标路径
 * 返回 :
 *      成功返回true,失败返回false
 * 作者 : Edgar.lee
 */
function copyPath($source, $dest, &$exclude = array())
{
    if( is_file($source) )
    {
        is_dir($isDir = dirname($dest)) || mkdir($isDir, 0777, true);    //创建目录
        return copy($source, $dest);
    } else if( is_dir($source) ) {
        is_dir($dest) || mkdir($dest, 0777, true);    //创建目录
        if($dp = opendir($source))
        {
            while(($file=readdir($dp)) != false) {
                if ($file !== '.' && $file !== '..' )
                {
                    if( !isset($exclude[$temp = "{$source}/{$file}"]) )
                    {
                        copyPath("{$source}/{$file}", "{$dest}/{$file}", $exclude);
                    }
                }
            }
            closedir($dp);
        }
        return true;
    }
}

/**
 * 描述 : 删除指定文件或文件夹
 * 参数 :
 *      path : 指定删除路径
 * 返回 :
 *      成功返回true,失败返回false
 * 作者 : Edgar.lee
 */
function deletePath($path)
{
    if( is_file($path) )
    {
        return unlink($path);
    } else if( is_dir($path) ) {
        if($dp = opendir($path))
        {
            while(($file=readdir($dp)) !== false) {
                if ($file !== '.' && $file !== '..' )
                {
                    deletePath($path .'/'. $file);
                }
            }
            closedir($dp);
        }
        return rmdir($path);
    }
}