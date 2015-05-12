<?php

/**
 * RSS Reader (read and parse rss from other sites)
 *
 * @package Cotonti
 * @version 2.00
 * @author esclkm, http://www.littledev.ru
 * @copyright Copyright (c) esclkm, http://www.littledev.ru 2012
 */

defined('COT_CODE') or die('Wrong URL');

$L['cfg_category'] = array("URL RSS ленты", "Для корректного отображения настроек включите jQuery ");

$L['Charset'] = "Кодировка";
$L['Template'] = "Шаблон";
$L['Rssfeedurl'] = "URL rss ленты";
$L['Rsserror'] = "Ошибка! Одно или несколько полей не заполнены!";

$L['rssreader_help']='Если отключено весь HTML парсинг будет удален из description<br />Если отсутствует шаблон дополнительных категорий в каталоге {ВАШ_СКИН}/plugins, будет использован шаблон rssreader.tpl';

?>