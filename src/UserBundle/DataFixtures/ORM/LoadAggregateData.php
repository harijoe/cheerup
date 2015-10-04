<?php

namespace UserBundle\DataFixtures\ORM;

use AppBundle\Entity\Aggregate;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadAggregateData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $aggregate1 = new Aggregate();
        $aggregate1->setAggregateType(Aggregate::OFFSHOOT);
        $aggregate1->setName('Première Antenne');
        $aggregate1->setDescription('Voici la description de l\'antenne 1');

        $aggregate2 = new Aggregate();
        $aggregate2->setAggregateType(Aggregate::OFFSHOOT);
        $aggregate2->setName('Deuxième Antenne');
        $aggregate2->setDescription('Voici la description de l\'antenne 2');

        $aggregate3 = new Aggregate();
        $aggregate3->setAggregateType(Aggregate::GROUP);
        $aggregate3->setName('Premier Groupe');
        $aggregate3->setDescription('Voici la description du groupe 1');

        $manager->persist($aggregate1);
        $manager->persist($aggregate2);
        $manager->persist($aggregate3);
        $manager->flush();
    }
}
