<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Notice;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setMail($faker->email());
            $user->setUsername($faker->userName());
            $user->setPassword($faker->password());
            $manager->persist($user);


            for($j = 0; $j < 2; $j++) {
                $category = new Category();
                $category->setLabel($faker->city());
                $manager->persist($category);

                for($k = 0; $k<3; $k++) {
                    $article = new Article();
                    $article->setTitle($faker->unique()->sentence());
                    $article->setContent($faker->text());
                    $article->setDate($faker->unique()->dateTime());
                    $article->setCreator($user);
                    $article->setCategory($category);
                    $article->setImageUrl($faker->imageUrl());
                    $manager->persist($article);

                    for($l = 0; $l < 3; $l++) {
                        $notice = new Notice();
                        $notice->setArticle($article);
                        $notice->setAuthor($user);
                        $notice->setContent($faker->text());
                        $notice->setNote(
                            $faker->numberBetween(0, 5));
                        $manager->persist($notice);
                    }


                }

            }
        }





        $manager->flush();
    }
}
