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

if (eregi("block-Encyclopedia.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $dbi;

$result = sql_query("SELECT eid, title FROM ".$prefix."_encyclopedia WHERE active='1'", $dbi);
while(list($eid, $title) = sql_fetch_row($result, $dbi)) {
    $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Encyclopedia&amp;op=list_content&amp;eid=$eid\">$title</a><br>";
}

?>