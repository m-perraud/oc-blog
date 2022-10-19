<?php

namespace Controllers;

use Repository\UserRepository;

class AuthController extends Controller
{

    public $adminLogin;
    public $adminPW;
    public $loginPost;
    public $passwordPost;



    public function registUser()
    {



        if($_POST && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']))
        {
            $userRepository = new UserRepository();

            $registerLogin = $_POST['username'];
            $registerPW = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $registerMail = strip_tags($_POST['email']);

            $message = 'Votre demande d\'inscription a été envoyée aux administrateurs. Vous serez recontacté(e) sous peu.';

            try {
                $user = $userRepository->registerUser($registerLogin, $registerPW, $registerMail);
            } catch (\PDOException $e) {
                    $message = "La création de compte n'a pas pue être exécutée.";
            }
        }

        
        return $this->twig->display('register.html.twig', 
                [
                    'message' => $message ?? "La création de compte n'a pas pue être exécutée."
                ]);

    }


    public function loginForm()
    {
        $loginPost = $_POST['username'];
        $passwordPost = $_POST['password'];

        $userRepository = new UserRepository();
        $users = $userRepository->verifyAdminLogin($loginPost);


        if (isset($loginPost) &&  isset($passwordPost)) {
            foreach ($users as $user) {
                if (
                    $user->getAdminLogin() === $loginPost
                    &&
                    password_verify($passwordPost, $user->getAdminPW())
                    &&
                    $user->getAdminStatus() == 1
                ) {
                    $_SESSION['auth'] = true;
                    $_SESSION['login'] = $loginPost;
                    $_SESSION['id'] = $user->getId();
                    return header('Location: /dashboard');
                }
                
                $error = 'L\'identifiant et/ou le mot de passe sont éronnés';
                return $this->twig->display('login.html.twig', 
            [
                'error' => $error
            ]);
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['auth'])) {

            $_SESSION = array();

            if (isset($_COOKIE[session_name()])) 
            {
                setcookie(session_name(), '', time() - 3600);
            }

            session_destroy();
            } 

        header('Location: /');
    }

}

