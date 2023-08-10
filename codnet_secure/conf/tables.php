<?php
/**
 * se define el esquema de la bbdd.
 * 
 * @author bernardo
 * @since 12-04-2011
 * 
 */

/* cdt_action_function */
define( 'CDT_SECURE_TABLE_CDTACTIONFUNCTION', 'cdt_action_function', true);
define( 'CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_ACTIONFUNCTION', 'cd_actionfunction', true);
define( 'CDT_SECURE_TABLE_CDTACTIONFUNCTION_CD_FUNCTION', 'cd_function', true);
define( 'CDT_SECURE_TABLE_CDTACTIONFUNCTION_DS_ACTION', 'ds_action', true);

/* cdt_user */
define( 'CDT_SECURE_TABLE_CDTUSER',  'cdt_user', true);
define( 'CDT_SECURE_TABLE_CDTUSER_CD_USER',  'cd_user', true);
define( 'CDT_SECURE_TABLE_CDTUSER_DS_USERNAME',  'ds_username', true );
define( 'CDT_SECURE_TABLE_CDTUSER_DS_NAME',  'ds_name', true );
define( 'CDT_SECURE_TABLE_CDTUSER_DS_EMAIL',  'ds_email', true );
define( 'CDT_SECURE_TABLE_CDTUSER_DS_PASSWORD',  'ds_password', true );
define( 'CDT_SECURE_TABLE_CDTUSER_CD_USERGROUP',  'cd_usergroup', true );
define( 'CDT_SECURE_TABLE_CDTUSER_DS_PHONE',  'ds_phone', true );
define( 'CDT_SECURE_TABLE_CDTUSER_DS_ADDRESS',  'ds_address', true );
define( 'CDT_SECURE_TABLE_CDTUSER_DS_IPS',  'ds_ips', true );
define( 'CDT_SECURE_TABLE_CDTUSER_NU_ATTEMPS',  'nu_attemps', true );

/* cdt_usergroup */
define( 'CDT_SECURE_TABLE_CDTUSERGROUP', 'cdt_usergroup', true);
define( 'CDT_SECURE_TABLE_CDTUSERGROUP_CD_USERGROUP', 'cd_usergroup', true);
define( 'CDT_SECURE_TABLE_CDTUSERGROUP_DS_USERGROUP', 'ds_usergroup', true);

/* cdt_function */
define( 'CDT_SECURE_TABLE_CDTFUNCTION', 'cdt_function', true);
define( 'CDT_SECURE_TABLE_CDTFUNCTION_CD_FUNCTION', 'cd_function', true);
define( 'CDT_SECURE_TABLE_CDTFUNCTION_DS_FUNCTION', 'ds_function', true);

/* cdt_usergroup_function */
define( 'CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION', 'cdt_usergroup_function', true);
define( 'CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUPFUNCTION', 'cd_usergroup_function', true);	
define( 'CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_USERGROUP', 'cd_usergroup', true);	
define( 'CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION_CD_FUNCTION', 'cd_function', true);	

/* cdt_menugroup */
define( 'CDT_SECURE_TABLE_CDTMENUGROUP', 'cdt_menugroup', true);
define( 'CDT_SECURE_TABLE_CDTMENUGROUP_CD_MENUGROUP', 'cd_menugroup', true);
define( 'CDT_SECURE_TABLE_CDTMENUGROUP_DS_NAME', 'ds_name', true);
define( 'CDT_SECURE_TABLE_CDTMENUGROUP_NU_ORDER', 'nu_order', true);
define( 'CDT_SECURE_TABLE_CDTMENUGROUP_NU_WIDTH', 'nu_width', true);
define( 'CDT_SECURE_TABLE_CDTMENUGROUP_DS_ACTION', 'ds_action', true);
define( 'CDT_SECURE_TABLE_CDTMENUGROUP_DS_CSSCLASS', 'ds_cssclass', true);

/* cdt_menuoption */
define( 'CDT_SECURE_TABLE_CDTMENUOPTION', 'cdt_menuoption', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUOPTION', 'cd_menuoption', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_DS_NAME', 'ds_name', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_DS_HREF', 'ds_href', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_CD_FUNCTION', 'cd_function', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_NU_ORDER', 'nu_order', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_CD_MENUGROUP', 'cd_menugroup', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_DS_CSSCLASS', 'ds_cssclass', true);
define( 'CDT_SECURE_TABLE_CDTMENUOPTION_DS_DESCRIPTION', 'ds_description', true);

/* cdt_registration */
define( 'CDT_SECURE_TABLE_CDTREGISTRATION', 'cdt_registration', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_CD_REGISTRATION', 'cd_registration', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DS_ACTIVATIONCODE', 'ds_activationcode', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DT_DATE', 'dt_date', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DS_USERNAME', 'ds_username', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DS_NAME', 'ds_name', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DS_EMAIL', 'ds_email', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DS_PASSWORD', 'ds_password', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DS_PHONE', 'ds_phone', true);
define( 'CDT_SECURE_TABLE_CDTREGISTRATION_DS_ADDRESS', 'ds_address', true);

?>