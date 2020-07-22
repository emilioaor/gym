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