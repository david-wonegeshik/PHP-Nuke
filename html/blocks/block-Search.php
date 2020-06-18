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

if (eregi("block-Search.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

$content = "<form action=\"modules.php?name=Search\" method=\"post\">";
$content .= "<br><center><input type=\"text\" name=\"query\" size=\"20\"></center>";
$content .= "</form>";

?>