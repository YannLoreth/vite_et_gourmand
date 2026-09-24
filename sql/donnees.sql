-- Jours de la semaine
INSERT INTO jours (libelle) VALUES
('Lundi'),
('Mardi'),
('Mercredi'),
('Jeudi'),
('Vendredi'),
('Samedi'),
('Dimanche');


-- Horaires
INSERT INTO horaire (jours_id, horaire_ouverture, horaire_fermeture) VALUES
(1, '09:00', '18:00'),
(2, '09:00', '18:00'),
(3, '09:00', '18:00'),
(4, '09:00', '18:00'),
(5, '09:00', '19:00'),
(6, '10:00', '17:00'),
(7, '10:00', '15:00');

INSERT INTO roles (libelle) VALUES
('Utilisateur'),
('Employé'),
('Administrateur');

-- regime
INSERT INTO regime (libelle) VALUES
('classique'),
('vegetarien'),
('vegan'),
('sans gluten');

-- theme
INSERT INTO theme (libelle) VALUES
('classique'),
('Noel'),
('Paques'),
('evenement');

-- Statut avis
INSERT INTO statut_avis (libelle) VALUES
('en_attente'),
('valide'),
('refuse');

-- menus
INSERT INTO menus (titre, nombre_personne_minimum, prix_par_personne, regime_id, theme_id, description, quantite_restante, conditions_menu) VALUES
('Menu de Noël gourmand', 12, 45.00, 1, 2, 'Un menu de fête complet, entrée chaude, plat mijoté, dessert traditionnel', 8, 'A commander 2 semaines avant la prestation'),
('Menu anniversaire classique', 6, 32.00, 1, 4, 'Formule conviviale pour toute occasion festive', 15, 'A commander 1 semaine avant'),
('Menu découverte classique', 4, 28.00, 1, 1, 'Menu simple et généreux pour un repas entre amis', 20, 'A commander 3 jours avant');

-- adresse_livraison
INSERT INTO adresse_livraison (adresse, code_postal, ville) VALUES
('12 rue des Vignes', '33000', 'Bordeaux'),
('5 allée du Parc', '33200', 'Bordeaux'),
('8 place Gambetta', '33000', 'Bordeaux');

-- statut_commande
INSERT INTO statut_commande (libelle) VALUES
('accepte'),
('en_preparation'),
('en_cours_de_livraison'),
('livre'),
('en_attente_du_retour_de_materiel'),
('terminee');

-- utilisateur
INSERT INTO utilisateur (email, pass, prenom, nom, telephone, ville, pays, addresse_postale, roles_id, code_postal) VALUES
('camille.r@example.com', 'motdepasseHash1', 'Camille', 'R.', '0611111111', 'Bordeaux', 'France', '12 rue des Vignes', 1, '33000'),
('thomas.l@example.com', 'motdepasseHash2', 'Thomas', 'L.', '0622222222', 'Bordeaux', 'France', '5 allée du Parc', 1, '33200'),
('sophie.m@example.com', 'motdepasseHash3', 'Sophie', 'M.', '0633333333', 'Bordeaux', 'France', '8 place Gambetta', 1, '33000');

-- commande
INSERT INTO commande (date_commande, date_prestation, heure_livraison, prix_menu, nombre_personne, prix_livraison, pret_materiel, restitution_materiel, adresse_livraison_id, utilisateur_id, menu_id, statut_commande_id) VALUES
('2026-12-10', '2026-12-24', '12:00:00', 540.00, 12, 0.00, TRUE, TRUE, 1, 1, 1, 6),
('2026-09-01', '2026-09-15', '19:00:00', 192.00, 6, 0.00, FALSE, NULL, 2, 2, 2, 6),
('2026-08-20', '2026-08-28', '13:00:00', 112.00, 4, 0.00, FALSE, NULL, 3, 3, 3, 6);

-- avis
INSERT INTO avis (note, commentaire, statut_avis_id, numero_commande) VALUES
(5, 'Menu de Noël réservé pour 12 personnes, tout était parfait ! Les plats étaient copieux, bien présentés, et la livraison est arrivée pile à l''heure. On recommande à 100%.', 2, 1),
(4, 'Très bonne prestation pour l''anniversaire de ma fille. Quelques minutes de retard sur la livraison, mais l''équipe nous a prévenus à l''avance. Les plats étaient délicieux, on recommencera.', 2, 2),
(5, 'Première commande chez Vite & Gourmand pour un menu classique entre amis, et clairement pas la dernière. Rapport qualité-prix excellent, et le service client a été très réactif à mes questions.', 2, 3);