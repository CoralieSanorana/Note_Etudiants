-- Insertions des élèves
INSERT INTO eleve (etu, nom, prenom, date_naissance, lieu_naissance) VALUES
('ETU001', 'Dupont', 'Jean', '2005-03-15', 'Paris'),
('ETU002', 'Martin', 'Marie', '2004-07-22', 'Lyon'),
('ETU003', 'Bernard', 'Pierre', '2005-11-08', 'Marseille'),
('ETU004', 'Durand', 'Sophie', '2004-05-19', 'Toulouse'),
('ETU005', 'Moreau', 'Luc', '2005-09-30', 'Nice');

INSERT INTO semestre (semestre, option) VALUES
('Semestre 3', 0),
('Semestre 4', 1);

-- Semestre 3
INSERT INTO matiere (ue, intitule) VALUES
('INF201', 'Programmation oriente objet'), -- 1
('INF202', 'Base de donnees objets'), -- 2
('INF203', 'Programmation systeme'), -- 3
('INF208', 'Reseau informatique'), -- 4
('MTH201', 'Methodes numeriques'), -- 5
('ORG201', 'Base de gestion'); -- 6

-- Semestre 4
INSERT INTO matiere (ue, intitule) VALUES
('INF204', 'Systeme d"information geographique'), -- 7
('INF205', 'Systeme d"information'), -- 8
('INF206', 'Interface Homme/Machine'), -- 9
('INF207', 'Elements d"algorithme'), -- 10
('INF209', 'Web dynamique'), -- 11
('INF210', 'Mini-projet de developpement'), -- 12
('INF211', 'Mini-projet de base de donnees et/ou de reseau'), -- 13
('INF212', 'Mini-projet de Web et design'), -- 14
('MTH203', 'MAO'), -- 15
('MTH204', 'Geometrie'), -- 16
('MTH205', 'Equations differentielles'), -- 17
('MTH206', 'Optimisation'), -- 18
('MTH202', 'Analyse des donnees'); -- 19



INSERT INTO option (option) VALUES
('Developpement'),
('Base de Donnees et Reseaux'),
('Web et Design');

-- Config pour Semestre 3
INSERT INTO config (id_semestre, id_matiere, credit) VALUES
(1, 1, 6),
(1, 2, 6),
(1, 3, 4),
(1, 4, 6),
(1, 5, 4),
(1, 6, 4);

-- Config pour Semestre 4
INSERT INTO config (id_semestre, id_option, id_matiere, credit) VALUES

-- Option DEV
(2, 1, 7, 6),
(2, 1, 8, 6),
(2, 1, 9, 4),
(2, 1,10, 6),
(2, 1,12, 10),
(2, 1,16, 4),
(2, 1,17, 4),
(2, 1,18, 4),
(2, 1,15, 4),

-- Option BD et Reseaux
(2, 2, 8, 6), 
(2, 2, 7, 6), 
(2, 2, 9, 6), 
(2, 2,10, 6), 
(2, 2,13, 10), 
(2, 2,19, 4),
(2, 2,17, 4),
(2, 2,18, 4),
(2, 2,15, 4),

-- Option Web et Design
(2, 3, 7, 6), 
(2, 3, 8, 6), 
(2, 3, 9, 6), 
(2, 3,10, 6),
(2, 3,11, 6),
(2, 3,14, 10),
(2, 3,19, 4),
(2, 3,16, 4),
(2, 3,18, 4),
(2, 3,15, 4);