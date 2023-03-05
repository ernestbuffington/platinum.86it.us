<?php
/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System						*/
/* ============================================						*/
/*														*/
/* This is the language module with all the system messages					*/
/*														*/
/* If you make a translation, please post them in the forums at					*/
/* www.ravenphpscripts.com										*/
/*														*/
/*														*/
/* You need to change the second quoted phrase, not the capitalised one			*/
/*														*/
/*														*/
/*														*/
/*														*/
/*														*/
/*														*/
/**************************************************************************/
global $anonwaitdays, $outsidewaitdays, $sitename;
//if (!defined('_DATE')) define('_DATE','Date');
//if (!defined('_OF')) define('_OF','of');
define('_1WEEK','1 Semana');
define('_2WEEKS','2 Semanas');
define('_30DAYS','30 D&iacute;as');
define('_ADDADOWNLOAD','Agregar una Nueva Descarga');
define('_ADDDOWNLOAD','Agregar Descarga');
define('_ADDEDON','Agregado el');
define('_ADDITIONALDET','Detalles Adicionales');
define('_ADDTHISFILE','Agregar este archivo');
define('_ALLOWTORATE','Permitir que otros usuarios lo valoren desde su sitio web!');
define('_AND','y');
define('_AUTHOR','Autor');
define('_AUTHOREMAIL','Correo del Autor');
define('_AUTHORNAME','Nombre del Autor');
define('_BREAKDOWNBYVAL','Desglose de las valoraciones por valor');
define('_BUTTONLINK','Bot&oacute;n de Enlace');
define('_CATEGORIES','Categor&iacute;as');
if (!defined('_CATEGORY')) define('_CATEGORY','Categor&iacute;a');
define('_CHECKFORIT','No proporcionaste ninguna direcci&oacute;n de correo electr&oacute;nico, pero vamos a revisar su enlace pronto.');
define('_COMPLETEVOTE1','Tu voto es apreciado.');
define('_COMPLETEVOTE2','Ya has votado por este recurso en los pasados '.$anonwaitdays.' d&iacute;a(s).');
define('_COMPLETEVOTE3','Vota por un recurso solo una vez.<br />Todos los votos son registrados y revisados.');
define('_COMPLETEVOTE4','No puedes votar por un link que tu mismo enviaste.<br />ATodos los votos son registrados y revisados.');
define('_COMPLETEVOTE5','Valoraci&oacute;n no seleccionada - el voto no fue contabilizado');
define('_COMPLETEVOTE6','Solo se permite un voto por direcci&oacute;n IP cada '.$outsidewaitdays.' d&iacute;a(s).');
define('_DAYS','d&iacute;as');
define('_DBESTRATED','Descargas Mejor Valoradas - Top');
define('_DCATLAST3DAYS','Nuevas Descargas Agregadas en esta Categor&iacute;a en los &uacute;ltimos 3 d&iacute;as');
define('_DCATNEWTODAY','Nuevas Descargas Agregadas en esta Categor&iacute;a en el d&iacute;a de Hoy');
define('_DCATTHISWEEK','Nuevas Descargas Agregadas en esta Categoria en esta semana');
define('_DDATE1','Fecha (Antiguas Descargas Primero)');
define('_DDATE2','Fecha (Nuevas Descargas Primero)');
define('_DESCRIPTION','Descripci&oacute;n');
define('_DETAILS','Detalles');
define('_DLETSDECIDE','Informaci&oacute;n de usuarios como usted ayudar&aacute; a otros visitantes a decidir mejor que descargar.');
define('_DONLYREGUSERSMODIFY','Solo los usuarios registradis pueden sugerir modificaciones de descargas. Por favor <a href="modules.php?name=Your_Account">reg&iacute;strese o inicie sesi&oacute;n</a>.');
define('_DOWNLOADALREADYEXT','ERROR: Este URL ya esta listado en la Base de Datos!');
define('_DOWNLOADCOMMENTS','Comentarios de la Descarga');
define('_DOWNLOADID','ID de la Descarga');
define('_DOWNLOADNAME','Nombre del Programa');
define('_DOWNLOADNODESC','ERROR: Necesitas escribir una DESCRIPCI&Oacute;N para tu URL!');
define('_DOWNLOADNOEMAIL','ERROR: Necesitas escribir una direcci&oacute;n de CORREO ELECTR&Oacute;NICO v&aacute;lida!');
define('_DOWNLOADNOTITLE','ERROR: Necesitas escribir un t&iacute;tulo para tu URL!');
define('_DOWNLOADNOURL','ERROR: Necesitas escribir una URL!');
define('_DOWNLOADNOW','Descargar este archivo ahora!');
define('_DOWNLOADPROFILE','Perfil de la Descarga');
define('_DOWNLOADRATING','Valoraci&oacute;n de la Descarga');
define('_DOWNLOADRATINGDET','Detalles de la Valoraci&oacute;n de la Descarga');
define('_DOWNLOADRECEIVED','Hemos recibido el env&iacute;o de su descarga. Gracias!');
define('_DOWNLOADS','Descargas');
define('_DOWNLOADSMAIN','P&aacute;gina Principal de Descargas');
define('_DOWNLOADSMAINCAT','Principales Categor&iacute;as de Descargas');
define('_DOWNLOADSNOTUSER1','No eres un usuario registrado o todav&iacute;a no has iniciado sesi&oacute;n.');
define('_DOWNLOADSNOTUSER2','Si estuvieras registrado podr&iacute;as agregar descargas al sitio.');
define('_DOWNLOADSNOTUSER3','Convertirse en usuario registrado es un proceso r&aacute;pido y f&aacute;cil.');
define('_DOWNLOADSNOTUSER4','&iquest;Por qu&eacute; requerimos registrarse para accesar a ciertas caracter&iacute;sticas?');
define('_DOWNLOADSNOTUSER5','As&iacute; podemos ofrecerle s&oacute;lo contenido de la m&aacute;s alta calidad,');
define('_DOWNLOADSNOTUSER6','Cada elemento es revisado y aprobado individualmente por nuestro personal.');
define('_DOWNLOADSNOTUSER7','Esperamos ofrecerle s&oacute;lo informaci&oacute;n valiosa.');
define('_DOWNLOADSNOTUSER8','<a href="modules.php?name=Your_Account">Registre una Cuenta</a>');
define('_DOWNLOADVOTE','Votar!');
define('_DPOSTPENDING','Todas las descargas son publicadas pendientes de verificaci&oacute;n.');
define('_DRATENOTE4','Puedes ver una liosta de los <a href="modules.php?name=Downloads&amp;d_op=TopRated">Recursos Mejor Valorados</a>.');
define('_DSUBMITONCE','Enviar una descarga &uacute;nica solo una vez.');
define('_DTOTALFORLAST','Total de nuevas descargas para los &uacute;ltimos');
define('_EDITORIAL','Editorial');
define('_EDITORIALBY','Editorial por');
define('_EDITORREVIEW','Revisi&oacute; del Editor');
define('_EDITTHISDOWNLOAD','Editar esta Descarga');
define('_FEELFREE2ADD','Si&eacute;ntase libre de agregar un comentario acerca de este sitio.');
define('_FILESIZE','Tama&ntilde;o del Archivo');
define('_FILEURL','Enlace hacia el Archivo');
define('_HIGHRATING','Alta valoraci&oacute;n');
define('_HOMEPAGE','P&aacute;gina Principal');
define('_HTMLCODE1','El c&oacute;digo HTML que deber&iacute;a usar en este caso, es el siguiente:');
define('_HTMLCODE2','El c&oacute;digo fuente para el bot&oacute;n anterior es:');
define('_HTMLCODE3','Usando este formulario permitir&aacute; a sus usuarios valorar este recurso directamente desde su sitio y la valoraci&oacute;n se registrar&aacute; aqu&iacute;. El formulario anterior est&aacute; desactivado, pero el siguiente c&oacute;digo trabajar&aacute; simplemente cortando y pegando en su p&aacute;gina web. El c&oacute;digo fuente se muestra a continuaci&oacute;n:');
define('_IDREFER','en el c&oacute;digo fuente HTML se hace referencia al n&uacute;mero de ID de tu sitio en la Base de Datos de '.$sitename.'. Aseg&uacute;rate de que este n&uacute;mero est&eacute; presente.');
define('_IFYOUWEREREG','Si estuvieras registrado podr&iacute;a hacer comentarios en este sitio web.');
define('_INBYTES','en bytes');
define('_INDB','en nuestra base de datos');
define('_INOTHERSENGINES','en otros Motores de B&uacute;squeda');
define('_INSTRUCTIONS','Instrucciones');
define('_ISTHISYOURSITE','&iquest;Es este tu recurso?');
define('_LAST30DAYS','Mes Pasado');
define('_LASTWEEK','Semana Pasada');
define('_LDESCRIPTION','Descripci&oacute;n: (255 caracteres como m&aacute;ximo)');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LOOKTOREQUEST','Revisaremos su solicitud pronto.');
define('_LOWRATING','Baja Valoraci&oacute;n');
define('_LTOTALVOTES','total de votos');
define('_LVOTES','votos');
define('_MAIN','Principal');
define('_MODIFY','Modificar');
define('_MOSTPOPULAR','M&aacute;s Populares - Top');
define('_NEW','Nuevo');
define('_NEWDOWNLOADS','Nuevas Descargas');
define('_NEWLAST3DAYS','Nuevo en los &Ulacute;timos 3 d&iacute;as');
define('_NEWTHISWEEK','Nuevo esta Semana');
define('_NEWTODAY','Nuevo Hoy');
define('_NEXT','Pr&oacute;xima P&aacute;gina');
define('_NOEDITORIAL','Ning&uacute;n editorial est&aacute; actualmente disponible en este sitio web.');
define('_NOMATCHES','No hay resultados para su consulta');
define('_NOOUTSIDEVOTES','No hay votos de Usuarios For&aacute;neos');
define('_NOREGUSERSVOTES','No hay votos de Usuarios Registrados');
define('_NOUNREGUSERSVOTES','No hay votos de Usuarios NO Registrados');
define('_NUMBEROFRATINGS','N&uacute;mero de Valoraciones');
define('_NUMOFCOMMENTS','N&uacute;mero de Comentarios');
define('_NUMRATINGS','# de Valoraciones');
define('_OFALL','de todo');
define('_OUTSIDEVOTERS','Vonatntes For&aacute;neos');
define('_OVERALLRATING','Valoraci&oacute;n Total');
define('_POPULAR','Popular');
define('_POPULARITY','Popularidad');
define('_POPULARITY1','Popularidad (de Menor a Mayor N&uacute;mero de Impresiones)');
define('_POPULARITY2','Popularidad (de Mayor a Menor N&uacute;mero de Impresiones)');
define('_PREVIOUS','P&aacute;gina Anterior');
define('_PROMOTE01','Quiz&aacute;s pueda estar interesado en varias de las opciones remotas de \'Valorar un Sitio Web\' que disponemos. Estas permiten poner una imagen (o inclusive un formulario de valoraci&oacute;n) en su sitio a fin de aumentar el n&uacute;mero de votos que reciben sus recursos. Por favor elija de una de las opciones mostradas a continuaci&oacute;n:');
define('_PROMOTE02','Una forma de enlazar al formulario de valoraci&oacute;n es a trav&eacute;s de un simple enlace de texto:');
define('_PROMOTE03','Si est&aacute; buscando algo m&aacute;s que un b&aacute;sico enlace de texto, puede querer utilizar un peque&ntilde;o bot&oacute;n de enlace:');
define('_PROMOTE04','Si hace trampa, eliminaremos su v&iacute;nculo. Dicho esto, asi es como se ve el formulario de valoraci&oacute;n remota.');
define('_PROMOTE05','Gracias! y buena suerte con sus valoraciones!');
define('_PROMOTEYOURSITE','Promover Su Sitio Web');
define('_RATEIT','Valorar este Sitio!');
define('_RATENOTE1','Por favor no vote por el mismo recurso m&aacute;s de una vez.');
define('_RATENOTE2','La escala es de 1 - 10, siendo 1 muy pobre y 10 excelente.');
define('_RATENOTE3','Por favor, sea objetivo con su voto, si todo el mundo recibe un 1 &oacute; un 10, las valoraciones no son muy &uacute;tiles.');
define('_RATENOTE5','No vote por su propio recurso o por el de un competidor.');
define('_RATERESOURCE','Valorar Recurso');
define('_RATETHISSITE','Valore este Recurso');
define('_RATING','Valoraci&oacute;n');
define('_RATING1','Valoraci&oacute;n (de Menor a Mayor Puntuaci&oacute;n)');
define('_RATING2','Valoraci&oacute;n (de Mayor a Menor Puntuaci&oacute;n)');
define('_REGISTEREDUSERS','Usuarios Registrados');
define('_REMOTEFORM','Formulario de Valoraci&oacute;n Remoto');
define('_REPORTBROKEN','Reportar Enlace Roto');
define('_REQUESTDOWNLOADMOD','Solicitud de Modificaci&oacute;n de Descarga');
define('_RESSORTED','Recursos actualmente ordenados por');
define('_RETURNTO','Volver a');
define('_SCOMMENTS','Comentarios');
define('_SEARCHRESULTS4','Resultados de la B&uacute;squeda de');
define('_SECURITYBROKEN','Por razones de seguridad su nombre de usuario y direcci&oacute;n IP tambi&eacute;n ser&aacute;n temporalmente registrados.');
define('_SELECTPAGE','Seleccionar P&aacute;gina');
define('_SENDREQUEST','Enviar Solicitud');
define('_SHOW','Mostrar');
define('_SHOWTOP','Mostrar Top');
define('_SORTDOWNLOADSBY','Ordenar Descargas por');
define('_STAFF','Personal');
define('_TEXTLINK','Enlace de Texto');
define('_THANKSBROKEN','Gracias por ayudarnos a mantener la integridad de este directorio.');
define('_THANKSFORINFO','Gracias por la informaci&oacute;n.');
define('_THANKSTOTAKETIME','Gracias por tomarte el tiempo de valorar un sitio aqu&iacute; en');
define('_THENUMBER','El N&uacute;mero');
define('_THEREARE','Hay');
define('_TITLE','T&iacute;tulo');
define('_TITLEAZ','T&iacute;tulo (A - Z)');
define('_TITLEZA','T&iacute;tulo (Z - A)');
define('_TO','Para');
define('_TOPRATED','Mejores Valorados');
define('_TOTALNEWDOWNLOADS','Total de Nuevas Descargas');
define('_TOTALOF','Total de');
define('_TOTALVOTES','Total de Votos:');
define('_TRATEDDOWNLOADS','Total de descargas valoradas');
define('_TRY2SEARCH','Trata de Buscar');
define('_TVOTESREQ','votos requeridos como m&iacute;nimo');
define('_UNKNOWN','Desconocido');
define('_UNREGISTEREDUSERS','Usuarios NO Registrados');
define('_URL','URL');
define('_USER','Usuario');
define('_USERANDIP','Su Nombre de Usuario y direcci&oacute;n IP han sido registrados, as&iacute; que por favor no abuse del sistema.');
define('_USERAVGRATING','Valoraci&oacute;n Promedio de Usuarios');
define('_USUBCATEGORIES','Subcategor&iacute;as');
define('_VERSION','Versi&oacute;n');
define('_VOTE4THISSITE','Votar por este Sitio!');
define('_WEIGHNOTE','* Nota: Este Recurso diferencia las valoraciones de los Usuarios Registrados vs. Usuarios No Registrados');
define('_WEIGHOUTNOTE','* Nota: Este recurso diferencia las valoracuiones de los votantes Registrados vs. For&aacute;neos');
define('_YOUARENOTREGGED','No eres un usuario registrado o no has iniciado sesi&oacute;n.');
define('_YOUAREREGGED','Eres un usuario registrado y ya has iniciado sesi&oacute;n.');

?>
