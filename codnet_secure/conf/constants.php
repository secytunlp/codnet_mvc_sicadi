<?php 

//login
define('CDT_SECURE_LOGIN_MAX_ATTEMPS', 5, true);

define("CDT_SECURE_LOGIN_ACTION", 'doAction?action=login', true);
define("CDT_SECURE_LOGIN_INIT_ACTION", 'login_init', true);
define("CDT_SECURE_ACCESS_DENIED_ACTION", 'login_init', true);

define('CDT_SECURE_LOGIN_TITLE', CDT_MVC_APP_TITLE, true);
define('CDT_SECURE_LOGIN_SUBTITLE', CDT_MVC_APP_SUBTITLE, true);


//registraciones
define('CDT_SECURE_REGISTRATION_ENABLED', true, true);
define('CDT_SECURE_REGISTER_TITLE', CDT_MVC_APP_TITLE, true);
define('CDT_SECURE_REGISTER_SUBTITLE', CDT_MVC_APP_SUBTITLE, true);
define("CDT_SECURE_REGISTRATION_LAYOUT", 'CdtLayoutBasic', true);
define("CDT_SECURE_ACTIVATE_REGISTRATION_ACTION", 'doAction?action=activate_registration', true);
define("CDT_SECURE_USERGROUP_DEFAULT_ID", 1, true);
define("CDT_SECURE_REGISTRATION_TERMS_LAYOUT", "CdtLayoutBasicAjax", true);

//recuperar clave
define("CDT_SECURE_FORGOT_PASSWORD_LAYOUT", 'LayoutSmileLogin', true);
define("CDT_SECURE_FORGOT_PASSWORD_INIT_ACTION", 'doAction?action=forgot_password_init', true);
define("CDT_SECURE_FORGOT_PASSWORD_ACTION", 'doAction?action=forgot_password', true);


?>