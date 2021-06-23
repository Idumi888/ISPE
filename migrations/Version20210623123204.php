<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623123204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concerne (id INT AUTO_INCREMENT NOT NULL, id_epreuve_id INT DEFAULT NULL, id_eleve_id INT DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, presence TINYINT(1) NOT NULL, INDEX IDX_37FF4F7BE1383E1 (id_epreuve_id), INDEX IDX_37FF4F7B5AB72B27 (id_eleve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epreuve (id INT AUTO_INCREMENT NOT NULL, code_module VARCHAR(255) NOT NULL, nom_module VARCHAR(50) NOT NULL, classe VARCHAR(50) NOT NULL, nombre_eleve INT NOT NULL, sujet VARCHAR(255) DEFAULT NULL, duree INT NOT NULL, date_epreuve DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epreuve_user (epreuve_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F4EBAB89AB990336 (epreuve_id), INDEX IDX_F4EBAB89A76ED395 (user_id), PRIMARY KEY(epreuve_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE concerne ADD CONSTRAINT FK_37FF4F7BE1383E1 FOREIGN KEY (id_epreuve_id) REFERENCES epreuve (id)');
        $this->addSql('ALTER TABLE concerne ADD CONSTRAINT FK_37FF4F7B5AB72B27 FOREIGN KEY (id_eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE epreuve_user ADD CONSTRAINT FK_F4EBAB89AB990336 FOREIGN KEY (epreuve_id) REFERENCES epreuve (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE epreuve_user ADD CONSTRAINT FK_F4EBAB89A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concerne DROP FOREIGN KEY FK_37FF4F7B5AB72B27');
        $this->addSql('ALTER TABLE concerne DROP FOREIGN KEY FK_37FF4F7BE1383E1');
        $this->addSql('ALTER TABLE epreuve_user DROP FOREIGN KEY FK_F4EBAB89AB990336');
        $this->addSql('ALTER TABLE epreuve_user DROP FOREIGN KEY FK_F4EBAB89A76ED395');
        $this->addSql('DROP TABLE concerne');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE epreuve');
        $this->addSql('DROP TABLE epreuve_user');
        $this->addSql('DROP TABLE `user`');
    }
}
