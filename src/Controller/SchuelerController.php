<?php

namespace App\Controller;



use App\Entity\Schueler;
use App\Form\SchuelerFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchuelerController extends AbstractController
{
  #[Route('/')]
  public function schueler(): Response
  {
    return $this->render('index.html.twig');
  }

  //info CREATE
  #[Route('/create', name: 'create_schueler')]
  public function createSchueler(Request $request, EntityManagerInterface $entityManager):Response
  {
    $neuerSchueler = new Schueler();

    $form = $this->createForm(SchuelerFormType::class, $neuerSchueler);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $neuerSchueler = $form->getData();
      $entityManager->persist($neuerSchueler);
      $entityManager->flush();
      return $this->redirect('showAll');
    }

    return $this->render('schueler/create.html.twig',[
      'form' => $form->createView()
    ]);
  }

  //info READ
  #[Route('/show/{id}', name: 'show')]
  public function show(Schueler $schueler, EntityManagerInterface $em):Response
  {
    return $this->render('schueler/show.html.twig', ['name' => $schueler]);
  }

  #[Route('/showAll', name:'showAll')]
  public function showAll(EntityManagerInterface $em):Response
  {
    $repo = $em->getRepository(Schueler::class);
    $schueler = $repo->findAll();
   return $this->render('schueler/showAll.html.twig', ['schuelers' => $schueler]);
  }

  //info UPDATE
  #[Route('/update/{id}', name: 'schueler_update')]
  public function updateSchueler(Request $request, Schueler $schueler, EntityManagerInterface $entityManager):Response
  {
    $form = $this->createForm(SchuelerFormType::class, $schueler);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $schueler = $form->getData();
      $entityManager->persist($schueler);
      $entityManager->flush();
      return $this->redirect('/showAll');
    }

    return $this->render('schueler/update.html.twig',[
      'form' => $form->createView()
    ]);
  }

  //info DELETE
  #[Route('/delete/{id}', name:'delete')]
  public function deleteSchueler(Schueler $schueler, EntityManagerInterface $entityManager):Response
  {
    $old = $schueler->getNachname();
    $entityManager->remove($schueler);
    $entityManager->flush();
    return $this->redirect('showAll');
  }

  #[Route('/delete2', name: 'delete2')]
  public function delete2():Response
  {
     return $this->render('schueler/delete.html.twig');
  }

  #[Route('/update2', name: 'update2')]
  public function update2(): Response
  {
      return $this->render('schueler/update.html.twig');
  }

  #[Route('/show2', name: 'show2')]
  public function show2(){
     return $this->render('schueler/show2.html.twig');
  }

}

//info vorher update
//    $old = $schueler->getNachname();
//    $schueler->setNachname('erik');
//    $entityManager->persist($schueler);
//    $entityManager->flush();
//    return new Response($old . ' heisst jetzt ' . $schueler->getNachname());

//info vorher in create
//    $schueler = new Schueler();
//    $schueler->setVorname('Bibo');
//    $schueler->setNachname('Bird');
//    $schueler->setTelefonNummer('35744833');
//    $schueler->setEmail('B@bird.live');
//    $schueler->setKommentar('Sesamschule');
//    $entityManager->persist($schueler);
//    $entityManager->flush();



  //info READ
//  #[Route('/show/{slug}')]
//  public function show(int $slug, EntityManagerInterface $entityManager): Response
//  {
//    $repo = $entityManager->getRepository(Schueler::class);
//    $schueler = $repo->find($slug);
//    return new Response('show datensatz ' . $schueler->getNachname());
//  }
