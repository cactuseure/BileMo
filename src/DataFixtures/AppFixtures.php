<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

class AppFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = Array();
        for ($user = 0; $user < 10; $user++) {
            $users[$user] = new User();
            $users[$user]->setEmail($faker->email);
            $users[$user]->setPassword('$2y$13$O7pR53jaMT/7ADmCgE8cKujJj/GPPzeZe4ZzBSc43kOljYUPMoTDW');
            $users[$user]->setRoles(['ROLE_USER']);

            $manager->persist($users[$user]);

            $customers = Array();
            for ($customer = 0; $customer < 10; $customer++) {
                $customers[$customer] = new Customer();
                $customers[$customer]->setFirstname($faker->firstName);
                $customers[$customer]->setLastname($faker->lastName);
                $customers[$customer]->setEmail($faker->email);
                $customers[$customer]->setOwner($users[$user]);

                $manager->persist($customers[$customer]);
            }
        }

        $brandsAndModels = [
            'Apple' => ['iPhone 13 Pro Max', 'iPhone 12 Pro', 'iPhone 11 Pro', 'iPhone XS', 'iPhone XR'],
            'Samsung' => ['Galaxy S21 Ultra', 'Galaxy Note 20 Ultra', 'Galaxy S20 FE', 'Galaxy Z Fold 3', 'Galaxy Z Flip 3'],
            'Huawei' => ['P40 Pro', 'Mate 40 Pro', 'P30 Pro', 'Mate 30 Pro', 'Nova 8 Pro'],
            'OnePlus' => ['9 Pro', '8T', 'Nord 2', '7T Pro', '6T'],
            'Google' => ['Pixel 6 Pro', 'Pixel 5', 'Pixel 4a', 'Pixel 4 XL', 'Pixel 3a']
        ];

        $products = Array();
        for ($product = 0; $product < 100; $product++) {
            $brand = array_rand($brandsAndModels);
            $model = $faker->randomElement($brandsAndModels[$brand]);

            $products[$product] = new Product();
            $products[$product]->setName("$brand $model");
            $products[$product]->setDescription("Découvrez le $brand $model, un téléphone haut de gamme avec des performances inégalées.");
            $products[$product]->setShortDescription("Le $model redefine l'excellence dans la technologie mobile.");
            $products[$product]->setSupplierPrice($faker->randomFloat(2, 700, 1500)); // Prix adaptés aux téléphones haut de gamme
            $products[$product]->setSuggestedPrice($faker->randomFloat(2, $products[$product]->getSupplierPrice(), 2000));
            $products[$product]->setFeatures(['Reconnaissance faciale', 'Étanchéité IP68', 'Charge rapide 30W', 'Écran OLED HDR10+']);
            $products[$product]->setImage($faker->imageUrl());
            $products[$product]->setBrand($brand);

            $manager->persist($products[$product]);
        }


        $manager->flush();
    }
}
