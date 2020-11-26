<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126131140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE habitant_profile (id INT AUTO_INCREMENT NOT NULL, habitant_id_id INT NOT NULL, recognition_code VARCHAR(255) NOT NULL, data JSON NOT NULL, UNIQUE INDEX UNIQ_FDB39DD67FE894F5 (habitant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE habitant_profile ADD CONSTRAINT FK_FDB39DD67FE894F5 FOREIGN KEY (habitant_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE habitant_profile');
    }
}
