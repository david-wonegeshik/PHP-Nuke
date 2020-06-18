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

if (eregi("block-Login.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $admin, $user;

$content = "<form action=\"modules.php?name=Your_Account\" method=\"post\">";
$content .= "<center><font class=\"content\">"._NICKNAME."<br>";
$content .= "<input type=\"text\" name=\"uname\" size=\"10\" maxlength=\"25\"><br>";
$content .= ""._PASSWORD."<br>";
$content .= "<input type=\"password\" name=\"pass\" size=\"10\" maxlength=\"20\"><br>";
$content .= "<input type=\"hidden\" name=\"op\" value=\"login\">";
$content .= "<input type=\"submit\" value=\""._LOGIN."\"></font></center></form>";
$content .= "<center><font class=\"content\">"._ASREGISTERED."</font></center>";

if (is_admin($admin) AND is_user($user)) {
    $content = "<center>"._ADMIN."<br>[ <a href=\"admin.php?op=logout\">"._LOGOUT."</a> ]</center>";
}

?>