<?php 
/* 
 * Terminate Session - Logout
 * Terminate Session (Logout)
 *
 *
 * @author 
 * @package com.zuizz.auth
 * @subpackage 
 *
 *
 *
 * Permissions / Roles 
 * User => Authentificated User can logout
 *
 *
 *
 * States 
 *
 * State 202  => 
 * Command accepted, session is deleted
 *
 *
 *
 * Available variables 
 *
 *
 *
 */

// your code somewhere here 




$this->load_class('zuizz.auth');
$auth = new ZUAUTH ();
$auth->logout();

$this->data['message'] = 'Session terminated';

ZU::header(202);

// set default mimetype
if (!$this->mimetype) {
    $this->mimetype = 'json';
}

switch ($this->mimetype) {
    case "json":
        header('Content-type: application/json');
        $this->contentbuffer = json_encode($this->data);
        break;
}

}