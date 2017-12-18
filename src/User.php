<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/12/14
 * Time: 15:52
 */

namespace Nobody1986\Qqexmail;



class User
{
    protected $_client;
    function __construct(Client $client)
    {
        $this->_client = $client;
    }

    /**
     * 参数	必须	说明
     *   access_token	是	调用接口凭证
     *   userid	是	成员UserID。企业邮帐号名，邮箱格式
     *   name	是	成员名称。长度为1~64个字节
     *   department	是	成员所属部门id列表，不超过20个
     *   position	否	职位信息。长度为0~64个字节
     *   mobile	否	手机号码
     *   tel	否	座机号码
     *   extid	否	编号
     *   gender	否	性别。1表示男性，2表示女性
     *   slaves	否	别名列表
     *   1.Slaves 上限为5个
     *   2.Slaves 为邮箱格式
     *   password	是	密码
     *   cpwd_login	否	用户重新登录时是否重设密码, 登陆重设密码后，该标志位还原。0表示否，1表示是，缺省为0
    */
    function create($userinfo){
        $url = 'https://api.exmail.qq.com/cgi-bin/user/create';
        return $this->_client->post($url,$userinfo);
    }

    function update($email,$userinfo){
        $url = 'https://api.exmail.qq.com/cgi-bin/user/update';
        $userinfo['userid'] = $email;
        return $this->_client->post($url,$userinfo);
    }
    function delete($email){
        $url = 'https://api.exmail.qq.com/cgi-bin/user/delete';
        return $this->_client->get($url,[
            'userid' => $email,
        ]);
    }
    function get($email){
        $url = 'https://api.exmail.qq.com/cgi-bin/user/get';
        return $this->_client->get($url,[
            'userid' => $email,
        ]);
    }
    /**
     *
     * 参数	必须	说明
        access_token	是	调用接口凭证
        department_id	是	获取的部门id。id为1时可获取根部门下的成员
        fetch_child	否	1/0：是否递归获取子部门下面的成员
     *
     *   参数	说明
        errcode	返回码
        errmsg	对返回码的文本描述内容
        userlist	成员列表
        userid	成员UserID
        name	成员名称
        department	成员所属部门
    */
    function getSimplelistByDept($departmentId,$child=0){
        $url = 'https://api.exmail.qq.com/cgi-bin/user/simplelist';
        return $this->_client->get($url,[
            'department_id' => $departmentId,
            'fetch_child' => $child,
        ]);
    }


    /**
     * 参数	说明
        errcode	返回码
        errmsg	对返回码的文本描述内容
        userlist	成员列表
        userid	成员UserID。企业邮帐号名，邮箱格式
        name	成员名称
        department	成员所属部门id列表
        position	职位信息
        mobile	手机号码
        tel	座机号码
        extid	编号
        gender	性别。0表示未定义，1表示男性，2表示女性
        slaves	别名列表
        1、Slaves上限为5个
        2、Slaves为邮箱格式
        cpwd_login	用户重新登录时是否重设密码, 登陆重设密码后，该标志位还原。0表示否，1表示是，缺省为0。
    */
    function getListByDept($departmentId,$child=0){
        $url = 'https://api.exmail.qq.com/cgi-bin/user/list';
        return $this->_client->get($url,[
            'department_id' => $departmentId,
            'fetch_child' => $child,
        ]);
    }
    /**
     * 参数	说明
        errcode	返回码
        errmsg	对返回码的文本描述内容
        list	列表数据
        user	成员帐号
        type	帐号类型。-1:帐号号无效; 0:帐号名未被占用; 1:主帐号; 2:别名帐号; 3:邮件群组帐号
    */
    function batchcheck($emails){
        $url = 'https://api.exmail.qq.com/cgi-bin/user/batchcheck';
        return $this->_client->post($url,[
            'userlist' => $emails,
        ]);
    }

}