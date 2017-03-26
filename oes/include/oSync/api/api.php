<?php
/**
 * 描述 : 查询用户状态
 * 参数 :
 *     &params : 客户端发送的参数
 *          type : sUserStatus
 *          user : 字符串=指定一个用户名; 数组=批量查询用户状态; 不写或null=当前会话下服务端登入的用户
 * 返回 :
 *      数组 : 以用户名为键,查询数据为值的数组,用户不存在时,值为失败码
 *      其他 : 直接返回查询数据,用户不存在时,返回失败码
 *           查询数据结构 : {
 *               'username'      : 用户名
 *               'loginState'    : 登入状态(当用户在任何地点登入时为true,否则为false)
 *               'isServerLogin' : 用户名是否在当前会话下的服务端登入,true=已登入,false=未登入
 *               'isAllowLogin'  : 是否可以登入(当用户未登入或允许多处登入或在本会话登入时为true否则false),如果当前用户登入了其他用户,则为false
 *           }
 * 演示 :
 *      请求 : {"type":"sUserState","user":["zxd","aaa","admin"]}
 *      返回 : {"state":"success","data":{"zxd":{"username":"zxd","loginState":false,"isAllowLogin":true},"aaa":"-1","admin":{"username":"admin","loginState":false,"isAllowLogin":true}}}
 * 作者 : Edgar.lee
 */
function sUserState(&$params) {
    $users = null;    //用户查询状态的用户列表
    $returnData = array();    //返回数据

    if( _dataFormat($params['user'], $users) === null && isset($_SESSION['user']['login']) )    //格式化数据不存在 && 当前会话已登入
    {
        $users = array(addslashes($_SESSION['user']['userName']));    //当前用户名
    }

    if( $users === null )    //失败
    {
        return OSYNC_FAILED;
    } else {
        $temp = join("','", $users);
        $sql = "SELECT
            `t_user`.username,
            UNIX_TIMESTAMP(IFNULL(`t_user_realtime_status`.expires_time, 0)) + 120 > '{$_SERVER['REQUEST_TIME']}' loginState,    /*是否登入,0=未登入,1=已登入*/
            `t_setting`.setting_value isAllowLogin /*是否允许用户登入,sql读取的'是否多处登入,yes=是,no=非',程序二次处理*/
        FROM
            `t_user`
                LEFT JOIN `t_user_realtime_status` ON
                    `t_user_realtime_status`.user_id = `t_user`.user_id
                LEFT JOIN `t_setting` ON
                    `t_setting`.setting_name = 'login_user_multi_pc'
        WHERE
            `t_user`.username IN ('{$temp}')";
        $temp = sql($sql);

        foreach($temp as &$v)
        {
            $v['loginState'] = $v['loginState'] === '1';    //是否登入,true=已登入,false=未登入
            if( $v['loginState'] && isset($_SESSION['user']['login']) )    //如果当前会话已登入
            {
                $v['isServerLogin'] = $v['isAllowLogin'] = $_SESSION['user']['userName'] === $v['username'];    //如果当前登入了其它用户,则不允许新用户登入
            } else {    //当前会话没登入
                $v['isServerLogin'] = false;
                $v['isAllowLogin'] = $v['loginState'] === false || $v['isAllowLogin'] === 'yes';    //如果用户没登入 || 系统可以多处登入,则为true
            }
        }

        oSync::bulkStripSlashes($users);    //去掉斜线
        $returnData = _dataFormat($temp, $users, 'username');

        return $returnData;
    }
}

/**
 * 描述 : 获取同步登入登出用户代码,默认会调用sUserState
 * 参数 :
 *     &params : 客户端发送的参数
 *          type : syncLoginCode
 *          user : 指定一个用户名; 不写或null=当前会话下服务端登入的用户
 * 返回 :
 *      返回查询数据,具体结构 : {
 *              'loginCode'      : 登入码,失败码=当登入失败时,字符串:0=登入的瞬间账户被删了,1=成功,1.1=登入成功,但需要修改密码(不强求),2=登入的瞬间账户被修改密码,4=一户一机登入时,其他人已登入,5=登入人数过多
 *              'sUserState'     : 参考"查询用户状态(type=sUserState)"
 *              'syncLoginHtml'  : 同步登入html代码(异步代码),已每个客户端ID(服务端的ID为server),对应的登入请求(html)为值,因为可能一户一机,所以每个页面都要加带这里代码,可以将生成的代码存到SESSION中,加快访问速度
 *              'syncLogoutHtml' : 同步退出html代码(同步代码),已每个客户端ID(服务端的ID为server),对应的登入请求(html)为值,在退出时输出到页面上,当前用户会自动解锁,syncLoginHtml代码变为无效,可以将生成的代码存到SESSION中,加快访问速度
 *          }
 * 演示 :
 *      请求 : {"type":"syncLoginCode","user":"zxd"}
 *      返回 : {
 *          "state" : "success",
 *          "data"   : {
 *              "loginCode"      : "1",
 *              "sUserState"     : {
 *                  "username"                     : "zxd",
 *                  "loginState"                   : true,
 *                  "isAllowLogin"                 : true
 *              },
 *              "syncLoginHtml"  : {    //可以二次处理,如删除某个客户端
 *                  "1(客户端的ID,服务端为server)" : 同步登入html代码
 *              },
 *              "syncLogoutHtml" : {    //可以二次处理,如删除某个客户端
 *                  "1(客户端的ID,服务端为server)" : 同步退出html代码
 *              }
 *          }
 *      }
 * 作者 : Edgar.lee
 */
