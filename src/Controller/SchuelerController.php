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
    public function schueler()
    {
        return new Response('Hallo Welt');
    }


    #[Route('schueler/showall')]
    public function showAll(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Schueler::class);
        $schuelers = $repository->findAll();
        return $this->render('schueler/showall.html.twig', [
            'schuelers' => $schuelers
        ]);
    }

    #[Route('schueler/{fn}/{id?}')]
    public function manage($fn, $id = null, EntityManagerInterface $em, SchuelerRepository $schuelerRepository)
    {
        switch ($fn) {
            case 'create':
                $schueler = new Schueler();
                $schueler->setVorname('Karl');
                $schueler->setNachname('Karlenson');
                $schueler->setEmail('aaa@aaa.aaa');
                $schueler->setTelefonNummer('0123456789');
                $schueler->setKommentar('Cooler Typ');

                $em->persist($schueler);
                $em->flush();

                $schueler->getId();
                return $this->render('schueler/show.html.twig', [
                    'schueler' => $schueler
                ]);
            case 'read':
                $schueler = $schuelerRepository->find($id);

                if (!$schueler) {
                    return new Response('Schueler not found');
                }

                return $this->render('schueler/show.html.twig', [
                    'schueler' => $schueler
                ]);

            case 'update':
                $schueler = $schuelerRepository->find($id);

                if (!$schueler) {
                    return new Response('Schueler not found');
                }
// still static
                $data = ['vorname' => 'Yooooo'];
                $this->updateSchuelerAttributes($schueler, $data);
                $em->persist($schueler);
                $em->flush();
                return $this->render('schueler/show.html.twig', [
                    'schueler' => $schueler,
                ]);

            case 'delete':
                $schueler = $schuelerRepository->find($id);
                if (!$schueler) {
                    return new Response('Schueler not found');
                }

                $em->remove($schueler);
                $em->flush();

                return new Response($schueler->getNachname() . ' Schueler has been removed');

            default:
                return new Response('Invalid operation');
        }
    }

    // will need this when it will be dynamic
    private function updateSchuelerAttributes(Schueler $schueler, array $info)
    {
        foreach ($info as $attribute => $value) {
            //if the attribute is "nachname", the generated setter method name will be "setNachname".
            $setter = 'set' . ucfirst($attribute);
            //call setter method
            $schueler->$setter($value);

        }
    }


//    #[Route('schueler/show/{id}')]
//    public function show(Schueler $schueler) :Response
//    {
//        return $this->render('schueler/show.html.twig',[
//            'schueler'=> $schueler
//        ]);
//    }
//
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