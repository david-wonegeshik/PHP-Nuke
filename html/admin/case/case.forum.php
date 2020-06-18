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

if (!eregi("admin.php", $PHP_SELF)) { die ("Access Denied"); }

switch($op) {

    case "ForumMainMenu":
    case "PrivDelUser":
    case "PrivPostRevForum":
    case "PrivClearUser":
    case "PrivAddUser":
    case "PrivForumUser":
    case "ForumCatOrder":
    case "ForumGoAdd":
    case "ForumGoSave":
    case "ForumCatDel":
    case "ForumGoDel":
    case "ForumCatSave":
    case "ForumCatEdit":
    case "ForumGoEdit":
    case "ForumGo":
    case "ForumCatAdd":
    case "ForumAdmin":
    case "BanSave":
    case "BanEdit":
    case "BanDel":
    case "BanAdd":
    case "ForumBanAdmin":
    case "WordForumDel":
    case "WordForumSave":
    case "WordForumEdit":
    case "WordForumAdd":
    case "ForumCensorAdmin":
    case "ForumConfigAdmin":
    case "ForumConfigChange":
    case "ForumManager":
    case "ForumSmiliesEdit":
    case "ForumSmiliesSave":
    case "ForumSmiliesAdd":
    case "ForumSmiliesDel":
    case "RankForumAdmin":
    case "RankForumEdit":
    case "RankForumDel":
    case "RankForumAdd":
    case "RankForumSave":
    include ("admin/modules/forum.php");
    break;

}

?>