<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Enhanced with NukeStats Module Version 1.0                           */
/* ==========================================                           */
/* Copyright ©2002 by Harry Mangindaan (sens@indosat.net) and           */
/*                    Sudirman (sudirman@akademika.net)                 */
/* http://www.nuketest.com                                              */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (eregi("counter.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}
require_once("mainfile.php");
global $prefix, $dbi;

/* Get the Browser data */

if((ereg("Nav", getenv("HTTP_USER_AGENT"))) || (ereg("Gold", getenv("HTTP_USER_AGENT"))) || (ereg("X11", getenv("HTTP_USER_AGENT"))) || (ereg("Mozilla", getenv("HTTP_USER_AGENT"))) || (ereg("Netscape", getenv("HTTP_USER_AGENT"))) AND (!ereg("MSIE", getenv("HTTP_USER_AGENT")) AND (!ereg("Konqueror", getenv("HTTP_USER_AGENT"))))) $browser = "Netscape";
elseif(ereg("MSIE", getenv("HTTP_USER_AGENT"))) $browser = "MSIE";
elseif(ereg("Lynx", getenv("HTTP_USER_AGENT"))) $browser = "Lynx";
elseif(ereg("Opera", getenv("HTTP_USER_AGENT"))) $browser = "Opera";
elseif(ereg("WebTV", getenv("HTTP_USER_AGENT"))) $browser = "WebTV";
elseif(ereg("Konqueror", getenv("HTTP_USER_AGENT"))) $browser = "Konqueror";
elseif((eregi("bot", getenv("HTTP_USER_AGENT"))) || (ereg("Google", getenv("HTTP_USER_AGENT"))) || (ereg("Slurp", getenv("HTTP_USER_AGENT"))) || (ereg("Scooter", getenv("HTTP_USER_AGENT"))) || (eregi("Spider", getenv("HTTP_USER_AGENT"))) || (eregi("Infoseek", getenv("HTTP_USER_AGENT")))) $browser = "Bot";
else $browser = "Other";

/* Get the Operating System data */

if(ereg("Win", getenv("HTTP_USER_AGENT"))) $os = "Windows";
elseif((ereg("Mac", getenv("HTTP_USER_AGENT"))) || (ereg("PPC", getenv("HTTP_USER_AGENT")))) $os = "Mac";
elseif(ereg("Linux", getenv("HTTP_USER_AGENT"))) $os = "Linux";
elseif(ereg("FreeBSD", getenv("HTTP_USER_AGENT"))) $os = "FreeBSD";
elseif(ereg("SunOS", getenv("HTTP_USER_AGENT"))) $os = "SunOS";
elseif(ereg("IRIX", getenv("HTTP_USER_AGENT"))) $os = "IRIX";
elseif(ereg("BeOS", getenv("HTTP_USER_AGENT"))) $os = "BeOS";
elseif(ereg("OS/2", getenv("HTTP_USER_AGENT"))) $os = "OS/2";
elseif(ereg("AIX", getenv("HTTP_USER_AGENT"))) $os = "AIX";
else $os = "Other";

/* Save on the databases the obtained values */

sql_query("update $prefix"._counter." set count=count+1 where (type='total' and var='hits') or (var='$browser' and type='browser') or (var='$os' and type='os')", $dbi);

/* Start Detailed Statistics */

$dot = date("d-m-Y-H");
$now = explode ("-",$dot);
$nowHour = $now[3];
$nowYear = $now[2];
$nowMonth = $now[1];
$nowDate = $now[0];

$resultyear = sql_query("select year from $prefix"."_stats_year where year='$nowYear'",$dbi);
$jml = sql_num_rows($resultyear,$dbi);
if ($jml <= 0) {
    sql_query("insert into $prefix"."_stats_year values('$nowYear','0')",$dbi);
    for ($i=1;$i<=12;$i++) {
	sql_query("insert into $prefix"."_stats_month values('$nowYear','$i','0')",$dbi);
	if ($i == 1) $TotalDay = 31;
	if ($i == 2) {
	    if (($nowYear % 4) == 0) {
		$TotalDay = 28;
	    } else {
		$TotalDay = 29;
	    }
	}
	if ($i == 3) $TotalDay = 31;
	if ($i == 4) $TotalDay = 30;
	if ($i == 5) $TotalDay = 31;
	if ($i == 6) $TotalDay = 30;
	if ($i == 7) $TotalDay = 31;
	if ($i == 8) $TotalDay = 31;
	if ($i == 9) $TotalDay = 30;
	if ($i == 10) $TotalDay = 31;
	if ($i == 11) $TotalDay = 30;
	if ($i == 12) $TotalDay = 31;
	for ($k=1;$k<=$TotalDay;$k++) {
	    sql_query("insert into $prefix"."_stats_date values('$nowYear','$i','$k','0')",$dbi);
	}
    }
}

$resulthour = sql_query("select hour from $prefix"."_stats_hour where (year='$nowYear') and (month='$nowMonth') and (date='$nowDate')",$dbi);

if (sql_num_rows($resulthour,$dbi) <= 0) {
    for ($z = 0;$z<=23;$z++) {
	sql_query("insert into $prefix"."_stats_hour values('$nowYear','$nowMonth','$nowDate','$z','0')",$dbi);
    }
}

sql_free_result($resulthour, $dbi);

sql_query("update $prefix"._stats_year." set hits=hits+1 where year='$nowYear'",$dbi);
sql_query("update $prefix"."_stats_month set hits=hits+1 where (year='$nowYear') and (month='$nowMonth')",$dbi);
sql_query("update $prefix"."_stats_date set hits=hits+1 where (year='$nowYear') and (month='$nowMonth') and (date='$nowDate')",$dbi);
sql_query("update $prefix"."_stats_hour set hits=hits+1 where (year='$nowYear') and (month='$nowMonth') and (date='$nowDate') and (hour='$nowHour')",$dbi);

?>