function syncLoginCode(&$params) {
    $returnData = array(    //返回数据
        'loginCode' => OSYNC_FAILED    //登入码,失败码=不允许登入,字符串:0=登入的瞬间账户被删了,1=成功,1.1=登入成功,但需要修改密码(不强求),2=登入的瞬间账户被修改密码,4=一户一地登入时,其他人已登入,5=登入人数过多
    );
    $returnData['sUserState'] = sUserState($params);    //查询用户状态

    if( is_array($returnData['sUserState']) && $returnData['sUserState']['isAllowLogin'] )    //允许用户登入
    {
        $sql = 'SELECT
            `t_user`.username,                     /*用户名*/
            IFNULL(`t_user`.pwd, "") `password`    /*密码*/
        FROM
            `t_user`
        WHERE
            `t_user`.username = "' .addslashes($returnData['sUserState']['username']). '"';
        $temp = sql($sql);

        //登入用户
        $indexObj = new index;
        $returnData['loginCode'] = $indexObj->requestLogin(array(
            'username' => $temp[0]['username'], 
            'password' => $temp[0]['password'], 
            'passwordEncryption' => ''
        ));

        if( (int)$returnData['loginCode'] === 1 )    //登入成功
        {
            //生成前端同步登入代码
            $data = array(    //同步数据
                array('type' => 'syncLogin', 'user' => $returnData['sUserState']['username']),    //登入数据
                array('type' => 'syncLogout', 'user' => $returnData['sUserState']['username'])    //登出数据
            );
            $cookie[0] = session_name() .'='. urlencode(session_id());    //附带原始cookie
            $cookie[1] = rawurlencode($cookie[0]);    //url编码后的cookie
            $allConfig = oSync::getConfig(null, false);
            $allConfig['server'] = array(    //生成服务器配置
                'enableRequest' => true,    //像服务器发送信息
                'url' => oSync::getConstant('rootUrl')    //接口跟URL
            ) + oSync::getConfig();

            foreach($allConfig as $k => &$v)
            {
                $url = $v['url'];
                $id = intval($k === 'server' ? $v['id'] : $k);

                if( isset($v['enableRequest']) && $v['enableRequest'] && isset($v['key']) )    //允许像客户端发送信息
                {
                    oSync::getConfig(null, $id);    //切换到默认客户端配置
                    $temp = array(
                        'md5Check' => md5($id . '2147443200' . $cookie[0] . $v['key']),    //md5校验码
                        'loginData' => rawurlencode(oSync::responseData($data[0], false)),
                        'logoutData' => rawurlencode(oSync::responseData($data[1], false))
                    );
                    $returnData['syncLoginHtml'][$k] = "<iframe src='{$url}/api/oi.php?id={$id}&t=2147443200&cookie={$cookie[1]}&md5Check={$temp['md5Check']}&data={$temp['loginData']}' style='display:none;'></iframe>";
                    $returnData['syncLogoutHtml'][$k] = "<script src='{$url}/api/oi.php?id={$id}&t=2147443200&cookie={$cookie[1]}&md5Check={$temp['md5Check']}&data={$temp['logoutData']}'></script>";
                }
            }
        }
    }

    return $returnData;
}

/**
 * 描述 : 查询用户组
 * 参数 :
 *     &params : 客户端发送的参数
 *          type  : sUserGroup
 *          group : 字符串=第一节点组名称; 数组=按照数组顺序依次查看子节点; 不写或null=返回所有用户组
 * 返回 :
 *      查询失败返回失败码,查询到但没有子节点返回空数组,成功返回树形数组
 * 演示 :
 *      请求 : {"type":"sUserGroup","group":["奥瑞文","产品研发部"]}
 *      返回 : {"state":"success","data":{"oExam产品组":[],"oTraining产品组":[],"oLearning产品组":{"新建组9":[]}}}
 * 作者 : Edgar.lee
 */
function sUserGroup(&$params) {
    _dataFormat($params['group'], $returnData);

    oSync::bulkStripSlashes($returnData);    //去斜线
    _getUserGroupStructure($returnData, 'getChildGroup_name');

    return $returnData === false ? OSYNC_FAILED : $returnData;
}

