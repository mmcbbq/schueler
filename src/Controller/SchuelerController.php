<?php

namespace App\Controller;

use App\Entity\Schueler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchuelerController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function schueler() :Response
    {
        return new Response('Hallo Welt');
    }

    #[Route('/show/{id}', name: 'show')]
    public function showSchueler(Schueler $schueler, $id): Response
    {
        return $this->render('schueler/show.html.twig', ['schueler' => $schueler]);
    }

    #[Route('/createSchueler/', name: 'create')]
    public function createSchueler(EntityManagerInterface $entityManager): Response
    {
        $neuerSchueler = new Schueler();
        $neuerSchueler->setNachname('Feuerstein');
        $neuerSchueler->setEmail('f-stein@gmx.de');
        $neuerSchueler->setTelefonNummer('73737373737');
        $neuerSchueler->setKommentar('hello you');

        $entityManager->persist($neuerSchueler);
        $entityManager->flush();

        return new Response($neuerSchueler->getNachname());
    }

    #[Route('update/{id}', name: 'update')]
    public function update(Schueler $schueler, EntityManagerInterface $entityManager)
    {
        $schueler->setNachname('otto');
        $entityManager->persist($schueler);
        $entityManager->flush();

        return new Response('name ist jetzt: '.$schueler->getNachname());
    }

    #[Route('delete/{id}', name: 'delete')]
    public function delete(Schueler $schueler, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($schueler);
        $entityManager->flush();

        return new Response('ist gelöscht');
    }

    #[Route('/showAll', name: 'showAll')]
    public function showAllFromDb(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Schueler::class);
        $schuelers = $repository->findAll();

        return $this->render('schueler/showall.html.twig', ['schuelers' => $schuelers]);
    }
}
