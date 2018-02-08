<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/12/14
 * Time: 14:46
 */

namespace Nobody1986\Qqexmail;


class Requester
{
    protected $_client;
    const HTTP_OK=200;
    const REQ_OK=0;
    function __construct()
    {
        $this->_client = new \GuzzleHttp\Client([
            'timeout' => 1
        ]);
    }
    protected  function _request($method,$url,$data=[]){
        if($method=='GET'){
            $resp = $this->_client->request($method,$url,['verify' => false]);
        }else{
            $resp = $this->_client->request($method,$url,[
                'verify' => false,
                'json' => $data
            ]);
        }
        $status = $resp->getStatusCode();
        if($status!=self::HTTP_OK){
            throw new errors\HttpException('',$status);
        }
        $body = (string)$resp->getBody();
        if(empty($body)){
            throw new errors\HttpException('',-1);
        }
        $bodyJson = json_decode($body,true);
        if($bodyJson['errcode'] != self::REQ_OK){
            throw new errors\ExmailException($bodyJson['errmsg'],$bodyJson['errcode']);
        }
        return $bodyJson;
    }

    function get($url,$data=[]){
        if(!empty($data)){
            if(strpos($url,'?')===false){
                $url = sprintf("%s?%s",$url,http_build_query($data));
            }else{
                $url = sprintf("%s&%s",$url,http_build_query($data));
            }
        }
        return $this->_request('GET',$url);
    }
    function post($url,$data=[]){
        return $this->_request('POST',$url,$data);
    }

}