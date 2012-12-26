<?php
/* 
 * Disable User
 * Disable or deactivate a user
 *
 *
 * @author 
 * @package com.zuizz.auth
 * @subpackage 
 *
 *
 *
 * Permissions / Roles 
 * Admin => Administrator can disable users but not himself
 *
 *
 *
 * States 
 *
 * State 202  => 
 * Ok, user is disabled
 *
 * State 422  => 
 * You can not disable yourself
 *
 *
 *
 * Available variables 
 *
 * userID
 * varname:identifier (int), always available:1
 *
 *
 *
 */

// your code somewhere here 

$this->values['identifier'];


$this->data['message'] = "dont forget the message";


switch ($this->mimetype) {
   case "json":
     header('Content-type: application/json');
     $this->contentbuffer = json_encode($this->data);
   break;
   case "xml":
     header('Content-type: application/xml');
     ZU::load_class('lalit.array2xml', 'xml', true);
     $xml = Array2XML::createXML('auth', $this->data);
     $this->contentbuffer = $xml->saveXML();
   break;
}