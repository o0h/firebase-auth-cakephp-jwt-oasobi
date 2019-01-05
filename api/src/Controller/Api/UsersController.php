<?php

namespace App\Controller\Api;

use ADmad\JwtAuth\Auth\JwtAuthenticate;
use App\Controller\AppController;
use App\Model\Table\UsersTable;

/**
 * Class UsersController
 * @package App\Controller\Api
 *
 * @property UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add']);

        $this->loadModel('Users');
    }

    public function add()
    {
        $user = $this->Auth->identify();
        if ($user){
            return $this->redirect('/users');
        }
        /** @var JwtAuthenticate $auth */
        $this->Auth->identify();
        $auth = $this->Auth->getAuthenticate('ADmad/JwtAuth.Jwt');
        $this->registerUser($auth->getPayload());
        $this->Auth->setUser(['User' => (array)$auth->getPayload()]);
        $this->set('_serialize', 'data');
        $this->set('data', $auth->getPayload());
    }

    private function registerUser($auth)
    {
        $user = $this->Users->newEntity([
            'sub' => $auth->sub,
            'provider' => $auth->firebase->sign_in_provider,
            'avatar_url' => $auth->picture,
            'name' => $auth->name,
        ]);

        return $this->Users->saveOrFail($user);
    }
}
