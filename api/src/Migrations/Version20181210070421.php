<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210070421 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, api_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metric (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metric_value (id INT AUTO_INCREMENT NOT NULL, metric_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, value NUMERIC(18, 10) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, value_interval SMALLINT DEFAULT NULL, INDEX IDX_9E2BA7A1A952D583 (metric_id), INDEX IDX_9E2BA7A144F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE metric_value ADD CONSTRAINT FK_9E2BA7A1A952D583 FOREIGN KEY (metric_id) REFERENCES metric (id)');
        $this->addSql('ALTER TABLE metric_value ADD CONSTRAINT FK_9E2BA7A144F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metric_value DROP FOREIGN KEY FK_9E2BA7A144F5D008');
        $this->addSql('ALTER TABLE metric_value DROP FOREIGN KEY FK_9E2BA7A1A952D583');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE metric');
        $this->addSql('DROP TABLE metric_value');
    }
}
