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

require_once("mainfile.php");

$PHP_SELF = "modules.php";
$result = sql_query("select main_module from ".$prefix."_main", $dbi);
list($name) = sql_fetch_row($result, $dbi);
$home = 1;
if ($httpref==1) {
    $referer = getenv("HTTP_REFERER");
    if ($referer=="" OR eregi("^unknown", $referer) OR substr("$referer",0,strlen($nukeurl))==$nukeurl OR eregi("^bookmark",$referer)) {
    } else {
        sql_query("insert into ".$prefix."_referer values (NULL, '$referer')", $dbi);
    }
    $result = sql_query("select * from ".$prefix."_referer", $dbi);
    $numrows = sql_num_rows($result, $dbi);
    if($numrows>=$httprefmax) {
        sql_query("delete from ".$prefix."_referer", $dbi);
    }
}
if (!isset($mop)) { $mop="modload"; }
if (!isset($mod_file)) { $mod_file="index"; }
if (ereg("\.\.",$name) || ereg("\.\.",$file)) {
    echo "You are so cool...";
} else {
    $modpath="modules/$name/$mod_file.php";
    if (file_exists($modpath)) {
	include($modpath);
    } else {
	$index = 1;
	include("header.php");
	OpenTable();
	if (is_admin($admin)) {
	    echo "<center><font class=\"\"><b>"._HOMEPROBLEM."</b></font><br><br>[ <a href=\"admin.php?op=modules\">"._ADDAHOME."</a> ]</center>";
	} else {
	    echo "<center>"._HOMEPROBLEMUSER."</center>";
	}
	CloseTable();
	include("footer.php");
    }
}

?>