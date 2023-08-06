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
        SchuelerFactory::new()->many(100)->create();
//         $schueler = new Schueler();
//         $schueler->setVorname('manuel');
//         $schueler->setNachname('Martinez');
//         $schueler->setTelefonNummer('123456');
//         $schueler->setEmail('manuel@mail.com');
//         $schueler->setKommentar('super ');
//         $manager->persist($schueler);
//
//        $manager->flush();
    }
}
