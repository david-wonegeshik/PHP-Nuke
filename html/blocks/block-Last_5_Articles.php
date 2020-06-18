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

/* Block to fit perfectly in the center of the site, remember that not all
   blocks looks good on Center, just try and see yourself what fits your needs */

if (eregi("block-Last_10_Articles.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $multilingual, $currentlang, $dbi;

if ($multilingual == 1) {
    $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
} else {
    $querylang = "";
}
$content = "<table width=\"100%\" border=\"0\">";
$result = sql_query("select sid, title, comments, counter from ".$prefix."_stories $querylang order by sid DESC limit 0,5", $dbi);
while(list($sid, $title, $comtotal, $counter) = sql_fetch_row($result, $dbi)) {
    $content .= "<tr><td align=\"left\"><strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a></td><td align=\"right\">[ $comtotal "._COMMENTS." - $counter "._READS." ]</td></tr>";
}
$content .= "</table>";
$content .= "<br><center>[ <a href=\"modules.php?name=News\">"._MORENEWS."</a> ]</center>";
?>