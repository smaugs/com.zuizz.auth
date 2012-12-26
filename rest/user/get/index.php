<?php 
/* 
 * Receive User Details
 * Role Administrator can receive a list of users or detailed information for a user. Owner can receive detailed information about himself.
 *
 *
 * @author 
 * @package com.zuizz.auth
 * @subpackage 
 *
 *
 *
 * Permissions / Roles 
 * User => User can receive data about himself
 * Admin => Role admin can receive data for all users
 *
 *
 *
 * States 
 *
 * State 200  => 
 * Ok
 *
 * State 404  => 
 * User not found
 *
 *
 *
 * Available variables 
 *
 *
 *
 */

// your code somewhere here 



$this->data['message'] = "dont forget the message";







/* 
 * Mimetype json 
 * Returns:
 * Generic user information as array.
 * 
*/

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