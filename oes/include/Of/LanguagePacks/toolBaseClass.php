<?php
class Of_LanguagePacks_toolBaseClass {
    private static $config            = null;       //配置文件
    private static $globalTranslation = array();    //全局翻译

    /**
     * 描述 : 初始化
     * 参数 :
     *      config : 配置文件
     * 返回 :
     *      
     * 作者 : Edgar.lee
     */
    public static function init( $config = array() ) {
        self::$config = &$config;
        if( class_exists('Of') )
        {
            $config += array(
                'lRootDir' => ROOT_DIR . Of::config('_language.path'),
                'mRootDir' => ROOT_DIR
            );
        } else {
            $config += array(
                'lRootDir' => dirname(__FILE__),
                'mRootDir' => ''
            );
        }

        set_time_limit(0);
        //self::test();    //演示方法
    }

    /**
     * 描述 : 各功能演示
     * 作者 : Edgar.lee
     */
    public static function test() {
        /* 获取指定目录
        print_r(self::getDir());
        // */

        /* 创建语言包
        print_r(self::create('CN'));
        // */

        /* 提取字符串
        print_r(self::fetchFileStr('/views/demo/ofControllers/viewTest.tpl.php', '加载默认语言中的该字符串', 1));
        // */

        /* 读取语言包
        $temp = &self::translation('/default/views/demo/ofControllers/viewTest.tpl.php.language', null, array('global', 'discard'));           //读数组
        //self::translation('/CN/demo/ofControllers.php.language', $temp);    //写数组
        //self::translation('/KK/demo/ofControllers.php.language', false);    //删除语言包
        print_r($temp);
        // */

        /* 读取目录状态
        print_r(self::dirState('/default/views/demo/ofControllers/viewTest.tpl.php.language'));
        // */

        /* 导入语言包
        self::import('/MM', array('/default', '/CN', '/CN/demo/ofControllers.php.language', '/default/~globalTranslation/229/136.language'));
        // */

        /* 合并语言包
        self::merge('/KK', array('/default', '/CN', '/MM'));
        // */

        /* 优化语言包
        self::optimize('/KK');
        // */
    }

    /**
     * 描述 : 磁盘优化语言包
     * 参数 :
     *      language : 语言包文件夹路径名
     *      type     : ['global'(生成全局翻译)]
     * 返回 :
     *      成功返回整理内容,失败返回false
     * 作者 : Edgar.lee
     */
    public static function optimize( $language, $type = array('global') ) {
        $lRootDir = &self::$config['lRootDir'];    //语言包根目录

        if( is_string($language) && is_dir($temp = $lRootDir . $language) )
        {
            //提取全局语言包
            $globalDir = $temp . '/~globalTranslation';    //全局路径
            $trData = array();                             //翻译数据
            $eachList = array(                             //遍历列表
                $language => true                          //是否是文件夹
            );

            while( list($path, $isDir) = each($eachList) ) {
                if( strpos( $path, '/~globalTranslation' ) === false )
                {
                    if( $isDir === false )                                    //分析文件
                    {
                        self::translation($path, null, array('global', 'discard'), $trData);    //查询数据
                    } else if( is_array($temp = self::getDir( $path )) ) {    //读取文件夹
                        $eachList += $temp;
                    }
                }
                unset($eachList[$path]);
            }

            if( in_array('global', $type) )
            {
                self::deletePath($globalDir);    //删除全局语言包
                foreach($trData['global'] as $k => &$v)
                {
                    self::fileRW( $k, $v );    //写回数据
                }
            }
            return $trData;
        }
        return false;
    }

