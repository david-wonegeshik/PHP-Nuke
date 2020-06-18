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
define("_SEARCH","Buscar");
define("_LOGIN","Login");
define("_WRITES", "escribiu");
define("_POSTEDON","Enviado o");
define("_NICKNAME","Alias");
define("_PASSWORD","Clave");
define("_WELCOMETO","Benvido a");
define("_EDIT","Editar");
define("_DELETE","Borrar");
define("_POSTEDBY","Enviado por");
define("_READS","Lecturas");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Voltar</a> ]");
define("_COMMENTS","cometarios");
define("_PASTARTICLES","Artigos Pasados");
define("_OLDERARTICLES","Artigos Antigos");
define("_BY","por");
define("_ON","o");
define("_LOGOUT","Sair");
define("_WAITINGCONT","Contido Esperando");
define("_SUBMISSIONS","Env�os");
define("_WREVIEWS","Rese�as esperando");
define("_WLINKS","Enlaces esperando");
define("_EPHEMERIDS","Efem�rides");
define("_ONEDAY","Tal d�a coma hoxe ...");
define("_ASREGISTERED","�A�nda non ten unha conta? Pode <a href=\"modules.php?name=Your_Account\">crear unha</a>. Como usuario rexistrado ter� ventaxas como selecciona-la apariencia da p�xina, configura-los comentarios e envia-los comentarios co seu nome.");
define("_MENUFOR","Men� de");
define("_NOBIGSTORY","Hoxe non hai Gran Historia.");
define("_BIGSTORY","A Historia m�is lida hoxe:");
define("_SURVEY","Enquisa");
define("_POLLS","Votaci�ns");
define("_PCOMMENTS","Comentarios:");
define("_RESULTS","Resultados");
define("_HREADMORE","Ler m�is...");
define("_CURRENTLY","Actualmente hai");
define("_GUESTS","invitados,");
define("_MEMBERS","membro(s) conectado(s).");
define("_YOUARELOGGED","Est� conectado como");
define("_YOUHAVE","Ten");
define("_PRIVATEMSG","mensaxe(s) privada(s).");
define("_YOUAREANON","� un usuario an�nimo. Pode rexistrarse <a href=\"modules.php?name=Your_Account\">aqu�</a>");
define("_NOTE","Nota:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Recibimos");
define("_PAGESVIEWS","impresi�ns desde");
define("_TOPIC","Tema");
define("_UDOWNLOADS","Descargas");
define("_VOTE","voto");
define("_VOTES","votos");
define("_MVIEWADMIN","Ver: S� Administradores");
define("_MVIEWUSERS","Ver: S� Usuarios Rexistrados");
define("_MVIEWANON","Ver: S� Usuarios An�nimos");
define("_MVIEWALL","Ver: T�do-los Visitantes");
define("_EXPIRELESSHOUR","Caducidade: menos dunha hora");
define("_EXPIREIN","Caduca en");
define("_HTTPREFERERS","Referencias HTTP");
define("_UNLIMITED","Ilimitado");
define("_HOURS","Horas");
define("_RSSPROBLEM","Actualmente hai un problema cos titulares deste sitio");
define("_SELECTLANGUAGE","Seleccionar Idioma");
define("_SELECTGUILANG","Seleccione Idioma da Interface:");
define("_NONE","Ning�n");
define("_BLOCKPROBLEM","<center>Hai un problema con este bloque.</center>");
define("_BLOCKPROBLEM2","<center>Non hai contido para este bloque.</center>");
define("_MODULENOTACTIVE","Desculpe, este M�dulo non est� activo!");
define("_NOACTIVEMODULES","M�dulos Inactivos");
define("_FORADMINTESTS","(Test do Admin)");
define("_BBFORUMS","Foros");
define("_ACCESSDENIED", "Acceso Denegado");
define("_RESTRICTEDAREA", "Est� intentando entrar en �rea restrinxida.");
define("_MODULEUSERS", "Desculpe, pero esta secci�n do noso sitio � s� para <i>Usuarios Rexistrados</i><br><br>Pode rexistrarse de forma gratu�ta <a href=\"modules.php?name=Your_Account&op=new_user\">aqu�</a>, despois poder�<br>acceder a esta secci�n sen restricci�ns. Gracias.<br><br>");
define("_MODULESADMINS", "Desculpe pero esta secci�n do noso sitio � s� para <i>Administradores</i><br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%A, %d de %B �s %T");
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