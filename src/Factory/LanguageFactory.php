<?php

namespace App\Factory;

use App\Entity\Language;
use App\Repository\LanguageRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Language>
 *
 * @method static Language|Proxy createOne(array $attributes = [])
 * @method static Language[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Language|Proxy find(object|array|mixed $criteria)
 * @method static Language|Proxy findOrCreate(array $attributes)
 * @method static Language|Proxy first(string $sortedField = 'id')
 * @method static Language|Proxy last(string $sortedField = 'id')
 * @method static Language|Proxy random(array $attributes = [])
 * @method static Language|Proxy randomOrCreate(array $attributes = [])
 * @method static Language[]|Proxy[] all()
 * @method static Language[]|Proxy[] findBy(array $attributes)
 * @method static Language[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Language[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LanguageRepository|RepositoryProxy repository()
 * @method Language|Proxy create(array|callable $attributes = [])
 */
final class LanguageFactory extends ModelFactory
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
            'orderRow' => 0,
            'isActive' => 1,
            'created' => self::faker()->dateTimeBetween('-1 year'),
            'updated' => self::faker()->dateTimeBetween('-1 year'),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Language $language): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Language::class;
    }
}
