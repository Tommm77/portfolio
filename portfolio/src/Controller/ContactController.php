<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use ReCaptcha\ReCaptcha;

class ContactController extends AbstractController
{

    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer, ReCaptcha $recaptcha)
    {
        $secret = "6LfMtiEbAAAAAEQC1_WZFFV8nOGMZLTzwvOH4XC0";
        $gRecaptchaResponse = null;
        $remoteIp = null;
        $resp = $recaptcha->setExpectedHostname('recaptcha-demo.appspot.com')
            ->setExpectedAction('homepage')
            ->setScoreThreshold(0.5)
            ->verify($gRecaptchaResponse, $remoteIp);

        if ($resp->isSuccess()) {
            // Verified!
        } else {
            $errors = $resp->getErrorCodes();
        }
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('picout.tom@gmail.com')
                ->subject('vous avez reçu un email')
                ->text(
                    'Sender : ' . $contactFormData['email'] . \PHP_EOL .
                        $contactFormData['message'],
                    'text/plain'
                );
            $mailer->send($message);
            $this->addFlash('success', 'Vore message a été envoyé');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
