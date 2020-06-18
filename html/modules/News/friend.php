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

if (!eregi("modules.php", $PHP_SELF)) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._RECOMMEND."";

function FriendSend($sid) {
    global $user, $cookie, $prefix, $dbi, $user_prefix;
    if(!isset($sid)) { exit(); }
    include ("header.php");
    $result=sql_query("select title from ".$prefix."_stories where sid=$sid", $dbi);
    list($title) = sql_fetch_row($result, $dbi);
    title(""._FRIEND."");
    OpenTable();
    echo "<center><font class=\"content\"><b>"._FRIEND."</b></font></center><br><br>"
	.""._YOUSENDSTORY." <b>$title</b> "._TOAFRIEND."<br><br>"
	."<form action=\"modules.php?name=News&amp;file=friend\" method=\"post\">"
	."<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
    if (is_user($user)) {
	$result=sql_query("select name, email from ".$user_prefix."_users where uname='$cookie[1]'", $dbi);
	list($yn, $ye) = sql_fetch_row($result, $dbi);
    }
    echo "<b>"._FYOURNAME." </b> <input type=\"text\" name=\"yname\" value=\"$yn\"><br><br>\n"
	."<b>"._FYOUREMAIL." </b> <input type=\"text\" name=\"ymail\" value=\"$ye\"><br><br><br>\n"
	."<b>"._FFRIENDNAME." </b> <input type=\"text\" name=\"fname\"><br><br>\n"
	."<b>"._FFRIENDEMAIL." </b> <input type=\"text\" name=\"fmail\"><br><br>\n"
	."<input type=\"hidden\" name=\"op\" value=\"SendStory\">\n"
	."<input type=\"submit\" value="._SEND.">\n"
	."</form>\n";
    CloseTable();
    include ('footer.php');
}

function SendStory($sid, $yname, $ymail, $fname, $fmail) {
    global $sitename, $nukeurl, $prefix, $dbi;

    $result2=sql_query("select title, time, topic from ".$prefix."_stories where sid=$sid", $dbi);
    list($title, $time, $topic) = sql_fetch_row($result2, $dbi);

    $result3=sql_query("select topictext from ".$prefix."_topics where topicid=$topic", $dbi);
    list($topictext) = sql_fetch_row($result3, $dbi);

    $subject = ""._INTERESTING." $sitename";
    $message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $yname "._CONSIDERED."\n\n\n$title\n("._FDATE." $time)\n"._FTOPIC." $topictext\n\n"._URL.": $nukeurl/modules.php?name=News&file=article&sid=$sid\n\n"._YOUCANREAD." $sitename\n$nukeurl";
    mail($fmail, $subject, $message, "From: \"$yname\" <$ymail>\nX-Mailer: PHP/" . phpversion());
    $title = urlencode($title);
    $fname = urlencode($fname);
    Header("Location: modules.php?name=News&file=friend&op=StorySent&title=$title&fname=$fname");
}

function StorySent($title, $fname) {
    include ("header.php");
    $title = urldecode($title);
    $fname = urldecode($fname);
    OpenTable();
    echo "<center><font class=\"content\">"._FSTORY." <b>$title</b> "._HASSENT." $fname... "._THANKS."</font></center>";
    CloseTable();
    include ("footer.php");
}

switch($op) {

    case "SendStory":
    SendStory($sid, $yname, $ymail, $fname, $fmail);
    break;
	
    case "StorySent":
    StorySent($title, $fname);
    break;

    case "FriendSend":
    FriendSend($sid);
    break;

}

?>