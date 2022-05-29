<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setLogin("admin");
        $user->setEmail("admin@gmail.com");
        $user->setName("AdminName");
        $user->setLastname("AdminLastName");
        $user->setAdress("43 boulevard d'ici");
        $user->setPhoneNumber("0667846417");
        // $user->setBirthdayDate(new DateTime("26/09/2001"));
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$Nq8uaP9Ld9IeAdYy7BlPcA$LYVLhYJ6mCioECDcZeTf3pkEDvQVe9emby93mzIlCSA');
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setLogin("utilisateur1");
        $user->setEmail("admin@gmail.com");
        $user->setName("user1Name");
        $user->setLastname("user1LastName");
        $user->setAdress("43 boulevard d'ici");
        $user->setPhoneNumber("0667846417");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$N+SQZbnpXAaAbqvTqRHsyA$aDlqFxK4ll0YUZBLfDCt5ayM7KS5E0EdbdA1iXs+67A');
        // $user->setBirthdayDate(new DateTime(18 / 04 / 1998));
        $user->setRoles(["ROLE_MEMBRE"]);
        $manager->persist($user);
        $manager->flush();
    }
}
