<?php

namespace App\Factory;

use App\Entity\Fachrichtung;
use App\Entity\Schueler;
use App\Repository\SchuelerRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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

private $entityManger;
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManger = $entityManager;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
       $rep =  $this->entityManger->getRepository(Fachrichtung::class);
       $fachrichtung = $rep->findAll();






        return [
            'Nachname' => self::faker()->lastName(),
            'TelefonNummer' => self::faker()->phoneNumber(),
            'email' => self::faker()->email(),
            'kommentar' => self::faker()->paragraph(3),
            'Vorname' => self::faker()->firstName(),
            'fachrichtung' => $fachrichtung[array_rand($fachrichtung)]
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
