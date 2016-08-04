<?php
require 'vendor/autoload.php';
use PhpSlackBot\Bot;

// Custom command
class MyCommand extends \PhpSlackBot\Command\BaseCommand {

    protected function configure() {
        $this->setName('mycommand');
    }

    protected function execute($message, $context) {
        $this->send($this->getCurrentChannel(), null, 'Hello !');
    }

}

$bot = new Bot();
$bot->setToken(getenv('SLACKBOT_TOKEN')); 
$bot->loadCommand(new MyCommand());
$bot->run();
