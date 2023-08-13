<?php

namespace App\Factory;

use App\Entity\Kurs;
use App\Repository\KursRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Kurs>
 *
 * @method        Kurs|Proxy create(array|callable $attributes = [])
 * @method static Kurs|Proxy createOne(array $attributes = [])
 * @method static Kurs|Proxy find(object|array|mixed $criteria)
 * @method static Kurs|Proxy findOrCreate(array $attributes)
 * @method static Kurs|Proxy first(string $sortedField = 'id')
 * @method static Kurs|Proxy last(string $sortedField = 'id')
 * @method static Kurs|Proxy random(array $attributes = [])
 * @method static Kurs|Proxy randomOrCreate(array $attributes = [])
 * @method static KursRepository|RepositoryProxy repository()
 * @method static Kurs[]|Proxy[] all()
 * @method static Kurs[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Kurs[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Kurs[]|Proxy[] findBy(array $attributes)
 * @method static Kurs[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Kurs[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class KursFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'bezeichnung' => self::faker()->word(),
            'createdAt' => self::faker()->dateTimeBetween('-1 year'),
            'name' => self::faker()->word(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Kurs $kurs): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Kurs::class;
    }
}
