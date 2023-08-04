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
        return $this->render('schueler/home.html.twig');
    }

//    #[Route('schueler/show/{id}')]
    private function show(Schueler $schueler) :Response
    {
        return $this->render('schueler/show.html.twig', [
            'schueler' => $schueler
        ]);
    }


//    #[Route('schueler/show/all')]
    private function showAll(EntityManagerInterface $em): Response
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
                // still static. $data needs to get value from somewhere
                $data = [
                    'vorname' => 'Karl',
                    'nachname' =>'Karlenson',
                    'email' => 'aaa@aaa.aaa',
                    'telefonNummer' => '0123456789',
                    'kommentar' => 'Cooler Typ'
                ];

                $schueler = $this->create($data);
                $em->persist($schueler);
                $em->flush();

                return $this->show($schueler);

            case 'read':
                if ($id === 'all'){
                    return $this->showAll($em);
                } else {
                    $schueler = $schuelerRepository->find($id);

                    if (!$schueler) {
                        return new Response('Schueler not found');
                    }

                    return $this->show($schueler);
                }
            case 'update':
                $schueler = $schuelerRepository->find($id);

                if (!$schueler) {
                    return new Response('Schueler not found');
                }
                // still static. $data needs to get value from somewhere
                $data = ['vorname' => 'Yooooo'];
                $this->update($schueler, $data);
                $em->persist($schueler);
                $em->flush();

                return $this->show($schueler);

            case 'delete':
                $schueler = $schuelerRepository->find($id);
                if (!$schueler) {
                    return new Response('Schueler not found');
                }

                $em->remove($schueler);
                $em->flush();

                return $this->showAll($em);

            default:
                return new Response('Invalid operation');
        }
    }

    // will need this when it will be dynamic
    private function update(Schueler $schueler, array $data)
    {
        foreach ($data as $attribute => $value) {
            //if the attribute is "nachname", the generated setter method name will be "setNachname".
            $setter = 'set' . ucfirst($attribute);
            //call setter method
            $schueler->$setter($value);
        }
    }

    // will need this when it will be dynamic
    private function create(array $data): Schueler
    {
        $schueler = new Schueler();
        foreach ($data as $attribute => $value) {
            //loop to every assignable key
            $setter = 'set' . ucfirst($attribute);
            //call setter method
            $schueler->$setter($value);
        }
        return $schueler;
    }

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