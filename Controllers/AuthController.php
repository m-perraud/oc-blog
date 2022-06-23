<?php

namespace Controllers;

use Repository\UserRepository;



class AuthController extends Controller
{

    public $adminLogin;
    public $adminPW;
    public $loginPost;
    public $passwordPost;

    public function loginForm()
    {
        $loginPost = $_POST['username'];
        $passwordPost = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $userRepository = new UserRepository();
        $users = $userRepository->verifyAdminLogin($loginPost, $passwordPost);

        if (isset($loginPost) &&  isset($passwordPost)) {
            foreach ($users as $user) {
                if (
                    $user->getAdminLogin() === $loginPost
                    &&
                    $user->getAdminPW() === $passwordPost
                    &&
                    $user->getAdminStatus() == 1
                ) {
                    $_SESSION['auth'] = true;
                    $_SESSION['login'] = $loginPost;
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

            // Delete the session vars by clearing the $_SESSION array
            $_SESSION = array();

            // Delete the session cookie by setting its expiration to an hour ago (3600)
            if (isset($_COOKIE[session_name()])) {      setcookie(session_name(), '', time() - 3600);    }

            // Destroy the session
            session_destroy();
            } 

        // Redirect to the home page
        header('Location: /');
    }

    public function registUser()
    {

        $registerLogin = $_POST['username'];
        $registerPW = password_hash($_POST['password'], PASSWORD_ARGON2I);
        $registerMail = strip_tags($_POST['email']);

        $userRepository = new UserRepository();

        if($_POST && isset($registerLogin) && isset($registerPW) && isset($registerMail))
        {

            $user = $userRepository->registerUser($registerLogin, $registerPW, $registerMail);

            $success = 'Votre demande d\'inscription a été envoyée aux administrateurs. Vous serez recontacté(e) sous peu.'; 
            return $this->twig->display('register.html.twig', 
                [
                    'success' => $success
                ]);
            }

            $this->twig->display('login.html.twig');
    }

}

