<?php

######################################################################
# PHP-NUKE: Advanced Content Management System
# ============================================
#
# Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)
# http://phpnuke.org
#
# Based on phpBB Forum
# ====================
# Copyright (c) 2001 by The phpBB Group
# http://www.phpbb.com
#
# Integration based on PHPBB Forum Addon 1.4.0
# ============================================
# Copyright (c) 2001 by Richard Tirtadji
# http://nukeaddon.com
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################

if (eregi("auth.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

// Keledan begin
// This lines should add user created before the forum upgrade to the table $prefix_user_status

if (is_user($user)) {
    $user_data = base64_decode($user);
    $userdata = explode(":", $user_data);
    $sql = "SELECT * FROM ".$prefix."_users WHERE uid = ".$userdata[0]."";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) < 1) {
	$sql="INSERT into ".$prefix."_users (uid, user_posts, user_attachsig, user_rank, user_level) VALUES ('".$userid."',0,0,0,1)";
        mysql_query($sql);
    }
}

// Keledan end

if(is_banned($REMOTE_ADDR, "ip", $db)) {
    die(""._BBBANNED."");
}

// set expire dates: one for a year, one for 10 minutes

$expiredate1 = time() + 3600 * 24 * 365;
$expiredate2 = time() + 600;

// update LastVisit cookie. This cookie is updated each time auth.php runs

setcookie("LastVisit", time(), $expiredate1,  $cookiepath, $cookiedomain, $cookiesecure);

// set LastVisitTemp cookie, which only gets the time from the LastVisit
// cookie if it does not exist yet
// otherwise, it gets the time from the LastVisitTemp cookie

if (!isset($HTTP_COOKIE_VARS["LastVisitTemp"])) {
    $temptime = $HTTP_COOKIE_VARS["LastVisit"];
} else {
    $temptime = $HTTP_COOKIE_VARS["LastVisitTemp"];
}

// set cookie.

setcookie("LastVisitTemp", $temptime ,$expiredate2, $cookiepath, $cookiedomain, $cookiesecure);

// set vars for all scripts

$now_time = time();
$last_visit = $temptime;
$sql = "SELECT * FROM ".$prefix."_config WHERE selected = 1";
if($result = mysql_query($sql)) {
    if($myrow = mysql_fetch_array($result)) {
	$allow_html = $myrow["allow_html"];
        $allow_bbcode = $myrow["allow_bbcode"];
        $allow_sig = $myrow["allow_sig"];
        $posts_per_page = $myrow["posts_per_page"];
        $hot_threshold = $myrow["hot_threshold"];
        $topics_per_page = $myrow["topics_per_page"];
        $email_sig = stripslashes($myrow["email_sig"]);
        $email_from = $myrow["email_from"];
   }
}

// We MUST do this up here, so it's set even if the cookie's not present.

$user_logged_in = 0;
$logged_in = 0;

// Check for a cookie on the users's machine.
// If the cookie exists, build an array of the users info and setup the theme.
// new code for the session ID cookie..

if (is_user($user)) {
    $user_logged_in = 1;
    getusrinfo($user);
    $userdata = get_userdata_from_id($userinfo[0], $db);
    if (is_banned($userdata[user_id], "username", $db)) {
	die(""._BBBANNED."");
    }
}

?>