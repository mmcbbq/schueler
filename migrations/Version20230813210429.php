<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230813210429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE schueler_kurs (schueler_id INT NOT NULL, kurs_id INT NOT NULL, INDEX IDX_737ED6579AC0A64E (schueler_id), INDEX IDX_737ED6572CAAFBEC (kurs_id), PRIMARY KEY(schueler_id, kurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schueler_kurs ADD CONSTRAINT FK_737ED6579AC0A64E FOREIGN KEY (schueler_id) REFERENCES schueler (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schueler_kurs ADD CONSTRAINT FK_737ED6572CAAFBEC FOREIGN KEY (kurs_id) REFERENCES kurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schueler_kurs DROP FOREIGN KEY FK_737ED6579AC0A64E');
        $this->addSql('ALTER TABLE schueler_kurs DROP FOREIGN KEY FK_737ED6572CAAFBEC');
        $this->addSql('DROP TABLE schueler_kurs');
    }
}
