<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/12/14
 * Time: 15:52
 */

namespace Nobody1986\Qqexmail;



class Department
{
    protected $_client;
    function __construct(Client $client)
    {
        $this->_client = $client;
    }

    function create($name,$parentid=1,$order=0){
        $url = 'https://api.exmail.qq.com/cgi-bin/department/create';
        return $this->_client->post($url,[
            'name' => $name,
            'parentid' => $parentid,
            'order' => $order,
        ]);
    }

    function update($id,$name,$parentid=1,$order=0){
        $url = 'https://api.exmail.qq.com/cgi-bin/department/update';
        return $this->_client->post($url,[
            'id' => $id,
            'name' => $name,
            'parentid' => $parentid,
            'order' => $order,
        ]);
    }
    function delete($id,$name){
        $url = 'https://api.exmail.qq.com/cgi-bin/department/delete';
        return $this->_client->get($url,[
            'id' => $id,
        ]);
    }
    /**
     *
     *   参数	说明
     *   errcode	返回码
     *   errmsg	对返回码的文本描述内容
     *   department	部门列表数据。以部门的order字段从小到大排列
     *   id	部门id
     *   name	部门名称
     *   parentid	父部门id。
     *   order	在父部门中的次序值。order值小的排序靠前
    */
    function getList($id){
        $url = 'https://api.exmail.qq.com/cgi-bin/department/list';
        return $this->_client->get($url,[
            'id' => $id,
        ]);
    }


    function search($name ,$fuzzy=0){
        $url = 'https://api.exmail.qq.com/cgi-bin/department/search';
        return $this->_client->post($url,[
            'name' => $name,
            'fuzzy' => $fuzzy,
        ]);
    }

}