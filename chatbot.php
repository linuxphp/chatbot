<?php
namespace ChatBot;

require __DIR__ . '/vendor/autoload.php';
use Hanson\Vbot\Foundation\Vbot;


class ChatBot
{
    private $config;
    static private $_instance = null;

    public function __construct($session = null)
    {
        $this->config = require_once __DIR__ . '/config.php';
        !empty($session) && $this->config['session'] = $session;
    }

    public function getInstance($session = null)
    {
        empty(self::$_instance) && self::$_instance = new self($session);

        return self::$_instance;
    }

    public function start()
    {
        //机器人实例
        $robot = new Vbot($this->config);

        //注册各种消息处理器
        $robot->messageHandler->setHandler([MessageHandler::class, 'messageHandler']);

        //load some extensions
        $robot->messageExtension->load([
        ]);

        //注册各种监听器
        $robot->observer->setQrCodeObserver([Observer::class, 'setQrCodeObserver']);
        $robot->observer->setLoginSuccessObserver([Observer::class, 'setLoginSuccessObserver']);
        $robot->observer->setReLoginSuccessObserver([Observer::class, 'setReLoginSuccessObserver']);
        $robot->observer->setExitObserver([Observer::class, 'setExitObserver']);
        $robot->observer->setFetchContactObserver([Observer::class, 'setFetchContactObserver']);
        $robot->observer->setBeforeMessageObserver([Observer::class, 'setBeforeMessageObserver']);
        $robot->observer->setNeedActivateObserver([Observer::class, 'setNeedActivateObserver']);

        $robot->server->serve();
    }
}

//启动聊天机器人
ChatBot::getInstance()->start();
