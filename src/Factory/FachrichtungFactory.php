<?php

namespace App\Factory;

use App\Entity\Fachrichtung;
use App\Repository\FachrichtungRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Fachrichtung>
 *
 * @method        Fachrichtung|Proxy create(array|callable $attributes = [])
 * @method static Fachrichtung|Proxy createOne(array $attributes = [])
 * @method static Fachrichtung|Proxy find(object|array|mixed $criteria)
 * @method static Fachrichtung|Proxy findOrCreate(array $attributes)
 * @method static Fachrichtung|Proxy first(string $sortedField = 'id')
 * @method static Fachrichtung|Proxy last(string $sortedField = 'id')
 * @method static Fachrichtung|Proxy random(array $attributes = [])
 * @method static Fachrichtung|Proxy randomOrCreate(array $attributes = [])
 * @method static FachrichtungRepository|RepositoryProxy repository()
 * @method static Fachrichtung[]|Proxy[] all()
 * @method static Fachrichtung[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Fachrichtung[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Fachrichtung[]|Proxy[] findBy(array $attributes)
 * @method static Fachrichtung[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Fachrichtung[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FachrichtungFactory extends ModelFactory
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
            'bezeichnung' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Fachrichtung $fachrichtung): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Fachrichtung::class;
    }
}
