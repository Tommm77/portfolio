<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Notification\Notification;
use App\Entity\Text;
use App\Form\TextType;
use App\Repository\TextRepository;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;



class PortfolioController extends AbstractController
{
    /**
     * @Route("/", name="portfolio")
     * @param TextRepository $repository
     * @return Response
     */

    public function presentation(TextRepository $repository)
    {

        $presentation = $repository->findBy(['code' => 'presentation']);
        $formation = $repository->findBy(['code' => 'formation']);
        $metier = $repository->findBy(['code' => 'metier']);
        return $this->render('portfolio/home.html.twig', [
            'presentation' => $presentation,
            'formation' => $formation,
            'metier' => $metier
        ]);
    }

    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('portfolio/home.html.twig');
    }
}
