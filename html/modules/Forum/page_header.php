<?php

######################################################################
# PHP-NUKE: Web Portal System
# ===========================
#
# Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)
# http://phpnuke.org
#
# Based on phpBB Forum
# ====================
# Copyright (c) 2001 by The phpBB Group
# http://www.phpbb.com
#
# Integration based on PHPBB Forum Addon 1.4.0
# ============================================
# Copyright (c) 2001 by Richard Tirtadji and Roberto Buonanno
# http://nukeaddon.com
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################

$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

#$login_logout_link = make_login_logout_link($user_logged_in, $url_phpbb);
?>
<font face="<?php echo $FontFace?>">
<?php

showheader($db);

//  Table layout (col and rowspans are marked with '*' and '-')
//  *one*   | two
//  *three* | four
//  -five-  | -six-

// cell one and three in the first TD with rowspan (logo)
?>
<TABLE BORDER=0 WIDTH="<?php echo $TableWidth?>" CELLPADDING="5" ALIGN="CENTER">

<?php
//Third row with cell five and six (misc. information)
switch($pagetype) {
        case 'reply':
?>
        <TD ALIGN="left">
                <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor?>">
                        <?php echo ""._BBMODBY."";?>:
<?php
$count = 0;
$forum_moderators = get_moderators($forum, $db);
   while(list($null, $mods) = each($forum_moderators)) {
      while(list($mod_id, $mod_name) = each($mods)) {
         if($count > 0)
           echo ", ";
         echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=".trim($mod_name)."\">".trim($mod_name)."</a>";
         $count++;
      }
   }
list($topic_title) = mysql_fetch_array(mysql_query("select topic_title from ".$prefix."_bbtopics where topic_id='$topic'"));
?></font><br>
                <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $FontColor?>"><b><? echo ""._BBFORUM."";?>:
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=viewforum&forum=<?php echo $forum?>"><?php echo $forum_name?></a></b>
                </font><br>
                <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $FontColor?>"><b><? echo ""._BBPOSTREPLYTOPIC."";?>:
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=viewtopic&topic=<?php echo $topic?>&forum=<?php echo $forum?>"><?php echo "$topic_title";?></a></b>
                </font>
        </TD>
<?php
        break;

        case 'newtopic':
?>
        <TD ALIGN="left">
                <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor?>">
                        <?php echo ""._BBMODBY."";?>:
<?php
$count = 0;
$forum_moderators = get_moderators($forum, $db);
   while(list($null, $mods) = each($forum_moderators)) {
      while(list($mod_id, $mod_name) = each($mods)) {
         if($count > 0)
           echo ", ";
         echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=".trim($mod_name)."\">".trim($mod_name)."</a>";
         $count++;
      }
   }
?></font><br>
                <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $FontColor?>"><b><? echo ""._BBPOSTNEWTOPIC."";?>:
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=viewforum&forum=<?php echo $forum?>"><?php echo $forum_name?></a></b>
                </font>
        </TD>
<?php
        break;

        case 'newforum':
        // No third row
        break;
        case 'viewforum':
?>
<TR>
        <TD ALIGN="LEFT">
        <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $FontColor?>">
                <b><?php echo $forum_name?></b>
                <BR>
                <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor?>">
                        <?php echo ""._BBMODBY."";?>:
<?php
$count = 0;
$forum_moderators = get_moderators($forum, $db);
   while(list($null, $mods) = each($forum_moderators)) {
      while(list($mod_id, $mod_name) = each($mods)) {
         if($count > 0)
           echo ", ";
         echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=".trim($mod_name)."\">".trim($mod_name)."</a>";
         $count++;
      }
   }
?></font></TD>
        <TD rowspan="2" ALIGN="CENTER">
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=newtopic&forum=<?php echo $forum?>"><IMG SRC="<?php echo "$imagesdir/new_topic-dark.jpg";?>" BORDER="0"></a>
        </TD>
</TR>
<?
        $total_forum = get_total_posts($forum, $db, 'forum');
?>
<TR>
        <TD ALIGN="LEFT">
        <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $textcolor?>">
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=index"><?php echo $sitename?> Forum Index</a>
                <b><?php echo ""._BBSEPARATOR."";?></b>
                <a href="<?php echo "modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum&$total_forum"?>"><?php echo stripslashes($forum_name)?></a>

        </TD>
</TR>

<?php
break;
        case 'viewtopic':
?>
<TR>
        <TD ALIGN="LEFT">
        <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $FontColor?>">
                <b><?php echo $forum_name?></b>
                <BR>
                <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor?>">
                        <?php echo ""._BBMODBY."";?>:
<?php
$count = 0;
$forum_moderators = get_moderators($forum, $db);
   while(list($null, $mods) = each($forum_moderators)) {
      while(list($mod_id, $mod_name) = each($mods)) {
         if($count > 0)
           echo ", ";
         echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=".trim($mod_name)."\">".trim($mod_name)."</a>";
         $count++;
      }
   }
?></font></TD>
        <TD ALIGN="CENTER">
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=newtopic&forum=<?php echo $forum?>"><IMG SRC="<?php echo "$imagesdir/new_topic-dark.jpg";?>" BORDER="0"></a>&nbsp;&nbsp;
<?php
        if($lock_state != 1) {
?>
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=reply&topic=<?php echo $topic?>&forum=<?php echo $forum?>"><IMG SRC="<?php echo "$imagesdir/reply-dark.jpg";?>" BORDER="0"></a></TD>
<?php
        }
        else
                        echo "<img src=\"$imagesdir/reply_locked-dark.jpg\" BORDER=0>\n";
?>
        </TD>
</TR>
<?
        $total_forum = get_total_posts($forum, $db, 'forum');
?>
<TR>
        <TD ALIGN="LEFT">
        <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $textcolor?>">
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=index"><?php echo $sitename?> Forum Index</a>
                <b><?php echo ""._BBSEPARATOR."";?></b>
                <a href="<?php echo "modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum&$total_forum"?>"><?php echo stripslashes($forum_name)?></a>
<?php

                echo "<b>"._BBSEPARATOR."</b>";
?>
                <?php echo $topic_subject?>
        </TD>
</TR>
<?php
        break;
}
?>
</TABLE>