<?php

namespace App\DataFixtures;

use App\Entity\Schueler;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $schueler = new Schueler();
        $schueler->setVorname('Jon');
        $schueler->setNachname('Doe');
        $schueler->setEmail('aaa@aaa.aaa');
        $schueler->setTelefonNummer('0123456789');
        $schueler->setKommentar('Cooler Typ');

        $manager->persist($schueler);
        $manager->flush();
    }
}
