<?php
define('OSYNC_SUCCEED', '1');    //成功
define('OSYNC_FAILED', '-1');    //失败,小数说明(-1.1:当运行定制sql或函数缺没有权限时的失败信息)
define('OSYNC_DENIED', '-2');    //拒绝,小数说明(-2.1:未通过安全校验; -2.2:服务端不存在客户端的配置文件; -2.3:本端拒绝发送数据; -2.4:远端拒绝接收请求)

class oSync    //通信
{
    private static $constants = null;    //常量存储

    /**
     * 描述 : 插件初始化,安全校验,解析post数据
     * 作者 : Edgar.lee
     */
    public static function init() {
        self::$constants['isServer'] = self::getConfig('id', false) === false;    //初始化常量(是否是服务器)
        $constant = self::getConstant();

         if($constant['isRequest'])    //两端通信
         {
            self::getConfig('enableResponse') || exit(OSYNC_DENIED . '.4');    //拒绝接受请求
            if(
                strlen($key = self::getConfig('key')) === 0 ||                               //无效key值
                $constant['t'] + self::getConfig('timeout') < $_SERVER['REQUEST_TIME'] ||    //访问超时
                md5($constant['id'] . $constant['t'] . (isset($_GET['cookie']) ? $_GET['cookie'] : '') . $key) !== $constant['md5Check']       //未通过安全验证
            ) {
                exit(OSYNC_DENIED . '.1');    //拒绝访问
            }

            ignore_user_abort(true);    //忽略客户端断开
            header('P3P: CP=CAO PSA OUR');    //隐私共享
            header('ORIVON_OSYNC_SESSIONNAME: ' . session_name());    //发送session名
            isset($_GET['cookie']) && $constant['cookie'] !== $_GET['cookie'] && setcookie(    //同步通信附加cookie
                'ORIVON_OSYNC',
                self::$constants['cookie'] = $_GET['cookie'],    //更新常量数据
                2147443200,
                '/'    //插件url根目录
            );
            isset($_REQUEST['data']) && $_POST = unserialize(self::txtEncrypt($key, $_REQUEST['data'], false));    //解密数据
            self::transcodingData($_POST, false);    //解码+防注入

            //根据常量,加载客户端或服务端文件
            include $constant['rootDir'] . ($constant['isServer'] ? '/com/requestServerInit.php' : '/com/requestClientInit.php');
        } elseif(isset($_GET['async']) && md5(serialize(self::getConfig(null, false))) === $constant['md5Check']) {    //异步请求
            ignore_user_abort(true);    //忽略连接断开
            session_id() && session_write_close();    //关闭session
            self::$constants = $_POST['constant'];    //拷贝配置文件
            self::getConfig(null, $_POST['constant']['id']);    //切换配置文件
            self::responseData(OSYNC_SUCCEED);
            self::requestData($_POST['data']);
            exit;
        }
    }

    /**
     * 描述 : 获取插件相关常量
     * 参数 :
     *      key : 指定获取的常量值,null返回所有常量
     * 作者 : Edgar.lee
     */
    public static function getConstant($key = null) {
        $constants = &self::$constants;
        if( $constants === null )
        {
            $constants = array(
                'rootDir'   => strtr(dirname(dirname(__FILE__)), '\\', '/'),                       //当前插件跟目录
                'rootUrl'   => null,                                                               //当前插件跟URL
                'id'        => isset($_GET['id']) ? (int)$_GET['id'] : false,                      //客户端在服务端配置文件的ID
                't'         => isset($_GET['t']) ? (int)$_GET['t'] : 0,                            //本次通信时间
                'md5Check'  => isset($_GET['md5Check']) ? $_GET['md5Check'] : '',                  //md5校验 md5(id + t)
                'cookie'    => isset($_COOKIE['ORIVON_OSYNC']) ? $_COOKIE['ORIVON_OSYNC'] : '',    //客户端与服务端通信时附带的COOKIE
                'isRequest' => null,                                                               //否直接请求,true=是,false=非请求
                'isServer'  => null,                                                               //是否是服务端,true=是,false=非
            );

            //否直接请求
            $constants['isRequest'] = strcasecmp($constants['rootDir'] . '/api/oi.php', strtr($_SERVER["SCRIPT_FILENAME"], '\\', '/')) === 0;

            //当前插件跟URL
            $temp = array(
                'scriptName' => strtr(strrev($_SERVER['SCRIPT_NAME']), '\\', '/'),
                'scriptFile' => strtr(strrev($_SERVER['SCRIPT_FILENAME']), '\\', '/'),
                'scriptPos'  => 1,    //脚本位置
            );
            for($i = 0, $iL = strlen($temp['scriptName']); $i < $iL; ++$i)
            {
                if( $temp['scriptName'][$i] !== $temp['scriptFile'][$i] )
                {
                    break;
                } elseif($temp['scriptName'][$i] === '/') {
                    $temp['scriptPos'] = $i + 1;
                }
            }
            $constants['rootUrl'] = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . substr($_SERVER['SCRIPT_NAME'], 0, -$temp['scriptPos']) . substr($constants['rootDir'], strlen(substr($_SERVER['SCRIPT_FILENAME'], 0, -$temp['scriptPos'])));
        }

        return $key === null ? $constants : $constants[$key];
    }

