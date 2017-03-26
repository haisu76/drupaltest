<?php
/**	
 *      (C)2009-2013 Orivon Inc.
 *      author@tiger
 */
define('VERSION','2.2.9');                                                              //版本号
define('RELEASE','2013-05-31');                                                         //发布时间
define('SOFT_NAME', 'oExam');                                                           //发布版本'oExam'或'oTraining'

define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));                               //网站根目录
define('ROOT_URL', ($temp = strtr(dirname(dirname($_SERVER['SCRIPT_NAME'])), '\\', '/')) === '/' ? '' : $temp);        //网站根目录
define('IS_INSTALL', substr($_SERVER['SCRIPT_NAME'], -18) === '/install/index.php');    //安装(true)或升级(false)
include ROOT_PATH . '/config.inc.php';                                                  //加载配置文件

/**
 * 描述 : 依赖性检查
 * 作者 : Edgar.lee
 */
function dependence(&$dependence) {
    $lang = &$GLOBALS['lang'];
    $config = &$GLOBALS['config'];

    $dependence = array(
        $lang['env_check'] => array(     //环境检查
            array(
                $lang['project'],        //项目名称
                $lang['required'],       //最低配置
                $lang['best'],           //推荐配置
                $lang['curr_server'],    //当前配置
                $lang['check_result']    //当前状态
            ),
            array(                       //操作系统
                $lang['os'],
                $lang['unlimit'],
                $lang['unix'],
                PHP_OS,
                true
            ),
            array(                       //php版本
                $lang['php'],
                '5.2.1+',
                '5.2.6+',
                PHP_VERSION,
                version_compare(PHP_VERSION, '5.2.1', '>=')
            ),
            array(                       //附件上传
                $lang['attachmentupload'],
                $lang['unlimit'],
                '20M',
                ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow',
                'state' => true
            ),
            array(                       //磁盘空间
                $lang['diskspace'],
                '100M+',
                '10G+',
                floor($temp = disk_free_space(ROOT_PATH) / 1048576) . 'M',
                $temp >= 100
            )
        ),
        $lang['priv_check'] => array(     //目录、文件权限检查
            array(
                $lang['step1_file'],           //目录文件
                $lang['step1_need_status'],    //所需状态
                $lang['check_result'],         //当前状态
            ),
            array(                        //配置文件
                './config.inc.php',
                $lang['readWrite'],
                isRW(ROOT_PATH . '/config.inc.php')
            ),
            array(                        //配置文件
                '.' . $config['_browseHome'],
                $lang['readWrite'],
                isRW(ROOT_PATH . $config['_browseHome'])
            ),
        ),
        $lang['func_depend'] => array(    //依赖性检查
            array(
                $lang['func_name'],       //函数名称
                $lang['check_result'],    //检查结果
            ),
            array(                        //mysql连接
                'mysql_connect()',
                function_exists('mysql_connect')
            ),
            array(                        //文件读写
                'file_get_contents()',
                function_exists('file_get_contents')
            ),
            array(                        //PDO扩展
                'GD',
                 function_exists('ImageColorAllocate')
            ),
            array(                        //PDO扩展
                'PDO' . (class_exists('PDO') ? '' : " {$lang['php_ini_install4']}(<font color='red'>未开启</font>)"),
                true
            ),
            array(                        //PDO扩展
                'ZIP' . (function_exists('zip_open') ? '' : " {$lang['php_ini_install4']}(<font color='red'>未开启</font>)"),
                true
            ),
        )
    );
}