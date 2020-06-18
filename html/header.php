<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (eregi("header.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

require_once("mainfile.php");

##################################################
# Include some common header for HTML generation #
##################################################

$header = 1;

function head() {
    global $slogan, $sitename, $banners, $Default_Theme, $nukeurl, $Version_Num, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle;
    if(is_user($user)) {
	$user2 = base64_decode($user);
	$cookie = explode(":", $user2);
	if($cookie[9]=="") $cookie[9]=$Default_Theme;
	if(isset($theme)) $cookie[9]=$theme;
	if(!$file=@opendir("themes/$cookie[9]")) {
	    $ThemeSel = $Default_Theme;
	} else {
	    $ThemeSel = $cookie[9];
	}
    } else {
	$ThemeSel = $Default_Theme;
    }
    include("themes/$ThemeSel/theme.php");
    echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
    echo "<html>\n";
    echo "<head>\n";
    echo "<title>$sitename $pagetitle</title>\n";

    include("includes/meta.php");
    include("includes/javascript.php");
    
    echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
    include("includes/my_header.php");
    echo "\n\n\n</head>\n\n";
    themeheader();
}

head();
include("includes/counter.php");
global $home;
if ($home == 1) {
    message_box();
    blocks(Center);
}
online();

?>