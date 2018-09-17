<?php
require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = '#'; //sesuaikan 
$channelSecret = '#';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];

$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$pesan_datang = explode(" ", $message['text']);

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
function bomsms($keyword) {
    $uri = "http://48.nakocoders.org/api/jdid/api.php?nomor=$keyword";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result .= "Sukses Silahkan Check [$keyword]\n-Nako";
    return $result;
}
function asmaul($keyword) {
    $uri = "http://api.aladhan.com/asmaAlHusna/$keyword";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result .= $json['data']['0']['transliteration'] ;
    return $result;
}
function iden($keyword) {
    $uri = "http://48.nakocoders.org/api/translate/api.php?textna=$keyword&bahasa1=id&bahasa2=en";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result .= $json['translationResponse'];
    return $result;
}
function enid($keyword) {
    $uri = "http://48.nakocoders.org/api/translate/api.php?textna=$keyword&bahasa1=en&bahasa2=id";

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result .= $json['translationResponse'];
    return $result;
}
function bomtel($keyword) {
    $uri = "http://48.nakocoders.org/api/jdid/tk.php?nomor=$keyword";
    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result .= "Sukses Silahkan Check [$keyword]\n-Nako";
    return $result;
}
function bomsmstel($keyword) {
    $uri = "http://48.nakocoders.org/api/jdid/tsel.php?nomor=$keyword";
    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result .= "Sukses Silahkan Check [$keyword]\n-Nako";
    return $result;
}
function bomsms3($keyword) {
    $uri = "http://48.nakocoders.org/api/jdid/3.php?nomor=$keyword";
    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
	$result .= "Sukses Silahkan Check [$keyword]\n-Nako";
    return $result;
}
if ($type == 'join' || $command == '/menu-list') {
    $text = "Welcome To NakoBOT\nUse Tools :\nSMS-BOM ALL : \n/sms1 <nohp>\n\BOM TELPON : \n/tel <nohp>\nBOM SMS 3 :\n/sms2 <nohp>\nBOM SMS TSEL : \n/sms3 <62nohp>\nTranslate ID-EN :\n/id-en <text>\nTranslate EN-ID :\n/en-id <text>\n-Nako";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
if($message['type']=='text') {
	    if ($command == '/sms1') {
        $result = bomsms($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/sms2') {
        $result = bomsms3($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/sms3') {
        $result = bomsmstel($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/tel') {
        $result = bomtel($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/id-en') {
        $result = iden($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/en-id') {
        $result = enid($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/s') {
        $result = asmaul($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}else if($message['type']=='sticker')
{	
	$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Makasih Kak Stikernya ^_^'										
									
									)
							)
						);
						
}
if (isset($balas)) {
    $result = json_encode($balas);
    file_put_contents('./balasan.json', $result);
    $client->replyMessage($balas);
}
?>