    /**
     * 描述 : 获取config.inc.php配置文件
     * 参数 :
     *      key    : 读取指定配置文件下的内容,null=返回所有配置文件,如果指定key值不存在,返回false
     *      client : true=调用客户端配置文件,false=调用全局配置文件,数字切换默认客户端配置文件
     * 作者 : Edgar.lee
     */
    public static function getConfig($key = null, $client = true) {
        static $config = null;      //全局配置文件
        static $clientId = null;    //客户端在服务端的ID
        if( $config === null )      //加载配置文件
        {
            $rootDir = self::getConstant('rootDir');
            require $rootDir . '/config.inc.php';
            if( !isset($config['id']) )    //是服务端
            {
                foreach($config as $k => &$v){ $v['id'] = (int)$k; }    //遍历服务端ID
                if(
                    self::getConstant('isRequest') &&                       //请求了本插件
                    !isset($config[$clientId = self::getConstant('id')])    //服务端中没有对应的客户端
                ) {
                    exit(OSYNC_DENIED . '.2');    //拒绝访问(服务端不存在客户端的配置文件)
                }
            }
        }

        if( $client === false || isset($config['id']) )    //获取全局配置文件 || 是客户端
        {
            $tempConfig = &$config;
        } else if( $client === true ) {    //记忆的客户端
            $tempConfig = &$config[$clientId];
        } else if( isset($config[$client]) ) {    //切换默认客户端
            $tempConfig = &$config[$client];
            $clientId = $client;
        } else {
            return false;
        }

        if($key === null)
        {
            return $tempConfig;
        } else if( isset($tempConfig[$key]) ) {    //根据第二参数返回信息
            return $tempConfig[$key];
        } else {
            return false;
        }
    }

    /**
     * 描述 : 转码传入的数据
     * 参数 :
     *     &data    : 传入指定的转码数据
     *      encode  : true=编码,false=解码
     *     &system  : 系统参数,可以自动读取,{charset : 客户端字符集, isServer : 当前环境是否是服务端}
     * 返回 :
     *      
     * 作者 : Edgar.lee
     */
    private static function transcodingData(&$data, $encode = true, &$system = null) {
        static $thisFun = __FUNCTION__;

        if( $system === null )
        {
            $system['charset'] = strtoupper(self::getConfig('charset'));
            $system['isServer'] = self::getConstant('isServer');
        }
        if( !isset($system['isTranscoding']) )
        {
            $system['isTranscoding'] = $system['isServer'] || $system['charset'] === 'UTF-8';    //是否需要转码(true=不需要, false=需要)
        }

        if(is_array($data))
        {
            $valueBackUp = $data;
            foreach($valueBackUp as $k => &$v)
            {
                unset($data[$k]);
                if( $encode === false )    //解码
                {
                    $system['isTranscoding'] || $k = iconv('UTF-8', "{$system['charset']}//IGNORE", $k);    //客户端环境下转换成客户编码
                    $k = addslashes($k);    //添加反斜线(防注入)
                } else {    //编码
                    $system['isTranscoding'] || $k = iconv($system['charset'], 'UTF-8//IGNORE', $k);
                }
                $data[$k] = $v;
                self::$thisFun($data[$k], $encode, $system);
            }
        } elseif(is_string($data)) {
            if( $encode === false )    //解码
            {
                $system['isTranscoding'] || $data = iconv('UTF-8', "{$system['charset']}//IGNORE", $data);    //客户端环境下转换成客户编码
                $data = addslashes($data);
            } else {    //编码
                $system['isTranscoding'] || $data = iconv($system['charset'], 'UTF-8//IGNORE', $data);
            }
        }
    }

