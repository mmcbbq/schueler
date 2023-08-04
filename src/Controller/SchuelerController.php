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
  #[Route('/createSchueler')]
  public function createSchueler(EntityManagerInterface $entityManager):Response
  {
    $schueler = new Schueler();
    $schueler->setNachname('grobi');
    $schueler->setTelefonNummer('64833');
    $schueler->setEmail('g@r.org');
    $schueler->setKommentar('sesamstrasse');
    $entityManager->persist($schueler);
    $entityManager->flush();
    return new Response('schueler created');
  }

  //info READ
//  #[Route('/show/{slug}')]
//  public function show(int $slug, EntityManagerInterface $entityManager): Response
//  {
//    $repo = $entityManager->getRepository(Schueler::class);
//    $schueler = $repo->find($slug);
//    return new Response('show datensatz ' . $schueler->getNachname());
//  }

  //info READ
  #[Route('/schuelertest/{id}')]
  public function readSchueler(Schueler $schueler):Response
  {
    return new Response('Hallo '.$schueler->getNachname());
  }

  //info UPDATE
  #[Route('/updateSchueler/{id}')]
  public function updateSchueler(Schueler $schueler, EntityManagerInterface $entityManager):Response
  {
    $old = $schueler->getNachname();
    $schueler->setNachname('erik');
    $entityManager->persist($schueler);
    $entityManager->flush();
    return new Response($old . ' heisst jetzt ' . $schueler->getNachname());
  }

  //info DELETE
  #[Route('/deleteSchueler/{id}')]
  public function deleteSchueler(Schueler $schueler, EntityManagerInterface $entityManager):Response
  {
    $old = $schueler->getNachname();
    $entityManager->remove($schueler);
    $entityManager->flush();
    return new Response("0Schueler $old gelöscht");
  }
}
