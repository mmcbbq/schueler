<?php

namespace App\Controller;



use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchuelerController
{
    #[Route('/')]
    public function schueler() :Response
    {
        return new Response('Hallo Welt');
    }

    #[Route('/show/{slug}')]
    public function show(int $slug ) :Response
    {
        return new Response('show datensatz '.$slug);
    }
}