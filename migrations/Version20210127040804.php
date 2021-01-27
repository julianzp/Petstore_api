<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127040804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pet ADD category_id INT DEFAULT NULL, ADD tags_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B8512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B858D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E4529B8512469DE2 ON pet (category_id)');
        $this->addSql('CREATE INDEX IDX_E4529B858D7B4FB4 ON pet (tags_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pet DROP FOREIGN KEY FK_E4529B8512469DE2');
        $this->addSql('ALTER TABLE pet DROP FOREIGN KEY FK_E4529B858D7B4FB4');
        $this->addSql('DROP INDEX UNIQ_E4529B8512469DE2 ON pet');
        $this->addSql('DROP INDEX IDX_E4529B858D7B4FB4 ON pet');
        $this->addSql('ALTER TABLE pet DROP category_id, DROP tags_id');
    }
}
