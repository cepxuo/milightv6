# Milight v.6 light controller integration with [Majordomo](http://majordomo.smartliving.ru)

This script sends comands to MiLight v6 controllers.

INSTALLATION
Just copy contents of MiLight_script.php to any new script in Majordomo. Run the script with options:
* ip=IP address of controller,
* port=port of controler (mostly used 5987),
* chan=channel (01, 02, 03 or 04),
* cmd=command (on, off or lvl),
<br/>In case of **lvl** command you need to specify brightness level with option `level=brightness level`.

For example: `http://192.168.0.1/objects/?script=MiLight_script&ip=192.168.0.200&port=5987&chan=01&cmd=on` will send command to controller 192.168.0.200 to switch the lamp on channel 01.<br/>
`http://192.168.0.1/objects/?script=MiLight_script&ip=192.168.0.200&port=5987&chan=01&cmd=lvl&level=50` will send command to controller 192.168.0.200 to set the brishtness level 50% on the lamp on channel 01.

---

# Интеграция контроллера Milight v.6 в [Majordomo](http://majordomo.smartliving.ru)

Данный скрипт отправляет команды контроллеру Milight v.6

УСТАНОВКА
Скопируйте содержание файла MiLight_script.php в любой новый сценарий. Вызывайте этот сценарий со следующими параметрами:
* ip=IP адрес контроллера,
* port=порт контроллера (чаще всего 5987),
* chan=канал (01, 02, 03 или 04),
* cmd=команда (on, off или lvl),
<br/>В случае команды **lvl** вам необходимо также указать уровень яркости через параметр `level=уровень яркости`.

Например: `http://192.168.0.1/objects/?script=MiLight_script&ip=192.168.0.200&port=5987&chan=01&cmd=on` отправит команду контроллеру 192.168.0.200, чтобы включить лампу на канале 01.<br/>
`http://192.168.0.1/objects/?script=MiLight_script&ip=192.168.0.200&port=5987&chan=01&cmd=lvl&level=50` отправит команду контроллеру 192.168.0.200, чтобы установить яркость 50% у лампы на канале 01.