/**
 * 描述 : 添加用户组
 * 参数 :
 *     &params : 客户端发送的参数
 *          type         : iUserGroup
 *          groupName    : 字符串=添加组名称; 数组=按照数组顺序依次添加子节点
 *          parentsGroup : 父节点位置,规则参考sUserGroup的group参数,不写或null=插入跟节点
 * 返回 :
 *      没写groupName或parentsGroup没有对应节点或插入过程中任意节点意外插入错误返回失败码,否则返回成功码
 * 演示 :
 *      请求 : {"type":"iUserGroup","groupName":["测\"试1","测\"试2"],"parentsGroup":["奥瑞文","产品研发部"]}
 *      返回 : {"state":"success","data":OSYNC_SUCCEED}
 * 作者 : Edgar.lee
 */
function iUserGroup(&$params) {
    if( _dataFormat($params['groupName'], $groupName) === null )
    {
        return OSYNC_FAILED;
    } else {
        if( _dataFormat($params['parentsGroup'], $parentsGroup) === null )    //插入跟节点
        {
            $pId = 0;
        } else {
            oSync::bulkStripSlashes($parentsGroup);    //去斜线
            $pId = _getUserGroupStructure($parentsGroup, 'getChildGroup_name');
        }
        if( $pId !== false )    //插入的父节点无效
        {
            foreach( $groupName as &$v )
            {
                $sql = "SELECT
                    `t_group`.group_id
                FROM
                    `t_group`
                WHERE
                    `t_group`.group_pid = '{$pId}'
                AND `t_group`.group_name = '{$v}'";

                $temp = sql($sql);
                if( count($temp) )    //查询到数据
                {
                    $pId = $temp[0]['group_id'];
                } else {
                    $sql = "INSERT INTO `t_group` 
                        (`group_pid`, `group_name`, `create_user_id`, `create_tm`)
                    VALUES
                        ('{$pId}', '{$v}', '0', now())";

                    if( ($pId = sql($sql)) === false )    //插入失败
                    {
                        break;
                    }
                }
            }
        }

        Of_Com_CommonPackage::cache('include_oSync_api_oi::_getUserGroupStructure', true);    //清除缓存
        return $pId === false ? OSYNC_FAILED : OSYNC_SUCCEED;
    }
}

/**
 * 描述 : 修改用户组
 * 参数 :
 *     &params : 客户端发送的参数
 *          type         : uUserGroup
 *          groupName    : 修改parentsGroup的直接子节点,以键为新名值为原名的数组
 *          parentsGroup : 父节点位置,规则参考sUserGroup的group参数
 * 返回 :
 *      没写groupName或parentsGroup没有对应节点返回失败码,否则返回成功码
 * 演示 :
 *      请求 : {"type":"uUserGroup","groupName":{"改名1":"测\"试1","改名2":"测\"试2"},"parentsGroup":["奥瑞文","产品研发部"]}
 *      返回 : {"state":"success","data":OSYNC_SUCCEED}
 * 作者 : Edgar.lee
 */
function uUserGroup(&$params) {
    if( !isset($params['groupName']) || !is_array($params['groupName']) )
    {
        return OSYNC_FAILED;
    } else {
        if( _dataFormat($params['parentsGroup'], $parentsGroup) === null )    //修改跟节点
        {
            $pId = 0;
        } else {
            oSync::bulkStripSlashes($parentsGroup);    //去斜线
            $pId = _getUserGroupStructure($parentsGroup, 'getChildGroup_name');
        }
        if( $pId !== false )    //插入的父节点无效
        {
            foreach( $params['groupName'] as $k => &$v )
            {
                $sql = "UPDATE
                    `t_group`
                SET
                    `t_group`.group_name = '{$k}'
                WHERE
                    `t_group`.group_pid = '{$pId}'
                AND `t_group`.group_name = '{$v}'";

                if( ($pId = sql($sql)) === false )    //修改失败
                {
                    break;
                }
            }
        }

        Of_Com_CommonPackage::cache('include_oSync_api_oi::_getUserGroupStructure', true);    //清除缓存
        return $pId === false ? OSYNC_FAILED : OSYNC_SUCCEED;
    }
}

/**
 * 描述 : 删除用户组
 * 参数 :
 *     &params : 客户端发送的参数
 *          type  : dUserGroup
 *          group : 删除节点及子节点位置(没写或null=返回失败码)
 * 返回 :
 *      没写group或group没有对应节点返回失败码,否则返回成功码
 * 演示 :
 *      请求 : {"type":"dUserGroup","group":["奥瑞文","产品研发部"]}
 *      返回 : {"state":"success","data":OSYNC_SUCCEED}
 * 作者 : Edgar.lee
 */
function dUserGroup(&$params) {
    if( _dataFormat($params['group'], $returnData) === null )    //没有删除的节点
    {
        return OSYNC_FAILED;
    } else {
        oSync::bulkStripSlashes($returnData);    //去斜线
        if(_getUserGroupStructure($returnData, 'getChildKey_name') === false)
        {
            return OSYNC_FAILED;
        } else {
            $returnData = join("','", array_keys($returnData));

            echo $sql = "DELETE FROM
                `t_group`
            WHERE
                `t_group`.group_id IN ('{$returnData}')";

            Of_Com_CommonPackage::cache('include_oSync_api_oi::_getUserGroupStructure', true);    //清除缓存
            return sql($sql) === false ? OSYNC_FAILED : OSYNC_SUCCEED;
        }
    }
}

