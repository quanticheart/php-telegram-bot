<?php

// Esse arquivo e pasta é gerado depois de instalação da biblioteca descrita acima

use App\Telegram\Telegram;

include_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Telegram::sendMessage($_ENV["TELEGRAM_CHAT"], "Hellow Wordo!");
Telegram::getChatIds();
