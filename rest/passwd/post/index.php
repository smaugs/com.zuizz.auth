<?php

if (ZU::is_auth()) {
    // Update Password
    $user = ORM::for_table('org_user')->find_one($_SESSION['ZUIZZ']['AUTH']['uid']);
    $user->password =       md5($GLOBALS ['ZUIZZ']->config->system ['salt'] . trim($this->values['credentials']) . $GLOBALS ['ZUIZZ']->config->system ['salt']);

    ZU::log('Password changed',0,'Passwd',__FILE__,NULL,$this->feature_id,0);
    ZU::header(204);
    $this->data['message'] = 'Password updated';
} else {
    ZU::header(422);
    $this->data['message'] = 'This request is not acceptable';
}


if (!$this->mimetype) {
    $this->mimetype = 'json';
}

switch ($this->mimetype) {
    case "json":
        header('Content-type: application/json');

        $this->contentbuffer = json_encode($this->data);
        break;
}



