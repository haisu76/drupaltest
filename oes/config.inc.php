<?php
/*不要删除该注释,安装后自动删除*/
$config = array(
    '_db'                 => array(
        'adapter'         => 'Pdo_Mysql',                           // Pdo_Mysql=使用pdo,Mysql=使用基础连接
        'params'          => array(
            'host'        => '127.0.0.1',
            'port'        => 3306,
            'user'        => 'root',
            'password'    => 'admin',
            'database'    => 'ots',
            'charset'     => 'utf8',
            'persistent'  => true
        )
    ),
    '_att'                => array(                                 //所有自定义附件路径,以_browseHome为根目录
        'courseware'      => '/courseware'                          //相对_browseHome课件地址
    ),
    '_browseHome'         => '/data',                               //附件根路径(可写权限)
    '_custom'             => array(
        'title'           => 'oTraining 在线培训系统'               //存储用户自定义的大标题
    ),
    '_extension'          => '/docTools/extensions',                //扩展路径
    '_language'           => array(
        'path'            => '/docTools/language/Edgar',            //语言包路径
        'defaultLanguage' => 'default'                              //默认语言,default=开发模式
    ),
    '_log'                => array(
        'debug'           => true,                                  //true=遇到错误会显示到页面上,[无,fasle]=关闭报错功能,不管何种模式都会记录下错误日志
        'sqlLog'          => '/../error/sqlLog',                    //sql日志路径
        'phpLog'          => '/../error/phpLog',                    //php日志路径
        'jsLog'           => '/../error/jsLog'                      //false=关闭js日志
    ),
    '_path'               => array(
        'rootDir'         => 'E:/work/product/oTraining/lizhan',    //网站根目录磁盘路径
        'rootUrl'         => '/oTraining/lizhan',                   //域名地址,根路径为空字符串
        'adminDir'        => '/admin'                               //相对根目录磁盘路径的后台文件地址
    ),
    '_viewsHome'          => '/views'
);