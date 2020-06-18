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


define("_CHARSET","ISO-8859-1");
define("_SEARCH","Cerca");
define("_LOGIN","Login");
define("_WRITES","Scrivere");
define("_POSTEDON","Postato il");
define("_NICKNAME","Nickname");
define("_PASSWORD","Password");
define("_WELCOMETO","Benvenuto su");
define("_EDIT","Edita");
define("_DELETE","Cancella");
define("_POSTEDBY","Postato da");
define("_READS","letture");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Indietro</a> ]");
define("_COMMENTS","commenti");
define("_PASTARTICLES","Articoli Precedenti");
define("_OLDERARTICLES","Articoli Vecchi");
define("_BY","di");
define("_ON","su");
define("_LOGOUT","Logout");
define("_WAITINGCONT","In Attesa");
define("_SUBMISSIONS","Articoli");
define("_WREVIEWS","Recensioni");
define("_WLINKS","Links");
define("_EPHEMERIDS","Eventi Storici");
define("_ONEDAY","One Day like Today...");
define("_ASREGISTERED","Non hai ancora un tuo account? <a href=\"modules.php?name=Your_Account\">crealo Qui</a>!. Come utente registrato potrai sfruttare appieno e personalizzare i servizi offerti.");
define("_MENUFOR","Menu per");
define("_NOBIGSTORY","Ancora Nessun Articolo.");
define("_BIGSTORY","L'Articolo pi&ugrave; letto del Giorno &egrave;:");
define("_SURVEY","Sondaggio");
define("_POLLS","Sondaggi");
define("_PCOMMENTS","Commenti:");
define("_RESULTS","Risultati");
define("_HREADMORE","Altro...");
define("_CURRENTLY","In questo momento ci sono,");
define("_GUESTS","Visitatori(e) e");
define("_MEMBERS","Utenti(e) nel sito.");
define("_YOUARELOGGED","Ciao");
define("_YOUHAVE","Hai");
define("_PRIVATEMSG","messaggio(i).");
define("_YOUAREANON","<font color=\"red\">Non ci conosciamo ancora? Registrati gratuitamente <a href=\"modules.php?name=Your_Account\">Qui</a></font>");
define("_NOTE","Nota:");
define("_ADMIN","Amministratore:");
define("_WERECEIVED","");
define("_PAGESVIEWS","pagine viste dal");
define("_TOPIC","Argomento");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Vota!");
define("_VOTES","Voti");
define("_MVIEWADMIN","Visualizzato da: Solo Amministratori");
define("_MVIEWUSERS","Visualizzato da: Solo Registrati");
define("_MVIEWANON","Visualizzato da: Solo Anonimi");
define("_MVIEWALL","Visualizzato da: Tutti");
define("_EXPIRELESSHOUR","Scadenza: Meno di un'ora");
define("_EXPIREIN","Scadenza tra");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Illimitato");
define("_HOURS","Ore");
define("_RSSPROBLEM","Problema Momentaneo con i Titoli di questo Sito");
define("_SELECTLANGUAGE","Seleziona Lingua");
define("_SELECTGUILANG","");
define("_NONE","Nessuna");
define("_BLOCKPROBLEM","<center>Al momento c'&egrave; un problema con questo blocco.</center>");
define("_BLOCKPROBLEM2","<center>Al momento non ci sono contenuti in questo blocco.</center>");
define("_MODULENOTACTIVE","Spiacente, modulo non attivo!");
define("_NOACTIVEMODULES","Moduli inattivi");
define("_FORADMINTESTS","(per tests amministrativi)");
define("_BBFORUMS","Forums");
define("_ACCESSDENIED", "Accesso Negato");
define("_RESTRICTEDAREA", "Stai provando ad accedere ad un'area privata.");
define("_MODULEUSERS", "Spiacenti, ma questa area del sito &egrave; solo per gli Utenti <i>Registrati</i><br><br>Si puoi registrare gratuitamente cliccando <a href=\"modules.php?name=Your_Account&amp;op=new_user\">qui</a>, poi potrai<br>accedere a quest'area senza restrizioni. Grazie.<br><br>");
define("_MODULESADMINS", "Spiacenti, ma questa area del sito &egrave; solo per gli <i>Amministratori</i><br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%A, %d %B @ %T %Z");
define("_DATESTRING2","%A, %d %B");
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