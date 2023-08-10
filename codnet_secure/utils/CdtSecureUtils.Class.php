<?php

/**
 * Utilidades para seguridad.
 *
 * @author bernardo
 * @since 01-06-2011
 */
class CdtSecureUtils{

	public static function login( CdtUser $oUser ){
		
		CdtUtils::cleanRequestError();
		
		/*
		$minutes = 30;
		if(defined("CDT_SECURE_SESION_LIFETIME"))
			$minutes = CDT_SECURE_SESION_LIFETIME;
			
		$mytimeout = $minutes * 60; // minutes * 60
		session_set_cookie_params($mytimeout);
		session_cache_expire($mytimeout / 60);
		session_start ();
		*/
		
		$_SESSION [APP_NAME]["ds_username"] = $oUser->getDs_username ();
		$_SESSION [APP_NAME]["ds_name"] = $oUser->getDs_name();
		$_SESSION [APP_NAME]["cd_user"] = $oUser->getCd_user ();
		$_SESSION [APP_NAME]["cd_usergroup"] = $oUser->getCd_usergroup(); 
		//dejamos en sessi�n las funciones que puede realizar el usuario (permisos).
		$_SESSION [APP_NAME]["functions"] = serialize( $oUser->getFunctions() ) ;
		
		
	}

	public static function logout() {
		$_SESSION [APP_NAME]['cd_user'] = null;
		unset ( $_SESSION [APP_NAME]['cd_user'] );
		unset ( $_SESSION [APP_NAME]['cd_usergroup'] );
		unset ( $_SESSION [APP_NAME]['functions'] );
		
		session_unset();
		session_destroy();
		
	}	
	
	public static function getUserLogged(){
		$oUser = new CdtUser();
		
		$data = CdtUtils::getParamSESSION(APP_NAME);
		$oUser->setCd_user( $data["cd_user"]);
		$oUser->setFunctions( unserialize( $data["functions"]) );
		$oUser->setDs_username( $data["ds_username"] );
		$oUser->setDs_name( $data["ds_name"] );
		$oUser->setCd_usergroup( $data["cd_usergroup"]);
		return $oUser;
	}

	public static function isUserLogged(){
		$data = CdtUtils::getParamSESSION(APP_NAME);
		
		$logueado =  ($data != "");
		
		if( $logueado ){
			$logueado = isset($data["cd_user"]) && !empty($data["cd_user"]); 
		}
		
		return $logueado;
	}
	
	public static function hasPermission( CdtUser $oUser, $cd_function ){
		$functions = $oUser->getFunctions();	
		
		$has = false;		
		if(!empty($cd_function)){						
			if(!empty($functions))
				foreach ($functions as $oFunction) {
					//echo $oFunction->getCd_function().' - '.$cd_function."<br>";	
					$has = ( $cd_function == $oFunction->getCd_function() );
					if($has) break;
				}			
		}else{
			$has = true;
		}
		return $has;
	}
}