/**
 * 描述 : 查询用户信息
 * 参数 :
 *     &params : 客户端发送的参数
 *          type : sUserInfo
 *          user : 字符串=指定一个用户名; 数组=批量查询用户信息; 不写或null=返回错误码
 * 返回 :
 *      数组 : 以用户名为键,查询数据为值的数组,用户不存在时,值为失败码
 *      其他 : 直接返回查询数据,用户不存在时,返回失败码
 *           查询数据结构 : {
 *               'username'  : 用户名
 *               'nickname'  : 昵称
 *               'status'    : 审核状态,070102=已审核,070101=未审核
 *               'credit'    : 拥有的积分
 *               'point'     : 用户所得学分
 *               'userGroup' : 已跟节点开始到用户所在组顺序的数组,如果所在组不存在返回失败码
 *           }
 * 演示 :
 *      请求 : {"type":"sUserInfo","user":["zxd","admin"]}    //假设admin是超级管理员
 *      返回 : {"state":"success","data":{"zxd":{"username":"zxd","nickname":"昵称","status":"070102","credit":"200","point":"10","userGroup":["奥瑞文","营销部"]},"admin":"-1"}}
 * 作者 : Edgar.lee
 */
function sUserInfo(&$params) {
    if( _dataFormat($params['user'], $users) === null )
    {
        return OSYNC_FAILED;
    } else {
        $temp = join("','", $users);

        $sql = "SELECT
            `t_user`.username,    /*用户名*/
            `t_user`.nickname,    /*昵称*/
            `t_user`.status,    /*审核状态,070102=已审核,070101=未审核*/
            `t_user`.credit,    /*积分*/
            `t_user`.point,    /*学分*/
            `t_user_group`.group_id userGroup    /*用户组*/
        FROM
            `t_user`
                LEFT JOIN `t_user_group` ON
                    `t_user_group`.user_id = `t_user`.user_id
        WHERE
            `t_user`.user_id <> '1'
        AND `t_user`.username IN ('{$temp}')";
        $temp = sql($sql);

        foreach($temp as &$v)
        {
            $v['userGroup'] = _getUserGroupStructure($v['userGroup'], 'getParentGroup_key');
        }

        oSync::bulkStripSlashes($users);    //去掉斜线
        $returnData = _dataFormat($temp, $users, 'username');

        return $returnData;
    }
}

/**
 * 描述 : 修改用户信息
 * 参数 :
 *     &params : 客户端发送的参数
 *          type : uUserInfo
 *          user : 字符串=指定一个用户名; 数组=批量修改用户信息; 不写或null=返回错误码
 *          set  : 已键为字段名,值为修改信息的一维数组,可以修改该的字段有 {
 *              'password'  : '修改密码',                      //修改密码
 *              'nickname'  : '修改昵称',                      //修改昵称
 *              'status'    : '070102',                        //修改审核状态,070102=已审核,070101=未审核
 *              'credit'    : '+10',                           //第一个字符'+', '-'字符代表原基础上操作,正常直接赋予新值
 *              'point'     : '-2',                            //第一个字符'+', '-'字符代表原基础上操作,正常直接赋予新值
 *              'userGroup' : array('奥瑞文', '产品研发部')    //修改所在的组,规则参考sUserGroup的group参数
 *          }
 * 返回 :
 *      set或user或用户组不存在时,值为失败码,否则成功
 * 演示 :
 *      请求 : {"type":"uUserInfo","user":["zxd","admin"],"set":{"nickname":"修改昵称","status":"070102","credit":"+10","point":"-2","userGroup":["奥瑞文","产品研发部"]}}
 *      返回 : {"state":"success","data":OSYNC_SUCCEED}
 * 作者 : Edgar.lee
 */
