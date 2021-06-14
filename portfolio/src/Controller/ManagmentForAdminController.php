<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagmentForAdminController extends AbstractController
{
    /**
     * @Route("/managmentforadmin", name="managment_for_admin")
     */
    public function index(): Response
    {
        return $this->render('managment_for_admin/index.html.twig', [
            'controller_name' => 'ManagmentForAdminController',
        ]);
    }
}
