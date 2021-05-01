<?php

namespace App\Controller;

use App\Repository\WineRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WineController extends AbstractController
{
    /**
     * @Route("/customer/wines", name="wines")
     */
    public function index(WineRepository $repo,PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $wines = $paginatorInterface->paginate(
           $repo->findAllWithPagination(),
            $request->query->getInt('page', 1), /*page number*/
            6 /*inque le nombre d'éléments par page*/
        );
        return $this->render('wine/wines.html.twig',[
            "wines" => $wines
        ]);
    }
}
