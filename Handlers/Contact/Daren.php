<?php

namespace ChatBot\Handlers\Contact;

use Hanson\Vbot\Support\File as Helper;
use Hanson\Vbot\Contact\Friends;
use Hanson\Vbot\Contact\Groups;
use Hanson\Vbot\Message\Card;
use Hanson\Vbot\Message\Emoticon;
use Hanson\Vbot\Message\File;
use Hanson\Vbot\Message\Image;
use Hanson\Vbot\Message\Text;
use Hanson\Vbot\Message\Video;
use Hanson\Vbot\Message\Voice;
use Illuminate\Support\Collection;

class Daren
{
    public static function messageHandler(Collection $message, Friends $friends, Groups $groups)
    {
        Helper::debug($message, false);
        if($message['fromType'] <> 'Group')
        {
            Text::send($message['from']['UserName'], '你好: ' . $message['content']);
        }

        return;
    }
}
