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

    case "YesDelCategory":
    case "subdelete":
    case "DelCategory":
    case "NoMoveCategory":
    case "EditCategory":
    case "SaveEditCategory":
    case "AddCategory":
    case "SaveCategory":
    case "DisplayStory":
    case "PreviewAgain":
    case "PostStory":
    case "EditStory":
    case "RemoveStory":
    case "ChangeStory":
    case "DeleteStory":
    case "adminStory":
    case "PreviewAdminStory":
    case "PostAdminStory":
    case "autoDelete":
    case "autoEdit":
    case "autoSaveEdit":
    case "submissions":
    include("admin/modules/stories.php");
    break;

}

?>