    /**
     * 描述 : 文本加密与解密
     * 参数 :
     *      keyArr  : 文本密钥,字符串或数组,可以使用两个密钥加强保护,默认值[orivon, Edgar.lee By],通过字符串或数组[0]传递简单密钥,数组[1]=加强密钥
     *      txt     : 需要加解密的文本
     *      encrypt : 加密解密标识,true(默认)=加密,false=解密
     * 返回 :
     *      加密或解密后的明码字符串
     * 演示 :
     *      txtEncrypt('密码', '测试');
     *      随机加密字符,如:Yegw4WXcMOth/DvC
     *      txtEncrypt('密码', txtEncrypt('密码', '测试'), false);
     *      测试
     *      txtEncrypt(array('初级密钥', '加强密钥'), txtEncrypt(array('初级密钥', '加强密钥'), '测试'), false);
     *      测试
     * 作者 : Edgar.lee
     */
    private static function txtEncrypt($keyArr, $txt = '', $encrypt = true) {
        $ctr = 0;
        $temp = '';

        if(is_bool($encrypt))    //第一层运算
        {
            //初始化密钥
            $keyArr = (array)$keyArr + array(
                'orivon',    //初级密钥
                'oSyn By Orivon',    //加强密钥
                'thisFun' => __FUNCTION__    //当前方法
                //'enhancedKey' => 加强密钥(加密/解密)值,算法 : md5($keyArr[1]) ^ md5(随机数)
            );
            $keyArr[0] = (string)$keyArr[0];
            $keyArr[1] = (string)$keyArr[1];
            if($keyArr[0] === $keyArr[1])
            {
                trigger_error('两次密钥不能相同');     //错误
                return false;
            }

            if($encrypt)    //加密
            {
                $encrypt_key = md5($_SERVER['REMOTE_ADDR'] . microtime() . rand());
                $keyArr['enhancedKey'] = self::$keyArr['thisFun']($keyArr[1], $encrypt_key, null);
                for($i = 0, $iL = strlen($txt); $i < $iL; $i++) {
                    $ctr = $ctr === 32 ? 0 : $ctr;
                    $temp .= $keyArr['enhancedKey'][$ctr] . ($txt[$i] ^ $encrypt_key[$ctr++]);
                }
                return base64_encode(self::$keyArr['thisFun']($keyArr[0], $temp, null));
            } else {    //解密
                $txt = self::$keyArr['thisFun']($keyArr[0], base64_decode(strtr($txt, ' ', '+')), null);
                $keyArr['enhancedKey'] = md5($keyArr[1]);
                for($i = 0, $iL = strlen($txt);$i < $iL; $i++) {
                    $ctr = $ctr === 32 ? 0 : $ctr;
                    $md5 = $txt[$i] ^ $keyArr['enhancedKey'][$ctr++];
                    $temp .= $txt[++$i] ^ $md5;
                }
                return $temp;
            }
        } else {    //第二层运算
            $keyArr = md5($keyArr);
            for($i = 0, $iL = strlen($txt); $i < $iL; $i++) {
                $ctr = $ctr === 32 ? 0 : $ctr;
                $temp .= $txt[$i] ^ $keyArr[$ctr++];
            }
            return $temp;
        }
    }

