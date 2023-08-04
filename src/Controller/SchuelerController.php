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

    #[Route('/schuelertest/{id}')]
    public function schuelertest (Schueler $schueler): Response
    {
        return new Response('Hallo' .$schueler->getNachname());
    }
    #[Route('update/{id}')]
    public function update(Schueler $schueler, EntityManagerInterface $entityManager): Response
    {
        $schueler->setNachname('karl');
        $entityManager->persist($schueler);
        $entityManager->flush();
        return new Response('dein name ist jetzt' .$schueler->getNachname());
    }

    #[Route('/delete/{id}')]
    public function delete(int $id, EntityManagerInterface $entityManager) :Response
    {
        $repository = $entityManager->getRepository(Schueler::class);
        $schueler = $repository->find($id);

        if ($schueler) {
            $entityManager->remove($schueler);
            $entityManager->flush();

            return new Response('Schüler '.$schueler->getNachname() .' wurde entfernt');
        }

        return new Response('Schüler nicht gefunden');
    }
}