<?php

namespace App\Controller;

use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Notification\Notification;
use App\Entity\Text;
use App\Form\TextType;
use App\Repository\TextRepository;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class VerifyController extends AbstractController
{
    /**
     * @Route("/verify", name="verify")
     * @param TextRepository $repository
     * @return Response
     */

    public function index(TextRepository $repository): Response
    {

        $texts = $repository->findAllVisible();
        return $this->render('verify/index.html.twig', [
            'texts' => $texts
        ]);
    }
    /**
     * @Route("/verify/{id}", name="verify.text.edit")
     * @param Text $text
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Text $text, Request $request)
    {
        $form = $this->createForm(TextType::class, $text);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('verify');
        }

        return $this->render('verify/edit.html.twig', [
            'text' => $text,
            'form' => $form->createView()
        ]);
    }
}
