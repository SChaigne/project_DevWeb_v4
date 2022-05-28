<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Commentary;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentaryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $commentary = new Commentary();
        $commentary->setText("Lorem Impsum n°", $commentary->getId());
        $commentary->setIdUser(new User());
        $commentary->setIdArticle(new Article());
        $manager->persist($commentary);

        $manager->flush();
    }
}
