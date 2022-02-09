<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Product;
use Liior\Faker\Prices;
use App\Entity\Category;
use Bluemmb\Faker\PicsumPhotosProvider;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    protected $slugger;
    private $hasher;

    public function __construct(SluggerInterface $slugger, UserPasswordHasherInterface $hasher)
    {
        $this->slugger = $slugger;
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $faker->addProvider(new Prices($faker));
        $faker->addProvider(new PicsumPhotosProvider($faker));

        $availableCountry = ['0' => 'France', '1' => 'Belgique', '2' => 'Suisse'];
        $country = $availableCountry[mt_rand(0, 2)];
        
        $admin = new User();

        $admin->setAddress($faker->streetAddress())
              ->setBirthDate($faker->dateTime())
              ->setCity($faker->city())
              ->setCountry($country)
              ->setEmail('admin@symfony.com')
              ->setFirstName($faker->firstName())
              ->setLastName($faker->lastName())
              ->setPassword($this->hasher->hashPassword($admin, 'password'))
              ->setPhone($faker->e164PhoneNumber())
              ->setPostalCode($faker->postcode())
              ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        for($u = 0; $u < 5; $u++){
            $user = new User();

            $country = $availableCountry[mt_rand(0, 2)];

            $user->setAddress($faker->streetAddress())
                 ->setBirthDate($faker->dateTime())
                 ->setCity($faker->city())
                 ->setCountry($country)
                 ->setEmail($faker->email())
                 ->setFirstName($faker->firstName())
                 ->setLastName($faker->lastName())
                 ->setPassword($this->hasher->hashPassword($admin, 'password'))
                 ->setPhone($faker->e164PhoneNumber())
                 ->setPostalCode($faker->postcode());

            $manager->persist($user);
        }

        for($c = 0; $c < 3; $c++){

            $category = new Category();

            $category->setName($faker->word())
                     ->setSlug($this->slugger->slug(strtolower($category->getName())))
                     ->setDescription($faker->sentence());

            $manager->persist($category);

            for($p = 0; $p < mt_rand(3, 8); $p++){

                $product = new Product();

                $product->setName($faker->words(mt_rand(2, 5), true))
                        ->setSlug($this->slugger->slug(strtolower($product->getName())))
                        ->setPrice($faker->price(1000, 100000))
                        ->setDescription($faker->paragraphs(mt_rand(2, 6), true))
                        ->setImage($faker->imageUrl(200, 200))
                        ->setCategory($category);

                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}
