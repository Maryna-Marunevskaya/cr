<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170510125150 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE request_category DROP FOREIGN KEY FK_F369F9E4427EB8A5');
        $this->addSql('CREATE TABLE enquiry (id INT AUTO_INCREMENT NOT NULL, enquiry VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enquiry_category (enquiry_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_7398000BD918DFF (enquiry_id), INDEX IDX_739800012469DE2 (category_id), PRIMARY KEY(enquiry_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enquiry_category ADD CONSTRAINT FK_7398000BD918DFF FOREIGN KEY (enquiry_id) REFERENCES enquiry (id)');
        $this->addSql('ALTER TABLE enquiry_category ADD CONSTRAINT FK_739800012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE request_category');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enquiry_category DROP FOREIGN KEY FK_7398000BD918DFF');
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request_category (request_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_F369F9E4427EB8A5 (request_id), INDEX IDX_F369F9E412469DE2 (category_id), PRIMARY KEY(request_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE request_category ADD CONSTRAINT FK_F369F9E412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE request_category ADD CONSTRAINT FK_F369F9E4427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id)');
        $this->addSql('DROP TABLE enquiry');
        $this->addSql('DROP TABLE enquiry_category');
    }
}
