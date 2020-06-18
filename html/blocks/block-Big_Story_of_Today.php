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

if (eregi("block-Big_Story_of_Today.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $cookie, $prefix, $multilingual, $currentlang, $dbi;

if ($multilingual == 1) {
    $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
} else {
    $querylang = "";
}

$today = getdate();
$day = $today["mday"];
if ($day < 10) {
    $day = "0$day";
}
$month = $today["mon"];
if ($month < 10) {
    $month = "0$month";
}
$year = $today["year"];
$tdate = "$year-$month-$day";
$result = sql_query("select sid, title from ".$prefix."_stories where (time LIKE '%$tdate%') $querylang order by counter DESC limit 0,1", $dbi);
list($fsid, $ftitle) = sql_fetch_row($result, $dbi);
$content = "<font class=\"content\">";
if ((!$fsid) AND (!$ftitle)) {
    $content .= ""._NOBIGSTORY."</font>";
} else {
    $content .= ""._BIGSTORY."<br><br>";
    $r_options = "";
    if (isset($cookie[4])) { $r_options .= "&amp;mode=$cookie[4]"; }
    if (isset($cookie[5])) { $r_options .= "&amp;order=$cookie[5]"; }
    if (isset($cookie[6])) { $r_options .= "&amp;thold=$cookie[6]"; }
    $content .= "<a href=\"modules.php?name=News&amp;file=article&amp;sid=$fsid$r_options\">$ftitle</a></font>";
}

?>