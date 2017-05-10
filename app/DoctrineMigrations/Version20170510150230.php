<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170510150230 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enquiry_category DROP FOREIGN KEY FK_739800012469DE2');
        $this->addSql('ALTER TABLE enquiry_category DROP FOREIGN KEY FK_7398000BD918DFF');
        $this->addSql('ALTER TABLE enquiry_category ADD CONSTRAINT FK_739800012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enquiry_category ADD CONSTRAINT FK_7398000BD918DFF FOREIGN KEY (enquiry_id) REFERENCES enquiry (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enquiry_category DROP FOREIGN KEY FK_7398000BD918DFF');
        $this->addSql('ALTER TABLE enquiry_category DROP FOREIGN KEY FK_739800012469DE2');
        $this->addSql('ALTER TABLE enquiry_category ADD CONSTRAINT FK_7398000BD918DFF FOREIGN KEY (enquiry_id) REFERENCES enquiry (id)');
        $this->addSql('ALTER TABLE enquiry_category ADD CONSTRAINT FK_739800012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }
}
