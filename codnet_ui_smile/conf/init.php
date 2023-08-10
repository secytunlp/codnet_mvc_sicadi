<?php

include_once('templates.php');
include_once('messages.php');


//layout que utilizan las acciones que muestran un panel de control.
define ( 'DEFAULT_PANEL_LAYOUT', 'LayoutSmilePanel', true );

//layout que utilizan las acciones comunes.
define ( 'DEFAULT_LAYOUT', 'LayoutSmile', true );

//layout para el login.
define ( 'DEFAULT_LOGIN_LAYOUT', 'LayoutSmileLogin', true );

//layout para los popups.
define ( 'DEFAULT_POPUP_LAYOUT', 'LayoutSmilePopup', true );

//template para los listados.
define ( 'DEFAULT_LISTAR_TEMPLATE', CDT_UI_SMILE_TEMPLATE_LISTAR, true );
define ( 'DEFAULT_BUSCAR_TEMPLATE', CDT_UI_SMILE_TEMPLATE_SELECCIONAR, true );


?>