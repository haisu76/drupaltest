<?php
/**
 * 描述 : 服务端初始化时加载的文件
 * 作者 : Edgar.lee
 */
$sessionName = session_name();    //session名称
$cookie = self::getConstant('cookie');    //附加cookie
parse_str(self::getConstant('cookie'), $cookie);

//同步附加cookie
if( isset($cookie[$sessionName]) && ( !isset($_COOKIE[$sessionName]) || $_COOKIE[$sessionName] !== $cookie[$sessionName] ) )    //附加cookie有服务端session && (服务端没有session || 与附加session不等)
{
    if( session_id() )    //session已开启
    {
        session_write_close();
        session_id($cookie[$sessionName]);
        session_start();
    } else {    //未开启
        setcookie($sessionName, $_COOKIE[$sessionName] = $cookie[$sessionName], 0, '/');
    }
}