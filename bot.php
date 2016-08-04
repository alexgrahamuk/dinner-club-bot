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

class InsultCommand extends \PhpSlackBot\Command\BaseCommand {

    protected function configure() {
        $this->setName('insult');
    }

    protected function execute($message, $context) {

	$insult = @file_get_contents('https://www.foaas.com/king/'.$this->getUserNameFromUserId($this->getCurrentUser()).'/'.$this->getName());

	if ($insult === false)
		return;

	//Cheap parse, accept header not working on api
	$insult = substr($insult, strpos($insult, '<h1>')+4);
	$insult = substr($insult, 0, strpos($insult, '</h1>'));

        $this->send($this->getCurrentChannel(), $this->getCurrentUser(), $insult);
    }

}

class FuckYouCommand extends \PhpSlackBot\Command\BaseCommand {

    protected function configure() {
        $this->setName('fuck_you');
    }

   
    protected function execute($message, $context) {

        $this->send
	(
		$this->getCurrentChannel(), 
		$this->getCurrentUser(), 
		'Hey '.$this->getUserNameFromUserId($this->getCurrentUser()).', fuck you too buddy!'
	);
    }

}



$bot = new Bot();
$bot->setToken(getenv('SLACKBOT_TOKEN')); 
$bot->loadCommand(new MyCommand());
$bot->loadCommand(new InsultCommand());
$bot->loadCommand(new FuckYouCommand());
$bot->run();
