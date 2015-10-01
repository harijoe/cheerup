<?php

namespace UserBundle\DataFixtures\ORM;

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
        $user1->setFirstname('user1');
        $user1->setLastname('user1');
        $user1->setPlainPassword('user1');
        $user1->setEmail('user1@mail.com');
        $user1->setProfileType('FORMER_MEMBER');
        $user1->setEnabled(true);

        $user2 = new User();
        $user2->setFirstname('user2');
        $user2->setLastname('user2');
        $user2->setPlainPassword('user2');
        $user2->setEmail('user2@mail.com');
        $user2->setProfileType('NETWORK_VOLUNTEER');
        $user2->setEnabled(true);

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();
    }
}
