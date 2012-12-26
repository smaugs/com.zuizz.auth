<?php
ZU::load_interface('zuizz.auth','auth');
class ZUAUTH implements ZUAUTH_interface{
	var $is_authenticated = FALSE;
	var $auth_failure = FALSE;
/*
 * Die ZUAUTH classe ist eine Implementierung des Auth interfaces
 * Hier wird die Authentification erledigt, die rechte zum entsprechenden login werden in ./class.zuizz.permissions.php erledigt
 *
 */
	function __construct(){

	}

	public function login($username, $credentials) {
		if (isset ( $username ) && isset ($credentials)) {

            $tmp = ORM::for_table('org_user')->where('name', $username)->find_one()->as_array();

			if ($username == $tmp['name'] && $tmp['password'] == md5 ( $GLOBALS ['ZUIZZ']->config->system ['salt'] . $credentials . $GLOBALS ['ZUIZZ']->config->system ['salt'] )) {
				$_SESSION ['ZUIZZ'] ['AUTH'] ['is_auth'] = TRUE;
				$_SESSION ['ZUIZZ'] ['AUTH'] ['username'] = $username;
				$_SESSION ['ZUIZZ'] ['AUTH'] ['uid'] = $tmp['user_id'];
				$_SESSION ['ZUIZZ'] ['AUTH'] ['contact'] = $tmp['contact_id'];
				$_SESSION ['ZUIZZ'] ['AUTH'] ['org'] = $tmp['org_id'];
				$this->is_authenticated = TRUE;
				// Permission reinitialisieren
				$GLOBALS['ZUIZZ']->perm->init ();
				return true;
			} else {
				$this->auth_failure = TRUE;
				unset ( $_SESSION ['ZUIZZ'] ['AUTH'] );
				unset ( $_SESSION ['ZUIZZ'] ['PERM'] );
				return false;
			}

		} else {
			unset ( $_SESSION ['ZUIZZ'] ['AUTH'] );
			unset ( $_SESSION ['ZUIZZ'] ['PERM'] );
			return false;
		}

	}


	// on NULL return user_id of logged in user
    public function get_user_id($username = NULL){
	    if(isset($username)){
		    // TODO user_id des entsprechenden users zurückgeben wenn bestimmter username verlangt wird
	    }else {
	    	$_SESSION ['ZUIZZ'] ['AUTH'] ['uid'];
	    }
    }

    // on NULL return user_name of logged in user
    public function get_user_name($user_id = NULL){
    if(isset($user_id)){
		    // TODO get_user_name des entsprechenden users zurückgeben wenn bestimmter username verlangt wird
	    }else {
	    	$_SESSION ['ZUIZZ'] ['AUTH'] ['username'];
	    }
    }

    // Logout
    public function logout(){
    	// rechte zurücksetzen
    	unset ( $_SESSION ['ZUIZZ'] );
        session_destroy();
    }

};