<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126144852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B37B2E8B728E969 ON habitat (mac_address)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5BA71B4A54F3B261 ON mirror (identifier_code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5BA71B4A22FFD58C ON mirror (ip_address)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_3B37B2E8B728E969 ON habitat');
        $this->addSql('DROP INDEX UNIQ_5BA71B4A54F3B261 ON mirror');
        $this->addSql('DROP INDEX UNIQ_5BA71B4A22FFD58C ON mirror');
    }
}
