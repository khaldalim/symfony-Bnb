<?php

namespace App\DataFixtures;

use Cocur\Slugify\Slugify;
use Faker\Factory;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        $slugify = new Slugify();

        // Nous gerons les annonces
        for ($i = 1; $i <= 30; $i++) {
            $article = new Article();

            $title          = $faker->sentence();
            $description    = $faker->paragraph(2);
            $content        = '<p>' . join('</p><p>', $faker->paragraphs(3)) . '</p>';
            $slug           = $slugify->slugify($title);
            $coverImage     = $faker->imageUrl(1000, 350);
           
            
            $article->setTitle($title)
                ->setCoverImage($coverImage)
                ->setDescription($description)
                ->setContent($content)
                ->setSlug($slug);
                                
            $manager->persist($article);
        }

        $manager->flush();
    }
}
