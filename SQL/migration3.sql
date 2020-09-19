-- Agrego token de firebase al usuario
ALTER TABLE register_user ADD COLUMN `firebase_token` VARCHAR(255) NULL;
