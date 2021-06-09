<?php

namespace App\Service;

use app\Entity\User;
use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use App\Security\EmailVerifier;
use App\Service\sendEmail;
use App\Service\createUser;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;


class userManagment
{
    private $emailVerifier;

    public function __construct(EntityManagerInterface $entityManager, EmailVerifier $emailVerifier)
    {
        $this->entityManager = $entityManager;
        $this->emailVerifier = $emailVerifier;
    }
    public function createUser(User $user)
    {
        //$entityManager = $this->getDoctrine()->getManager();
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // do anything else you need here, like send an email
    }
    public function sendEmail(User $user)
    {
        $this->emailVerifier->sendEmailConfirmation(
            'app_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('picout.tom@gmail.com', 'MyEmail'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
        // do anything else you need here, like send an email
    }
}
