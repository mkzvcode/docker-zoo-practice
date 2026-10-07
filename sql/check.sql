SHOW TABLES;
SELECT COUNT(*) AS cnt FROM animals;
SELECT a.id, a.name AS animal, s.name AS species, e.name AS enclosure,
       a.birth_date, a.weight
FROM animals a
JOIN species s ON a.species_id = s.id
JOIN enclosures e ON a.enclosure_id = e.id
ORDER BY a.id;
