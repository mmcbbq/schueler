<?php

namespace App\Controller;
use App\Entity\Schueler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchuelerController extends AbstractController
{
    #[Route('/')]
    public function schueler() :Response
    {
        return new Response('Hallo Welt');
    }

//    #[Route('/show/{id}')]
//    public function show(int $id, EntityManagerInterface $entityManager) :Response
//    {
//        $repository = $entityManager->getRepository(Schueler::class);
//        $schueler = $repository->find($id);
//
//        return new Response('Hallo '.$schueler->getNachname());
//    }


    #[Route('/createschueler')]
    public function createschueler (EntityManagerInterface $entityManager) :Response
    {
        $neuerSchueler = new Schueler();
        $neuerSchueler->setNachname('Doe');
        $neuerSchueler->setEmail('Doe@joe.de');
        $neuerSchueler->setTelefonNummer('0123456');
        $neuerSchueler->setKommentar('Ist ein Joe');

        $entityManager->persist($neuerSchueler);
        $entityManager->flush();


        return new Response('Schüler '.$neuerSchueler->getNachname() .' hinzugefügt');
}

    #[Route('/show/{id}')]
    public function showschueler (Schueler $schueler):Response
    {


        return $this->render('schueler/show.html.twig',[
            'schueler'=> $schueler
        ]);
    }
    #[Route('update/{id}')]
    public function update(Schueler $schueler, EntityManagerInterface $entityManager)
    {
        $schueler->setNachname('karl');
        $entityManager->persist($schueler);
        $entityManager->flush();
        return new Response('dein name ist jetzt' .$schueler->getNachname());

    }

}