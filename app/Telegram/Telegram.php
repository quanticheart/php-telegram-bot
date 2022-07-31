<?php

namespace App\Telegram;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\Types\Message;

class Telegram
{
    /**
     * @param string $chatID
     * @param string $message
     * @return Message
     * @throws Exception
     * @throws InvalidArgumentException
     */
    static function sendMessage(string $chatID, string $message): Message
    {
        $bot = new BotApi($_ENV["TELEGRAM_TOKEN"]);
        return $bot->sendMessage($chatID, $message);
    }

    /**
     *
     */
    static function getChatIds()
    {
        $ids = "https://api.telegram.org/bot" . $_ENV["TELEGRAM_TOKEN"] . "/getUpdates";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $ids);
        $result = curl_exec($ch);
        curl_close($ch);
//        var_dump(json_decode($result, true));

        $json = json_decode($result, true);
        $id = array();
        foreach ($json["result"] as $item) {
            $chat = $item["message"]["chat"];

            $chatItem = array();
            $chatItem["id"] = $chat["id"];

            if (array_key_exists("title", $chat))
                $chatItem["title"] = $chat["title"];

            if (array_key_exists("first_name", $chat))
                $chatItem["first_name"] = $chat["first_name"];

            if (array_key_exists("username", $chat))
                $chatItem["username"] = $chat["username"];

            $chatItem["type"] = $chat["type"];

            $id[] = $chatItem;
        }

        print_r($id);
    }
}