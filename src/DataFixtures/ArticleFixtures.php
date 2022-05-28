<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\CryptoCurrency;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitre('Article n° ' . $i);
            $article->setContent("Le contenu de cette article est généré via les fixtures, il sera possible ultérieurement de mettre du lorem Ipsum");
            $article->setNbLike(mt_rand(10, 100));
            $article->setIdUser(new User());
            $article->setIdCrypto(new CryptoCurrency());

            $manager->persist($article);
        }

        $manager->flush();
    }
}
