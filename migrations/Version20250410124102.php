<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250410124102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE ue DROP FOREIGN KEY fk_resp_ue
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE admin DROP FOREIGN KEY fk_teacher
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE admin DROP FOREIGN KEY fk_employee
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bloc DROP FOREIGN KEY fk_ue
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY inscription_ibfk_1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription DROP FOREIGN KEY inscription_ibfk_2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post DROP FOREIGN KEY fk_teacher_post
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post DROP FOREIGN KEY fk_bloc_post
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE admin
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE bloc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE inscription
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE post
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE teacher
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE employee DROP birthdate, CHANGE name name VARCHAR(100) NOT NULL, CHANGE surname surname VARCHAR(100) NOT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE phone_number phone_number VARCHAR(100) NOT NULL, CHANGE password password VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_5D9F75A1E7927C74 ON employee (email)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE student DROP birthdate, CHANGE password password VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_B723AF33E7927C74 ON student (email)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX fk_resp_ue ON ue
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ue CHANGE name name VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, id_teacher INT DEFAULT NULL, id_employee INT DEFAULT NULL, INDEX id_teacher (id_teacher), INDEX fk_employee (id_employee), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE bloc (id INT AUTO_INCREMENT NOT NULL, id_ue INT NOT NULL, name TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_ue (id_ue), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = 'Dans moodle on peut créer des blocs pour organiser l''ue' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE inscription (id_student INT NOT NULL, id_ue INT NOT NULL, date_inscription DATE DEFAULT CURRENT_DATE, INDEX id_ue (id_ue), INDEX IDX_5E90F6D669BE0643 (id_student), PRIMARY KEY(id_student, id_ue)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, id_teacher INT NOT NULL, id_bloc INT NOT NULL, title VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, content MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATETIME NOT NULL, INDEX fk_teacher_post (id_teacher), INDEX fk_bloc_post (id_bloc), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, surname VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, birthdate DATE NOT NULL, email VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, phone_number VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE admin ADD CONSTRAINT fk_teacher FOREIGN KEY (id_teacher) REFERENCES teacher (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE admin ADD CONSTRAINT fk_employee FOREIGN KEY (id_employee) REFERENCES employee (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bloc ADD CONSTRAINT fk_ue FOREIGN KEY (id_ue) REFERENCES ue (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT inscription_ibfk_1 FOREIGN KEY (id_student) REFERENCES student (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE inscription ADD CONSTRAINT inscription_ibfk_2 FOREIGN KEY (id_ue) REFERENCES ue (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD CONSTRAINT fk_teacher_post FOREIGN KEY (id_teacher) REFERENCES teacher (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE post ADD CONSTRAINT fk_bloc_post FOREIGN KEY (id_bloc) REFERENCES bloc (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_5D9F75A1E7927C74 ON employee
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE employee ADD birthdate DATE NOT NULL, CHANGE name name TEXT NOT NULL, CHANGE surname surname TEXT NOT NULL, CHANGE email email TEXT NOT NULL, CHANGE phone_number phone_number INT NOT NULL, CHANGE password password TEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_B723AF33E7927C74 ON student
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE student ADD birthdate DATE NOT NULL, CHANGE password password TEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ue CHANGE name name VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ue ADD CONSTRAINT fk_resp_ue FOREIGN KEY (id_responsable) REFERENCES teacher (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX fk_resp_ue ON ue (id_responsable)
        SQL);
    }
}
