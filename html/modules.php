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

if (isset($name)) {

    $result = sql_query("select active, view from ".$prefix."_modules where title='$name'", $dbi);
    list($mod_active, $view) = sql_fetch_row($result, $dbi);
    if (($mod_active == 1) OR ($mod_active == 0 AND is_admin($admin) OR ($name == "Content"))) {
	if (!isset($mop)) { $mop="modload"; }
	if (!isset($file)) { $file="index"; }
	if (ereg("\.\.",$name) || ereg("\.\.",$file)) {
	    echo "You are so cool...";
	} else {
	    if ($view == 0) {
		$modpath="modules/$name/$file.php";
    		if (file_exists($modpath)) {
		    include($modpath);
    		} else {
		    die ("Sorry, such file doesn't exist...");
		}
	    }
	    if ($view == 1 AND is_user($user) || is_admin($admin)) {
		$modpath="modules/$name/$file.php";
    		if (file_exists($modpath)) {
		    include($modpath);
    		} else {
		    die ("Sorry, such file doesn't exist...");
		}
	    } elseif ($view == 1 AND !is_user($user) || !is_admin($admin)) {
		$pagetitle = "- "._ACCESSDENIED."";
		include("header.php");
		title("$sitename: "._ACCESSDENIED."");
		OpenTable();
		echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"
		    .""._MODULEUSERS.""
		    .""._GOBACK."";
		CloseTable();
		include("footer.php");
		die();
	    }
	    if ($view == 2 AND is_admin($admin)) {
		$modpath="modules/$name/$file.php";
    		if (file_exists($modpath)) {
		    include($modpath);
    		} else {
		    die ("Sorry, such file doesn't exist...");
		}	
	    } elseif ($view == 2 AND !is_admin($admin)) {
		$pagetitle = "- "._ACCESSDENIED."";
		include("header.php");
		title("$sitename: "._ACCESSDENIED."");
		OpenTable();
		echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"
		    .""._MODULESADMINS.""
		    .""._GOBACK."";
		CloseTable();
		include("footer.php");
		die();
	    }
	}
    } else {
	include("header.php");
	OpenTable();
	echo "<center>"._MODULENOTACTIVE."<br><br>"
	    .""._GOBACK."</center>";
	CloseTable();
	include("footer.php");
    }
} else {
    die ("Sorry, you can't access this file directly...");
}

?>