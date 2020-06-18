<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Last referers block for phpNuke portal                               */
/* Copyright (c) 2001 by Jack Kozbial (jack@internetintl.com            */
/* http://www.InternetIntl.com                                          */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (eregi("block-Last_Referers.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $dbi, $admin;

$ref = 10; // how many referers in block
$a = 1;
$result = sql_query("select rid, url from ".$prefix."_referer order by rid DESC limit 0,$ref", $dbi);
while(list($rid, $url) = sql_fetch_row($result, $dbi)) {
    $url2 = ereg_replace("_", " ", $url);
    if(strlen($url2) > 18) {
	$url2 = substr($url,0,20);
        $url2 .= "..";
    }
    $content .= "$a:&nbsp;<a href=\"$url\" target=\"new\">$url2</a><br>";
    $a++;
}
if (is_admin($admin)) {
    $total = sql_num_rows(sql_query("select * from ".$prefix."_referer", $dbi), $dbi);
    $content .= "<br><center>$total "._HTTPREFERERS."<br>[ <a href=\"admin.php?op=delreferer\">"._DELETE."</a> ]</center>";
    
}

?>