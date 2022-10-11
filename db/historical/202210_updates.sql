-- Actualizaciones de base de datos en el mes de octubre de 2022
-- Por: Edwin Fajardo
-- 2022-10-06
DROP VIEW available_modules;
CREATE VIEW available_modules AS
SELECT m.*,
	um.access_type,
	em.entity_id,
	u.user_id,
	em.module_order
FROM entity_modules em,
	app_modules m,
	user_modules um,
	users u
WHERE m.module_id = em.module_id
	AND em.status = 1
	AND um.module_id = m.module_id
	AND um.status = 1
	AND u.entity_id = em.entity_id
	AND u.user_id = um.user_id
ORDER BY module_order;
-- Nahutech
-- Teleinf