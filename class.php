<?php
class telebot
{
	#==========ОШИБКИ===========
	# 21 - не указали токен
	#
	#
	#===========================
	#========ПЕРЕМЕННЫЕ=========
	private $token;
	#===========================
	public function __construct($token)
	{
		$this->token = $token;
	}
	#====================ПРИВАТНЫЕ ФУНКЦИИ=================
	private function get($s)
	{
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $s);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			$r = curl_exec ($ch);
			if ($r == NULL) {
				return "Ошибка: ".curl_errno($ch) . " - " . curl_error($ch);
			}else{
				return $r;
			}
		curl_close($ch);
	}
	#======================================================

	#=====================ПУБЛИЧНЫЕ========================
	public function log($str)
	{
		file_put_contents("log.txt", "[".date('M-d-y_H:i:s')."]: ".$str."\n", FILE_APPEND);
	}
	
	function pre($pre){
		echo "<pre>";
		print_r($pre);
		echo "<pre>";
	}

	public function update_id($s)
	{
		switch($s)
		{
			case 'r': #чтение последнего обновления
				if(file_exists("update_id.txt")){
					return file_get_contents("update_id.txt");
				} else return 0;
			break;

			default:
				file_put_contents("update_id.txt", $s);
			break;
		}
	}
	public function GetUpdates($offset = 0)
	{
		if(!$this->token) return 21;
		$r = json_decode( $this->get("https://api.telegram.org/".$this->token."/getupdates?offset=".$offset), true );
		return $r['result'];
	}

	public function SMessage($w, $s, $keyboard = true)
	{
		if(!$this->token) return 21;
		if(is_array($keyboard))
		{
   			$reply = json_encode(array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => true));
   			return $this->get( "https://api.telegram.org/".$this->token."/sendmessage?".http_build_query( array("chat_id" => $w, "text" => $s, 'reply_markup' => $reply) ) );

		}
		return $this->get( "https://api.telegram.org/".$this->token."/sendmessage?". http_build_query(array("chat_id" => $w, "text" => $s)) );
	}

	#======================================================
}


?>