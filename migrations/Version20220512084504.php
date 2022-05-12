<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512084504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E666962A644');
        $this->addSql('DROP INDEX IDX_23A0E6679F37AE5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, id_user_id, id_crypto_id, titre, content, nb_like, date FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_crypto_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, content CLOB NOT NULL, nb_like INTEGER DEFAULT NULL, date DATETIME NOT NULL, CONSTRAINT FK_23A0E6679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_23A0E666962A644 FOREIGN KEY (id_crypto_id) REFERENCES crypto_currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, id_user_id, id_crypto_id, titre, content, nb_like, date) SELECT id, id_user_id, id_crypto_id, titre, content, nb_like, date FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E666962A644 ON article (id_crypto_id)');
        $this->addSql('CREATE INDEX IDX_23A0E6679F37AE5 ON article (id_user_id)');
        $this->addSql('DROP INDEX IDX_1CAC12CAD71E064B');
        $this->addSql('DROP INDEX IDX_1CAC12CA79F37AE5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentary AS SELECT id, id_user_id, id_article_id, text FROM commentary');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('CREATE TABLE commentary (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_article_id INTEGER NOT NULL, text CLOB NOT NULL, CONSTRAINT FK_1CAC12CA79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1CAC12CAD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentary (id, id_user_id, id_article_id, text) SELECT id, id_user_id, id_article_id, text FROM __temp__commentary');
        $this->addSql('DROP TABLE __temp__commentary');
        $this->addSql('CREATE INDEX IDX_1CAC12CAD71E064B ON commentary (id_article_id)');
        $this->addSql('CREATE INDEX IDX_1CAC12CA79F37AE5 ON commentary (id_user_id)');
        $this->addSql('DROP INDEX IDX_3A629B71C72A4771');
        $this->addSql('DROP INDEX IDX_3A629B71A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subscribe_user AS SELECT subscribe_id, user_id FROM subscribe_user');
        $this->addSql('DROP TABLE subscribe_user');
        $this->addSql('CREATE TABLE subscribe_user (subscribe_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(subscribe_id, user_id), CONSTRAINT FK_3A629B71C72A4771 FOREIGN KEY (subscribe_id) REFERENCES subscribe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3A629B71A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO subscribe_user (subscribe_id, user_id) SELECT subscribe_id, user_id FROM __temp__subscribe_user');
        $this->addSql('DROP TABLE __temp__subscribe_user');
        $this->addSql('CREATE INDEX IDX_3A629B71C72A4771 ON subscribe_user (subscribe_id)');
        $this->addSql('CREATE INDEX IDX_3A629B71A76ED395 ON subscribe_user (user_id)');
        $this->addSql('DROP INDEX IDX_FD61255EC72A4771');
        $this->addSql('DROP INDEX IDX_FD61255E19932572');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subscribe_crypto_currency AS SELECT subscribe_id, crypto_currency_id FROM subscribe_crypto_currency');
        $this->addSql('DROP TABLE subscribe_crypto_currency');
        $this->addSql('CREATE TABLE subscribe_crypto_currency (subscribe_id INTEGER NOT NULL, crypto_currency_id INTEGER NOT NULL, PRIMARY KEY(subscribe_id, crypto_currency_id), CONSTRAINT FK_FD61255EC72A4771 FOREIGN KEY (subscribe_id) REFERENCES subscribe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FD61255E19932572 FOREIGN KEY (crypto_currency_id) REFERENCES crypto_currency (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO subscribe_crypto_currency (subscribe_id, crypto_currency_id) SELECT subscribe_id, crypto_currency_id FROM __temp__subscribe_crypto_currency');
        $this->addSql('DROP TABLE __temp__subscribe_crypto_currency');
        $this->addSql('CREATE INDEX IDX_FD61255EC72A4771 ON subscribe_crypto_currency (subscribe_id)');
        $this->addSql('CREATE INDEX IDX_FD61255E19932572 ON subscribe_crypto_currency (crypto_currency_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, lastname, email, adress, phone_number, birthday_date, is_expert, roles, login, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, birthday_date DATE DEFAULT NULL, is_expert BOOLEAN DEFAULT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , login VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, name, lastname, email, adress, phone_number, birthday_date, is_expert, roles, login, password) SELECT id, name, lastname, email, adress, phone_number, birthday_date, is_expert, roles, login, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_23A0E6679F37AE5');
        $this->addSql('DROP INDEX IDX_23A0E666962A644');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, id_user_id, id_crypto_id, titre, content, nb_like, date FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_crypto_id INTEGER NOT NULL, titre VARCHAR(255) NOT NULL, content CLOB NOT NULL, nb_like INTEGER DEFAULT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO article (id, id_user_id, id_crypto_id, titre, content, nb_like, date) SELECT id, id_user_id, id_crypto_id, titre, content, nb_like, date FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6679F37AE5 ON article (id_user_id)');
        $this->addSql('CREATE INDEX IDX_23A0E666962A644 ON article (id_crypto_id)');
        $this->addSql('DROP INDEX IDX_1CAC12CA79F37AE5');
        $this->addSql('DROP INDEX IDX_1CAC12CAD71E064B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentary AS SELECT id, id_user_id, id_article_id, text FROM commentary');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('CREATE TABLE commentary (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_article_id INTEGER NOT NULL, text CLOB NOT NULL)');
        $this->addSql('INSERT INTO commentary (id, id_user_id, id_article_id, text) SELECT id, id_user_id, id_article_id, text FROM __temp__commentary');
        $this->addSql('DROP TABLE __temp__commentary');
        $this->addSql('CREATE INDEX IDX_1CAC12CA79F37AE5 ON commentary (id_user_id)');
        $this->addSql('CREATE INDEX IDX_1CAC12CAD71E064B ON commentary (id_article_id)');
        $this->addSql('DROP INDEX IDX_FD61255EC72A4771');
        $this->addSql('DROP INDEX IDX_FD61255E19932572');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subscribe_crypto_currency AS SELECT subscribe_id, crypto_currency_id FROM subscribe_crypto_currency');
        $this->addSql('DROP TABLE subscribe_crypto_currency');
        $this->addSql('CREATE TABLE subscribe_crypto_currency (subscribe_id INTEGER NOT NULL, crypto_currency_id INTEGER NOT NULL, PRIMARY KEY(subscribe_id, crypto_currency_id))');
        $this->addSql('INSERT INTO subscribe_crypto_currency (subscribe_id, crypto_currency_id) SELECT subscribe_id, crypto_currency_id FROM __temp__subscribe_crypto_currency');
        $this->addSql('DROP TABLE __temp__subscribe_crypto_currency');
        $this->addSql('CREATE INDEX IDX_FD61255EC72A4771 ON subscribe_crypto_currency (subscribe_id)');
        $this->addSql('CREATE INDEX IDX_FD61255E19932572 ON subscribe_crypto_currency (crypto_currency_id)');
        $this->addSql('DROP INDEX IDX_3A629B71C72A4771');
        $this->addSql('DROP INDEX IDX_3A629B71A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subscribe_user AS SELECT subscribe_id, user_id FROM subscribe_user');
        $this->addSql('DROP TABLE subscribe_user');
        $this->addSql('CREATE TABLE subscribe_user (subscribe_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(subscribe_id, user_id))');
        $this->addSql('INSERT INTO subscribe_user (subscribe_id, user_id) SELECT subscribe_id, user_id FROM __temp__subscribe_user');
        $this->addSql('DROP TABLE __temp__subscribe_user');
        $this->addSql('CREATE INDEX IDX_3A629B71C72A4771 ON subscribe_user (subscribe_id)');
        $this->addSql('CREATE INDEX IDX_3A629B71A76ED395 ON subscribe_user (user_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, login, roles, password, email, name, lastname, adress, phone_number, birthday_date, is_expert FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(255) NOT NULL, roles VARCHAR(255) DEFAULT \'visitor\' NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(20) NOT NULL, lastname VARCHAR(20) NOT NULL, adress VARCHAR(255) DEFAULT NULL, phone_number INTEGER NOT NULL, birthday_date DATE DEFAULT NULL, is_expert BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, login, roles, password, email, name, lastname, adress, phone_number, birthday_date, is_expert) SELECT id, login, roles, password, email, name, lastname, adress, phone_number, birthday_date, is_expert FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
