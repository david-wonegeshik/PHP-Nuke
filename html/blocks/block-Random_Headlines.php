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

if (eregi("block-Random_Headlines.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $multilingual, $currentlang, $dbi, $tipath, $user, $cookie;

$r_options = "";
if (isset($cookie[4])) { $r_options .= "&amp;mode=$cookie[4]"; }
if (isset($cookie[5])) { $r_options .= "&amp;order=$cookie[5]"; }
if (isset($cookie[6])) { $r_options .= "&amp;thold=$cookie[6]"; }

if ($multilingual == 1) {
    $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
} else {
    $querylang = "";
}

$result = sql_query("select * from ".$prefix."_topics", $dbi);
$numrows = sql_num_rows($result, $dbi);
if ($numrows > 1) {
    $result = sql_query("select topicid from ".$prefix."_topics", $dbi);
    while (list($topicid) = sql_fetch_row($result, $dbi)) {
	$topic_array .= "$topicid-";
    }
    $r_topic = explode("-",$topic_array);
    mt_srand((double)microtime()*1000000);
    $numrows = $numrows-1;
    $topic = mt_rand(0, $numrows);
    $topic = $r_topic[$topic];
} else {
    $topic = 1;
}

$result = sql_query("select sid, title from ".$prefix."_stories where topic='$topic' $querylang order by sid DESC limit 0,9", $dbi);
$res = sql_query("select topicimage, topictext from ".$prefix."_topics where topicid='$topic'", $dbi);
list($topicimage, $topictext) = sql_fetch_row($res, $dbi);
$content = "<br><center><a href=\"modules.php?name=News&new_topic=$topic\"><img src=\"$tipath$topicimage\" border=\"0\" alt=\"$topictext\"></a><br>[ <a href=\"modules.php?name=Search&amp;topic=$topic\">$topictext</a> ]</center><br>";
$content .= "<table border=\"0\" width=\"100%\">";
while(list($sid, $title) = sql_fetch_row($result, $dbi)) {
    $content .= "<tr><td valign=\"top\"><strong><big>&middot;</big></strong></td><td><a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\">$title</a></td></tr>";
}
$content .= "</table>";

?>