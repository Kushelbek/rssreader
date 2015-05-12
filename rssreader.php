<?php

/* ====================
 * [BEGIN_COT_EXT]
 * Hooks=global
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

require_once $cfg['plugins_dir'] . '/rssreader/inc/lastrss.php';

function cot_rss_parse($rss_url, $rss_count, $skinfile, $charset = "UTF-8", $htmlsave = 1)
{
	global $cfg;
	if (mb_strpos($rss_url, 'http://') !== 0)
	{
		$rss_url = 'http://' . $rss_url;
	}
	$jj = 0;

	$readrss = new XTemplate(cot_tplfile($skinfile, 'plug'));

	// create lastRSS object
	$rss = new lastRSS;

	// setup transparent cache
	$rss->cache_dir = $cfg['cache_dir']."\rssreader";
	$rss->cache_time = 14400;
	$rss->items_limit = $rss_count;
	$rss->date_format = $cfg['formatyearmonthday'];
	if (!$htmlsave)
	{
		$rss->stripHTML = true;
	}
	else
	{
		$rss->stripHTML = false;
	}
	$rss->cp = 'UTF-8';
	$rss->default_cp = $charset;
	$rss->CDATA = "content";
	// load some RSS file
	if ($rs = $rss->get($rss_url))
	{
		if ($rs[image_url] != '')
		{
			$rss_image = "<a href=\"$rs[image_link]\"><img src=\"$rs[image_url]\" alt=\"$rs[image_title]\" vspace=\"1\" border=\"0\" /></a>";
		}

		foreach ($rs['items'] as $item)
		{
			$jj++;
			$readrss->assign(array(
				"RSS_LINK" => $item[link],
				"RSS_TITLE" => $item['title'],
				"RSS_DATE" => $item['pubDate'],
				"RSS_DESCRIPTION" => $item['description'],
				"RSS_CAT" => $item['category'],
				"RSS_COMMENTS" => $item['comments'],
				"RSS_ENCLOSURE" => $item['enclosure'],
				"RSS_GUID" => $item['guid'],
				"RSS_SUORCE" => $item['source'],
				"RSS_ODDEVEN" => cot_build_oddeven($jj),
				"RSS_NUM" => $jj,
			));
			$readrss->parse("MAIN.RSS_BLOCK");
		}
		$readrss->assign(array(
			"RSS_INFO_LINK" => $rs['link'],
			"RSS_INFO_TITLE" => $rs['title'],
			"RSS_INFO_IMAGE" => $rss_image,
			"RSS_INFO_DESC" => $rs['description']
		));
	}
	else
	{
		$readrss->parse("MAIN.ERROR");
	}

	$readrss->parse("MAIN");

	return $readrss->text("MAIN");
}

if (!is_array($RSSREADER))
{
	$categories = explode("\n", $cfg['plugin']['rssreader']['category']);

	foreach ($categories as $k => $v)
	{
		$v = trim($v);
		$v = explode('|', $v);
		$v[2] = (int) $v[2] > 0 ? $v[2] : $cfg['maxrowsperpage'];
		if (!empty($v[0]) && !empty($v[1]))
		{
			$RSSREADER[strtoupper($v[0])] = cot_rss_parse($v[1], $v[2], 'rssreader.' . $v[0] . '.tpl', $v[3], $v[4]);
		}
	}
	/* @var $db CotDB */
	/* @var $cache Cache */
	/* @var $t Xtemplate */
	$cache && $cache->db->store('RSSREADER', $RSSREADER, 'system', 3 * 3600);
}
