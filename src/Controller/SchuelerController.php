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
        //$schueler=showAllFromDb();
        return $this->render('/base.html.twig');
    }


//kurzeschreibweise für das auslesen id ist wichtig
    #[Route('/show/{id}', name:'showSchueler' )]
    public function showSchueler(Schueler $schueler,$id ):Response
    {

        return $this->render('schueler/show.html.twig', ['schueler'=>$schueler]);
    }

//CREATE
    #[Route('/create',name:'createSchueler' )]
    public function createSchueler(Request $request, EntityManagerInterface $entityManager):Response{
        //$entityManager-ist dafür verantwortlich das objekte aus der Datenbank gespeichert und rausgelsene werden.
        $neuerSchueler=new Schueler();
        $form=$this->createForm(SchuelerFormType::class,$neuerSchueler);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $neuerSchueler=$form->getData();
            $entityManager->persist($neuerSchueler); //persist erzählt der doctrine kümmer dich mal drum
            $entityManager->flush(); //doctrine schaut nach allen Objekten die persist hinzugefügt hat und  fügt das Objekt in die Tabelle hinzu
            return $this->redirectToRoute('showAllSchueler');
        }
        return $this->render('schueler/create.html.twig',['form'=>$form->createView()]);


//        $neuerSchueler->setVorname('Oliver');
//        $neuerSchueler->setNachname('Winterfeld');
//        $neuerSchueler->setEmail('o.winterfeld@gmx.de');
//        $neuerSchueler->setTelefonNummer('5555888989');
//        $neuerSchueler->setKommentar('uuuuahhhh');
//        //dd($neuerSchueler);//dump and die beendet und gibt  das object aus
//        $entityManager->persist($neuerSchueler); //persist erzählt der doctrine kümmer dich mal drum
//        $entityManager->flush(); //doctrine schaut nach allen Objekten die persist hinzugefügt hat und  fügt das Objekt in die Tabelle hinzu
//        return $this->render('schueler/create.html.twig', ['schuelername'=>$neuerSchueler->getNachname()]);
// //       return new Response($neuerSchueler->getNachname());
    }

    #[Route('/showall')]
    public function showAll():Response{

        $schueler=['erik','petra','simon','maik'];
        return $this->render('schueler/showall.html.twig',['schuelers'=>$schueler]);
    }

    //READ
    #[Route('/showAllFromDb',name:'showAllSchueler') ]
    public function showAllFromDb(EntityManagerInterface $entityManager ):Response
    {
        $repository=$entityManager->getRepository(Schueler::class);
        $schuelers=$repository->findAll();
//        dd($schuelers);
        return $this->render('schueler/showall.html.twig', ['schuelers'=>$schuelers]);
    }

    //UPDATE
    #[Route('update/{id}',name:'updateSchueler')]
    public function update(Request $request,Schueler $schueler,EntityManagerInterface $entityManager){

        $form=$this->createForm(SchuelerFormType::class,$schueler);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $schueler=$form->getData();
            $entityManager->persist($schueler); //persist erzählt der doctrine kümmer dich mal drum
            $entityManager->flush(); //doctrine schaut nach allen Objekten die persist hinzugefügt hat und  fügt das Objekt in die Tabelle hinzu
            return $this->redirectToRoute('showAllSchueler');
        }
        return $this->render('schueler/update.html.twig',['schueler'=>$schueler,'form'=>$form->createView()]);
    }

    #[Route('delete/{id}',name:'deleteSchueler')]
    public function delete(Schueler $schueler,EntityManagerInterface $entityManager):Response{
        $entityManager->remove($schueler);
        $entityManager->flush();
        $repository=$entityManager->getRepository(Schueler::class);
        $schuelers=$repository->findAll();
        return $this->render('schueler/showall.html.twig',['schuelers'=>$schuelers]);
    }



}