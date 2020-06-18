<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please sent to me (fbc@mandrakesoft.com)    */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/


define("_CHARSET","ISO-8859-2");
define("_SEARCH","Szukaj");
define("_LOGIN","Login");
define("_WRITES","napisa�");
define("_POSTEDON","Wys�ano dnia");
define("_NICKNAME","Pseudonim");
define("_PASSWORD","Has�o");
define("_WELCOMETO","Witaj w");
define("_EDIT","Edytuj");
define("_DELETE","Skasuj");
define("_POSTEDBY","Wys�any przez");
define("_READS","ods�on");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Wr��</a> ]");
define("_COMMENTS","komentarze");
define("_PASTARTICLES","Ostatnie artyku�y");
define("_OLDERARTICLES","Starsze artyku�y");
define("_BY","przez");
define("_ON","dnia");
define("_LOGOUT","Wyloguj");
define("_WAITINGCONT","Oczekuj�ca tre��");
define("_SUBMISSIONS","Wys�anie");
define("_WREVIEWS","Oczekuj�ce recenzje");
define("_WLINKS","Oczekuj�ce linki");
define("_EPHEMERIDS","Ephemeridy");
define("_ONEDAY","Pewnego dnia, jak dzisiaj...");
define("_ASREGISTERED","Nie masz jeszcze konta? Mo�esz <a href=\"modules.php?name=Your_Account&amp;op=new_user\">sobie za�o�y�</a>. Jako zarejestrowany u�ytkownik b�dziesz mia� kilka przywilej�w.");
define("_MENUFOR","Menu dla");
define("_NOBIGSTORY","Dzi� jeszcze nie by�o najwa�niejszego artyku�u.");
define("_BIGSTORY","Dzisiaj najcz�ciej czytanym artyku�em jest:");
define("_SURVEY","G�osowanie");
define("_POLLS","Ankiety");
define("_PCOMMENTS","Komentarzy:");
define("_RESULTS","Wyniki");
define("_HREADMORE","przeczytaj wi�cej...");
define("_CURRENTLY","Aktualnie jest");
define("_GUESTS","go��(ci) i");
define("_MEMBERS","u�ytkownik(�w) online.");
define("_YOUARELOGGED","Jeste� zalogowany jako");
define("_YOUHAVE","Masz");
define("_PRIVATEMSG","prywatn� wiadomo��(ci).");
define("_YOUAREANON","Jeste� anonimowym u�ytkownikiem. Mo�esz si� zarejestrowa� za darmo klikaj�c <a href=\"modules.php?name=Your_Account&amp;op=new_user\">tutaj</a>");
define("_NOTE","Notatka:");
define("_ADMIN","Administrator:");
define("_WERECEIVED","Otrzymali�my");
define("_PAGESVIEWS","ods�on strony od");
define("_TOPIC","Temat");
define("_UDOWNLOADS","Download�w");
define("_VOTE","G�osuj");
define("_VOTES","G�os�w");
define("_MVIEWADMIN","Zobacz�: Tylko administratorzy");
define("_MVIEWUSERS","Zobacz�: Tylko zarejestrowani u�ytkownicy");
define("_MVIEWANON","Zobacz�: Tylko anonimowi u�ytkownicy");
define("_MVIEWALL","Zobacz�: Wszyscy odwiedzaj�cy");
define("_EXPIRELESSHOUR","Wa�no��: Mniej ni� 1 godzina");
define("_EXPIREIN","Wa�no�� w");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Nielimitowane");
define("_HOURS","Godzin");
define("_RSSPROBLEM","Aktualnie mamy problem z nag��wkami na tej stronie");
define("_SELECTLANGUAGE","Wybierz j�zyk");
define("_SELECTGUILANG","Wybierz j�zyk interfejsu:");
define("_NONE","Brak");
define("_BLOCKPROBLEM","<center>teraz wystepuje problem z tym blokiem.</center>");
define("_BLOCKPROBLEM2","<center>Teraz nie ma zawarto�ci dla tego bloku.</center>");
define("_MODULENOTACTIVE","Sorry, ten modu� nie zosta� aktywowany!!");
define("_NOACTIVEMODULES","Nieaktywne modu�y");
define("_FORADMINTESTS","(wy��cznie do testowania przez Admina)");
define("_BBFORUMS","Forum");
define("_ACCESSDENIED", "Access Denied");
define("_RESTRICTEDAREA", "You are trying to access to a restricted area.");
define("_MODULEUSERS", "We are Sorry but this section of our site is for <i>Registered Users Only</i><br><br>You can register for free by clicking <a href=\"modules.php?name=Your_Account&op=new_user\">here</a>, then you can<br>access to this section without restrictions. Thanks.<br><br>");
define("_MODULESADMINS", "We are Sorry but this section of our site is for <i>Administrators Only</i><br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%d-%m-%Y o godz. %T");
define("_DATESTRING2","%d-%m-%Y");
define("_DATE","Date");
define("_HOUR","Hour");
define("_UMONTH","Month");
define("_YEAR","Year");
define("_JANUARY","January");
define("_FEBRUARY","February");
define("_MARCH","March");
define("_APRIL","April");
define("_MAY","May");
define("_JUNE","June");
define("_JULY","July");
define("_AUGUST","August");
define("_SEPTEMBER","September");
define("_OCTOBER","October");
define("_NOVEMBER","November");
define("_DECEMBER","December");

/*****************************************************/
/* Function to translate Datestrings                 */
/*****************************************************/

function translate($phrase) {
    switch($phrase) {
	case "xdatestring":	$tmp = "%A, %B %d @ %T %Z"; break;
	case "linksdatestring":	$tmp = "%d-%b-%Y"; break;
	case "xdatestring2":	$tmp = "%A, %B %d"; break;
	default:		$tmp = "$phrase"; break;
    }
    return $tmp;
}

?>