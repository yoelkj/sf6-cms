<?php

namespace App\Factory;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Country>
 *
 * @method static Country|Proxy createOne(array $attributes = [])
 * @method static Country[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Country|Proxy find(object|array|mixed $criteria)
 * @method static Country|Proxy findOrCreate(array $attributes)
 * @method static Country|Proxy first(string $sortedField = 'id')
 * @method static Country|Proxy last(string $sortedField = 'id')
 * @method static Country|Proxy random(array $attributes = [])
 * @method static Country|Proxy randomOrCreate(array $attributes = [])
 * @method static Country[]|Proxy[] all()
 * @method static Country[]|Proxy[] findBy(array $attributes)
 * @method static Country[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Country[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CountryRepository|RepositoryProxy repository()
 * @method Country|Proxy create(array|callable $attributes = [])
 */
final class CountryFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'name' => null,
            'code' => 'en',
            'isActive' => true,
            'language' => LanguageFactory::random(),
            'created' => self::faker()->dateTimeBetween('-1 year'),
            'updated' => self::faker()->dateTimeBetween('-1 year'),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Country $country): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Country::class;
    }
}
