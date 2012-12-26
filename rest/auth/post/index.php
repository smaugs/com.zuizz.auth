<?php
$this->load_class('zuizz.auth');
$auth = new ZUAUTH ();


$auth->login($this->values ['username'], $this->values ['credentials']);
$this->data['session_token'] = session_id();
$this->data['message'] = 'authentification OK';

if (!ZU::is_auth()) {
    ZU::header(401);
    $this->data['message'] = 'unknown username or bad password';
}

if (!$this->mimetype) {
    $this->mimetype = 'json';
}

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
