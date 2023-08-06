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


    #[Route('/createschueler', name: 'create_schueler')]
    public function createschueler (Request $request, EntityManagerInterface $entityManager) :Response
    {
        $schueler = new Schueler();
        $form = $this->createForm(SchuelerFormType::class, $schueler);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newschueler = $form->getData();
            $entityManager->persist($newschueler);
            $entityManager->flush();
            return $this->redirectToRoute('schueler_showall');
        }
        return $this->render('schueler/create.html.twig', [
            'form'  => $form->createView()
        ]);
//        $neuerSchueler = new Schueler();
//        $neuerSchueler->setNachname('Doe');
//        $neuerSchueler->setEmail('Doe@joe.de');
//        $neuerSchueler->setTelefonNummer('0123456');
//        $neuerSchueler->setKommentar('Ist ein Joe');
//
//        $entityManager->persist($neuerSchueler);
//        $entityManager->flush();


//        return new Response('Schüler '.$neuerSchueler->getNachname() .' hinzugefügt');
}

    #[Route('/show/{id}', name: 'schueler_show')]
    public function showschueler (Schueler $schueler):Response
    {


        return $this->render('schueler/show.html.twig',[
            'schueler'=> $schueler
        ]);
    }
    #[Route('/showall', name: 'schueler_showall')]
    public function showall(EntityManagerInterface $entityManager):Response
    {
        $rep = $entityManager->getRepository(Schueler::class);
        $schueler = $rep->findAll();
//        $schueler=['Erik','Petra','Simon','Maik'];

        return $this->render('schueler/showall.html.twig',['schuelers'=> $schueler
            ]);

    }

    #[Route('update/{id}', name:'schueler_update') ]
    public function update(Request $request, Schueler $schueler, EntityManagerInterface $entityManager):Response
    {
        $form = $this->createForm(SchuelerFormType::class, $schueler);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        return $this->redirectToRoute('schueler_showall');
        }


//        $schueler->setNachname('karl');




        $entityManager->persist($schueler);
        $entityManager->flush();
        return $this->render('schueler/update.html.twig',[
            'schueler' => $schueler,
            'form'  => $form->createView()
        ]);

    }

}