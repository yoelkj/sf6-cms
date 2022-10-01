<?php

namespace App\DataFixtures;

use App\Factory\CompanyFactory;
use App\Factory\CountryFactory;
use App\Factory\LanguageFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Languages
        LanguageFactory::createOne([
            'name' =>  'English',
            'code' =>  'en'
        ]);

        LanguageFactory::createOne([
            'name' =>  'Spanish',
            'code' =>  'es'
        ]);

        //Countries
        CountryFactory::createOne([
            'name' =>  'Peru',
            'code' =>  'PE'
        ]);
        //Countries
        CountryFactory::createOne([
            'name' =>  'United State',
            'code' =>  'US'
        ]);

        //Countries
        CompanyFactory::createOne([
            'name' =>  'Bucky',
            'address' =>  'Address bucky company',
            'phoneMain' =>  '+51 999 999 999',
            'emailMain' =>  'main@bucky.com'
        ]);

        //Users
        UserFactory::createOne([
            'email' =>  'admin@bucky.com',
            'roles' =>  ['ROLE_ADMIN']
        ]);

        UserFactory::createOne([
            'email' =>  'test@bucky.com',
            'roles' =>  ['ROLE_USER'],
            'avatar' => 'tisha.png',
        ]);
        
        //UserFactory::createMany(3);

        $manager->flush();

    }
}
