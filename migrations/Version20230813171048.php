<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230813171048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fachrichtung (id INT AUTO_INCREMENT NOT NULL, bezeichnung VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schueler (id INT AUTO_INCREMENT NOT NULL, fachrichtung_id INT DEFAULT NULL, nachname VARCHAR(255) NOT NULL, telefon_nummer VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, kommentar LONGTEXT NOT NULL, vorname VARCHAR(255) DEFAULT NULL, INDEX IDX_C382476D8CC5E0D6 (fachrichtung_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schueler ADD CONSTRAINT FK_C382476D8CC5E0D6 FOREIGN KEY (fachrichtung_id) REFERENCES fachrichtung (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schueler DROP FOREIGN KEY FK_C382476D8CC5E0D6');
        $this->addSql('DROP TABLE fachrichtung');
        $this->addSql('DROP TABLE schueler');
    }
}
