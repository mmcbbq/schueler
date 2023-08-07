<?php

namespace App\Controller;


use App\Entity\Schueler;
use App\Form\SchuelerFormType;
use App\Repository\SchuelerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchuelerController extends AbstractController
{


    #[Route('/')]
    public function schueler()
    {
        return $this->render('schueler/home.html.twig');
    }

    #[Route('schueler/{fn}/{id?}')]
    public function manage($fn, $id = null, EntityManagerInterface $em, SchuelerRepository $schuelerRepository, Request $request)
    {
        switch ($fn) {
            case 'create':
                $schueler = new Schueler();
                return $this->createAndHandleForm($schueler,$request,$em, $fn);
            case 'read':
                if ($id === 'all') {
                    return $this->readAll($em);
                } else {
                    $schueler = $schuelerRepository->find($id);
                    if (!$schueler) {
                        return new Response('Schueler not found');
                    }
                    return $this->read($schueler);
                }

            case 'update':
                $schueler = $schuelerRepository->find($id);
                if (!$schueler) {
                    return new Response('Schueler not found');
                }
                return $this->createAndHandleForm($schueler,$request,$em, $fn);

            case 'delete':
                $schueler = $schuelerRepository->find($id);
                if (!$schueler) {
                    return new Response('Schueler not found');
                }
                $em->remove($schueler);
                $em->flush();
                return $this->readAll($em);

            default:
                return new Response('Invalid operation');
        }
    }


    #[Route('schueler/read/{id}')]
    private function read(Schueler $schueler): Response
    {
        return $this->render('schueler/read.html.twig', [
            'schueler' => $schueler
        ]);
    }

    #[Route('schueler/read/all', name: 'readAllSchueler')]
    private function readAll(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Schueler::class);
        $schuelers = $repository->findAll();
        return $this->render('schueler/readall.html.twig', [
            'schuelers' => $schuelers
        ]);
    }

    private function createAndHandleForm($schueler, $request, $em, $fn)
    {
        $form = $this->createForm(SchuelerFormType::class, $schueler);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($schueler);
            $em->flush();
            return $this->redirectToRoute('readAllSchueler');
        }
        return $this->render(
            'schueler/'.$fn.'.html.twig', [
            'form' => $form->createView()
        ]);
    }


//    #[Route('schueler/update/{id}')]
//    private function update(Schueler $schueler, $request)
//    {
//        $form = $this->createForm(SchuelerFormType::class,$schueler);
//        $form->handleRequest($request);
//        return $form;
//    }
//
//    // will need this when it will be dynamic
//    #[Route('schueler/create')]
//    public function create(Schueler $schueler, $request)
//    {
//        $form = $this->createForm(SchuelerFormType::class, $schueler);
//        $form->handleRequest($request);
//        return $form;
//    }


//    #[Route('/schueler/create')]
//    public function create(EntityManagerInterface $em): Response
//    {
//        $schueler = new Schueler();
//        $schueler->setNachname('Karl');
//        $schueler->setEmail('aaa@aaa.aaa');
//        $schueler->setTelefonNummer('0123456789');
//        $schueler->setKommentar('Cooler Typ');
//
//
//        $em->persist($schueler);
//        $em->flush();
//
//        return new Response('Schueler Created!');
//    }
//
//    #[Route('schueler/update/{id}')]
//    public function update(Schueler $schueler, EntityManagerInterface $em): Response
//    {
//        $schueler->setNachname('Karl');
//        $em->persist($schueler);
//        $em->flush();
//
//        return new Response('Dein name ist jetzt ' . $schueler->getNachname());
//    }
//
//    #[Route('schueler/delete/{id}')]
//    public function delete(Schueler $schueler, EntityManagerInterface $em): Response
//    {
//        $em->remove($schueler);
//        $em->flush();
//        return new Response($schueler->getNachname() . ' Schueler wird gelöscht');
//    }
//
//    #[Route('schueler/test/{id}')]
//    public function schuelerTest (Schueler $schueler): Response
//    {
//        return new Response('Hello ' . $schueler->getNachname());
//    }
}