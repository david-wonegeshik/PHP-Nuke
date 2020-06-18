<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* =========================                                            */
/* Part of phpBB integration                                            */
/* Copyright (c) 2001 by                                                */
/*    Richard Tirtadji AKA King Richard (rtirtadji@hotmail.com)         */
/*    Hutdik Hermawan AKA hotFix (hutdik76@hotmail.com)                 */
/* http://www.phpnuke.web.id                                            */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

$forumpage = 1;

if($cancel) {
    header("Location: modules.php?name=Private_Messages");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include("modules/".$module_name."/functions.php");
include("modules/".$module_name."/auth.php");

if (!is_user($user)) {
    Header("Location: modules.php?name=Your_Account");
} else {	
    include('header.php');
    $userdata = explode(":", base64_decode($user));
    if (!$result = check_user_pw($userdata[1],$userdata[2],$db,$system))
    $userdata = get_userdata($userdata[1], $db);

if($submit) {
    if($subject == '') {
        forumerror(0017);
    }
    if (check_html($subject, "nohtml") != $subject) {
	OpenTable();
	echo "<center><b>I don't like you... Nice Try!</b></center>";
	CloseTable();
	include("footer.php");
	die();
    }
    if($image == '') {
        forumerror(0018);
    }
    if($message == '') {
        forumerror(0019);
    }
    if($allow_html == 0 && isset($html)) {
    	$message = htmlspecialchars($message);
    }
    if($allow_bbcode == 1 && !isset($bbcode)) {
	$message = bbencode_priv($message);
    }
    if($sig) {
    	$message .= "<br>-----------------<br>" . $userdata[user_sig];
    }
    $message = str_replace("\n", "<br>", $message);
    if(!$smile) {
	$message = smile($message);
    }
    $message = make_clickable($message);
    $message = addslashes($message);
    $time = date("Y-m-d H:i");
    $res = sql_query("select uid from ".$user_prefix."_users where uname='$to_user'", $dbi);
    list($to_userid) = sql_fetch_row($res, $dbi);
    if ($to_userid == "") {
        OpenTable();
        echo "<center>"._USERNOTINDB."<br>"
    	    .""._CHECKNAMEANDTRY."<br><br>"
    	    .""._GOBACK."</center>";
        CloseTable();
        include("footer.php");
    } else {	
        $sql = "INSERT INTO ".$prefix."_priv_msgs (msg_image, subject, from_userid, to_userid, msg_time, msg_text) ";
        $sql .= "VALUES ('$image', '$subject', '$userdata[uid]', '$to_userid', '$time', '$message')";
        if(!$result = sql_query($sql, $dbi)) {
	    forumerror(0020);
	}
	OpenTable();
	echo "<center>"._MSGPOSTED."<br><a href=\"modules.php?name=Private_Messages\">"._RETURNTOPMSG."</a></center>";
	CloseTable();
    }    
}
if ($delete_messages.x && $delete_messages.y) {
    for ($i=0;$i<$total_messages;$i++) {
	$sql = "DELETE FROM ".$prefix."_priv_msgs WHERE msg_id='$msg_id[$i]' AND to_userid='$userdata[uid]'";
	if(!sql_query($sql, $dbi)) {
    	    forumerror(0021);
	} else {
	    $status =1;
	}
    }
    if ($status) {
        OpenTable();
        echo "<center>"._MSGDELETED."<br><a href=\"modules.php?name=Private_Messages\">"._RETURNTOPMSG."</a></center>";
        CloseTable();
    }    
}
if ($delete) {
    $sql = "DELETE FROM ".$prefix."_priv_msgs WHERE msg_id='$msg_id' AND to_userid='$userdata[uid]'";
    if(!sql_query($sql, $dbi)) {
        forumerror(0021);
    } else {
        OpenTable();
        echo "<center>"._MSGDELETED."<br><a href=\"modules.php?name=Private_Messages\">"._RETURNTOPMSG."</a></center>";
        CloseTable();
    }
}

if ($reply || $send) {

    if ($uname != "") {
	$res = sql_num_rows(sql_query("select * from ".$user_prefix."_users where uname='$uname'", $dbi), $dbi);
	if ($res == 0) {
	    title("$sitename: "._PRIVATEMESSAGE."");
	    OpenTable();
	    echo "<center><b>"._PRIVMSGERROR."</b><br><br>"
		.""._USERDOESNTEXIST."<br><br>"
		.""._GOBACK."</center>";
	    CloseTable();
	    include("footer.php");
	    die();
	}
    }










    if ($reply) {
	$sql = "SELECT msg_image, subject, from_userid, to_userid FROM ".$prefix."_priv_msgs WHERE msg_id = $msg_id";
	$result = sql_query($sql, $dbi);
	if (!$result) {
	    forumerror(0022);
	}
	$row = sql_fetch_array($result, $dbi);
	if (!$row) {
	    forumerror(0023);
	}
	$fromuserdata = get_userdata_from_id($row[from_userid], $db);
	$touserdata = get_userdata_from_id($row[to_userid], $db);
	if ( is_user($user) && ($userdata[0] != $touserdata[uid]) ) {
	    forumerror(0024);
	}
    }
    echo "<FORM ACTION=\"modules.php?name=Private_Messages&file=reply\" METHOD=\"POST\" NAME=\"coolsus\">"
        ."<TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACEING=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\" WIDTH=\"100%\"><TR><TD bgcolor=\"$bgcolor2\">"
        ."<TABLE BORDER=\"0\" CALLPADDING=\"1\" CELLSPACEING=\"1\" WIDTH=\"100%\">"
        ."<TR BGCOLOR=\"$bgcolor2\" ALIGN=\"LEFT\">"
        ."<TD width=\"25%\"><FONT COLOR=\"$textcolor2\"><b>"._ABOUTPOSTING.":</b></FONT></TD>"
        ."<TD><FONT COLOR=\"$textcolor2\">"._ALLREGCANPOST."</FONT></TD>"
        ."</TR>"
        ."<TR ALIGN=\"LEFT\">"
        ."<TD BGCOLOR=\"$bgcolor3\" width=\"25%\"><b>"._TO.":<b></TD>";
    if ($reply) {
        echo "<TD BGCOLOR=\"$bgcolor1\"><INPUT TYPE=\"HIDDEN\" NAME=\"to_user\" VALUE=\"$fromuserdata[uname]\">$fromuserdata[uname]</TD>";
    } else {
        if ($uname) {
	    echo "<TD BGCOLOR=\"$bgcolor1\"><INPUT NAME=\"to_user\" SIZE=\"26\" maxlength=\"25\" value=\"$uname\">";
	} else {
	    echo "<TD BGCOLOR=\"$bgcolor1\"><INPUT NAME=\"to_user\" SIZE=\"26\" maxlength=\"25\">";
	}
	echo "</td>";
    }
    echo "</TR>"
        ."<TR ALIGN=\"LEFT\">"
        ."<TD BGCOLOR=\"$bgcolor3\" width=\"25%\"><b>"._SUBJECT.":<b></TD>";
    if ($reply) {
        echo "<TD  BGCOLOR=\"$bgcolor1\"><INPUT TYPE=\"TEXT\" NAME=\"subject\" VALUE=\""._RE.": $row[subject]\" SIZE=\"50\" MAXLENGTH=\"100\"></TD>";
    } else { 
        echo "<TD  BGCOLOR=\"$bgcolor1\"><INPUT TYPE=\"TEXT\" NAME=\"subject\" SIZE=\"50\" MAXLENGTH=\"100\"></TD>";
    }
    echo "</TR>"
        ."<TR ALIGN=\"LEFT\" VALIGN=\"TOP\">"
        ."<TD  BGCOLOR=\"$bgcolor3\" width=\"25%\"><b>"._MESSAGEICON.":<b></TD>"
        ."<TD  BGCOLOR=\"$bgcolor1\">";
    $handle=opendir("images/forum/subject");
    while ($file = readdir($handle)) {
        $filelist[] = $file;
    }
    asort($filelist);
    $a = 1;
    while (list ($key, $file) = each ($filelist)) {
	ereg(".gif|.jpg",$file);
	if ($file == "." || $file == "..") {
	    $a=1;
	} else {	
	    if ($file == $row[msg_image] && $row[msg_image] != "") {
	        echo "<INPUT TYPE='radio' NAME='image' VALUE='$file' checked><IMG SRC=images/forum/subject/$file BORDER=0>&nbsp;";
	    } else {
	        if ($a == 1 && $row[msg_image] == "") {
		    $sel = "checked";
		} else {
		    $sel = "";
		}
		echo "<INPUT TYPE='radio' NAME='image' VALUE='$file' $sel><IMG SRC=images/forum/subject/$file BORDER=0>&nbsp;";
		$a++;
	    }
	}
	if ($count >= 10) {
	    $count=1; echo "<br>";
	}
	$count++;
    }
    echo "</TD>"
        ."</TR>"
        ."<TR ALIGN=\"LEFT\" VALIGN=\"TOP\">"
        ."<TD BGCOLOR=\"$bgcolor3\" width=\"25%\"><b>"._MESSAGE.":</b><br><br>"
        ."<font class=\"content\">"
        .""._HTML.": ";
    if($allow_html == 1) {
        echo ""._PMON."<BR>\n";
    } else {
        echo ""._PMOFF."<BR>\n";
    }
    echo ""._BBCODE.": ";
    if($allow_bbcode == 1) {
        echo ""._PMON."<br>\n";
    } else {
        echo ""._PMOFF."<BR>\n";
    }	
    if ($reply) {
        $sql = "SELECT p.msg_text, p.msg_time, u.uname FROM ".$prefix."_priv_msgs p, ".$user_prefix."_users u ";
        $sql .= "WHERE (p.msg_id = $msg_id) AND (p.from_userid = u.uid)";
        if($result = sql_query($sql, $dbi)) {
    	    $row = sql_fetch_array($result, $dbi);
	    $text = desmile($row[msg_text]);
	    $text = str_replace("<BR>", "\n", $text);
	    $text = stripslashes($text);
	    $text = bbdecode($text);
	    $reply = "[quote]\n"._PMON." $row[msg_time], $row[uname] "._WROTE.":\n$text\n[/quote]";
	} else {
	    $reply = "Error Contacting database. Please try again.\n";
	}
    }				
    echo "</font></TD>"
        ."<TD BGCOLOR=\"$bgcolor1\"><TEXTAREA NAME=\"message\" ROWS=\"10\" COLS=\"45\" WRAP=\"VIRTUAL\">";
    if ($reply) {
        echo $reply;
    }
    echo "</TEXTAREA><BR>";
    putitems();
    echo "</TD>"
        ."</TR>"
        ."<TR ALIGN=\"LEFT\">"
        ."<TD BGCOLOR=\"$bgcolor3\" width=\"25%\"><b>"._OPTIONS.":</b></TD>"
        ."<TD BGCOLOR=\"$bgcolor1\">";
    if($allow_html == 1) {
        echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"html\">"._HTMLDISSABLE."<br>";
    }
    if($allow_bbcode == 1) {
        echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"bbcode\">"._BBCODEDISSABLE."<br>";
    }
    echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"smile\">"._SMILEDISSABLE."<br>"
	."</TD>"
        ."</TR>"
        ."<TR>"
        ."<TD BGCOLOR=\"$bgcolor1\" colspan=\"2\" ALIGN=\"CENTER\">"
        ."<INPUT TYPE=\"HIDDEN\" NAME=\"msg_id\" VALUE=\"$msg_id\">"
        ."<INPUT TYPE=\"SUBMIT\" NAME=\"submit\" VALUE=\""._SUBMIT."\">&nbsp;<INPUT TYPE=\"RESET\" VALUE=\""._CLEAR."\">";
    if (reply) {
        echo "&nbsp;<INPUT TYPE=\"SUBMIT\" NAME=\"cancel\" VALUE=\""._CANCELREPLY."\">";
    } else {
        echo "&nbsp;<INPUT TYPE=\"SUBMIT\" NAME=\"cancel\" VALUE=\""._CANCELSEND."\">";
    }
    echo "</TD>"
        ."</TR>"
        ."</TABLE></TD></TR></TABLE>"
        ."</FORM>"
        ."<BR>";
    }
}
include('footer.php');

?>