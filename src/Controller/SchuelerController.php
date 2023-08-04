<?php

namespace App\Controller;


use App\Entity\Schueler;
use App\Repository\SchuelerRepository;
use Doctrine\ORM\EntityManager;
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

    #[Route('schueler/test/{id}')]
    public function schuelerTest (Schueler $schueler): Response
    {
        return new Response('Hello ' . $schueler->getNachname());
    }

    #[Route('schueler/show/{id}')]
    public function show(Schueler $schueler) :Response
    {
        return $this->render('schueler/show.html.twig',[
            'schueler'=> $schueler
        ]);
    }

    #[Route('schueler/showall')]
    public function showAll(EntityManagerInterface $em) :Response
    {
        $repository=$em->getRepository(Schueler::class);
        $schuelers = $repository->findAll();
        return $this->render('schueler/showall.html.twig',[
            'schuelers'=>$schuelers
        ]);
    }



    #[Route('/schueler/create')]
    public function create(EntityManagerInterface $em): Response
    {
        $schueler = new Schueler();
        $schueler->setNachname('Karl');
        $schueler->setEmail('aaa@aaa.aaa');
        $schueler->setTelefonNummer('0123456789');
        $schueler->setKommentar('Cooler Typ');


        $em->persist($schueler);
        $em->flush();

        return new Response('Schueler Created!');
    }

    #[Route('schueler/update/{id}')]
    public function update(Schueler $schueler, EntityManagerInterface $em): Response
    {
        $schueler->setNachname('Karl');
        $em->persist($schueler);
        $em->flush();

        return new Response('Dein name ist jetzt ' . $schueler->getNachname());
    }

    #[Route('schueler/delete/{id}')]
    public function delete(Schueler $schueler, EntityManagerInterface $em): Response
    {
        $em->remove($schueler);
        $em->flush();
        return new Response($schueler->getNachname() . ' Schueler wird gelöscht');
    }
}