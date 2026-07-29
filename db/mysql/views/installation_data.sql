DROP VIEW IF EXISTS `installation_data`;
CREATE VIEW `installation_data` AS
SELECT `e`.*,
	`u`.`user_id`,
	`u`.`user_name`,
	`u`.`nickname`,
	`u`.`email`
FROM `entities` `e`
	LEFT JOIN `users` `u` ON `u`.`user_id` = `e`.`admin_user`;
