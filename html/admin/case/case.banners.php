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

if (!eregi("admin.php", $PHP_SELF)) { die ("Access Denied"); }

switch($op) {

    case "BannersAdmin":
    case "BannersAdd":
    case "BannerAddClient":
    case "BannerFinishDelete":
    case "BannerDelete":
    case "BannerEdit":
    case "BannerChange":
    case "BannerClientDelete":
    case "BannerClientEdit":
    case "BannerClientChange":
    include("admin/modules/banners.php");
    break;

}

?>