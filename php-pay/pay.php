<?php
    require_once('WxPay.php');
    header("content:application/json;chartset=uft-8");
    $post=$_POST;
    if(empty($post)){
        echo json_encode(['code'=>-1,'msg'=>'no params']);
        exit;
    }
    if(!isset($post['openid'])||empty($post['openid'])){
        echo json_encode(['code'=>-2,'msg'=>'no openid']);
        exit;
    }
    $pay=new Wxpay();
    $res=$pay->wxpay_unified_order(time(),$post['openid']);
    if($res){
        echo json_encode(['code'=>0,'msg'=>'success','data'=>$res]);
        exit;
    }else{
        echo json_encode(['code'=>-3,'msg'=>'get pay info failed']);
        exit;
    }