function uUserInfo(&$params) {
    isset($params['set']['userGroup']) && oSync::bulkStripSlashes($params['set']['userGroup']);    //去斜线
    if( !isset($params['set']) || (isset($params['set']['userGroup']) && ($params['set']['userGroup'] = _getUserGroupStructure($params['set']['userGroup'], 'getChildGroup_name')) === false) || _dataFormat($params['user'], $users) === null )
    {
        return OSYNC_FAILED;
    } else {
        $setList = null;    //修改列表
        $params['user'] = $users;
        $validSet = array('password' => true, 'nickname' => true, 'status' => true, 'credit' => true, 'point' => true, 'userGroup' => true);    //有效修改

        foreach($params['set'] as $k => &$v)
        {
            if( isset($validSet[$k]) )
            {
                if($k === 'credit' || $k === 'point')    //数学运算
                {
                    $v = (string)$v;
                    if(isset($v[0]))
                    {
                        $temp = $v[0];
                        $v = abs($v);
                        $setList[] = "`t_user`.`{$k}`=IF(" . ($temp === '+' || $temp === '-' ? "`t_user`.{$k}{$temp}{$v} > 0, `t_user`.{$k}{$temp}{$v}, 0)" : $v);
                    } else {
                        continue;
                    }
                } elseif($k === 'status') {
                    $v = $v == '070102' ? '070102' : '070101';
                    $setList[] = "`t_user`.`{$k}`='{$v}'";
                } elseif($k === 'userGroup') {
                    $setList[] = "`t_user_group`.`group_id`='{$v}'";
                } elseif($k === 'password') {
                    $setList[] = "`t_user`.`pwd`=PASSWORD('{$v}')";
                } else {
                    $setList[] = "`t_user`.`{$k}`='{$v}'";
                }
            }
        }

        if($setList === null)    //没有可修改的
        {
            return OSYNC_FAILED;
        } else {
            $temp = join("','", $users);
            $setList = join(',', $setList);

            $sql = "UPDATE
                `t_user`
                    LEFT JOIN `t_user_group` ON
                        `t_user_group`.user_id = `t_user`.user_id
            SET
                {$setList}
            WHERE
                `t_user`.`user_id` <> '1'
            AND `t_user`.`username` IN ('{$temp}')";

            return sql($sql) === false ? OSYNC_FAILED : OSYNC_SUCCEED;
        }
    }
}

/**
 * 描述 : 插入用户信息
 * 参数 :
 *     &params : 客户端发送的参数
 *          type : iUserInfo
 *          info : 可以是一维数组,也可以是二维数组(除username为必填项,其它都为选填项) {
 *              'username'  => '插入用户1',                     //用户名,不写则返回失败码
 *              'password'  => '修改密码',                      //密码
 *              'nickname'  => '昵称',                          //修改昵称,默认为''
 *              'status'    => '070102',                        //修改审核状态,会根据"登入参数"->"注册后自动通过审核"确定默认值
 *              'credit'    => '10',                            //积分,默认0
 *              'point'     => '2',                             //学分,默认0
 *              'userGroup' => array('奥瑞文', '产品研发部')    //所在的用户组,规则参考sUserGroup的group参数,没写或组不存在则为跟组
 *          }
 * 返回 :
 *      有一个username值不写或插入异常返回失败码,否则成功
 * 演示 :
 *      请求 : {
 *          "type":"iUserInfo",
 *          "info":[
 *              {"username":"插入用户1","nickname":"昵称","status":"070102","credit":"10","point":"2","userGroup":["奥瑞文","产品研发部"]},
 *              {"username":"插入用户1","nickname":"昵称","status":"070102","credit":"10","point":"2","userGroup":["奥瑞文","产品研发部"]}
 *          ]
 *      }
 *      返回 : {"state":"success","data":OSYNC_SUCCEED}
 * 作者 : Edgar.lee
 */
