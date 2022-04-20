<?php 

namespace Controllers; 

use Source\Renderer;
use Models\User;

class HomeController
{
    public function index(): Renderer
    {
        $userModel = new User();
        $statement = $userModel->getPDO()->query('SELECT * FROM admin');

        foreach($statement->fetchAll() as $admin)
        {
            // dump($admin);
        }

        return Renderer::make('index');
    }
}

