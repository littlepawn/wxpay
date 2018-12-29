<?php
/**
 * 根据小程序回传的code获取openid和session_key
 */
header("content:application/json;chartset=uft-8");
$app_id="xxxxxxxxxxxxxxx";
$secret="xxxxxxxxxxxxxxx";
$post=$_POST;
if(empty($post)){
    echo json_encode(['code'=>-1,'msg'=>'no params']);
    exit;
}
if(!isset($post['code'])){
    echo json_encode(['code'=>-2,'msg'=>'no code']);
    exit;
}
$code=$post['code'];
if(empty($code)){
    echo json_encode(['code'=>-2,'msg'=>'no code']);
    exit;
}
$url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$app_id."&secret=".$secret."&js_code=".$code."&grant_type=authorization_code";        
$res = file_get_contents($url); 
$result = json_decode($res);
//openid不建议返回给客户端，此处为用到数据库及方便演示，则返给客户端用来调起支付
if($result->openid){
    echo json_encode(['code'=>0,'msg'=>'success','data'=>['openid'=>$result->openid]]);
    exit;
}else{
    echo json_encode(['code'=>-3,'msg'=>$result->errmsg]);
    exit;
}
