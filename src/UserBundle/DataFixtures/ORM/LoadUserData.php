<?php

namespace UserBundle\DataFixtures\ORM;

use AppBundle\Entity\Aggregate;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
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

        $aggregate = $this->getReference('offshoot');

        $user2 = new User();
        $user2->setFirstname('Marcel');
        $user2->setLastname('Pagnol');
        $user2->setPlainPassword('user2');
        $user2->setEmail('user2@mail.com');
        $user2->setProfileType('FORMER_MEMBER');
        $user2->setEnabled(true);
        $user2->setOffshootOfOrigin($aggregate);

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
