<?php
///////////////////////////////////////////////////////////////////////
// GCalendar for PHP-Nuke 7.6 (with Chatserv patches) through 8.0
// Copyright (C) 2007 Brian Neal
// Author: Brian Neal bgneal@gmail.com
// 
// admin language/lang-spanish.php - This file is part of GCalendar
///////////////////////////////////////////////////////////////////////
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
///////////////////////////////////////////////////////////////////////
// 
// Admin language file; spanish.
// Translation by Juan Cabezas Moreno.
// 
///////////////////////////////////////////////////////////////////////

define('_ADMIN_TITLE',        'Panel de administración de GCalendar');
define('_ADMIN_DENIED',       'No tienes permisos para administrar este módulo.');
define('_ADMIN_APPROVE',      'Eventos pendietnes de aprobación ');
define('_ADMIN_ADD_EVENT',    'Añadir evento ');
define('_ADMIN_EDIT_CONFIG',  'Opciones');
define('_ADMIN_EDIT_CAT',     'Categorías');
define('_ADMIN_EDIT_EVENTS',  'Editar eventos');

define('_CONF_YES',  'Si');
define('_CONF_NO',   'No');
define('_NONE_SELECTED',      'No has seleccionado envento/s para eliminar');
define('_CONFIRM_DELETE',     '¿Realmente quieres borrar los eventos seleccionados?');
define('_EVENTS_DEL_ERR',     'Se produjo un error al eliminas el/los evento(s)!');

define('_NO_PENDING_EVENTS',  'No hay ningún evento que necesite aprobación en este momento.');
define('_NO_EVENTS',          'Ningún evento aprobado en este momento.');
define('_EVENT_ID',           'ID');
define('_EVENT_START_DATE',   'Fecha de inicio');
define('_EVENT_TITLE',        'Título');
define('_EVENT_SUBMITTER',    'Enviado por');
define('_EVENT_ACTIONS',      'Acciones');
define('_EVENT_SELECT',       'Seleccionar');

define('_VIEW_TITLE',         'Ver evento');
define('_EDIT_TITLE',         'Editar/Aprobar evento');
define('_DEL_SELECTED',       'Eliminar eventos seleccionados');
define('_SELECT_ALL',         'Seleccionar todos');
define('_SELECT_NONE',        'No seleccionar ninguno');
define('_SORT_BY_TITLE',      'tecleo a la clase por esta columna');

define('_ADMIN_FORM_EDIT_TITLE', 'Editar evento: ');
define('_ADMIN_FORM_ADD_TITLE',  'Añadir evento: ');

define('_ADMIN_SUBMIT_LABEL', 'Actualizar evento');
define('_ADMIN_ADD_LABEL',    'Añadir evento');

define('_ADMIN_VIEW_EVENT',   'Viendo evento número: ');
define('_ADMIN_EDIT_EVENT',   'Editando evento número: ');
define('_ADMIN_UPDATE_EVENT', 'Actualizando evento número: ');
define('_ADMIN_CONFIRM_DEL',  '¿Estás realmente seguro de eliminar evento/s? #%d?');
define('_ADMIN_DELETE_OK',    'Se eliminaron correctamente los eventos señalados #');
define('_ADMIN_DELETE_ERR',   'Error al eliminar eventos/s #');
define('_ADMIN_UPDATE_ERR',   'Error al actualizar evento #');
define('_ADMIN_ADD_OK',       'El evento se añadió correctamente');
define('_ADMIN_ADD_ERR',      'Error al añadir el evento');

define('_CURRENT_CATS',       'Lista de categorías existentes: ');
define('_MODIFY_BUTTON',      'Modificar categiría seleccionada: ');
define('_DELETE_BUTTON',      'Eliminar categoría seleccionada: ');
define('_ADD_BUTTON',         'Añadir categoría ');
define('_CONFIRM_DELETE_CAT', '¿Realmente deseas eliminar esta categoría? ');
define('_NO_ADD_TEXT',        'Especifica el nombre de la categoría ');

define('_ADMIN_PURGE_RESULTS',   'Se elimnaron eventos caducados ');
define('_PURGE_BUTTON_TEXT',  'Eliminar eventos caducados ');
define('_PURGE_CONFIRM_HELP', 
   '¿Realmente deseas eliminar acontecimientos caducados?. Esto borrará de la base de datos todos los acontecimientos sin repetición aprobados hasta la fecha de hoy.' .
   ' * * * ');
define('_ADMIN_DB_OK',     'Correcto');
define('_ADMIN_DB_ERR',    'Error de la base de datos');

