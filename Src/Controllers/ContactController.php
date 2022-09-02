<?php 

namespace Controllers; 

use Repository\PostsRepository;
use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends Controller
{
    public function contact()
    {
        $postsRepository = new PostsRepository(); 
        $posts = $postsRepository->getLastPosts();
        return $this->twig->display('contact.html.twig', [
            'posts' => $posts
        ]);
    }

    public function sendMail() 
        {

            $mailName = $_POST['name'];
            $mailEmail = $_POST['email'];
            $mailSubject = $_POST['subject'];
            $mailMessage = $_POST['message'];

            //dd($_POST);

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.sendinblue.com';
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ));
            $mail->SMTPAuth = true;
            $mail->Username = 'm.perr.test@gmail.com';
            $mail->Password = 'Q659ZHyp1qAJtRFr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->setFrom('m.perr.test@gmail.com');
            $mail->addAddress('m.perr.test@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = $mailSubject;
            $mail->Body    = $mailMessage;



        if (isset($mailName) &&  isset($mailEmail) && isset($mailSubject) && isset($mailMessage)){
            if(!$mail->send()) {
                echo "Error while sending Email.";
                var_dump($mail);
            } else {
                $success = 'Votre email a bien été envoyé.';
                return $this->twig->display('index.html.twig', [
                    'success' => $success
                ]);
            }
        }
    }



}