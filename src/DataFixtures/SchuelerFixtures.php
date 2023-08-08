<?php

namespace App\DataFixtures;

use App\Entity\Schueler;
use App\Factory\SchuelerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SchuelerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//         $schueler = new Schueler();
//         $schueler->setVorname('john');
//         $schueler->setNachname('Doe');
//         $schueler->setEmail('john@doe.de');
//         $schueler->setTelefonNummer('0123456');
//         $schueler->setKommentar('ist ein guter');
//
//
//         $manager->persist($schueler);
//
//        $manager->flush();

        SchuelerFactory::new()->many(20)->create();


    }
}