    /**
     * 描述 : 表单提交
     * 参数 :
     *      url      : 请求的完整路径
     *      data     : 提交数据{get : get数据, post : post数据}post数据,两种数据类型:array会解析成字符串,string=直接发送
     * 返回 :
     *      {state:error=失败;success=成功, data:失败=[错误描述,失败码];成功=目标输出的内容}
     * 作者 : Edgar.lee
     */
    private static function &postForm($url, $data = array())
    {
        //参数初始化
        static $cookie = null;    //与服务端通信时附带的COOKIE
        $postData = isset($data['post']) ? $data['post'] : '';    //post数据
        $getData = isset($data['get']) ? $data['get'] : '';    //get数据
        is_array($postData) && $postData = http_build_query($postData);    //格式化post参数
        is_array($getData) && $getData = http_build_query($getData);    //格式化get参数
        $postDatalen = strlen($postData);    //post参数长度

        if( $cookie === null )
        {
            $cookie = self::getConstant('isServer') ? '' : self::getConstant('cookie');
        }

        //路径解析
        $parseUrl = parse_url($url) + array(    //解析目标网址
            'scheme' => 'http',
            'port' => '80',
            'query' => ''
        );
        $parseUrl['scheme'] = strtolower($parseUrl['scheme']) === 'https' ? 'ssl://' : '';    //支持https
        $parseUrl['query'] .= ($parseUrl['query'] === '' || $getData === '' ? '' : '&') . $getData;

        //发送请求
        $fp = @fsockopen($parseUrl['scheme'] . $parseUrl['host'], $parseUrl['port'], $errno, $errstr, self::getConfig('timeout'));
        if (!$fp)
        {
            trigger_error("{$errstr} ($errno)");     //错误
            $data = array('state' => 'error', 'data' => array($errstr, $errno));    //状态,内容
        } else {
            $out[] = "POST {$parseUrl['path']}?{$parseUrl['query']} HTTP/1.1\r\n";
            $out[] = "Host: {$parseUrl['host']}\r\n";
            $out[] = "Cookie: {$cookie}\r\n";
            $out[] = "Content-type: application/x-www-form-urlencoded\r\n";
            $out[] = "Connection: Close\r\n";
            $out[] = "Content-Length: {$postDatalen}\r\n";
            $out[] = "\r\n";
            $out[] = "{$postData}\r\n";
            fwrite($fp, join($out));

            while ( !feof($fp) )
            {
                if( ($receive[] = fgets($fp, 2048)) === "\r\n" && !self::getConfig('debug') )    //当读取全部头后 && 不是debug模式,则读取指定长度(Content-Length)的数据,然后关闭连接
                {
                    preg_match("/Content-Length: (\d+)/", join($receive), $temp);
                    $receive[] = fgets($fp, $temp[1] + 1);
                    break;
                }
            }
            fclose($fp);

            $receive = explode("\r\n\r\n", join($receive), 2);
            self::getConfig('debug') && print_r($receive);    //调试模式

            if( preg_match('/ORIVON_OSYNC_SESSIONNAME: (\w+)/', $receive[0], $temp) )    //读取请求SESSION cookie
            {
                preg_match("/Set-Cookie: ({$temp[1]}=[^;]*)/", $receive[0], $temp) && $cookie = $temp[1];
            }

            if( preg_match('/.* (\d+) .*/', $receive[0], $temp) && $temp[1] === '200')    //请求成功
            {
                $receive = is_numeric($receive[1]) ? $receive[1] : unserialize(self::txtEncrypt(self::getConfig('key'), $receive[1], false));    //解密
                self::transcodingData($receive, false);    //解码+防注入
                $data = array('state' => 'success', 'data' => &$receive);    //状态,内容
            } else {    //失败
                $data = array('state' => 'error', 'data' => &$temp);    //状态,内容
            }
        }
        return $data;
    }

    /**
     * 描述 : 响应请求数据
     * 参数 :
     *      data   : 响应数据
     *      print  : true=使用echo输出,false=使用return返回
     * 返回 :
     *      
     * 作者 : Edgar.lee
     */
    public static function &responseData($data, $print = true) {
        self::transcodingData($data);    //数据编码
        $data = self::txtEncrypt(self::getConfig('key'), serialize($data));

        if($print)
        {
            header('Content-Length: ' . strlen($data));
            echo $data;
            ob_get_length() && ob_flush();
            flush();
        }
        return $data;
    }

