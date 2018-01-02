<?php
namespace ChatBot;

class Observer
{
    public static function setQrCodeObserver($qrCodeUrl)
    {
        vbot('console')->log('正在为你准备手机端二维码', 'Tips');
        vbot('console')->log('成功生成二维码链接：' . $qrCodeUrl, 'Tips');
    }

    public static function setLoginSuccessObserver()
    {
        vbot('console')->log('登录成功', 'Tips');
    }

    public static function setReLoginSuccessObserver()
    {
        vbot('console')->log('免扫码登录成功', 'Tips');
    }

    public static function setExitObserver()
    {
        vbot('console')->log('退出程序', 'Tips');
    }

    public static function setFetchContactObserver(array $contacts)
    {
        vbot('console')->log('获取好友成功', 'Tips');
    }

    public static function setBeforeMessageObserver()
    {
        vbot('console')->log('准备接收消息', 'Tips');
    }

    public static function setNeedActivateObserver()
    {
        vbot('console')->log('准备挂了，但应该能抢救一会', 'Tips');
    }
}
