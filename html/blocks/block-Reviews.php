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

if (eregi("block-Reviews.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $dbi;

$result = sql_query("SELECT id, title FROM ".$prefix."_reviews order by id DESC limit 0,10", $dbi);
while(list($id, $title) = sql_fetch_row($result, $dbi)) {
    $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Reviews&amp;rop=showcontent&amp;id=$id\">$title</a><br>";
}

?>