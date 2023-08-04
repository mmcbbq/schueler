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


//kurzeschreibweise für das auslesen id ist wichtig
    #[Route('/show/{id}', name:'showSchueler' )]
    public function showSchueler(Schueler $schueler,$id ):Response
    {
        return $this->render('schueler/show.html.twig', ['schueler'=>$schueler]);
    }

//CREATE
    #[Route('/createSchueler/')]
    public function createSchueler(EntityManagerInterface $entityManager):Response{
        //$entityManager-ist dafür verantwortlich das objekte aus der Datenbank gespeichert und rausgelsene werden.
        $neuerSchueler=new Schueler();
        $neuerSchueler->setNachname('Feuerstein');
        $neuerSchueler->setEmail('f-stein@gmx.de');
        $neuerSchueler->setTelefonNummer('73737373737');
        $neuerSchueler->setKommentar('hello you');
        //dd($neuerSchueler);//dump and die beendet und gibt  das object aus
        $entityManager->persist($neuerSchueler); //persist erzählt der doctrine kümmer dich mal drum
        $entityManager->flush(); //doctrine schaut nach allen Objekten die persist hinzugefügt hat und  fügt das Objekt in die Tabelle hinzu
        return new Response($neuerSchueler->getNachname());
    }

    #[Route('/showall')]
    public function showAll():Response{

        $schueler=['erik','petra','simon','maik'];
        return $this->render('schueler/showall.html.twig',['schuelers'=>$schueler]);
    }

    //READ
    #[Route('/showAllFromDb')]
    public function showAllFromDb(EntityManagerInterface $entityManager ):Response
    {
        $repository=$entityManager->getRepository(Schueler::class);
        $schuelers=$repository->findAll();
//        dd($schuelers);
        return $this->render('schueler/showall.html.twig', ['schuelers'=>$schuelers]);
    }

    //UPDATE
    #[Route('update/{id}')]
    public function update(Schueler $schueler,EntityManagerInterface $entityManager){

        $schueler->setNachname('otto');
        $entityManager->persist($schueler);
        $entityManager->flush();//flush ist wie excute und führt aus
        return new Response('name ist jetzt: '.$schueler->getNachname());

    }
    #[Route('delete/{id}')]
    public function delete(Schueler $schueler,EntityManagerInterface $entityManager):Response{
        $entityManager->remove($schueler);
        $entityManager->flush();
        return new Response('ist gelöscht');
    }



}