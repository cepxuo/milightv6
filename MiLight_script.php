```php
// Прописываем начальные переменные и переносим в них параметры из строки вызова скрипта
$ip = $params["ip"];
$hello = hex2bin("200000001602623AD5EDA301AE082D466141A7F6DCAFD3E600001E");
$port = $params["port"];
$cmd = $params["cmd"];
$chan = $params["chan"];
$level = str_pad(dechex($params["level"]), 2, '0', STR_PAD_LEFT); // так как нам надо значение в HEX с 0 в начале для значений от 1 до 9, конвертим параметр из DEC в HEX и добавляем 0, если надо

// Прописываем команды
$off = "3100000804020000000100";
$on  = "3100000804010000000100";
$lvl = "3100000803".$level."0000000100";

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
}

// Высчитываем контрольную сумму команды
$crcdec = 0;
for ($i = 0; $i <= 21; $i+=2) {
	$crcdec = $crcdec + hexdec(substr($outcmd,$i,2));
}
$crc = dechex($crcdec);

// Общаемся с контроллером
$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_sendto($sock, $hello, strlen($hello), 0, $ip, $port);
socket_recvfrom($sock, $bufbin, 44, 0, $ip, $port);
$buf = bin2hex($bufbin);
$sessionID = substr($buf,38,4); // Получаем SessionID из ответа контроллера
$outhex = "8000000011".$sessionID."00".$chan."00".$outcmd.$crc; // Собираем полный текст команды контроллеру
$out = hex2bin($outhex); // конвертируем её в BIN
socket_sendto($sock, $out, strlen($out), 0, $ip, $port);
socket_recvfrom($sock, $buf, 16, 0, $ip, $port); // Так как я всегда отправляю команды с SequenceID = 1, то ответ от контроллера не обрабатываю
socket_close($sock);
```
