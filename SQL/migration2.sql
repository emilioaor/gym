-- Agrego estatus a las clases
ALTER TABLE classes ADD COLUMN `status` VARCHAR(20) NOT NULL DEFAULT 'active';
