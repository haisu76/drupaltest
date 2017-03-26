<?php
define('UC_SYN', 0);                                        //是否开启UC同步,0=关闭,1=开启
define('UC_CONNECT', '');                                   // 连接 UCenter 的方式: 'mysql'/'', 默认为空时为 fscoketopen()
                                                            // 建议采用 mysql, 高效&安全

//数据库相关 (当 UC_CONNECT 为 'mysql' 时,配置以下信息)
define('UC_DBHOST', 'localhost');                           // UCenter 数据库主机
define('UC_DBUSER', 'root');                                // UCenter 数据库用户名
define('UC_DBPW', 'admin');                                 // UCenter 数据库密码
define('UC_DBNAME', 'ultrax');                              // UCenter 数据库名称
define('UC_DBCHARSET', 'utf8');                             // UCenter 数据库字符集 (mysql使用的编码)
define('UC_DBTABLEPRE', '`ultrax`.pre_ucenter_');           // UCenter 数据库表前缀
define('UC_DBCONNECT', 0);                                  // 数据库持久连接 0=关闭, 1=打开

//通信相关 (当 UC_CONNECT 为 '' 时,配置以下信息)
define('UC_KEY', '123456789');                              // 与 UCenter 的通信密钥, 要与 UCenter 保持一致
define('UC_API', 'http://192.168.1.4/ucenter/uc_server');   // UCenter 的 URL 地址, 在调用头像时依赖此常量
define('UC_CHARSET', 'utf-8');                              // UCenter 的字符集 (iconv使用的编码)
define('UC_IP', '');                                        // UCenter 的 IP, 当 UC_CONNECT 为非 mysql 方式时, 并且当前应用服务器解析域名有问题时, 请设置此值
define('UC_APPID', 2);                                      // 当前应用的 ID