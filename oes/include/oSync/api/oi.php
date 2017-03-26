<?php
/**
 * 描述 : 服务端通信接口
 * 作者 : Edgar.lee
 */
require dirname(dirname(__FILE__)) . '/com/oSync.php';
require oSync::getConstant('rootDir') . '/api/systemInit.php';    //框架初始
require oSync::getConstant('rootDir') . '/api/api.php';           //加载api函数

define('OSYNC_IS_SINGLE', isset($_POST['type']));    //单条操作(支持批量操作),true=是,false=否
OSYNC_IS_SINGLE && $_POST = array($_POST);    //单条请求转批量
$responseData = array();    //响应数据
$syncClientData = null;     //同步客户端数据
$needSyncClient = array(      //需要同步客户端操作
    'iUserGroup' => true,    //添加组
    'dUserGroup' => true,    //删除组
    'uUserGroup' => true,    //修改组
    'iUserInfo' => true,     //添加用户
    'dUserInfo' => true,     //删除用户
    'uUserInfo' => true      //修改用户
);

//批量解析请求
foreach($_POST as $k => &$v)
{
    if( isset($v['type']) && is_callable($v['type']) )
    {
        if( isset($needSyncClient[$v['type']]) )
        {
            $syncClientData[$k] = $v;
        }
        $responseData[$k] = call_user_func($v['type'], $v, $_POST, $responseData);
    } else {
        $responseData[$k] = OSYNC_FAILED;
    }
}

oSync::getConfig(null, oSync::getConstant('id'));    //切换到默认客户端配置
isset($_GET['cookie']) || oSync::responseData(OSYNC_IS_SINGLE ? $responseData[0] : $responseData);    //浏览器请求 || 输出响应
if($syncClientData !== null)    //需要同步客户端,开启异步处理
{
    set_time_limit(0);    //关闭脚本超时
    session_write_close();    //关闭session
    oSync::requestData($syncClientData);    //同步客户端
}