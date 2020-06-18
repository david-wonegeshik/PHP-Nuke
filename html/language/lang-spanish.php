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
define("_WRITES", "escribió");
define("_POSTEDON","Enviado el");
define("_NICKNAME","Nickname");
define("_PASSWORD","Password");
define("_WELCOMETO","Bienvenido a");
define("_EDIT","Editar");
define("_DELETE","Borrar");
define("_POSTEDBY","Enviado por");
define("_READS","Lecturas");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Volver Atrás</a> ]");
define("_COMMENTS","Cometarios");
define("_PASTARTICLES","Artículos Pasados");
define("_OLDERARTICLES","Artículos Viejos");
define("_BY","por");
define("_ON","el");
define("_LOGOUT","Salir");
define("_WAITINGCONT","Contenido Esperando");
define("_SUBMISSIONS","Envíos");
define("_WREVIEWS","Reviews");
define("_WLINKS","Enlaces");
define("_EPHEMERIDS","Efemérides");
define("_ONEDAY","Tal día como hoy...");
define("_ASREGISTERED","¿Todavía no tienes una cuenta? Puedes <a href=\"modules.php?name=Your_Account\">crearte una</a>. Como usuario registrado tendrás ventajas como seleccionar la apariencia de la página, configurar los comentarios y enviar los comentarios con tu nombre.");
define("_MENUFOR","Menú de");
define("_NOBIGSTORY","Hoy aún no hay una Gran Historia.");
define("_BIGSTORY","La Historia más leída hoy:");
define("_SURVEY","Encuesta");
define("_POLLS","Encuestas");
define("_PCOMMENTS","Comentarios:");
define("_RESULTS","Resultados");
define("_HREADMORE","Leer más...");
define("_CURRENTLY","Actualmente hay");
define("_GUESTS","invitados,");
define("_MEMBERS","miembro(s) conectado(s).");
define("_YOUARELOGGED","Estás conectado como");
define("_YOUHAVE","Tienes");
define("_PRIVATEMSG","mensaje(s) privado(s).");
define("_YOUAREANON","Eres un usuario anónimo. Puedes registrarte <a href=\"modules.php?name=Your_Account\">aquí</a>");
define("_NOTE","Nota:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Hemos recibido");
define("_PAGESVIEWS","impresiones desde");
define("_TOPIC","Tópico");
define("_UDOWNLOADS","Descargas");
define("_VOTE","voto");
define("_VOTES","votos");
define("_MVIEWADMIN","Ver: Sólo Administradores");
define("_MVIEWUSERS","Ver: Sólo Usuarios Registrados");
define("_MVIEWANON","Ver: Sólo Usuarios Anónimos");
define("_MVIEWALL","Ver: Todos los Visitantes");
define("_EXPIRELESSHOUR","Caducidad: menos de una hora");
define("_EXPIREIN","Caduca en");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Ilimitado");
define("_HOURS","Horas");
define("_RSSPROBLEM","Actualmente hay un problema con los titulares de este sitio");
define("_SELECTLANGUAGE","Seleccionar Idioma");
define("_SELECTGUILANG","Selecciona Idioma de la Interfaz:");
define("_NONE","Ninguno");
define("_BLOCKPROBLEM","<center>Hay un problema con este bloque.</center>");
define("_BLOCKPROBLEM2","<center>En este momento no existe contenido para este bloque.</center>");
define("_MODULENOTACTIVE","Disculpa, este Módulo no está Activo!");
define("_NOACTIVEMODULES","Módulos Inactivos");
define("_FORADMINTESTS","(Para Pruebas)");
define("_BBFORUMS","Foros");
define("_ACCESSDENIED", "Acceso Denegado");
define("_RESTRICTEDAREA", "Estás intentando entrar en área restringida.");
define("_MODULEUSERS", "Lo sentimos pero esta sección de nuestro sitio es sólo para <i>Usuarios Registrados</i><br><br>Puedes registrarte de forma gratuíta <a href=\"modules.php?name=Your_Account&op=new_user\">aquí</a>, luego podrás<br>acceder a esta sección sin restricciones. Gracias.<br><br>");
define("_MODULESADMINS", "Lo sentimos pero esta sección de nuestro sitio es sólo para <i>Administradores</i><br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%A, %d %B a las %T");
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