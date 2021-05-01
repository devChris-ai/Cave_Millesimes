<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210425154747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE denomination (id INT AUTO_INCREMENT NOT NULL, territory_id INT DEFAULT NULL, appellation VARCHAR(150) NOT NULL, field VARCHAR(150) NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_15AEA10C73F74AD4 (territory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE territory (id INT AUTO_INCREMENT NOT NULL, region VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wine (id INT AUTO_INCREMENT NOT NULL, denomination_id INT DEFAULT NULL, year INT NOT NULL, conservation INT NOT NULL, color VARCHAR(20) NOT NULL, INDEX IDX_560C6468E9293F06 (denomination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE denomination ADD CONSTRAINT FK_15AEA10C73F74AD4 FOREIGN KEY (territory_id) REFERENCES territory (id)');
        $this->addSql('ALTER TABLE wine ADD CONSTRAINT FK_560C6468E9293F06 FOREIGN KEY (denomination_id) REFERENCES denomination (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wine DROP FOREIGN KEY FK_560C6468E9293F06');
        $this->addSql('ALTER TABLE denomination DROP FOREIGN KEY FK_15AEA10C73F74AD4');
        $this->addSql('DROP TABLE denomination');
        $this->addSql('DROP TABLE territory');
        $this->addSql('DROP TABLE wine');
    }
}
