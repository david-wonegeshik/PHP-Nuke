<?php

########################################################################
# PHP-Nuke Block: Total Hits v0.1                                      #
#                                                                      #
# Copyright (c) 2001 by C. Verhoef (cverhoef@gmx.net)                  #
#                                                                      #
########################################################################
# This program is free software. You can redistribute it and/or modify #
# it under the terms of the GNU General Public License as published by #
# the Free Software Foundation; either version 2 of the License.       # 
######################################################################## 

if (eregi("block-Who_is_Online.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $user, $cookie, $prefix, $dbi, $user_prefix;

cookiedecode($user);
$ip = getenv("REMOTE_ADDR");
$username = $cookie[1];
if (!isset($username)) {
    $username = "$ip";
    $guest = 1;
}

$result = sql_query("SELECT username FROM ".$prefix."_session where guest=1", $dbi);
$guest_online_num = sql_num_rows($result, $dbi);

$result = sql_query("SELECT username FROM ".$prefix."_session where guest=0", $dbi);
$member_online_num = sql_num_rows($result, $dbi);

$who_online_num = $guest_online_num + $member_online_num;
$who_online = "<center><font class=\"content\">"._CURRENTLY." $guest_online_num "._GUESTS." $member_online_num "._MEMBERS."<br>";
$result = sql_query("select title from ".$prefix."_blocks where bkey='online'", $dbi);
list($title) = sql_fetch_row($result, $dbi);
$content = "$who_online";
if (is_user($user)) {
    $content .= "<br>"._YOUARELOGGED." <b>$username</b>.<br>";
    if (is_active("Private_Messages")) {
	$result = sql_query("select uid from ".$user_prefix."_users where uname='$username'", $dbi);
	list($uid) = sql_fetch_row($result, $dbi);
	$result2 = sql_query("select to_userid from ".$prefix."_priv_msgs where to_userid='$uid'", $dbi);
	$numrow = sql_num_rows($result2, $dbi);
	$content .= ""._YOUHAVE." <a href=\"modules.php?name=Private_Messages\"><b>$numrow</b></a> "._PRIVATEMSG."";
    }
    $content .= "</font></center>";
} else {
    $content .= "<br>"._YOUAREANON."</font></center>";
}

?>