<?php 

namespace Controllers; 

use Utils\Constant;
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

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = Constant::SMTP_HOST;
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ));
            $mail->SMTPAuth = true;
            $mail->Username = Constant::SMTP_USERNAME;
            $mail->Password = Constant::SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->setFrom(Constant::SMTP_SETFROM);
            $mail->addAddress(Constant::SMTP_ADDADRESS);
            $mail->isHTML(true);
            $mail->Subject = $mailSubject;
            $mail->Body    = $mailName .' '. $mailEmail .' '. $mailMessage;



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