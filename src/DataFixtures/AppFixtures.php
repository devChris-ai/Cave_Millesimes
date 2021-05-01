<?php

namespace App\DataFixtures;


use App\Entity\Denomination;
use App\Entity\Territory;
use App\Entity\Wine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $territory1 = new Territory();
        $territory1->setRegion("Bourgogne");
        $manager->persist($territory1);

        $territory2 = new Territory();
        $territory2->setRegion("Bordeaux");
        $manager->persist($territory2);

        $denomination1 = new Denomination();
        $denomination1->setAppellation("Pommard 1er cru")
            ->setField("Domaine de Courcel")
            ->setFile("etiquette_Pommard_cave.png")
            ->setTerritory($territory1);
        $manager->persist($denomination1);

        $denomination2 = new Denomination();
        $denomination2->setAppellation("Sauternes")
            ->setField("Château d'Yquem")
            ->setFile("chateau_yquem_2015.png")
            ->setTerritory($territory2);
        $manager->persist($denomination2);

        $denomination3 = new Denomination();
        $denomination3->setAppellation("Latricières Chambertin Grand Cru")
            ->setField("Domaine Jean Louis Trapet")
            ->setFile("latricieres_chambertin.png")
            ->setTerritory($territory1);
        $manager->persist($denomination3);

        $denomination4 = new Denomination();
        $denomination4->setAppellation("Aloxe-Corton 1er cru")
            ->setField("Domaine Antonin Guyon")
            ->setFile("aloxe_corton.jpg")
            ->setTerritory($territory1);
        $manager->persist($denomination4);

        $denomination5 = new Denomination();
        $denomination5->setAppellation("Saint-Emilion Grand Cru")
            ->setField("Château La Dominique")
            ->setFile("chateau_laDominique.jpg")
            ->setTerritory($territory2);
        $manager->persist($denomination5);

        $denominations = [$denomination1,$denomination2,$denomination3,$denomination4,$denomination5];

        $faker = Factory::create('fr_FR');
        foreach($denominations as $d){
            $rand = rand(3,5);
            for($i=1; $i <= $rand; $i++){
                $wine = new Wine();
                $wine->setYear($faker->numberBetween($min=1900,$max=2021))
                // $wine->setYear($faker->year($max='2021'))
                    ->setConservation(($faker->numberBetween($min=2021,$max=2030)))
                    ->setColor($faker->randomElement($array = array('Rouge','Blanc','Rosé')))
                    ->setDenomination($d);
                $manager->persist($wine);
            
            }

        }

        $manager->flush();
    }
}
