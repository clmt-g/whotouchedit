-- Table des utilisateurs
CREATE TABLE user (
                      idUser INT PRIMARY KEY AUTO_INCREMENT,
                      nom VARCHAR(100) NOT NULL,
                      prenom VARCHAR(100) NOT NULL,
                      login VARCHAR(50) UNIQUE NOT NULL,
                      passwd VARCHAR(255) NOT NULL,
                      role ENUM('technicien', 'responsable', 'admin', 'direction') NOT NULL,
);

-- Table des machines
CREATE TABLE machines (
                          idMachine INT PRIMARY KEY AUTO_INCREMENT,
                          nom VARCHAR(100) NOT NULL,
                          reference VARCHAR(50) UNIQUE NOT NULL,
                          dateInstallation DATE NOT NULL,
                          etat ENUM('opérationnelle', 'en_maintenance', 'planifiée', 'en_panne', 'hors_service') DEFAULT 'opérationnelle',
                          criticite ENUM('faible', 'moyen', 'critique') DEFAULT 'moyen',
                          localisation VARCHAR(200) NOT NULL,
);

-- Table des interventions
CREATE TABLE interventions (
                               idIntervention INT PRIMARY KEY AUTO_INCREMENT,
                               dateHeure DATETIME NOT NULL,
                               description TEXT NOT NULL,
                               statut ENUM('en_attente', 'en_cours', 'terminee', 'annulee') DEFAULT 'en_attente',
                               commentaire TEXT,
                               idMachine INT NOT NULL,
                               idUser INT NOT NULL,
                               FOREIGN KEY (idMachine) REFERENCES machines(idMachine),
                               FOREIGN KEY (idUser) REFERENCES user(idUser)
);

-- Table des interventions planifiées
CREATE TABLE interventions_planifiees (
                                          idInterventionPlanifiee INT PRIMARY KEY AUTO_INCREMENT,
                                          dateDebut DATETIME NOT NULL,
                                          dateFin DATETIME NOT NULL,
                                          type ENUM('préventive', 'contrôle périodique', 'calibration', 'amelioration') NOT NULL,
                                          description TEXT NOT NULL,
                                          statut ENUM('planifiee', 'en_cours', 'terminee', 'annulee') DEFAULT 'planifiee',
                                          frequence ENUM('quotidienne', 'hebdomadaire', 'mensuelle', 'trimestrielle', 'annuelle', 'ponctuelle') NOT NULL,
                                          idMachine INT NOT NULL,
                                          deleted BOOLEAN DEFAULT FALSE,
                                          FOREIGN KEY (idMachine) REFERENCES machines(idMachine)
);

-- Table d'association entre interventions planifiées et techniciens
CREATE TABLE intervention_planifiee_techniciens (
                                                    idInterventionPlanifiee INT NOT NULL,
                                                    idUser INT NOT NULL,
                                                    deleted BOOLEAN DEFAULT FALSE,
                                                    PRIMARY KEY (idInterventionPlanifiee, idUser),
                                                    FOREIGN KEY (idInterventionPlanifiee) REFERENCES interventions_planifiees(idInterventionPlanifiee),
                                                    FOREIGN KEY (idUser) REFERENCES user(idUser)
);
