<?php

namespace App\Controller\Api;

use App\Controller\AppController;

class UsersController extends AppController
{

    public function add()
    {
        $this->set('_serialize', 'data');
        $this->set('data', ['status' => 'OK']);
    }

}
