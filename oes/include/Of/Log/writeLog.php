<?php
set_error_handler(array('Of_Log_writeLog', 'phpLog'));
set_exception_handler(array('Of_Log_writeLog', 'phpLog'));

class Of_Log_writeLog {
    /**
     * 描述 : 获取配置文件
     * 作者 : Edgar.lee
     */
    static private function &getConfig() {
        static $config = null;
        $config === null && include dirname(dirname(dirname(dirname(__FILE__)))) . '/config.inc.php';
        return $config;
    }

    /**
     * 描述 : 格式化日志
     * 参数 :
     *     &logData : 日志数据
     * 结构 : {
     *      'logType'     : 错误类型(sqlError, exception, error)
     *      'environment' : {    错误体,包括环境,错误细节,回溯
     *          'code'=>              : php=错误级别, sql=错误码及说明
     *          'message'             : php=错误描述, sql=错误sql
     *          'file'                : 定位->路径
     *          'line'                : 定位->行数
     *          'predefinedVariables' : {    环境变量
     *              '_ENV'     : 对应超全局变量
     *              '_POST'    : 对应超全局变量
     *              '_GET'     : 对应超全局变量
     *              '_COOKIE'  : 对应超全局变量
     *              '_SERVER'  : 对应超全局变量
     *              '_REQUEST' : 对应超全局变量
     *              'config'   : 配置文件
     *          }
     *          'debugBacktrace'     : {}    //回溯信息,js没有
     *      }
     *      'time'        : 生成时间戳
     *  }
     * 作者 : Edgar.lee
     */
    static private function formatLog( &$logData ) {
        $config = &self::getConfig();     //配置文件

        //定位->路径 转化 相对路径
        $logData['environment']['file'] = strtr(substr( $logData['environment']['file'], strlen($config['_path']['rootDir']) ), '\\', '/');

        //添加预定义数据
        $logData['environment']['predefinedVariables'] = array(
            //'_ENV'      => &$_ENV,    //服务器变量
            '_POST'    => &$_POST,
            '_GET'     => &$_GET,
            '_COOKIE'  => &$_COOKIE,
            '_SERVER'  => &$_SERVER,
            '_REQUEST' => &$_REQUEST
        );
        //$logData['environment']['predefinedVariables']['config'] = &$config;    //存储配置文件
        $logData['time']   = $_SERVER['REQUEST_TIME'];

        //格式化回溯
        if( isset($logData['environment']['debugBacktrace']) )
        {
            foreach($logData['environment']['debugBacktrace'] as &$v)
            {
                if(isset($v['object']))
                {
                    unset($v['object']);
                }
                if(isset($v['args']))
                {
                    $temp = array();    //临时参数拷贝数组
                    foreach($v['args'] as &$arg)
                    {
                        if(is_scalar($arg) || is_resource($arg) || $arg === null)    //是一个标量,资源,null
                        {
                            $temp[] = gettype($arg) . ' (' . var_export($arg, true) . ')';
                        } else if(is_object($arg)) {    //对象
                            $temp[] = 'object (' . get_class($arg) . ')';
                        } else if(is_array($arg)) {    //数组
                            $temp[] = var_export($arg, true);
                        }
                    }
                    $v['args'] = $temp;
                }
            }
        }
    }

    /**
     * 描述 : 记录日志数据
     * 参数 :
     *     &logData  : 日志数据
     *      logType  : 日志内容[js, php, mysql]
     *      printStr : 显示错误内容,会根据相关配置绝对是否显示
     * 作者 : Edgar.lee
     */
    static private function writeLog( &$logData, $logType, $printStr ) {
        $config = &self::getConfig();     //配置文件

        //打印日志
        if(    //ini_get('error_reporting')
            !empty($config['_log']['debug']) ||    //配置文件debug模式
            isset($_GET['__OF_DEBUG__']) ||        //参数debug模式
            (                                      //请求路径debug模式
                isset($_SERVER['HTTP_REFERER']) &&
                ($temp = parse_url($_SERVER['HTTP_REFERER'])) &&
                isset($temp['query']) &&
                !parse_str($temp['query'], $temp) &&
                isset($temp['__OF_DEBUG__'])
            )
        ) {
            echo $printStr;
        }

        //写入日志
        $logPath = $config['_path']['rootDir'] . $config['_log'][$logType . 'Log'] . date('/Y/m/d',$_SERVER['REQUEST_TIME']) . $logType;
        is_dir($temp = dirname($logPath)) || mkdir($temp, 0777, true);
        file_put_contents($logPath, strtr(serialize($logData), array("\r\n" => ' ' . ($temp = chr(0)), "\r" => $temp, "\n" => $temp)) . "\n", FILE_APPEND | LOCK_EX);
    }

