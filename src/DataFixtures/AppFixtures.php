<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Notice;
use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $users = [];
        $categories = [];
        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setMail($faker->email());
            $user->setUsername($faker->userName());
            $user->setPassword($faker->password());
            $user->setRoles($faker->randomElements(['ROLE_USER', 'ROLE_ADMIN']));
            $manager->persist($user);
            $users[] = $user;

        }
        for ($j = 0; $j < 20; $j++) {
            $category = new Category();
            $city = $faker->city();
            $category->setLabel($city);
            $category->setSlug((new Slugify())->slugify($city));
            $manager->persist($category);
            $categories[] = $category;
        }
        for ($k = 0; $k < 50; $k++) {
            $article = new Article();
            $title = $faker->unique()->sentence();
            $articleContent = "<h1>" . $title . "</h1><br>"
                . "<p>" . $faker->text() . "</p>"
                . "<p>" . $faker->text() . "</p><br>"
                . "<p>" . $faker->paragraph(30) . "</p>";
            $article->setTitle($title);
            $article->setSlug((new Slugify())->slugify($title));
            $article->setContent($articleContent);
            $article->setDate($faker->unique()->dateTime());
            $article->setCreator($users[$faker->numberBetween(0, count($users) - 1)]);
            $article->setCategory($categories[$faker->numberBetween(0, count($categories) - 1)]);
            $article->setImageUrl($faker->imageUrl());
            $manager->persist($article);

            for ($l = 0; $l < 3; $l++) {
                $notice = new Notice();
                $notice->setArticle($article);
                $notice->setAuthor($users[$faker->numberBetween(0, count($users) - 1)]);
                $notice->setContent($faker->text());
                $notice->setNote(
                    $faker->numberBetween(0, 5));
                $manager->persist($notice);
            }


        }


        $manager->flush();
    }
}
