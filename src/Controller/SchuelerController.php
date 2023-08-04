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
  public function schueler(): Response
  {
    return new Response('Hallo Welt');
  }

  //info CREATE
  #[Route('/create')]
  public function createSchueler(EntityManagerInterface $entityManager):Response
  {
    $schueler = new Schueler();
    $schueler->setVorname('Bibo');
    $schueler->setNachname('Bird');
    $schueler->setTelefonNummer('35744833');
    $schueler->setEmail('B@bird.live');
    $schueler->setKommentar('Sesamschule');
    $entityManager->persist($schueler);
    $entityManager->flush();
    return new Response('schueler created');
  }

  //info READ
  #[Route('/show/{id}', name: 'show')]
  public function show(Schueler $schueler, EntityManagerInterface $em):Response
  {
    return $this->render('schueler/show.html.twig', ['name' => $schueler]);
  }

  #[Route('/showAll')]
  public function showAll(EntityManagerInterface $em):Response
  {
    $repo = $em->getRepository(Schueler::class);
    $schueler = $repo->findAll();
//    $schueler = ['grobi', 'bibo', 'erik', 'samson', 'ernie', 'bert'];
   return $this->render('showAll.html.twig', ['schuelers' => $schueler]);
  }

  //info UPDATE
  #[Route('/update/{id}')]
  public function updateSchueler(Schueler $schueler, EntityManagerInterface $entityManager):Response
  {
    $old = $schueler->getNachname();
    $schueler->setNachname('erik');
    $entityManager->persist($schueler);
    $entityManager->flush();
    return new Response($old . ' heisst jetzt ' . $schueler->getNachname());
  }

  //info DELETE
  #[Route('/delete/{id}')]
  public function deleteSchueler(Schueler $schueler, EntityManagerInterface $entityManager):Response
  {
    $old = $schueler->getNachname();
    $entityManager->remove($schueler);
    $entityManager->flush();
    return new Response("0Schueler $old gelöscht");
  }
}



  //info READ
//  #[Route('/show/{slug}')]
//  public function show(int $slug, EntityManagerInterface $entityManager): Response
//  {
//    $repo = $entityManager->getRepository(Schueler::class);
//    $schueler = $repo->find($slug);
//    return new Response('show datensatz ' . $schueler->getNachname());
//  }
