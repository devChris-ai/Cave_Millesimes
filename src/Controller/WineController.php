<?php

namespace App\Controller;

use App\Repository\WineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WineController extends AbstractController
{
    /**
     * @Route("/customer/wines", name="wines")
     */
    public function index(WineRepository $repo): Response
    {
        $wines = $repo->findAll();
        return $this->render('wine/wines.html.twig',[
            "wines" => $wines
        ]);
    }
}
