<?php
/**
 * 描述 : 客户端初始化时加载的文件
 * 作者 : Edgar.lee
 */
if( isset($_POST['type']) && $_POST['type'] === 'syncLogin' )    //客户端发送同登入信息时,验证登入用户的有效性
{
    $temp = self::requestData(array(
        'type' => 'sUserState',
        'user' => $_POST['user']
    ));
    if( $temp['state'] !== 'success' || !is_array($temp['data']) || !$temp['data']['isServerLogin'] )    //如果没有查询成功 或者 同步账号没在服务端登入
    {
        exit(OSYNC_FAILED);
    }
}