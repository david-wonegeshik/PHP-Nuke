<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (eregi("block-Categories.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $cat, $language, $prefix, $multilingual, $currentlang, $dbi;

    if ($multilingual == 1) {
	    $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
    } else {
	    $querylang = "";
    }
    $result = sql_query("select catid, title from ".$prefix."_stories_cat order by title", $dbi);
    $numrows = sql_num_rows($result, $dbi);
    if ($numrows == 0) {
	return;
    } else {
	$boxstuff = "<font class=\"content\">";
	while(list($catid, $title) = sql_fetch_row($result, $dbi)) {
	    $result2 = sql_query("select * from ".$prefix."_stories where catid='$catid' $querylang", $dbi);
	    $numrows = sql_num_rows($result2, $dbi);
	    if ($numrows > 0) {
		$res = sql_query("select time from ".$prefix."_stories where catid='$catid' $querylang order by sid DESC limit 0,1", $dbi);
		list($time) = sql_fetch_row($res, $dbi);
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $dat);
		if ($cat == 0 AND !$a) {
		    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<b>"._ALLCATEGORIES."</b><br>";
		    $a = 1;
		} elseif ($cat != 0 AND !$a) {
		    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=News\">"._ALLCATEGORIES."</a><br>";
		    $a = 1;
		}
		
		if ($cat == $catid) {
		    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<b>$title</b><br>";
		} else {
		    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\">$title</a> <font class=tiny>($dat[2]/$dat[3])</font><br>";
		}
	    }
	}
	$boxstuff .= "</font>";
	$content = $boxstuff;
    }

?>