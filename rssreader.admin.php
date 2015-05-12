<?php

/* ====================
 * [BEGIN_COT_EXT]
 * Hooks=admin.config.edit.loop
 * [END_COT_EXT]
  ==================== */

/**
 * RSS Reader (read and parse rss from other sites)
 *
 * @package Cotonti
 * @version 2.00
 * @author esclkm, http://www.littledev.ru
 * @copyright Copyright (c) esclkm, http://www.littledev.ru 2012
 */
defined('COT_CODE') or die('Wrong URL');

$adminhelp = $L['rssreader_help'];

if ($p == 'rssreader' && $config_name == 'category' && $cfg['jquery'])
{
	$sskin = cot_tplfile('rssreader.admin', 'plug');
	$tt = new XTemplate($sskin);

	$categories = explode("\n", $config_value);
	$jj = 0;
	foreach ($categories as $k => $v)
	{
		$v = trim($v);
		$v = explode('|', $v);

		$jj++;
		$tt->assign(array(
			"ADDNUM" => $jj,
			"ADDNAME" => $v[0],
			"ADDURL" => $v[1],
			"ADDCOUNT" => $v[2],
			"ADDCHARSET" => $v[3],
			"ADDHTML" => $v[4],
		));
		$tt->parse("ADMIN.RSS");
	}

	$jj++;
	$tt->assign(array(
		"ADDNUM" => 'new',
		"ADDNAME" => '',
		"ADDURL" => '',
		"ADDCOUNT" => '',
		"ADDCHARSET" => '',
		"ADDHTML" => '1',
	));
	$tt->parse("ADMIN.RSS");

	$tt->assign(array(
		"CATNUM" => $jj
	));

	$tt->parse("ADMIN");
	$div = $tt->text("ADMIN");

	$t->assign(array(
		"ADMIN_CONFIG_ROW_CONFIG_MORE" => $div . '<div id="helptext">' . $config_more . '</div>'
	));
}