function iUserInfo(&$params) {
    //初始化
    $usersData   = isset($params['info']['username']) ? array($params['info']) : $params['info'];    //用户数据(二维转换)
    $userStatus  = '070101';    //用户默认审核状态
    $userGroup   = array();    //用户组{用户名:组ID}
    $insertData  = array();    //插入数据{用户名:sql数据}
    $insertGroup = array();    //插入组数据

    $temp = sql('SELECT
        `t_setting`.setting_value
    FROM
        `t_setting`
    WHERE
        `t_setting`.setting_name = "user_auto_register"
    AND `t_setting`.setting_value = "yes"');

    count($temp) && $userStatus = '070102';

    //整理格式
    foreach($usersData as &$v)
    {
        if( is_array($v) && isset($v['username']) )
        {
            $v['nickname'] = isset($v['nickname']) && $v['nickname'] ? $v['nickname'] : '';                    //昵称
            $v['password'] = isset($v['password']) && $v['password'] ? $v['password'] : '';                    //昵称
            $v['status']   = isset($v['status']) && $v['status'] === '070102' ? $v['status'] : $userStatus;    //审核状态
            $v['credit']   = isset($v['credit']) && $v['credit'] ? (int)$v['credit'] : 0;                      //积分
            $v['point']    = isset($v['point']) && $v['point'] ? (int)$v['point'] : 0;                         //学分

            if( _dataFormat($v['userGroup'], $temp) === null )
            {
                $userGroup[$v['username']] = 0;
            } else {
                oSync::bulkStripSlashes($temp);    //去斜线
                $userGroup[$v['username']] = (int)_getUserGroupStructure($temp, 'getChildGroup_name');
            }

            $insertData[$v['username']] = "('{$v['username']}', '{$v['nickname']}', '{$v['status']}', '{$v['credit']}', '{$v['point']}', PASSWORD('{$v['password']}'))";
        } else {    //格式异常
            return OSYNC_FAILED;
        }
    }

    sql('LOCK TABLES `t_user` WRITE, `t_user_group` WRITE');    //用户表,用户组表上锁
    $sql = 'SELECT
        `t_user`.username
    FROM
        `t_user`
    WHERE
        `t_user`.username IN ("' .join('","', array_keys($insertData)). '")';
    $temp = sql($sql);

    foreach($temp as &$v)
    {
        $v = addslashes($v['username']);
        unset($userGroup[$v], $insertData[$v]);    //删除已存在的数据
    }

    if(count($insertData))
    {
        //插入用户
        $sql = 'INSERT INTO `t_user` (`username`, `nickname`, `status`, `credit`, `point`, `pwd`) VALUES ' . join(',', $insertData);
        if(sql($sql) === false)    //sql错误
        {
            return OSYNC_FAILED;
        }

        //查询用户组
        $sql = 'SELECT
            `t_user`.user_id,
            `t_user`.username
        FROM
            `t_user`
        WHERE
            `t_user`.username IN ("' .join('","', array_keys($userGroup)). '")';
        $temp = sql($sql);

        foreach($temp as &$v)
        {
            $v['username'] = addslashes($v['username']);
            $insertGroup[$v['user_id']] = "('{$v['user_id']}', '{$userGroup[$v['username']]}')";
        }

        //删除用户组(防子多项插入)
        $sql = 'DELETE FROM `t_user_group` WHERE `t_user_group`.user_id IN ("' .join('","', array_keys($insertGroup)). '")';
        sql($sql);

        //插入用户组
        $sql = 'INSERT INTO `t_user_group` (`user_id`, `group_id`) VALUES ' . join(',', $insertGroup);
        sql($sql);

        sql('UNLOCK TABLES');    //解锁
        return OSYNC_SUCCEED;
    } else {
        sql('UNLOCK TABLES');    //解锁
        return OSYNC_SUCCEED;
    }
}

/**
 * 描述 : 删除用户信息
 * 参数 :
 *     &params : 客户端发送的参数
 *          type : dUserInfo
 *          user : 字符串=指定一个用户名; 数组=批量删除用户信息; 不写或null=返回错误码
 * 返回 :
 *      删除异常返回失败码,否则成功
 * 演示 :
 *      请求 : {"type":"dUserInfo","user":["zxd","admin"]}
 *      返回 : {"state":"success","data":OSYNC_SUCCEED}
 * 作者 : Edgar.lee
 */
function dUserInfo(&$params) {
    if( _dataFormat($params['user'], $users) === null )
    {
        return OSYNC_FAILED;
    }

    $sql = 'DELETE FROM
        `t_user`
    WHERE
        `t_user`.user_id <> "1"
    AND `t_user`.username IN ("' .join('","', $users). '")';

    return sql($sql) === false ? OSYNC_FAILED : OSYNC_SUCCEED;
}

/**
 * 描述 : 同步登入,有syncLoginCode返回的syncLoginHtml代码调用
 * 参数 :
 *     &params       : 客户端发送的参数
 *          type : syncLogout
 *          user : 登入的用户名
 * 返回 :
 *      根据自身系统返回html代码
 * 作者 : Edgar.lee
 */
function syncLogin(&$params) {
    //插入常驻脚本
    Of_View::printHead('before::<script language="javascript" charset="UTF-8" src="' .ROOT_URL. '/js/index/injectLogin.js"' .(isset($_SESSION['user']['login']) ? ' login="1"' : ''). ' sessionName="' .$_SESSION['system']['sessionName']. '"></script>');

    Of_View::printHead();    //打印头
    Of_View::printHead(false);    //打印尾
}

/**
 * 描述 : 同步登出,有syncLoginCode返回的syncLogoutHtml代码调用
 * 参数 :
 *     &params : 客户端发送的参数
 *          type : syncLogout
 *          user : 登出的用户名
 * 返回 :
 *      成功 : 输出成功码
 * 作者 : Edgar.lee
 */
function syncLogout(&$params) {
    if( isset($_SESSION['user']['login']) && $_SESSION['user']['userName'] === stripslashes($params['user']) )    //当前登入用户为退出用户
    {
        $_SERVER['HTTP_X_REQUESTED_WITH'] = true;    //屏蔽跳转头

        $userObj = new user;
        $userObj->logout();

        echo OSYNC_SUCCEED;
    } else {
        echo OSYNC_FAILED;
    }
}

/**
 * 描述 : 执行sql
 * 参数 :
 *      sql        : sql语句
 *      permission : 是否需要判断权限,null=不需要权限,否则需要开启配置文件中对应客户端的superClient
 * 返回 :
 *      数组 : 以用户名为键,查询数据为值的数组,用户不存在时,值为失败码
 *      其他 : 直接返回查询数据,用户不存在时,返回失败码
 * 作者 : Edgar.lee
 */
function sql($sql, $permission = null) {
    if($permission === null || oSync::getConfig('superClient'))
    {
        $returnData = Of_Controller::sql( is_string($sql) ? $sql : stripslashes($sql['sql']) );
        if($returnData === false && $permission !== null)
        {
            $returnData = OSYNC_FAILED;
        }
        return $returnData;
    } else {
        return OSYNC_FAILED . '.1';    //无权运行定制sql或函数
    }
}

/**
 * 描述 : 查询用户状态
 * 参数 :
 *     &params       : 客户端发送的参数
 *     &requestData  : 全部请求数据
 *     &responseData : 目前已生成的响应数据
 * 返回 :
 *      数组 : 以用户名为键,查询数据为值的数组,用户不存在时,值为失败码
 *      其他 : 直接返回查询数据,用户不存在时,返回失败码
 *           查询数据结构 : {
 *               'username'     : 用户名
 *               'loginState'   : 登入状态(当用户在任何地点登入时为true,否则为false)
 *               'isAllowLogin' : 是否可以登入(当用户未登入或允许多处登入或在本会话登入时为true否则false)
 *           }
 * 演示 :
 *      请求 : {"type":"sUserState","user":["zxd","aaa","admin"]}
 *      返回 : {"state":"success","data":{"zxd":{"username":"zxd","loginState":false,"isAllowLogin":true},"aaa":"-1","admin":{"username":"admin","loginState":false,"isAllowLogin":true}}}
 * 作者 : Edgar.lee
 */
function fun(&$params, &$requestData, &$responseData) {
    if( !oSync::getConfig('superClient') )    //超级客户端
    {
        return OSYNC_FAILED . '.1';
    }

    if(isset($params['code']))
    {
        global $k;
        $code = is_array($params['code']) ? $params['code'] : array('', $params['code']);
        oSync::bulkStripSlashes($code);    //去斜线

        if( ($requestData[$k] = @create_function($code[0], $code[1])) === false )
        {
            return OSYNC_FAILED;
        } elseif(isset($params['run']) && $params['run']) {
            return $requestData[$k]($params, $requestData, $responseData);
        } else {
            return OSYNC_SUCCEED;
        }
    } else {
        return OSYNC_FAILED;
    }
}

/**
 * 描述 : 获取用户组结构
 * 参数 :
 *     &rawData    : 原始数据
 *      type       : 处理类型,getChildGroup_name=通过名称获取子组; getChildKey_name=通过名称获取全部子ID(包含本ID); getParentGroup_key=通过ID获取父节点并排序
 *      permission : 权限校验
 * 返回 :
 *      getChildGroup_name : 原始数据变成查询到的子节点,没查到为false; 返回最后节点ID,没查到返回false
 *      getChildKey_name   : 原始数据变成查询到的子节点ID(一维数组); 返回最后节点ID,没查到返回false
 *      getParentGroup_key : 返回所有父节点数组,没查到返回失败码
 * 作者 : Edgar.lee
 */
function _getUserGroupStructure(&$rawData, $type, $permission = null) {
    if( $permission !== null )
    {
        return OSYNC_FAILED;
    }

    if( !$groupRelationalArr = &Of_Com_CommonPackage::cache('include_oSync_api_oi::_getUserGroupStructure') )
    {
        $groupRelationalArr = array();    //记录机构关系
        $changeParentIndex = create_function('&$groupRelationalArr, $parentId, $nowFun', '
            foreach($groupRelationalArr as $kc => &$vc)    //子节点继承当前节点ID
            {
                if($parentId != $kc)
                {
                    if(isset($vc[\'pIdList\'][$parentId]))    //是当前节点的子节点
                    {
                        $groupRelationalArr[$parentId][\'children\'][$vc[\'name\']] = &$vc[\'children\'];
                        $vc[\'pIdList\'] += $groupRelationalArr[$parentId][\'pIdList\'];
                        $groupRelationalArr[$parentId][\'cIdList\'] += $vc[\'cIdList\'];
                        $nowFun($groupRelationalArr, $kc, $nowFun);
                    } elseif(isset($groupRelationalArr[$parentId][\'pIdList\'][$kc])) {    //是当前节点的父ID
                        $vc[\'cIdList\'] += $groupRelationalArr[$parentId][\'cIdList\'];
                    }
                }
            }
        ');

        //读出所有机构ID
        $sql = "SELECT
            `t_group`.group_name,    /*机构名称*/
            `t_group`.group_id,    /*机构ID*/
            `t_group`.group_pid    /*机构父ID*/
        FROM
            `t_group`";
        $temp = sql($sql);

        //计算节点之间相互关系
        foreach($temp as &$v)
        {
            $groupRelationalArr[$v['group_id']] = array(
                'pId'      => $v['group_pid'],     //直接父节点
                'name'     => $v['group_name'],    //节点名
                'children' => array(),             //子节点
                'cIdList'  => array(               //子节点列表(包含自己)
                    $v['group_id'] => true,
                ),
                'pIdList'  => array(               //父节点列表(包含自己)
                    $v['group_id'] => true,
                    $v['group_pid'] => true
                )
            );
            if(isset($groupRelationalArr[$v['group_pid']]))    //继承父节点
            {
                $groupRelationalArr[$v['group_id']]['pIdList'] += $groupRelationalArr[$v['group_pid']]['pIdList'];
                $groupRelationalArr[$v['group_pid']]['children'][$v['group_name']] = &$groupRelationalArr[$v['group_id']]['children'];    //父节点引用子节点
            }
            $changeParentIndex($groupRelationalArr, $v['group_id'], $changeParentIndex);    //子节点继承当前节点ID
        }
    }

    if( $type === 'getChildGroup_name' || $type === 'getChildKey_name' )    //通过名称获取子组 || 通过名字获取全局子ID
    {
        $pId = 0;    //初始父节点
        $returnData = false;    //返回数据,false=查询失败
        if($rawData === null)
        {
            $rawData = array(null);
        }

        foreach( $rawData as &$rV )
        {
            foreach( $groupRelationalArr as $gK => &$gV )
            {
                if( $gV['pId'] == $pId && ($rV === null || $rV === $gV['name'] ) )
                {
                    $returnData[$gV['name']] = $gV['children'];
                    if($rV !== null)
                    {
                        $pId = $gK;
                        break;
                    }
                }
            }
        }

        if($rawData[0] === null)    //查询全部数据
        {
            $rawData = $returnData;
        } elseif(count($returnData) === count($rawData)) {    //查询指定数据
            $rawData = $type === 'getChildGroup_name' ? end($returnData) : $groupRelationalArr[$pId]['cIdList'];    //返回子组名称 或 全部子ID(包含本ID)
        } else {
            $pId = $rawData = false;
        }

        return $pId;
    } elseif( $type === 'getParentGroup_key' ) {    //通过ID获取父节点并排序
        if( isset($groupRelationalArr[$rawData]) )
        {
            if(isset($groupRelationalArr[$rawData]['pIdList'][0]))    //没有对父类排过序
            {
                $temp = $groupRelationalArr[$rawData]['pIdList'];
                $sortData = array();
                unset($temp[0]);

                while(count($temp))
                {
                    reset($temp);
                    list($key) = each($temp);
                    foreach($temp as $k => &$v)
                    {
                        if( isset($groupRelationalArr[$key]['pIdList'][$k]) )    //如果是key的父节点
                        {
                            $key = $k;
                        }
                    }
                    $sortData[$key] = true;
                    unset($temp[$key]);
                }
                $groupRelationalArr[$rawData]['pIdList'] = $sortData;
            }

            foreach($groupRelationalArr[$rawData]['pIdList'] as $k => &$v)
            {
                $returnData[] = $groupRelationalArr[$k]['name'];
            }
            return $returnData;
        } else {
            return OSYNC_FAILED;
        }
    }
}

/**
 * 描述 : 数据格式化
 *        将请求数据变为数组,并返回true=单条数据,false=批量数据(包含空数组),null=没有数据
 *        将响应数据匹配处理,并返回处理后的信息
 * 参数 :
 *     &rawData    : 原始数据
 *     &matches    : 匹配数据
 *      formatType : 格式化类型,true=请求数据,字符串=响应数据(字符串代表原始数据中的字段名)
 * 返回 :
 *      formatType === true : 单条数据返回true,多条数据返回false,没有数据=null
 *      formatType === false : 根据最近formatType === true返回值生成返回数据
 * 作者 : Edgar.lee
 */
function _dataFormat(&$rawData, &$matches = null, $formatType = true) {
    static $single = null;

    if( $formatType === true )    //格式化请求数据
    {
        if( isset($rawData) )
        {
            if( !is_array($rawData) )    //不是数组,按字符处理
            {
                $matches = array((string)$rawData);
                $single = true;    //单条数据
            } else {    //可能包含空数组的数组
                $matches = $rawData;
                $single = false;    //批量数据
            }
        } else {
            $single = null;    //没有数据
        }

        return $single;
    } elseif( is_string($formatType) ) {    //格式化响应数据
        $returnData = array();

        if( $single === false )    //批量数据(包括空数组)
        {
            foreach($matches as &$mV)
            {
                if( is_array($rawData) )    //如果查询数据是数组
                {
                    foreach($rawData as $rK => &$rV)    //遍历原始数据
                    {
                        if( isset($rV[$formatType]) && $rV[$formatType] === $mV )
                        {
                            $returnData[$mV] = $rV;
                            unset($rawData[$rK]);
                            break;
                        }
                    }
                }

                if( !isset($returnData[$mV]) )    //查询失败
                {
                    $returnData[$mV] = OSYNC_FAILED;
                }
            }

            return $returnData;
        } elseif( is_array($rawData) && isset($rawData[0]) ) {    //单条或没有数据(按单条数据处理) && 是数组 && 存在0索引
            return $rawData[0];
        } else {    //单条或没有数据(按单条数据处理),但没查到数据
            return OSYNC_FAILED;
        }
    } else {    //没有权限
        return OSYNC_FAILED;
    }
}