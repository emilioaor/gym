-- Inserto un role a los usuarios
ALTER TABLE register_user ADD COLUMN `role` VARCHAR(45) NULL AFTER `user_password`;
-- Los usuarios actuales los considero admin
UPDATE register_user SET role = 'admin' WHERE role IS NULL AND user_id > 0;
-- Role requerido
ALTER TABLE register_user CHANGE COLUMN `role` `role` VARCHAR(45) NOT NULL;

-- Inserto un usuario por cada miembro registrado
insert into register_user (first_name, last_name, user_email, user_password, role)
select member_name, '', member_email, '$2y$12$17QFLskTC0dAvC/GkkK.7OVM.ZnygvYFkyAXCTwGNDOS1mwQDG/VS', 'member'
from member_reg;

-- Crear tabla de clases
CREATE TABLE `classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `time` TIME NOT NULL,
  PRIMARY KEY (`id`));

-- Insertar las clases
INSERT INTO classes (time) VALUES('05:00:00');
INSERT INTO classes (time) VALUES('06:00:00');
INSERT INTO classes (time) VALUES('07:00:00');
INSERT INTO classes (time) VALUES('08:00:00');
INSERT INTO classes (time) VALUES('09:00:00');
INSERT INTO classes (time) VALUES('10:00:00');
INSERT INTO classes (time) VALUES('11:00:00');
INSERT INTO classes (time) VALUES('12:00:00');
INSERT INTO classes (time) VALUES('13:00:00');
INSERT INTO classes (time) VALUES('14:00:00');
INSERT INTO classes (time) VALUES('15:00:00');
INSERT INTO classes (time) VALUES('16:00:00');
INSERT INTO classes (time) VALUES('17:00:00');
INSERT INTO classes (time) VALUES('18:00:00');
INSERT INTO classes (time) VALUES('19:00:00');
INSERT INTO classes (time) VALUES('20:00:00');

-- Relacion entre miembro y clases
CREATE TABLE `class_member` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `class_id` INT NOT NULL,
  `member_id` INT NOT NULL,
  `date` DATE NOT NULL,
  INDEX `fk_class_member_1_idx` (`class_id` ASC),
  INDEX `fk_class_member_2_idx` (`member_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_class_member_1`
  FOREIGN KEY (`class_id`)
  REFERENCES `classes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_member_2`
  FOREIGN KEY (`member_id`)
  REFERENCES `member_reg` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);