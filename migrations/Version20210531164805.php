<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531164805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creating the message table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
			$this->addSql('CREATE TABLE message (id CHAR(36) PRIMARY KEY NOT NULL,
				participant_id CHAR(36) NOT NULL UNIQUE,
				INDEX idx_participant USING BTREE (participant_id(36)),
				username VARCHAR(128) NOT NULL,
				content VARCHAR(768) NOT NULL,
				date_creation VARCHAR(64),
				INDEX idx_date_creation USING BTREE (date_creation(32))
				)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
				$this->addSql('DROP TABLE message');
    }
}
