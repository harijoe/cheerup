<?php

namespace UserBundle\DataFixtures\ORM;

use AppBundle\Entity\Aggregate;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setFirstname('Bob');
        $user1->setLastname('Dylan');
        $user1->setPlainPassword('user1');
        $user1->setEmail('user1@mail.com');
        $user1->setProfileType('FORMER_MEMBER');
        $user1->setEnabled(true);

        $aggregate = new Aggregate();
        $aggregate->setAggregateType(Aggregate::OFFSHOOT);
        $aggregate->setName('Antenne cheerup');
        $aggregate->setDescription('Voici la description d\'une antenne cheerup');

        $user2 = new User();
        $user2->setFirstname('Marcel');
        $user2->setLastname('Pagnol');
        $user2->setPlainPassword('user2');
        $user2->setEmail('user2@mail.com');
        $user2->setProfileType('FORMER_MEMBER');
        $user2->setEnabled(true);
        $user2->setOffshootOfOrigin($aggregate);

        $manager->persist($aggregate);
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();
    }
}
