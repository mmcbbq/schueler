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

//    $schueler = new Schueler();
//    $schueler->setVorname('Erik');
//    $schueler->setNachname('B');
//    $schueler->setTelefonNummer('5635543');
//    $schueler->setEmail('e@b.live');
//    $schueler->setKommentar('BBQ');

//    $manager->persist($schueler);
//    $manager->flush();

    SchuelerFactory::new()->many(1500)->create();
  }
}
