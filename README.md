# milightv6
Milight v.6 light controller integration with Majordomo

This script sends comands to MiLight v6 controllers.

INSTALLATION
Just copy contents of MiLight_script.php to any new script in Majordomo. Run the script with options:
* ip=IP address of controller,
* port=port of controler (mostly used 5987),
* chan=channel (01, 02, 03 or 04),
* cmd=command (on, off or lvl),
---
In case of **lvl** command you need to specify brightness level with option `level=brightness level`.

------------------------------------------------------------------------------------------------------------------

# milightv6
Интеграция контроллера Milight v.6 в Majordomo

Данный скрипт отправляет команды контроллеру Milight v.6

УСТАНОВКА
Скопируйте содержание файла MiLight_script.php в любой новый сценарий. Вызывайте этот сценарий со следующими параметрами:
* ip=IP адрес контроллера,
* port=порт контроллера (чаще всего 5987),
* chan=канал (01, 02, 03 или 04),
* cmd=команда (on, off или lvl),
---
В случае команды **lvl** вам необходимо также указать уровень яркости через параметр `level=уровень яркости`.
