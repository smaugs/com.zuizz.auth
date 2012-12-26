<?php

// redirect
if (ZU::is_auth() && isset($_SESSION ['ZUIZZ'] ['PERM'] ['ROLE'])) {
    // TODO:: redirect anhand User settings (last page?) implementieren


    $roles = $_SESSION ['ZUIZZ'] ['PERM'] ['ROLE'];

    foreach ($roles as $role) {
        if (isset($this->config ['redirects'] ['role'] [$role])) {
            $target = $this->config ['redirects'] ['role'] [$role];


            $orm = ORM::for_table('pages_tree');
            $orm->where('route',$target);
            $data = $orm->find_one();

            if($data){
            // recht auf zielpage prüfen
            if (ZU::check_permission(100, $data->get('page_id'), 1)) {
                header('Location: /' . $target);
            }

            }
        }

    }


}