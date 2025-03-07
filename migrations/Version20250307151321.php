<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250307151321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, numero INT NOT NULL, description LONGTEXT NOT NULL, size NUMERIC(10, 2) NOT NULL, weight NUMERIC(10, 2) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_62DC90F398260155 (region_id), INDEX IDX_62DC90F312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_talent (pokemon_id INT NOT NULL, talent_id INT NOT NULL, INDEX IDX_7A307EA12FE71C3E (pokemon_id), INDEX IDX_7A307EA118777CEF (talent_id), PRIMARY KEY(pokemon_id, talent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_type (pokemon_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_B077296A2FE71C3E (pokemon_id), INDEX IDX_B077296AC54C8C93 (type_id), PRIMARY KEY(pokemon_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_gender (pokemon_id INT NOT NULL, gender_id INT NOT NULL, INDEX IDX_ABAE76162FE71C3E (pokemon_id), INDEX IDX_ABAE7616708A0E0 (gender_id), PRIMARY KEY(pokemon_id, gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon_weakness (pokemon_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_E8ECF4E72FE71C3E (pokemon_id), INDEX IDX_E8ECF4E7C54C8C93 (type_id), PRIMARY KEY(pokemon_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F398260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE pokemon_talent ADD CONSTRAINT FK_7A307EA12FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_talent ADD CONSTRAINT FK_7A307EA118777CEF FOREIGN KEY (talent_id) REFERENCES talent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296A2FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_gender ADD CONSTRAINT FK_ABAE76162FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_gender ADD CONSTRAINT FK_ABAE7616708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_weakness ADD CONSTRAINT FK_E8ECF4E72FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_weakness ADD CONSTRAINT FK_E8ECF4E7C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F398260155');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F312469DE2');
        $this->addSql('ALTER TABLE pokemon_talent DROP FOREIGN KEY FK_7A307EA12FE71C3E');
        $this->addSql('ALTER TABLE pokemon_talent DROP FOREIGN KEY FK_7A307EA118777CEF');
        $this->addSql('ALTER TABLE pokemon_type DROP FOREIGN KEY FK_B077296A2FE71C3E');
        $this->addSql('ALTER TABLE pokemon_type DROP FOREIGN KEY FK_B077296AC54C8C93');
        $this->addSql('ALTER TABLE pokemon_gender DROP FOREIGN KEY FK_ABAE76162FE71C3E');
        $this->addSql('ALTER TABLE pokemon_gender DROP FOREIGN KEY FK_ABAE7616708A0E0');
        $this->addSql('ALTER TABLE pokemon_weakness DROP FOREIGN KEY FK_E8ECF4E72FE71C3E');
        $this->addSql('ALTER TABLE pokemon_weakness DROP FOREIGN KEY FK_E8ECF4E7C54C8C93');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE pokemon_talent');
        $this->addSql('DROP TABLE pokemon_type');
        $this->addSql('DROP TABLE pokemon_gender');
        $this->addSql('DROP TABLE pokemon_weakness');
    }
}