    /**
     * 描述 : 客户端与服务端相互发送数据
     * 参数 :
     *      postData : 向服务器发送的post数据
     *      async    : 异步请求,当不关心请求结果时使用
     * 返回 :
     *      返回响应的数据
     * 作者 : Edgar.lee
     */
    public static function &requestData($postData, $async = false)
    {
        if( $async )    //异步请求
        {
            $data['get']['async'] = '1';
            $data['get']['md5Check'] = md5(serialize(self::getConfig(null, false)));
            $data['post']['data'] = $postData;    //请求数据
            $data['post']['constant'] = self::getConstant();    //常量数据

            $data = &self::postForm(self::getConstant('rootUrl') . '/com/oSync.php', $data);

            return $data;
        } elseif( self::getConstant('isServer') ) {    //服务端
            $returnData = array();
            $defaultClientId = self::getConstant('id');    //默认客户端ID
            $allConfig = self::getConfig(null, false);    //全部配置文件
            if( self::getConstant('isRequest') )    //客户端请求时,排除当前客户端的同步
            {
                unset($allConfig[$defaultClientId]);
            }

            foreach($allConfig as $k => &$v)
            {
                if( self::getConfig('enableRequest', $k) )    //切换客户端并判断是否允许像客户端发送信息
                {
                    $data['get']['t'] = time();
                    $data['get']['id'] = $k;
                    $data['get']['md5Check'] = md5($k . $data['get']['t'] . self::getConfig('key'));
                    $data['post']['data'] = &self::responseData($postData, false);    //序列化并加密文本

                    $returnData[$k] = &self::postForm(self::getConfig('url') . '/api/oi.php', $data);
                } else {
                    $returnData[$k] = array('state' => 'success', 'data' => OSYNC_DENIED . '.3');    //拒绝发送数据
                }
            }

            self::getConfig(null, $defaultClientId);    //切换回默认客户端配置
            return $returnData;
        } else {    //客户端
            if( self::getConfig('enableRequest') )
            {
                $key = self::getConfig('key');    //获取key

                $data['get']['t'] = $_SERVER['REQUEST_TIME'];
                $data['get']['id'] = self::getConfig('id');
                $data['get']['md5Check'] = md5($data['get']['id'] . $data['get']['t'] . $key);
                $data['post']['data'] = &self::responseData($postData, false);    //序列化并加密文本

                $data = &self::postForm(self::getConfig('url') . '/api/oi.php', $data);
            } else {
                $data = array('state' => 'success', 'data' => OSYNC_DENIED . '.3');    //拒绝发送数据
            }

            return $data;
        }
    }

    /**
     * 描述 : 批量去掉斜线
     * 参数 :
     *      &textList     : 指定转换的文本或数组
     *       excludeArr   : 在textList为数组模式下指定排除项,默认null,array=按节点顺序排除textList的过滤(如果某项的值为false,则排除该项的键及其子项; 如果值是空数组仅排除其子项)
     * 作者 : Edgar.lee
     */
    public static function bulkStripSlashes(&$textList, $excludeArr = null) {
        if(is_array($textList))
        {
            $newTextList = array();
            foreach($textList as $k => &$v)
            {
                $nextExcludeArr = null;    //下一次递归限制变量
                if(is_array($excludeArr) && isset($excludeArr[$k]) )
                {
                    if(is_array($nextExcludeArr = &$excludeArr[$k]))    //如果是数组,去掉键值斜线
                    {
                        $newTextList[stripslashes($k)] = &$v;    //得到的新键值
                        if(!count($nextExcludeArr)){ continue; }    //如果是空数组,跳过子节点
                    } else {
                        $newTextList[$k] = &$v;    //拷贝键值
                        continue;
                    }
                } else {
                    $newTextList[stripslashes($k)] = &$v;    //得到的新键值
                }
                self::bulkStripSlashes($v, $nextExcludeArr);
            }
            $textList = $newTextList;
        } elseif(is_string($textList)) {
            $textList = stripslashes($textList);
        }
    }
}

oSync::init();    //初始化