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

if (eregi("block-Survey.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $multilingual, $currentlang, $dbi, $boxTitle, $content, $pollcomm, $user, $cookie;

if ($multilingual == 1) {
    $querylang = "WHERE planguage='$currentlang' AND artid='0'";
} else {
    $querylang = "WHERE artid='0'";
}

$result = sql_query("SELECT pollID FROM ".$prefix."_poll_desc $querylang ORDER BY pollID DESC LIMIT 1", $dbi);
$pollID = sql_fetch_row($result, $dbi);
$pollID = $pollID[0];
if ($pollID == 0 || $pollID == "") {
    $content = "";
} else {
    if(!isset($url))
	$url = sprintf("modules.php?name=Surveys&amp;op=results&amp;pollID=%d", $pollID);
    $content .= "<form action=\"modules.php?name=Surveys\" method=\"post\">";
    $content .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
    $content .= "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">";
    $result = sql_query("SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID=$pollID", $dbi);
    list($pollTitle, $voters) = sql_fetch_row($result, $dbi);
    $boxTitle = _SURVEY;
    $content .= "<font class=\"content\"><b>$pollTitle</b></font><br><br>\n";
    $content .= "<table border=\"0\" width=\"100%\">";
    for($i = 1; $i <= 12; $i++) {
	$result = sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE (pollID=$pollID) AND (voteID=$i)", $dbi);
	$object = sql_fetch_object($result, $dbi);
	if(is_object($object)) {
	    $optionText = $object->optionText;
	    if($optionText != "") {
		$content .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><font class=\"content\">$optionText</font></td></tr>\n";
	    }
	}
    }
    $content .= "</table><br><center><font class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></font><br>";
    if (is_user($user)) {
	cookiedecode($user);
    }
    for($i = 0; $i < 12; $i++) {
	$result = sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID=$pollID) AND (voteID=$i)", $dbi);
	$object = sql_fetch_object($result, $dbi);
	$optionCount = $object->optionCount;
	$sum = (int)$sum+$optionCount;
    }
    $content .= "<br><font class=\"content\"><a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=$cookie[4]&amp;order=$cookie[5]&amp;thold=$cookie[6]\"><b>"._RESULTS."</b></a><br><a href=\"modules.php?name=Surveys\"><b>"._POLLS."</b></a><br>";

    if ($pollcomm) {
	list($numcom) = sql_fetch_row(sql_query("select count(*) from ".$prefix."_pollcomments where pollID=$pollID", $dbi), $dbi);
	$content .= "<br>"._VOTES.": <b>$sum</b> <br> "._PCOMMENTS." <b>$numcom</b>\n\n";
    } else {
	$content .= "<br>"._VOTES." <b>$sum</b>\n\n";
    }
    $content .= "</font></center></form>\n\n";
}

?>