define('_ADMIN_CONFIG_FORM_TITLE',  'Editar opciones de configuración : ');
define('_ADMIN_CONFIG_TITLE',       'Título: ');
define('_ADMIN_CONFIG_IMAGE',       'Imagen: ');
define('_ADMIN_CONFIG_IMAGE_TIP',   'Opcional; ruta de la imagen que se utilizará para el calendario');
define('_ADMIN_CONFIG_MIN_YEAR',    'Año de inicio del calendario:          ');
define('_ADMIN_CONFIG_MAX_YEAR',    'Año de de finalización del calendario: ');
define('_ADMIN_CONFIG_UPDATE',      'Guardar opciones');
define('_ADMIN_CONFIG_YEAR_TIP',    'Rango seguro: 1902-2037 para servidores Unix; 1970-2037 para servidores Windows');
define('_ADMIN_CONFIG_USER_SUBMIT', 'Permisos de uso: ');
define('_ADMIN_CONFIG_USER_SUBMIT_TIP', 'Control para envío de eventos');
define('_ADMIN_CONFIG_REQ_APP',     '¿Los eventos enviados requieren aprobación?: ');
define('_ADMIN_CONFIG_SHORT_DATE_FORMAT', 'Formato de fecha corto:');
define('_ADMIN_CONFIG_REG_DATE_FORMAT',   'Formato de fecha regular:');
define('_ADMIN_CONFIG_LONG_DATE_FORMAT',  'Formato de fecha largo:');
define('_ADMIN_CONFIG_DATE_FORMAT_EX',    '(Leer el manual)');
define('_ADMIN_CONFIG_FIRST_DAY_WEEK',    'Primer día de la semana:');
define('_ADMIN_CONFIG_WEEKENDS',    'Weekend Days:');
define('_ADMIN_CONFIG_TIME_FORMAT', 'Formato de Tiempo:');
define('_ADMIN_CONFIG_TAGS',        'Permitido HTML Tags:');
define('_ADMIN_CONFIG_TAGS_TIP',    'Introduce los nombres separados por comas para HTML tags');
define('_ADMIN_CONFIG_ATTRS',       'Permitido HTML Tag atributos:');
define('_ADMIN_CONFIG_ATTRS_TIP',   'Introduce los nombres separados por comas para HTML tag atributos');
define('_ADMIN_CONFIG_AUTO_LINK',   'Enable Auto-Links:');
define('_ADMIN_CONFIG_LOC_REQ',     'Event Location Field Required:');
define('_ADMIN_CONFIG_DETAILS_REQ', 'Event Details Field Required:');
define('_ADMIN_CONFIG_EMAIL_NOTIFY', 'Email Notification of New Events:');
define('_ADMIN_CONFIG_EMAIL_TO', 'Email To Addresses:');
define('_ADMIN_CONFIG_EMAIL_TO_TIP', 'Enter a comma separated list of email addresses');
define('_ADMIN_CONFIG_EMAIL_FROM', 'Email From Address:');
define('_ADMIN_CONFIG_EMAIL_SUBJECT', 'Email Subject:');
define('_ADMIN_CONFIG_EMAIL_MSG', 'Email Message:');
define('_ADMIN_CONFIG_CAT_LEGEND', 'Show Category Legend:');

define('_SUBMIT_OFF',      'Nadie');
define('_SUBMIT_MEMBERS',  'Miembros solamente');
define('_SUBMIT_ANYONE',   'Cualquiera');

define('_ADMIN_EDIT_EVENT_LINK', 'Editar este evento');

define('_CATEGORY_ID', 'Category ID:');

define('_ADMIN_CONFIG_WYSIWYG', 'Use RavenNuke Editor:');
define('_ADMIN_CONFIG_USER_UPDATE', 'Users Can Update Their Events:');

define('_ADMIN_GOTO_MODULE', 'Go To GCalendar Module');
define('_RSVP_OFF',        'Off');
define('_RSVP_ON',         'On');
define('_RSVP_ON_EMAIL',   'On with email notifications');
define('_ADMIN_CONFIG_RSVP',  'RSVP:');
define('_ADMIN_CONFIG_RSVP_SUBJECT', 'RSVP Email Subject:');
define('_GCAL_RSVP_ADMIN_TITLE', 'Edit RSVP');
define('_GCAL_ADMIN_EDIT_RSVP', 'Edit RSVP Information for Event #');
define('_GCAL_DEL_RSVP', 'Delete Selected Users From RSVP List');
define('_GCAL_EMPTY_RSVP_LIST', 'No one on the RSVP list');
define('_GCAL_DEL_RSVP_CONFIRM', 'Are you sure you want to remove the selected users from the RSVP list?');
define('_GCAL_ADMIN_ABOUT', 'About');
define('_GCAL_ADMIN_ABOUT_TEXT', 'GCalendar is Copyright &copy; 2007 by Brian Neal');
define('_GCAL_ADMIN_ABOUT_TEXT2', 'GCalendar is free software released under the GNU GPL. See the file COPYING ' .
   'in the GCalender distribution archive.');
define('_GCAL_ADMIN_ABOUT_TEXT3', 
   'Please read the included manual for instructions, a full list of credits, and licensing information.<br />' .
   'For support, please visit the <a href="http://sourceforge.net/projects/gcalendar-nuke/">GCalendar for PHP-Nuke' .
   ' Support Website</a>.');
define('_GCAL_ADMIN_ABOUT_TEXT4', 'If you find GCalender useful, please consider making a donation!');
define('_GCAL_ADMIN_DONATE', 'Donate to GCalendar');

define('_SUBMIT_GROUPS',   'Groups');
define('_ADMIN_GROUPS',    'Groups');
define('_ADMIN_NO_GROUPS', 'You don\'t have NSN Groups installed or you don\'t have any groups yet.');
define('_ADMIN_GROUP_PERM_LABEL', 'Group Permissions: ');
define('_ADMIN_GROUP_PERM_GROUP', 'Group');
define('_ADMIN_GROUP_PERM_SUBMIT', 'Can Submit Events');
define('_ADMIN_GROUP_PERM_APPROV', 'Events do not require approval');
define('_ADMIN_GROUP_PERM_SAVE', 'Save');
define('_ADMIN_GROUP_SUBMIT_NOTE', 'Only applies if the \'User Submissions\' option is set to \'Groups\'');
define('_ADMIN_GROUP_CAT_LABEL', 'Category Assignments: ');
define('_ADMIN_GROUP_CAT_EXPLANATION', 
   'Categories can be assigned to groups; in which case only group members can see events in those categories. ' .
   'If a category is not assigned to any group, it is visible to all. ' .
   'Multiple groups can be assigned to a category (shift- or ctrl-click the groups).');
define('_ADMIN_GROUP_CAT_COMBO', 'Category:');
define('_ADMIN_GROUP_CAT_GROUPS', 'Assigned Groups:');
define('_ADMIN_GROUP_CAT_SAVE', 'Update Category');
?>
