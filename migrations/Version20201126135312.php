<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126135312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitant_profile DROP FOREIGN KEY FK_FDB39DD67FE894F5');
        $this->addSql('DROP INDEX UNIQ_FDB39DD67FE894F5 ON habitant_profile');
        $this->addSql('ALTER TABLE habitant_profile CHANGE habitant_id_id habitant_id INT NOT NULL');
        $this->addSql('ALTER TABLE habitant_profile ADD CONSTRAINT FK_FDB39DD68254716F FOREIGN KEY (habitant_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FDB39DD68254716F ON habitant_profile (habitant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitant_profile DROP FOREIGN KEY FK_FDB39DD68254716F');
        $this->addSql('DROP INDEX UNIQ_FDB39DD68254716F ON habitant_profile');
        $this->addSql('ALTER TABLE habitant_profile CHANGE habitant_id habitant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE habitant_profile ADD CONSTRAINT FK_FDB39DD67FE894F5 FOREIGN KEY (habitant_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FDB39DD67FE894F5 ON habitant_profile (habitant_id_id)');
    }
}
