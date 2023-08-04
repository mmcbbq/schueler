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
    //READ
//    #[Route('/show/{id}')]
//    public function show(int $id,EntityManagerInterface $entityManager ):Response
//    {
//        $repository=$entityManager->getRepository(Schueler::class);
//        $schueler=$repository->find($id);
//        return new Response('show datensatz '.$schueler->getNachname());
//    }

//kurzeschreibweise für das auslesen id ist wichtig
    #[Route('/shuelertest/{id}')]
    public function shuelertest(Schueler $schueler ):Response
    {
        return new Response('shuelertest '.$schueler->getKommentar());
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
        $entityManager->flush(); //doctrone schaut nach allen fügt das Objekt hinzu
        return new Response($neuerSchueler->getNachname());
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