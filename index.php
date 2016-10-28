<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015 Kasra Madadipouya <kasra@madadipouya.com>
*
*/

require 'vendor/autoload.php';
define("BOTNAME","jesoopuri_bot");
$client = new Zelenin\Telegram\Bot\Api('258662542:AAEB0DjEpT78nizCudXpnJfYJOg8rlI_udE'); // Set your access token
$url = ''; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));


function getRandomUrl($tag){
	try{
		$db = new PDO('sqlite:jesoo.db');
		$result = $db->query('SELECT * FROM Immagini WHERE tag=\''.$tag.'\' ORDER BY RANDOM() LIMIT 1');
		 
		foreach($result as $row){
			$last = str_replace('open?','uc?',$row['url']);
		}
		$db = NULL;
	}catch(PDOException $e){
		print 'Exception : '.$e->getMessage();
	}
	
	return $last;
}

function getRandomQuote($thinker){
	$table = "Quote";
	if($thinker) $table = "Thinker";
	try{
		$db = new PDO('sqlite:jesoo.db');
 		$count = $db->query("SELECT count(*) as cc FROM ".$table);
 		foreach($count as $row){
 			$max = $row['cc'];
 		}
		$rand = rand(1,$max);
		$result = $db->query('SELECT * FROM '.$table.' WHERE id='.$rand);	
		//$result = $db->query('SELECT * FROM '.$table.' ORDER BY RANDOM() LIMIT 1');	
		foreach($result as $row){
			$last = $row['text'];
		}
		$db = NULL;
	}catch(PDOException $e){
		print 'Exception : '.$e->getMessage();
	}
	
	return $last;
}

function getRandomQuoteD($thinker){
	$table = "Quote";
	if($thinker) $table = "Thinker";
	try{
		$db = new PDO('sqlite:jesoo.db');

		$result = $db->query('SELECT * FROM '.$table.' ORDER BY RANDOM() LIMIT 1');	
		foreach($result as $row){
			$last = $row['text'];
		}
		$db = NULL;
	}catch(PDOException $e){
		print 'Exception : '.$e->getMessage();
	}
	
	return $last;
}

//your app
try {

    if($update->message->text == '/anciola' || $update->message->text == '/anciola@'.BOTNAME)
    {

    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendPhoto([
    		'chat_id' => $update->message->chat->id,
    		'photo' => getRandomUrl('Anciola')
    			 
    	]);
  
    }else if($update->message->text == '/vala' || $update->message->text == '/vala@'.BOTNAME){
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendPhoto([
    			'chat_id' => $update->message->chat->id,
    			'photo' => getRandomUrl('Vala')
    	
    	]);
    }else if($update->message->text == '/cotoletta' || $update->message->text == '/cotoletta@'.BOTNAME){
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	 
    	$response = $client->sendPhoto([
    			'chat_id' => $update->message->chat->id,
    			'photo' => getRandomUrl('Cotoletta')
    	
    	]);
    }else if($update->message->text == '/dan' || $update->message->text == '/dan@'.BOTNAME){
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	 
    	$response = $client->sendPhoto([
    			'chat_id' => $update->message->chat->id,
    			'photo' => getRandomUrl('Dan')
    	
    	]);
    }else if($update->message->text == '/zilv' || $update->message->text == '/zilv@'.BOTNAME){
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	 
    	$response = $client->sendPhoto([
    			'chat_id' => $update->message->chat->id,
    			'photo' => getRandomUrl('Zilv')
    	
    	]);
    }else if($update->message->text == '/cats' || $update->message->text == '/cats@'.BOTNAME){
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	 
    	$response = $client->sendPhoto([
    			'chat_id' => $update->message->chat->id,
    			'photo' => getRandomUrl('Cats')
    	
    	]);
    }else if($update->message->text == '/dailyquote' || $update->message->text == '/dailyquote@'.BOTNAME){
    	$daily_quote = "\"".getRandomQuote(false)."\" - ".getRandomQuote(true);
   		$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    			'chat_id' => $update->message->chat->id,
    			'text' => $daily_quote
    			 
    	]);
	}
    else
    {
    	//$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	//$response = $client->sendMessage([
    	//	'chat_id' => $update->message->chat->id,
    	//	'text' => "Perzona Falza!!! Questo comando non esiste!"
    	//	]);

    }
    
    
   

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}


