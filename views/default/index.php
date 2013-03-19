<?php
/*
 * Auth Dispatcher
 *
 * Redirect auf config ziel der Rolle
 *
 * Ansonsten wird die loginmaske dargestellt
 *
 *
 *
 */

$this->load_class('zuizz.auth');
$auth = new ZUAUTH ();

if (isset ($this->values ['username'])) {
    $auth->login($this->values ['username'], $this->values ['credentials']);
    $this->data ['auth_failed'] = !$auth->is_authenticated;
} else {
    $this->values ['username'] = "";
    $this->data ['auth_failed'] = FALSE;
}


$this->fetch();