    /**
     * 描述 : 记录php错误及异常
     * 作者 : Edgar.lee
     */
    static public function phpLog($errno, $errstr=null, $errfile=null, $errline=null)
    {
        $config = &self::getConfig();

        //错误,异常基本信息
        if($errstr===null)    //异常
        {
            $backtrace=array(
                'logType'=>'exception'
                ,'environment'=>array(
                        'code'           => $errno->getCode(),       //异常代码
                        'message'        => $errno->getMessage(),    //异常消息
                        'file'           => $errno->getFile(),       //异常文件
                        'line'           => $errno->getLine(),       //异常行
                        'debugBacktrace' => $errno->getTrace()       //异常追踪
                )
            );
        } else {    //错误
            $backtrace=array(
                'logType'=>'error'
                ,'environment'=>array(
                        'code'=>$errno
                        ,'message'=>$errstr
                        ,'file'=>$errfile
                        ,'line'=>$errline
                )
            );
        }

        //debug运行追踪
        if( !isset($backtrace['environment']['debugBacktrace']) )
        {
            $backtrace['environment']['debugBacktrace'] = debug_backtrace();
            array_splice($backtrace['environment']['debugBacktrace'], 0, 1);
        }

        //格式化日志
        self::formatLog($backtrace);

        //错误从扩展发出
        if( strncmp($backtrace['environment']['file'], '/include/Of/Extension/extensionMatch.php(', 41) === 0 )
        {
            $temp = '';
            foreach($backtrace['environment']['debugBacktrace'] as &$v)
            {
                if( isset($v['class']) )
                {
                    $temp = $v['class'];
                    break;
                }
            }
            $backtrace['environment']['file'] = '/' . strtr($temp, '_', '/') . '.php';    //扩展路径
        }

        //输出日志信息
        $errorLevel=array(
            0=>'Exception'                      //异常
            ,1=>'E_ERROR'                       //致命的运行时错误。错误无法恢复。脚本的执行被中断。
            ,2=>'E_WARNING'                     //非致命的运行时错误。脚本的执行不会中断。
            ,4=>'E_PARSE'                       //编译时语法解析错误。解析错误只应该由解析器生成。
            ,8=>'E_NOTICE'                      //运行时提示。可能是错误，也可能在正常运行脚本时发生。
            ,16=>'E_CORE_ERROR'                 //由 PHP 内部生成的错误。
            ,32=>'E_CORE_WARNING'               //由 PHP 内部生成的警告。
            ,64=>'E_COMPILE_ERROR'              //由 Zend 脚本引擎内部生成的错误。
            ,128=>'E_COMPILE_WARNING'           //由 Zend 脚本引擎内部生成的警告。
            ,256=>'E_USER_ERROR'                //由于调用 trigger_error() 函数生成的运行时错误。
            ,512=>'E_USER_WARNING'              //由于调用 trigger_error() 函数生成的运行时警告。
            ,1024=>'E_USER_NOTICE'              //由于调用 trigger_error() 函数生成的运行时提示。
            ,2048=>'E_STRICT'                   //运行时提示。对增强代码的互用性和兼容性有益。
            ,4096=>'E_RECOVERABLE_ERROR'        //可捕获的致命错误。
            ,8191=>'E_DEPRECATED'               //运行时通知。启用后将会对在未来版本中可能无法正常工作的代码给出警告。
            ,16384=>'E_USER_DEPRECATED'         //用户产少的警告信息。 
            ,30719=>'E_ALL'                     //所有的错误和警告，除了 E_STRICT。
        );

        self::writeLog($backtrace, 'php', "<font style='display:block; color:#F00; font-weight:bold;'>{$errorLevel[$backtrace['environment']['code']]} : \"{$backtrace['environment']['message']}\" in {$backtrace['environment']['file']} on line {$backtrace['environment']['line']}. Timestamp : {$_SERVER['REQUEST_TIME']}</font>");
    }

    /**
     * 描述 : 记录sql错误
     * 参数 :
     *      errorCode : sql的错误
     *      errorSql  : 错误的sql
     * 作者 : Edgar.lee
     */
    static public function sqlLog($errorCode, $errorSql)
    {
        $config = &self::getConfig();
        $sysBacktrace = debug_backtrace();
        $ofDirLen = strlen(Of_DIR);
        $extensionMatch = Of_DIR . '\Extension\extensionMatch.php(';    //匹配扩展
        $extensionMatchLen = strlen($extensionMatch);

        for($i = 0, $l = count($sysBacktrace); $i < $l; ++$i)
        {
            if(isset($sysBacktrace[$i]['file']) && (strncmp($extensionMatch, $sysBacktrace[$i]['file'], $extensionMatchLen) === 0 || strncmp(Of_DIR, $sysBacktrace[$i]['file'], $ofDirLen) !== 0) )
            {
                break;
            }
        }

        //debug运行追踪
        array_splice($sysBacktrace, 0, $i);
        if( strncmp($extensionMatch, $sysBacktrace[0]['file'], $extensionMatchLen) === 0 )
        {
            $sysBacktrace[0]['file'] = ROOT_DIR . '/' . strtr($sysBacktrace[1]['class'], '_', '/') . '.php';
        }

        //生成错误列表
        $backtrace=array(
            'logType'=>'sqlError'
            ,'environment'=>array(
                'code' => &$errorCode,
                'message' => &$errorSql,
                'file' => $sysBacktrace[0]['file'],
                'line' => $sysBacktrace[0]['line'],
                'debugBacktrace' => &$sysBacktrace
            )
        );

        //格式化日志
        self::formatLog($backtrace);

        //输出错误日志
        self::writeLog($backtrace, 'sql', "<font style='display:block; color:#F00; font-weight:bold;'>[{$backtrace['environment']['code']}] : \"{$backtrace['environment']['message']}\" in {$backtrace['environment']['file']} on line {$backtrace['environment']['line']}. Timestamp : {$_SERVER['REQUEST_TIME']}</font>");
    }
}
//trigger_error("A custom error has been triggered");        //错误
//throw new Exception("Value must be 1 or below");        //异常