    /**
     * 描述 : 合并语言包
     * 参数 :
     *      path  : 指定输出文件夹路径
     *      merge : (array)指定合并的路径
     * 返回 :
     *      成功返回true,失败返回false
     * 作者 : Edgar.lee
     */
    public static function merge( $path, $merge ) {
        if( is_string($path) )
        {
            $lRootDir = &self::$config['lRootDir'];    //语言包根目录
            $merge = array_flip((array)$merge);        //合并列表

            foreach( $merge as $mk => &$mv )
            {
                $mergeLen = strlen($mk);
                if( is_array($eachList = self::getDir( $mk )) )
                {
                    while( list($dir, $isDir) = each($eachList) ) {
                        if( !file_exists($lRootDir . ($mgDir = $path . substr($dir, $mergeLen))) )    //文件(夹)不存在
                        {
                            self::copyPath($lRootDir . $dir, $lRootDir . $mgDir);
                        } else if( $isDir === false ) {                                            //是文件
                            if( is_array($data = self::fileRW( $dir )) && count($data) )
                            {
                                is_array($mgData = self::fileRW( $mgDir )) || $mgData = array();
                                list(, $temp) = each($data);
                                if( is_array($temp) )    //页面翻译
                                {
                                    $data += array(array(), array());
                                    $trType = array(0, 1);    //0=php翻译,1=js翻译
                                    foreach( $trType as &$t )    //遍历两种翻译类型
                                    {
                                        foreach( $data[$t] as $query => &$trArr )    //请求参数 => 翻译体
                                        {
                                            foreach( $trArr as $or => &$tr )    //原始翻译 => 对应翻译信息
                                            {
                                                foreach( $tr as $k => &$v )    //关键词 => 对应的属性
                                                {
                                                    if( empty($mgData[$t][$query][$or][$k][0]) )
                                                    {
                                                        $mgData[$t][$query][$or][$k] = $data[$t][$query][$or][$k];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else {                 //全局翻译
                                    foreach( $data as $k => &$v )    //关键词 => 对应翻译
                                    {
                                        if( empty($mgData[$k]) )
                                        {
                                            $mgData[$k] = $v;
                                        }
                                    }
                                }
                                self::fileRW( $mgDir, $mgData );
                            }
                        } else if( is_array($temp = self::getDir( $dir )) ) {                      //是文件夹
                            $eachList += $temp;
                        }
                        unset($eachList[$dir]);
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 描述 : 导入语言包
     * 参数 :
     *      path   : 指定文件或文件夹路径
     *      import : (array)指定导入的路径
     * 返回 :
     *      成功返回true,失败返回false
     * 作者 : Edgar.lee
     */
    public static function import( $path, $import ) {
        if( is_string($path) )
        {
            $lRootDir = &self::$config['lRootDir'];    //语言包根目录
            $trList = array();                         //翻译集合
            $pathLen = strlen($path);                  //路径长度
            $import = (array)$import;                  //导入列表
            $eachList = array(                         //遍历列表
                $path => is_dir($lRootDir . $path)     //是否是文件夹
            );

            //翻译集合
            foreach($import as $ik => &$iv)
            {
                if( is_file($lRootDir . $iv) )
                {
                    if( is_array($data = self::fileRW( $iv )) && count($data) )
                    {
                        list(, $temp) = each($data);
                        if( is_array($temp) )    //页面翻译
                        {
                            $data += array(array(), array());
                            $trType = array(0, 1);    //0=php翻译,1=js翻译
                            foreach( $trType as &$t )    //遍历两种翻译类型
                            {
                                foreach( $data[$t] as $query => &$trArr )    //请求参数 => 翻译体
                                {
                                    foreach( $trArr as $or => &$tr )    //原始翻译 => 对应翻译信息
                                    {
                                        foreach( $tr as $k => &$v )    //关键词 => 对应的属性
                                        {
                                            if( !empty($v[0]) && (!isset($trList[$t][$query][$or][$k]) || $trList[$t][$query][$or][$k][1] < $v[1]) )
                                            {
                                                unset($v[2]);
                                                $trList[$t][$query][$or][$k] = $v;
                                            }
                                        }
                                    }
                                }
                            }
                        } else {                 //全局翻译
                            foreach( $data as $k => &$v )    //关键词 => 对应翻译
                            {
                                if( !empty($v) && !isset($trList[''][$k]) )
                                {
                                    $trList[''][$k] = $v;
                                }
                            }
                        }
                    }
                    unset($import[$ik]);
                }
            }

            //开始导入
            $import = array_flip($import);
            while( list($path, $isDir) = each($eachList) ) {
                if( $isDir === false )                                    //分析文件
                {
                    if( is_array($data = self::fileRW( $path )) && count($data) )
                    {
                        //打开文件夹中的导入信息
                        $temp = substr($path, $pathLen);
                        foreach($import as $ik => &$iv)
                        {
                            is_array($iv = self::fileRW( $ik . $temp )) || $iv = null;
                        }

                        //依据不同方式导入
                        list(, $temp) = each($data);
                        if( is_array($temp) )    //页面翻译
                        {
                            $data += array(array(), array());
                            $trType = array(0, 1);    //0=php翻译,1=js翻译

                            //遍历原始数据
                            foreach( $trType as &$t )    //遍历两种翻译类型
                            {
                                foreach( $data[$t] as $query => &$trArr )    //请求参数 => 翻译体
                                {
                                    foreach( $trArr as $or => &$tr )    //原始翻译 => 对应翻译信息
                                    {
                                        foreach( $tr as $k => &$v )    //关键词 => 对应的属性
                                        {
                                            $iState = true;
                                            foreach($import as &$iv)                             //精确级
                                            {
                                                if( !empty($iv[$t][$query][$or][$k][0]) && (empty($v[0]) || $iv[$t][$query][$or][$k][1] < $v[1]) )
                                                {
                                                    $iv = &$iv[$t][$query][$or][$k];
                                                    unset($iv[2]);    //注销行数(保留原数据行数)
                                                    $v = $iv + $v;
                                                    $iState = false;
                                                }
                                            }

                                            if( $iState )
                                            {
                                                if( !empty($trList[$t][$query][$or][$k][0]) )    //页面级
                                                {
                                                    $v = $trList[$t][$query][$or][$k] + $v;
                                                } else if( !empty($trList[''][$or]) ) {          //全局级
                                                    $v[0] = $trList[''][$or];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else {                 //全局翻译
                            foreach( $data as $k => &$v )
                            {
                                $iState = true;
                                foreach( $import as $ik => &$iv )    //关键词 => 对应翻译
                                {
                                    if( !empty($iv[$k]) )
                                    {
                                        $v = $iv[$k];
                                        $iState = false;
                                    }
                                }

                                if( $iState && !empty($trList[''][$k]) )    //全局级
                                {
                                    $v = $trList[''][$k];
                                }
                            }
                        }
                    }
                    self::fileRW( $path, $data );    //写回导入数据
                } else if( is_array($temp = self::getDir( $path )) ) {    //读取文件夹
                    $eachList += $temp;
                }
                unset($eachList[$path]);
            }
            return true;
        }
        return false;
    }

    /**
     * 描述 : 目录状态
     * 参数 :
     *      path : 指定文件或文件夹路径
     *      type : 查看的状态 {
     *          'ignore'  : ''    //忽略列表, true=有忽略, false=无忽略
     *          'key'     : ''    //键级状态, true=有未翻译, false=全部完成
     *          'page'    : ''    //页级状态, 同上
     *          'global'  : ''    //全局状态, 同上
     *          'discard' : ''    //废弃翻译, true=有废弃, false=无废弃
     *      }
     * 返回 :
     *      返回填充后的type数据
     * 作者 : Edgar.lee
     */
    public static function dirState( $path, $type = null ) {
        $lRootDir = &self::$config['lRootDir'];    //语言包根目录
        $type === null && $type = array(           //默认类型列表
            'ignore'  => '',    //忽略列表
            'key'     => '',    //键级状态
            'page'    => '',    //页级状态
            'global'  => '',    //全局状态
            'discard' => ''     //废弃翻译
        );
        $eachList = array(                         //遍历列表
            $path => is_dir($lRootDir . $path)    //是否是文件夹
        );

        while( list($path, $isDir) = each($eachList) ) {
            if( strpos( $path, '/~globalTranslation' ) === false )
            {
                if( $isDir === false )                                    //分析文件
                {
                    $temp = array('global');
                    isset($type['discard']) && !is_bool($type['discard']) && $temp[] = 'discard';
                    $data = &self::translation($path, null, $temp);    //查询数据
                    $trType = array(0, 1);                                            //0=php翻译,1=js翻译

                    foreach( $trType as &$t )    //遍历两种翻译类型
                    {
                        foreach( $data[$t] as $query => &$trArr )    //请求参数 => 翻译体
                        {
                            foreach( $trArr as $or => &$tr )    //原始翻译 => 对应翻译信息
                            {
                                foreach( $tr as $k => &$v )    //关键词 => 对应的属性
                                {
                                    isset($type['ignore']) && !is_bool($type['ignore']) && $v['ignore'] && $type['ignore'] = true;                                         //标记有忽略
                                    isset($type['global']) && !is_bool($type['global']) && empty($v['other']['global']) && $type['global'] = true;                         //标记全局未翻译
                                    isset($type['key']) && !is_bool($type['key']) && ($k !== '' || $v[2] > 0) && empty($v[0]) && $type['key'] = true;                                                  //标记键级未翻译
                                    isset($type['discard']) && !is_bool($type['discard']) && !$v['ignore'] && !empty($v['other']['discard']) && $type['discard'] = true;    //废弃翻译

                                    if( $k === '' )    //页级
                                    {
                                        isset($type['page']) && !is_bool($type['page']) && empty($v[0]) && $type['page'] = true;                                           //标记页级未翻译
                                    }
                                }
                            }
                        }
                    }
                } else if( is_array($temp = self::getDir( $path )) ) {    //读取文件夹
                    $eachList += $temp;
                }
                if( !in_array('', $type, true) )
                {
                    return $type;
                }
            }
            unset($eachList[$path]);
        }

        return $type;
    }

    /**
     * 描述 : 翻译读写操作
     * 参数 :
     *      path  : 指定文件路径
     *      write : 默认null=读出数据,false=删除数据,数组=写回内容
     *      other : 其他数据["global"(全局翻译), "discard"(查询无效)]
     * 返回 :
     *      读取时,成功返回一个数组,失败返回错误内容
     *      写入时,成功返回true,失败返回错误内容
     *      删除时,成功返回删除空目录的父层路径,失败返回false
     * 作者 : Edgar.lee
     */
    public static function &translation( $path, $write = null, $other = array(), &$index = null ) {
        $lRootDir = &self::$config['lRootDir'];                                                   //语言包根目录
        $lDir = ($temp = explode('/', $path, 3)) && isset($temp[1]) ? "/{$temp[1]}" : '';         //翻译包路径
        $fetchStr = isset($temp[2]) ? substr("/{$temp[2]}", 0, -9) : false;                       //文件路径
        $globalTranslation = &self::$globalTranslation;                                           //全局翻译
        $other = array_flip($other);                                                              //其它数据
        $writeGlobalTranslation = array();                                                        //需要写会的全局翻译
        $data = $write === null ? self::fileRW( $path ) : $write;                                 //数据初始化

        //判断全局操作
        if( strpos( $path, '/~globalTranslation' ) === false && is_file($lRootDir . $path) )
        {
            if( is_array($data) )    //数据有效
            {
                $data += array(array(), array(), array(), array(), array());    //填充数据[php翻译,js翻译,php引用,js引用,php与js修改时间]

                $trType = array(0, 1);    //0=php翻译,1=js翻译
                foreach( $trType as &$t )    //遍历两种翻译类型
                {
                    foreach( $data[$t] as $query => &$trArr )    //请求参数 => 翻译体
                    {
                        foreach( $trArr as $or => &$tr )    //原始翻译 => 对应翻译信息
                        {
                            if( count($tr) )
                            {
                                isset($tr['']) || $tr[''] = array('', $_SERVER['REQUEST_TIME'], 0);    //默认数据初始化
                                foreach( $tr as $k => &$v )    //关键词 => 对应的属性
                                {
                                    $globalDir = $lDir . '/~globalTranslation/' . ord($or[0]) . (isset($or[1]) ? '/' . ord($or[1]) : '') . '.language';    //全局路径
                                    if( !isset($globalTranslation[$globalDir]) )    //全局翻译缓存
                                    {
                                        $globalTranslation[$globalDir] = is_array($temp = self::fileRW( $globalDir )) ? $temp : array();
                                    }

                                    if( $write === null )    //读
                                    {
                                        $v['ignore'] = isset($v['ignore']) ? (boolean)$v['ignore'] : false;    //忽略属性默认值(true=未忽略,true=忽略)
                                        if( isset($other['global']) )    //读取全局翻译
                                        {
                                            $v['other']['global'] = isset($globalTranslation[$globalDir][$or]) ? $globalTranslation[$globalDir][$or] : '';
                                            $index['global'][$globalDir][$or] = $v['other']['global'];    //引用全局路径
                                        }
                                        if( isset($other['discard']) )    //读取废弃翻译
                                        {
                                            $v['other']['discard'] = !(self::fetchFileStr($fetchStr, $or, $t) === true && ($k === '' || self::fetchFileStr($fetchStr, $k, $t) === true));
                                        }
                                    } else {                 //写
                                        if( isset($other['global']) )    //写回全局翻译
                                        {
                                            $globalTranslation[$globalDir][$or] = $v['other']['global'];    //修改全局翻译
                                            $writeGlobalTranslation[$globalDir] = true;            //记录全局翻译
                                        }
                                        unset($v['other']);
                                    }
                                }
                            }
                        }
                    }
                }

                ksort($data);    //数组排序
                if( $write !== null )    //写入数据
                {
                    $data = self::fileRW( $path, $data );              //写局部翻译
                    foreach( $writeGlobalTranslation as $k => &$v )    //写全局翻译
                    {
                        self::fileRW( $k, $globalTranslation[$k] );
                    }
                }
            } else if($data === false) {    //删除文件
                if( $data = self::deletePath($lRootDir . $path) )
                {
                    while( $path = dirname($path) )    //删除空文件夹
                    {
                        if( count(self::getDir( $path )) )
                        {
                            break;
                        } else {
                            self::deletePath($lRootDir . $path);
                        }
                    }
                    $data = $path;
                }
            }
        } else {
            $data = self::msg('路径无效');
        }
        return $data;
    }

    /**
     * 描述 : 获取指定目录
     * 参数 :
     *      path : 相对lRootDir的子目录,默认''
     * 返回 :
     *      {目录名 : true为文件夹;false为文件, ...}
     * 作者 : Edgar.lee
     */
    public static function &getDir( $path = '' ) {
        $fileList = array();                       //文件列表
        $lRootDir = &self::$config['lRootDir'];    //语言包根目录
        if( is_dir($temp = $lRootDir . $path) )
        {
            $handle = opendir($temp);
            while ( ($fileName = readdir($handle)) !== false )
            {
                if ( $fileName !== '.' && $fileName !== '..' )
                {
                    $temp = "{$path}/{$fileName}";
                    $fileList[$temp] = is_dir($lRootDir . $temp);
                }
            }
            closedir($handle);
            asort($fileList);    //文件在上,文件夹在下
        } else {
            $fileList = self::msg('路径无效');
        }
        return $fileList;
    }

    /**
     * 描述 : 创建语言包
     * 参数 :
     *      name : 语言包名(国家名缩写)
     * 作者 : Edgar.lee
     */
    public static function create($name) {
        $lRootDir = &self::$config['lRootDir'];    //语言包根目录
        if( file_exists($temp[0] = "{$lRootDir}/{$name}") || !is_dir($temp[1] = "{$lRootDir}/default") )
        {
            return self::msg(isset($temp[1]) ? '开发语言包不存在' : '创建语言包已存在');
        } elseif(self::copyPath($temp[1], $temp[0])) {    //复制语言包
            return true;
        } else {                                          //复制失败,尝试删除
            self::deletePath($temp[0]);
            return self::msg('创建发生错误');
        }
    }

    /**
     * 描述 : 语言文件读写操作
     * 参数 :
     *      path  : 指定文件路径
     *      write : 默认null=读出数据,其他=写回内容
     * 返回 :
     *      读取时,成功返回一个数组,失败返回错误内容
     *      写入时,成功返回true,失败返回错误内容
     * 作者 : Edgar.lee
     */
    private static function fileRW($path, $write = null) {
        $filePath = self::$config['lRootDir'] . $path;    //语言包根目录

        if( $write === null )    //读操作
        {
            if( is_file($filePath) )
            {
                $fp = fopen($filePath , 'r');    //打开读写流
                flock($fp , LOCK_SH);        //加共享锁
                $contents = unserialize(fread($fp, filesize($filePath)));
                fclose($fp);
            } else {
                $contents = self::msg('文件不存在');
            }
        } else if( is_array($write) ) {    //全局级语言包写入前检查
            is_dir($temp = dirname($filePath)) || mkdir($temp, 0777, true);    //创建目录
            $fp = fopen($filePath , is_file($filePath) ? 'r+' : 'x+');    //打开读写流
            flock($fp , LOCK_EX);    //加共享锁
            ftruncate($fp, 0);       //清空
            $contents = fwrite($fp, serialize($write)) ? true : self::msg('写入错误');
            fclose($fp);
        } else {
            $contents = self::msg('格式错误');
        }

        return $contents;
    }

    /**
     * 描述 : 删除指定文件或文件夹
     * 参数 :
     *      path : 指定删除路径
     * 返回 :
     *      成功返回true,失败返回false
     * 作者 : Edgar.lee
     */
    private static function deletePath($path)
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
                        self::deletePath($path .'/'. $file);
                    }
                }
                closedir($dp);
            }
            return rmdir($path);
        }
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
    private static function copyPath($source, $dest)
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
                        self::copyPath("{$source}/{$file}", "{$dest}/{$file}");
                    }
                }
                closedir($dp);
            }
            return true;
        }
    }

    /**
     * 描述 : 提取文件的js与php字符串
     * 参数 :
     *      path : 指定提取文件路径
     *      str  : 查询的字符串
     *      type : 0=php, 1=js
     * 返回 :
     *      成功返回true,失败返回false,错误返回字符串
     * 作者 : Edgar.lee
     */
    private static function &fetchFileStr( $pata, $str, $type ) {
        if( is_file( $pata = self::$config['mRootDir'] . $pata) )
        {
            static $cacheStr = array();                //缓存字符串
            if( !isset($cacheStr[$pata]) )
            {
                $indexData = &$cacheStr[$pata];            //缓存引用
                $indexData = array();                      //返回数据
                $fileStr = php_strip_whitespace($pata);    //文本内容
                $fileStrLower = strtolower($fileStr);      //小写内容

                if( strtolower(pathinfo($pata, PATHINFO_EXTENSION)) === 'js' )    //js脚本
                {
                    $tagStack = array(array(    //标签栈
                        'position' => 0,
                        'matches'  => array(
                            '/*'        => false,
                            '//'        => false,
                            '\''        => true,
                            '"'         => true,
                            '</script>' => false
                        )
                    ));
                    $analyzeType = array($tagStack[0]['matches']);
                } else {                                                          //混合脚本
                    $tagStack = array();                       //标签栈
                    $analyzeType = array(array(                //解析默认匹配,[php,js]
                        '<?php'   => false,    //程序起始位置
                    ), array(
                        '<!--'    => false,    //注释起始位置
                        '<script' => false,    //脚本起始位置
                        '<'       => false,    //html起始位置
                    ));
                }

                foreach($analyzeType as &$defaultMatches)
                {
                    $nowPos = 0;    //当前位置
                    while(true)
                    {
                        $matchPos = Of_Com_MysqlStructureUpdate::strArrPos($fileStrLower, ($temp = count($tagStack)) === 0 ? $defaultMatches : $tagStack[$temp - 1]['matches'], $nowPos);
                        if($matchPos === false)
                        {
                            break;
                        } else {
                            //print_r($matchPos);
                            $nowPos = $matchPos['position'] + strlen($matchPos['match']);
                            switch($matchPos['match']) {
                                case '<?php'     :    //程序起始位置
                                    $tagStack[] = array(    //入栈
                                        'position' => $matchPos['position'],
                                        'matches'  => array(
                                            '\'' => true,
                                            '"'  => true,
                                            '?>' => false
                                        )
                                    );
                                    break;
                                case '<!--'      :    //注释起始位置
                                    $tagStack[] = array(    //入栈
                                        'position' => $matchPos['position'],
                                        'matches'  => array(
                                            '-->' => false
                                        )
                                    );
                                    break;
                                case '<script'   :    //脚本起始位置
                                    $tagStack[] = array(    //入栈
                                        'position' => $matchPos['position'],
                                        'matches'  => array(
                                            '/*'        => false,
                                            '//'        => false,
                                            '\''        => true,
                                            '"'         => true,
                                            '</script>' => false
                                        )
                                    );
                                    break;
                                case '<'         :    //html起始位置
                                    $tagStack[] = array(    //入栈
                                        'position' => $matchPos['position'],
                                        'matches'  => array(
                                            '\'' => true,
                                            '"'  => true,
                                            '>'  => false
                                        )
                                    );
                                    break;
                                case '/*'        :    //多行注释开始
                                    $tagStack[] = array(    //入栈
                                        'position' => $matchPos['position'],
                                        'matches'  => array(
                                            '*/'        => false
                                        )
                                    );
                                    break;
                                case '//'        :    //单行注释开始
                                    $tagStack[] = array(    //入栈
                                        'position' => $matchPos['position'],
                                        'matches'  => array(
                                            "\n"        => false
                                        )
                                    );
                                    break;

                                case '?>'        :    //程序结束
                                    $fileStr = substr_replace($fileStr, '', $temp = $tagStack[count($tagStack) - 1]['position'], $nowPos - $temp);    //删除程序脚本
                                    $fileStrLower = substr_replace($fileStrLower, '', $temp = $tagStack[count($tagStack) - 1]['position'], $nowPos - $temp);    //删除程序脚本
                                    $nowPos = $temp;                                                                                                  //更新查询位置
                                case '-->'       :    //注释结束
                                case '</script>' :    //脚本结束
                                case '>'         :    //html结束
                                case '*/'        :    //多行注释结束
                                case "\n"        :    //单行注释结束
                                    array_pop($tagStack);    //出栈
                                    break;

                                case '\''        :    //字符串检查
                                case '"'         :
                                    $tagStackCount = count($tagStack);
                                    if( isset($tagStack[$tagStackCount - 1]['closure']) )    //引号闭合
                                    {
                                        $temp = array(
                                            false    //false为php,true为js
                                        );
                                        if( isset($tagStack[$tagStackCount - 2]['matches']['?>']) || $temp[0] = isset($tagStack[$tagStackCount - 2]['matches']['</script>']) )    //php 或 js
                                        {
                                            $indexData[(int)$temp[0]][substr($fileStr, $temp[1] = $tagStack[$tagStackCount - 1]['position'] + 1, $matchPos['position'] - $temp[1])] = true;
                                        }
                                        array_pop($tagStack);    //出栈
                                    } else {
                                        $tagStack[] = array(    //入栈
                                            'position' => $matchPos['position'],
                                            'closure'  => $matchPos['match'],
                                            'matches'  => array(
                                                $matchPos['match'] => true
                                            )
                                        );
                                    }
                                    break;
                            }
                        }
                    }
                }
            }
            $data = isset($cacheStr[$pata][$type][$str]);
        } else {
            $data = self::msg('文件不存在');
        }
        return $data;
    }

    /**
     * 描述 : 复制指定文件或文件夹
     * 参数 :
     *      text : 原始消息
     * 返回 :
     *      返回格式化消息
     * 作者 : Edgar.lee
     */
    private static function msg($text) {
        return $text;
    }
}

/**国家语种缩写
 * en        英文
 * en_US     英文                   (美国)
 * ar        阿拉伯文
 * ar_AE     阿拉伯文               (阿拉伯联合酋长国)
 * ar_BH     阿拉伯文               (巴林)
 * ar_DZ     阿拉伯文               (阿尔及利亚)
 * ar_EG     阿拉伯文               (埃及)
 * ar_IQ     阿拉伯文               (伊拉克)
 * ar_JO     阿拉伯文               (约旦)
 * ar_KW     阿拉伯文               (科威特)
 * ar_LB     阿拉伯文               (黎巴嫩)
 * ar_LY     阿拉伯文               (利比亚)
 * ar_MA     阿拉伯文               (摩洛哥)
 * ar_OM     阿拉伯文               (阿曼)
 * ar_QA     阿拉伯文               (卡塔尔)
 * ar_SA     阿拉伯文               (沙特阿拉伯)
 * ar_SD     阿拉伯文               (苏丹)
 * ar_SY     阿拉伯文               (叙利亚)
 * ar_TN     阿拉伯文               (突尼斯)
 * ar_YE     阿拉伯文               (也门)
 * be        白俄罗斯文
 * be_BY     白俄罗斯文             (白俄罗斯)
 * bg        保加利亚文
 * bg_BG     保加利亚文             (保加利亚)
 * ca        加泰罗尼亚文
 * ca_ES     加泰罗尼亚文           (西班牙)
 * cs        捷克文
 * cs_CZ     捷克文                 (捷克共和国)
 * da        丹麦文
 * da_DK     丹麦文                 (丹麦)
 * de        德文
 * de_AT     德文                   (奥地利)
 * de_CH     德文                   (瑞士)
 * de_DE     德文                   (德国)
 * de_LU     德文                   (卢森堡)
 * el        希腊文
 * el_GR     希腊文                 (希腊)
 * en_AU     英文                   (澳大利亚)
 * en_CA     英文                   (加拿大)
 * en_GB     英文                   (英国)
 * en_IE     英文                   (爱尔兰)
 * en_NZ     英文                   (新西兰)
 * en_ZA     英文                   (南非)
 * es        西班牙文
 * es_BO     西班牙文               (玻利维亚)
 * es_AR     西班牙文               (阿根廷)
 * es_CL     西班牙文               (智利)
 * es_CO     西班牙文               (哥伦比亚)
 * es_CR     西班牙文               (哥斯达黎加)
 * es_DO     西班牙文               (多米尼加共和国)
 * es_EC     西班牙文               (厄瓜多尔)
 * es_ES     西班牙文               (西班牙)
 * es_GT     西班牙文               (危地马拉)
 * es_HN     西班牙文               (洪都拉斯)
 * es_MX     西班牙文               (墨西哥)
 * es_NI     西班牙文               (尼加拉瓜)
 * et        爱沙尼亚文
 * es_PA     西班牙文               (巴拿马)
 * es_PE     西班牙文               (秘鲁)
 * es_PR     西班牙文               (波多黎哥)
 * es_PY     西班牙文               (巴拉圭)
 * es_SV     西班牙文               (萨尔瓦多)
 * es_UY     西班牙文               (乌拉圭)
 * es_VE     西班牙文               (委内瑞拉)
 * et_EE     爱沙尼亚文             (爱沙尼亚)
 * fi        芬兰文
 * fi_FI     芬兰文                 (芬兰)
 * fr        法文
 * fr_BE     法文                   (比利时)
 * fr_CA     法文                   (加拿大)
 * fr_CH     法文                   (瑞士)
 * fr_FR     法文                   (法国)
 * fr_LU     法文                   (卢森堡)
 * hr        克罗地亚文
 * hr_HR     克罗地亚文             (克罗地亚)
 * hu        匈牙利文
 * hu_HU     匈牙利文               (匈牙利)
 * is        冰岛文
 * is_IS     冰岛文                 (冰岛)
 * it        意大利文
 * it_CH     意大利文               (瑞士)
 * it_IT     意大利文               (意大利)
 * iw        希伯来文
 * iw_IL     希伯来文               (以色列)
 * ja        日文
 * ja_JP     日文                   (日本)
 * ko        朝鲜文
 * ko_KR     朝鲜文                 (南朝鲜)
 * lt        立陶宛文
 * lt_LT     立陶宛文               (立陶宛)
 * lv        拉托维亚文(列托)
 * lv_LV     拉托维亚文(列托)       (拉脱维亚)
 * mk        马其顿文
 * mk_MK     马其顿文               (马其顿王国)
 * nl        荷兰文
 * nl_BE     荷兰文                 (比利时)
 * nl_NL     荷兰文                 (荷兰)
 * no        挪威文
 * no_NO     挪威文                 (挪威)
 * pl        波兰文
 * pl_PL     波兰文                 (波兰)
 * pt        葡萄牙文
 * pt_BR     葡萄牙文               (巴西)
 * pt_PT     葡萄牙文               (葡萄牙)
 * ro        罗马尼亚文
 * ro_RO     罗马尼亚文             (罗马尼亚)
 * ru        俄文
 * ru_RU     俄文                   (俄罗斯)
 * sh        塞波尼斯-克罗地亚文
 * sh_YU     塞波尼斯-克罗地亚文    (南斯拉夫)
 * sk        斯洛伐克文
 * sk_SK     斯洛伐克文             (斯洛伐克)
 * sl        斯洛文尼亚文
 * sl_SI     斯洛文尼亚文           (斯洛文尼亚)
 * sq        阿尔巴尼亚文
 * sq_AL     阿尔巴尼亚文           (阿尔巴尼亚)
 * sr        塞尔维亚文
 * sr_YU     塞尔维亚文             (南斯拉夫)
 * sv        瑞典文
 * sv_SE     瑞典文                 (瑞典)
 * th        泰文
 * th_TH     泰文                   (泰国)
 * tr        土耳其文
 * tr_TR     土耳其文               (土耳其)
 * uk        乌克兰文
 * uk_UA     乌克兰文               (乌克兰)
 * zh        中文
 * zh_CN     中文                   (中国)
 * zh_HK     中文                   (香港)
 * zh_TW     中文                   (台湾)
 */