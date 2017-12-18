<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/12/14
 * Time: 14:28
 */
namespace Nobody1986\Qqexmail;
class Client{
    protected $_corpid;
    protected $_secret;
    protected $_requester;
    protected $_accessToken;
    protected $_expire;
    function __construct($corpid,$secret)
    {
        $this->_corpid=$corpid;
        $this->_secret=$secret;
        $this->_requester = new Requester();
    }

    function auth(){
        $url = "https://api.exmail.qq.com/cgi-bin/gettoken";
        $ret = $this->_requester->get($url,[
            'corpid' => $this->_corpid,
            'corpsecret' => $this->_secret
        ]);
        $this->_accessToken = $ret['access_token'];
        $this->_expire = time() + $ret['expires_in'];
    }

    function get($url,$data){
        return $this->_requester->get($url,$data+['access_token'=>$this->_accessToken]);
    }

    function post($url,$data){
        if(strpos($url,'?')===false){
            $url = sprintf("%s?%s",$url,http_build_query([
                'access_token'=>$this->_accessToken
            ]));
        }else{
            $url = sprintf("%s&%s",$url,http_build_query([
                'access_token'=>$this->_accessToken
            ]));
        }
        return $this->_requester->post($url,$data);
    }



}