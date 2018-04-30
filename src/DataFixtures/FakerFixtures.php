<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 30/04/2018
 * Time: 17:00
 */

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class FakerFixtures extends Fixture implements FixtureInterface
{

    protected $em;

    public function __construct()
    {

    }

    public function load(ObjectManager $manager)
    {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < 100; $i++) {
            $member = new Member();
            $member->setFirstname($faker->firstName);
            $member->setLastname($faker->lastName);
            $member->setEmail($faker->email);
            $member->setPassword($faker->password);
            //$encoded= $enc->encodePassword($member, $registerForm->get('password')->getData());
            //$member->setPassword($encoded);
            $member->setTel(0000000000);
            $member->setNote($faker->numberBetween($min = 1, $max = 5));
            $member->setVehicle($faker->text);
            $member->setRoles(["ROLE_USER"]);
            //$member->setComments($faker->realText(1000));

            $manager->persist($member);
        }

        $manager->flush();
    }




}