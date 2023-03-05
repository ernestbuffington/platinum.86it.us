<?php
/**
 * TegoNuke(tm) Mailer: Replaces Native PHP Mail
 *
 * Inspired by Nuke-Evolution and PHPNukeMailer.  Uses a re-written PHPNukeMailer
 * admin module for the administration of the mailer functions and Swift Mailer library
 * of classes to perform the actual mail functions.
 *
 * Will be used to replace PHP mail() function throughout RavenNuke(tm) /
 * PHP-Nuke.  This has become necessary as Hosts have started locking down
 * access to the mail() function and requiring SMTP authentication.
 *
 * PHP versions 5.2+ ONLY
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Integration
 * @package     TegoNuke(tm)
 * @subpackage  Mailer
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @author      (Translation author) Jonathan Estrella (aka: slaytanic) <dev.exuberanza.com>
 * @copyright   2007 - 2010 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.1.0_249
 * @link        http://montegoscripts.com
*/
/*****************************************************/
/* PhpNukeMailer v1.0.9 (Apr-11-2007)                */
/* By: Jonathan Estrella (kiedis.axl@gmail.com)      */
/* http://www.slaytanic.tk                           */
/* Copyright © 2004-2007 by Jonathan Estrella        */
/*****************************************************/
define('_TNML_MNU_BACK2ADM_LAB', 'Administraci&oacute;n del Sitio');
define('_TNML_MNU_MAILCFG_LAB', 'Configuraci&oacute;n de TegoNuke Mailer');
define('_TNML_MNU_ABOUT_LAB', 'Acerca de TegoNuke Mailer');
define('_TNML_HLP_LEGEND_LAB', 'Sit&uacute;e el cursor sobre estos iconos para ayuda adicional');
define('_TNML_HLP_LEGEND_HLP', 'Correcto, as&iacute; es como se hace!');
define('_TNML_OPTSGENERAL_LAB','Opciones Generales del Mailer');
define('_TNML_OPTSSMTP_LAB','Configuraci&oacute;n de SMTP');
define('_TNML_OPTSSENDMAIL_LAB','Configuraci&oacute;n de Sendmail');
define('_TNML_OFF','DESACTIVADO');
define('_TNML_ONWITHSEND','ACTIVADO, CON ENVIO');
define('_TNML_ONNOSEND','ACTIVADO, SIN ENVIO');
define('_TNML_NONE','Ninguno');
define('_TNML_PNMACTIVATE_LAB', 'Activar el Mailer?');
define('_TNML_PNMACTIVATE_HLP', 'Activa o Desactiva el mailer.<br /><br />Si encuentras que tu sistema RavenNuke(tm) / PHP-Nuke no est&aacute; enviando emails, tu servidor puede haber bloqueado el uso de la funci&oacute;n PHP mail(). Puedes usar SMTP autenticado, que es donde este Mailer entra en acci&oacute;n.<br /><br /><strong>No</strong> = La funci&oacute;n nativa predeterminada PHP mail() ser&aacute; usada.  Este es el valor por defecto.<br /><br /><strong>Si</strong> = Activar&aacute; el Mailer y te permitir&aacute; escoger el <strong>M&eacute;todo de Env&iacute;o</strong>.<br /><br />(Consulta la ventana de ayuda en Metodo de Envio para ver que puedes configurar a continuaci&oacute;n.)');
define('_TNML_SENDMETHOD_LAB', 'M&eacute;todo de Env&iacute;o');
define('_TNML_SENDMETHOD_HLP', 'Especificar el m&eacute;todo de env&iacute;o deseado.<br /><br />La mayor parte del tiempo, si se necesita utilizar este Mailer, su servidor le pedir&aacute; utilizar SMTP autentificado. En este caso, seleccione la opci&oacute;n SMTP y podr&aacute; realizar los ajustes adicionales de su servicio SMTP. Actualmente, las opciones disponibles son:<br /><br /><strong>Mail()</strong> = Usar la funci&oacute;n mail(). Es la funci&oacute;n nativa por defecto de PHP. (Si la funci&oacute;n mail() est&aacute; funcionando con el mailer desactivado, puede usar este mailer y obtener caracter&iacute;sticas adicionales como mejor gesti&oacute;n de errores y procesamiento de env&iacute;o por lotes.<br /><br /><strong>SMTP</strong> = Seleccionando esta opci&oacute;n podr&aacute; ajustar algunas configuraciones adicionales. Esta puede ser la &uacute;nica opci&oacute;n a utilizar si su servicio de alojamiento ha desactivado la nativa funci&oacute;n mail() de PHP. (NOTA: Si su servidor requiere el uso de SMTP, tambi&eacute;n debe ajustar la configuraci&oacute;n del servidor SMTP dentro de los Foros.)<br /><br /><strong>SendMail</strong> = Esta opci&oacute;n usar&aacute; el demonio sendmail. Ser&iacute;a extra&ntilde;o que alg&uacute;n servidor exija SendMail sobre SMTP autenticado, pero solo en caso de que lo necesite, aqu&iacute; est&aacute;.');
define('_TNML_BOUNCEADDR_LAB', 'Correo electr&oacute;nico de rebote');
define('_TNML_BOUNCEADDR_HLP', 'Deje este campo en blanco si no desea proveer un correo electr&oacute;nico de rebote; Sin embargo, esto podr&iacute;a ayudarle a mantenerse fuera de las listas negras de spam.<br /><br />Se recomienda que cree una direcci&oacute;n de correo electr&oacute;nico independiente para recoger mensajes devueltos, para que pueda mantenerse al tanto de la limpieza de las direcciones de correo electr&oacute;nico incorrectas y/o viciadas en la tabla de usuarios. Tambi&eacute;n puede ser una buena idea para asegurarse de que la direcci&oacute;n es una con su propio dominio de env&iacute;o (de nuevo, las mismas razones de listas negras de spam).');
define('_TNML_DEBUGLEVEL_LAB', 'Nivel de Depuracion');
define('_TNML_DEBUGLEVEL_HLP', 'El Mailer le provee con las siguientes opciones de depuracion y los mensajes son SOLO vistos por un administrador logueado:<br /><br /><strong>DESACTIVADO</strong> = No hay depuracion (predeterminado)<br /><br /><strong>ACTIVADO, CON ENVIO</strong> = SOLO el administrador podra ver los mensajes de depuracion y aun enviara correos<br /><br /><strong>ACTIVADO, SIN ENVIO</strong> = SOLO el administrador podra ver los mensajes de depuracion, pero no se encviara ningun correo (aunque el sistema se comporte como i lo hubiera hecho)');
define('_TNML_SMTPHOST_LAB', 'Servidor SMTP');
define('_TNML_SMTPHOST_HLP', 'Especificar el servidor SMTP - ej. smtp.yourdomain.tld o mail.yourdomain.tld.<br /><br />La mayor&iacute;a de servicios de alojamiento viene con alg&uacute;n tipo de Panel de Control. Le recomendamos utilizar dicho panel de control para crear una nueva cuenta de correo en su servidor, que se utilizar&aacute; solamente para el env&iacute;o de mensajes (Utilice una contrase&ntilde;a diferente a la de su cuenta principal). Una vez configurado, o incluso si tienes que utilizar tu cuenta de correo principal, su Panel de Control deber&iacute;a tener la opci&oacute;n de mostrar las opciones de configuraci&oacute;n SMTP necesarias, incluso el nombre del servidor. De lo contrario, pregunta por los ajustes necesarios del servidor SMTP.');
define('_TNML_SMTPHELO_LAB', 'SMTP Helo');
define('_TNML_SMTPHELO_HLP', 'Especificar el SMTP Helo.<br /><br />Usualmente igual al Servidor SMTP.  Prueba poniendo lo mismo y si no funciona, consulta tu servicio de alojamiento.');
define('_TNML_SMTPPORT_LAB', 'Puerto SMTP');
define('_TNML_SMTPPORT_HLP', 'Especificar puerto SMTP.<br /><br />Usualmente 25, puede requerirse un puerto diferente. <strong>NOTA:</strong> Este mailer actualmente no soporta conexiones seguras (SSL), que no deben ser confundidas con conexiones autenticadas!');
define('_TNML_SMTPAUTH_LAB', 'Autenticaci&oacute;n SMTP');
define('_TNML_SMTPAUTH_HLP', 'Activar autenticaci&oacute;n SMTP.<br /><br />La mayor&iacute;a de servidores requieren que se les proporcione la autenticaci&oacute;n de usuario y contrase&ntilde;a, que deber&iacute;a ser la cuenta de correo electr&oacute;nico y la contrase&ntilde;a de la nueva cuenta que acabas de crear, o podr&iacute;a ser su principal cuenta de correo (no recomiendable).');
define('_TNML_SMTPUSER_LAB', 'Usuario SMTP');
define('_TNML_SMTPUSER_HLP', 'Especificar usuario SMTP.<br /><br />Suele ser igual a la cuenta de correo electr&oacute;nico configurada, o, dependiendo del Panel de Control y el Servidor SMTP, puede ser un poco diferente.<br /><br />Por ejemplo, si el usuario que configuraste se llama <strong>user</strong>, se pueden presentar las siguientes formas de nombre de usuario: <strong>user</strong>, <strong>user@yourdomain.tld</strong>, y <strong>user+yourdomain.tld</strong>.<br /><br />Si esto no funciona, puede contactar su servicio de alojamiento.');
define('_TNML_SMTPPASS_LAB', 'Contrase&ntilde;a SMTP');
define('_TNML_SMTPPASS_HLP', 'Especicar contrase&ntilde;a del servidor SMTP.<br /><br />Escr&iacute;belo tal como lo configuraste.');
define('_TNML_SMTPENCRYPT_LAB', 'Usar cifrado?');
define('_TNML_SMTPENCRYPT_HLP', 'Si tu servicio SMTP es capaz de usar sesiones cifradas, es altamente recomendable utilizarlas.  Tan solo asegurate que el metodo seleccionado esta soportado y que el puerto SMTP mas arriba es tambien el apropiado.');
define('_TNML_SMTPENCRYPTMETHOD_LAB', 'Metodo de Cifrado');
define('_TNML_SMTPENCRYPTMETHOD_HLP', 'Si se va a utilizar cifrado, puedes escoger entre SSL o TLS.');
define('_TNML_SENDMAIL_LAB', 'Ruta para Sendmail');
define('_TNML_SENDMAIL_HLP', 'Ruta absoluta para usar Sendmail.<br /><br />Ser&iacute;a raro que su servidor requiera usar este demonio porque, en nuestra opini&oacute;n, puede ser f&aacute;cilmente explotado si no se configura correctamente. Pero, en caso de necesitarlo, aqu&iacute; est&aacute;. Si la ruta por defecto no funciona, puede preguntar a su servicio de alojamiento la ruta correcta.');
