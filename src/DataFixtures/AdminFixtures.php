<?php

namespace App\DataFixtures;
use App\Entity\Admin;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        $admin = new Admin();
        $admin
            ->setPassword($this->passwordEncoder->encodePassword(
                         $admin,
                        'contractor-admin-12!'
                    ))
            ->setUsername('admin');
       $manager->persist($admin);


        $manager->flush();
    }
}
