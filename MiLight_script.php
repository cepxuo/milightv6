// Прописываем начальные переменные и переносим в них параметры из строки вызова скрипта
$ip = $params["ip"];
$hello = hex2bin("200000001602623AD5EDA301AE082D466141A7F6DCAFD3E600001E");
$cmd = $params["cmd"];
$level = str_pad(dechex($params["level"]), 2, '0', STR_PAD_LEFT); // так как нам надо значение в HEX с 0 в начале для значений от 1 до 9, конвертим параметр из DEC в HEX и добавляем 0, если надо
$DECcolor = $params["color"];
if( !$params["port"] ) {
   $port = 5987; // Порт по умолчанию 5987
} else {
  $port = $params["port"]; 
}
if( !$params["chan"] ) {
   $chan = "01"; // Канал по умолчанию 01
} else {
  $chan = $params["chan"]; 
}
if( !$params["mo"] ) {
   $mo = "05"; // Режим по умолчанию 05 - переключение цветов
} else {
  $mo = $params["mo"]; 
}

//Вычисляем цвет
$color = dechex($DECcolor);

// Прописываем команды
$off = "310000080402000000".$chan."00";
$on  = "310000080401000000".$chan."00";
$lvl = "3100000803".$level."000000".$chan."00";
$clr = "3100000801".$color.$color.$color.$color.$chan."00";
$night = "310000080405000000".$chan."00";
$white = "310000080564000000".$chan."00";
$disco = "3100000806".$mo."000000".$chan."00";
$slower = "310000080404000000".$chan."00";
$faster = "310000080403000000".$chan."00";


// Выбираем, какую команду отправлять контроллеру
switch($cmd){
 case "off";
  $outcmd= $off;
  break;
 case "on";
  $outcmd = $on;
  break;
 case "level";
  $outcmd = $lvl;
  break;
 case "color";
  $outcmd = $clr;
  break;
 case "night";
  $outcmd = $night;
  break;
 case "white";
  $outcmd = $white;
  break;
 case "disco";
  $outcmd = $disco;
  break;
 case "slower";
  $outcmd = $slower;
  break;
 case "faster";
  $outcmd = $faster;
  break;
}

// Высчитываем контрольную сумму команды
$crcdec = 0;
for ($i = 0; $i <= 21; $i+=2) {
	$crcdec = $crcdec + hexdec(substr($outcmd,$i,2)); // Отрезаем лишнее
}

if( strlen(dechex($crcdec)) > 2){
    $crc1 = dechex($crcdec);
    $crc = substr($crc1,1,2);
} else {
    $crc = dechex($crcdec);
}


// Общаемся с контроллером
$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_sendto($sock, $hello, strlen($hello), 0, $ip, $port);
socket_recvfrom($sock, $bufbin, 44, 0, $ip, $port);
$buf = bin2hex($bufbin);
$sessionID = substr($buf,38,4); // Получаем SessionID из ответа контроллера
$outhex = "8000000011".$sessionID."000100".$outcmd.$crc; // Собираем полный текст команды контроллеру
$out = hex2bin($outhex); // конвертируем её в BIN
socket_sendto($sock, $out, strlen($out), 0, $ip, $port);
socket_recvfrom($sock, $buf, 16, 0, $ip, $port); // Так как я всегда отправляю команды с SequenceID = 1, то ответ от контроллера не обрабатываю
socket_close($sock);

