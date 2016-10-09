<?php

include "class.php";

$c = new telebot ("bot206162829:AAF9WAxr7BGYSS5oneQPTq7z0T4_HAWPIVw");	
$r = $c->GetUpdates($c->update_id('r'));
$botName = array("Камамон" , "карамон", "Karamon", "karamon");

	foreach($r as $i => $v)
	{
		if($c->update_id('r') < $r[$i]['update_id'])
		{
			 // Сохранение последнего update_id 
			 $c->update_id($r[$i]['update_id']);
			 
			 $chatID = $r[$i]['message']['chat']['id'];
			 //$name = $r[$i]['message']['chat']['first_name'];
			 //$full_name = $r[$i]['message']['chat']['first_name'] . " " . $r[$i]['message']['chat']['last_name'];
			 $login = $r[$i]['message']['from']['username'];
			 $userID = $r[$i]['message']['from']['id'];
			 $message = mb_strtolower($r[$i]['message']['text'], "UTF-8");
			 
			 if($message == "/start") {
			 	$c->SMessage($chatID,"Добро пожаловать, " . $full_name . " в Burger & Lounge Grill Bar. Здесь пока пусто и все только начинается как будет все готово я обязательно свяжусь с администрацией ресторана!");
			 }
			 
			 
			 
			 
		$sym = str_split($message);
		if($sym[0] == "!")
		{
			switch(mb_strtolower($message, "UTF-8"))
			{
				case "!меню":
					$c->SMessage($chatID,"Вошли в меню");
					break;
				default: 
					$c->SMessage($chatID, "Неизвестная команда");
					break;
			}
		} 
		else 
		{
			if($r[$i]['message']['chat']['type'] == "group") 
			 {
			 	$arg = explode(",", $message);
			 	if(in_array($arg[0], $botName))
			 	{
					$message = substr(mb_strtolower($r[$i]['message']['text'], "UTF-8"), strlen($arg[0] . ", "));

					switch($message){
						case "privet":
							$message = "И Вам здравствуйте," . " Завен!";
							break;
						case "привет":
							$message = "И Вам здравствуйте," . " Завен!";
							break;
						case "как дела?":
							$message = "Спасибо, все отлично! Как у Вас?";
							break;
						case "как дела":
							$message = "Спасибо, все отлично! Как у Вас?";
							break;
						case "kak dela?":
							$message = "Спасибо, все отлично! Как у Вас?";
							break;
						case "kak dela":
							$message = "Спасибо, все отлично! Как у Вас?";
							break;
					}
				}
				else return false;
			 }
			$c->SMessage($chatID,$message);
		}
			 
			 
			 
			 
			 
		}
	}
	
	
	
?>