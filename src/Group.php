<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/12/14
 * Time: 15:52
 */

namespace Nobody1986\Qqexmail;



class Group
{
    protected $_client;
    function __construct(Client $client)
    {
        $this->_client = $client;
    }

    /**
     * 参数	必须	说明
     *   参数	必须	说明
     *   access_token	是	调用接口凭证
     *   groupid	是	邮件群组名称
     *   groupname	是	邮件群组名称
     *   userlist	否	成员帐号，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成
     *   grouplist	否	成员邮件群组，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成
     *   department	否	成员部门，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成
     *   allow_type	是	群发权限。0: 企业成员, 1任何人， 2:组内成员，3:指定成员
     *   allow_userlist	否	群发权限为指定成员时，需要指定成员
    */
    function create($groupinfo){
        $url = 'https://api.exmail.qq.com/cgi-bin/group/create';
        return $this->_client->post($url,$groupinfo);
    }

    /**
     * 参数	必须	说明
     *   access_token	是	调用接口凭证
     *   groupid	是	邮件群组id，邮件格式
     *   groupname	否	邮件群组名称
     *   userlist	否	成员帐号，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成
     *   grouplist	否	成员邮件群组，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成
     *   department	否	成员部门，userlist，grouplist，department至少一个。成员由userlist，grouplist，department共同组成
     *   allow_type	否	群发权限。0: 企业成员,1任何人，2:组内成员，3:指定成员
     *   allow_userlist	否	群发权限为指定成员时，需要指定成员
    */
    function update($group,$groupinfo){
        $url = 'https://api.exmail.qq.com/cgi-bin/group/update';
        $groupinfo['groupid'] = $group;
        return $this->_client->post($url,$groupinfo);
    }
    function delete($group){
        $url = 'https://api.exmail.qq.com/cgi-bin/group/delete';
        return $this->_client->get($url,[
            'groupid' => $group,
        ]);
    }
    /**
     * 参数	说明
     *   errcode	返回码
     *   errmsg	对返回码的文本描述内容
     *   groupid	邮件群组id，邮件格式
     *   groupname	邮件群组名称
     *   userlist	成员帐号
     *   grouplist	成员邮件群组
     *   department	成员部门
     *   allow_type	群发权限。0: 企业成员, 1任何人， 2:组内成员，3:指定成员
     *   allow_userlist	群发权限为指定成员时，需要指定成员，否则赋值失效
    */
    function get($group){
        $url = 'https://api.exmail.qq.com/cgi-bin/group/get';
        return $this->_client->get($url,[
            'groupid' => $group,
        ]);
    }

}