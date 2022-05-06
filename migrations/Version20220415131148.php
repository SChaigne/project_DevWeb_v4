<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415131148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crypto_currency ADD COLUMN category VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__crypto_currency AS SELECT id, name, symbole, price, description, marketcup, nb_follow_tt FROM crypto_currency');
        $this->addSql('DROP TABLE crypto_currency');
        $this->addSql('CREATE TABLE crypto_currency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, symbole VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, description CLOB DEFAULT NULL, marketcup VARCHAR(255) DEFAULT NULL, nb_follow_tt INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO crypto_currency (id, name, symbole, price, description, marketcup, nb_follow_tt) SELECT id, name, symbole, price, description, marketcup, nb_follow_tt FROM __temp__crypto_currency');
        $this->addSql('DROP TABLE __temp__crypto_currency');
    }
}
