<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202121858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blogs ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blogs ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blogs ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN blogs.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE category ADD feed_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category ADD feed_last_updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN category.feed_last_updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE blogs DROP title');
        $this->addSql('ALTER TABLE blogs DROP description');
        $this->addSql('ALTER TABLE blogs DROP created_at');
        $this->addSql('ALTER TABLE category DROP feed_url');
        $this->addSql('ALTER TABLE category DROP feed_last_updated_at');
    }
}
