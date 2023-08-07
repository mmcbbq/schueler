<?php

namespace App\Factory;

use App\Entity\Schueler;
use App\Repository\SchuelerRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
/**
 * @extends ModelFactory<Schueler>
 *
 * @method        Schueler|Proxy create(array|callable $attributes = [])
 * @method static Schueler|Proxy createOne(array $attributes = [])
 * @method static Schueler|Proxy find(object|array|mixed $criteria)
 * @method static Schueler|Proxy findOrCreate(array $attributes)
 * @method static Schueler|Proxy first(string $sortedField = 'id')
 * @method static Schueler|Proxy last(string $sortedField = 'id')
 * @method static Schueler|Proxy random(array $attributes = [])
 * @method static Schueler|Proxy randomOrCreate(array $attributes = [])
 * @method static SchuelerRepository|RepositoryProxy repository()
 * @method static Schueler[]|Proxy[] all()
 * @method static Schueler[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Schueler[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Schueler[]|Proxy[] findBy(array $attributes)
 * @method static Schueler[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Schueler[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class SchuelerFactory extends ModelFactory
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
            'email' => self::faker()->email(),
            'kommentar' => self::faker()->paragraph(nbSentences: 3),
            'nachname' => self::faker()->lastName(),
            'telefonnummer' => self::faker()->phoneNumber(),
            'vorname' => self::faker()->firstName(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Schueler $schueler): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Schueler::class;
    }
}
