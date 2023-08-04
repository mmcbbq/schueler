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
//        return new Response('show datensatz '.$schueler->getNachname());
//    }
#[Route('/show/{id}')]
public function showschueler(Schueler $schueler):Response{
        return $this->render('schueler/show.html.twig',['schueler'=> $schueler]);
}

    #[Route('/createSchueler')]
    public function createSchueler(EntityManagerInterface $entityManager):Response{
        $schueler = new Schueler();
        $schueler->setNachname('Mustermann');
        $schueler->setTelefonNummer(12345);
        $schueler->setEmail('e@mail.de');
        $schueler->setKommentar('wissenswertes zeug');
        $entityManager->persist($schueler);
        $entityManager->flush();
        return new Response($schueler->getNachname());
    }
    #[Route('/update/{id}')]
    public function update(Schueler $schueler, EntityManagerInterface $entityManager){
        $schueler->setNachname('frank');
        $entityManager->persist($schueler);
        $entityManager->flush();
        return new Response($schueler->getNachname());
    }
    #[Route('/delete/{id}')]
    public function delete(Schueler $schueler, EntityManagerInterface $entityManager):void{
    $entityManager->remove($schueler);
    $entityManager->flush();
    }
    #[Route('/showall')]
    public function showall(){
        $schueler = ['Erik', 'Petra', 'Simon', 'Maik'];
        return $this->render('schueler/showall.html.twig',['schuelers'=> $schueler]);
    }

    #[Route('/showAllFromDb')]
    public function showAllFromDb(EntityManagerInterface $entityManager ):Response
    {
        $repository=$entityManager->getRepository(Schueler::class);
        $schuelers=$repository->findAll();
//        dd($schuelers);
        return $this->render('schueler/showall.html.twig', ['schuelers'=>$schuelers]);
    }

}