<?php

namespace App\DataFixtures;

use App\Entity\Fachrichtung;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $fachrichtung1 = new Fachrichtung();
       $fachrichtung1->setBezeichnung('Anwendungsentwicklung');
        $manager->persist($fachrichtung1);
        $fachrichtung2 = new Fachrichtung();
        $fachrichtung2->setBezeichnung('Systemintegration');
        $manager->persist($fachrichtung1);
        $manager->persist($fachrichtung2);
        $manager->flush();
    }
}
