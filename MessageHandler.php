<?php

namespace ChatBot;

use ChatBot\Handlers\Contact\Daren;
use ChatBot\Handlers\Type\RecallType;
use ChatBot\Handlers\Type\TextType;
use Hanson\Vbot\Contact\Friends;
use Hanson\Vbot\Contact\Groups;
use Hanson\Vbot\Contact\Members;
use Hanson\Vbot\Message\Emoticon;
use Hanson\Vbot\Message\Text;
use Illuminate\Support\Collection;

class MessageHandler
{
    public static function messageHandler(Collection $message)
    {
        //好友实例
        $friends = vbot('friends');

        //群实例
        $groups = vbot('groups');

        //群成员实例
        $members = vbot('members');

        //公众号实例
        //$officials = vbot('officials');

        //特殊账号实例
        //$specials = vbot('specials');

        //获取自己实例
        //$myself = vbot('myself');


        Daren::messageHandler($message, $friends, $groups);
        //ColleagueGroup::messageHandler($message, $friends, $groups);
        //FeedbackGroup::messageHandler($message, $friends, $groups);
        //ExperienceGroup::messageHandler($message, $friends, $groups);
        //TextType::messageHandler($message, $friends, $groups);
        //RecallType::messageHandler($message);

        if($message['type'] === 'new_friend') 
        {
            Text::send($message['from']['UserName'], '客官，等你很久了！');
            $groups->addMember($groups->getUsernameByNickname('ChatBot体验群'), $message['from']['UserName']);
        }

        if($message['type'] === 'emoticon' && random_int(0, 1)) 
        {
            Emoticon::sendRandom($message['from']['UserName']);
        }

        if($message['type'] === 'official') 
        {
            vbot('console')->log('收到公众号消息:'.$message['title'].$message['description'].  $message['app'].$message['url']);
        }

        if($message['type'] === 'request_friend') 
        {
            vbot('console')->log('收到好友申请:'.$message['info']['Content'].$message['avatar']);
            if(in_array($message['info']['Content'], ['echo', 'print_r', 'var_dump', 'print'])) 
            {
                $friends->approve($message);
            }
        }
    }
}
