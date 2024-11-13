-- Création de la table Class (Classe des personnages)
CREATE TABLE Class (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    base_pv INT NOT NULL,
    base_mana INT NOT NULL,
    strength INT NOT NULL,
    initiative INT NOT NULL,
    max_items INT NOT NULL
);

-- Création de la table Items (Objets disponibles dans le jeu)
CREATE TABLE Items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

-- Création de la table Loot (Butins des monstres)
CREATE TABLE Loot (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    item_id INT, -- Relation avec Items
    quantity INT NOT NULL,
    FOREIGN KEY (item_id) REFERENCES Items(id)
);

-- Création de la table Treasure (Trésors dans les chapitres)
CREATE TABLE Treasure (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    item_id INT, -- Relation avec Items
    quantity INT NOT NULL,
    FOREIGN KEY (item_id) REFERENCES Items(id)
);

-- Création de la table Monster (Monstres rencontrés dans l'histoire)
CREATE TABLE Monster (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    pv INT NOT NULL,
    mana INT,
    initiative INT NOT NULL,
    strength INT NOT NULL,
    attack TEXT,
    loot_id INT, -- Relation avec Loot
    xp INT NOT NULL,
    FOREIGN KEY (loot_id) REFERENCES Loot(id)
);

-- Création de la table Hero (Personnage principal)
CREATE TABLE Hero (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    class_id INT, -- Relation avec Class
    image VARCHAR(255),
    biography TEXT,
    pv INT NOT NULL,
    mana INT NOT NULL,
    strength INT NOT NULL,
    initiative INT NOT NULL,
    armor VARCHAR(50),
    primary_weapon VARCHAR(50),
    secondary_weapon VARCHAR(50),
    shield VARCHAR(50),
    spell_list TEXT,
    xp INT NOT NULL,
    current_level INT DEFAULT 1,
    FOREIGN KEY (class_id) REFERENCES Class(id)
);

-- Création de la table Level (Niveaux de progression des classes)
CREATE TABLE Level (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT, -- Relation avec Class
    level INT NOT NULL,
    required_xp INT NOT NULL,
    pv_bonus INT NOT NULL,
    mana_bonus INT NOT NULL,
    strength_bonus INT NOT NULL,
    initiative_bonus INT NOT NULL,
    FOREIGN KEY (class_id) REFERENCES Class(id)
);

-- Création de la table Chapter (Chapitres de l'histoire)
CREATE TABLE Chapter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    image VARCHAR(255),
    treasure_id INT, -- Relation avec Treasure
    FOREIGN KEY (treasure_id) REFERENCES Treasure(id)
);

-- Création de la table Encounter (Rencontres dans les chapitres)
CREATE TABLE Encounter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT,
    monster_id INT,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(id),
    FOREIGN KEY (monster_id) REFERENCES Monster(id)
);

-- Table intermédiaire pour l'inventaire des héros (Hero - Items)
CREATE TABLE Inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hero_id INT,
    item_id INT,
    FOREIGN KEY (hero_id) REFERENCES Hero(id),
    FOREIGN KEY (item_id) REFERENCES Items(id)
);

-- Création de la table Links (Liens entre chapitres)
CREATE TABLE Links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT,
    next_chapter_id INT,
    description TEXT,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(id),
    FOREIGN KEY (next_chapter_id) REFERENCES Chapter(id)
);

-- Table intermédiaire pour les trésors dans les chapitres (Chapter - Items)
CREATE TABLE Chapter_Treasure (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT,
    item_id INT,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(id),
    FOREIGN KEY (item_id) REFERENCES Items(id)
);

-- Table intermédiaire pour les quêtes des héros (Hero - Chapter)
CREATE TABLE Quest (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hero_id INT,
    chapter_id INT,
    FOREIGN KEY (hero_id) REFERENCES Hero(id),
    FOREIGN KEY (chapter_id) REFERENCES Chapter(id)
);


--Création des classes 
INSERT INTO Class (name, description, base_pv, base_mana, strength, initiative, max_items)
VALUES 
('Guerrier', 'Un combattant robuste et puissant, spécialisé dans le combat au corps à corps.', 30, 0, 25, 12, 6);

INSERT INTO Class (name, description, base_pv, base_mana, strength, initiative, max_items)
VALUES 
('Mage', 'Un expert des arts magiques, utilisant une grande quantité de mana pour lancer des sorts puissants.', 25, 150, 8, 14, 3);

INSERT INTO Class (name, description, base_pv, base_mana, strength, initiative, max_items)
VALUES 
('Voleur', 'Un voleur agile et discret, capable de frapper rapidement et de s’échapper.', 20, 10, 15, 20, 5);

--Création des monstres
INSERT INTO Monster (name, pv, mana, initiative, strength, attack, loot_id, xp)
VALUES 
('Sanglier', 50, 0, 10, 12, 'Charge puissante', 'Cuir de Sanglier', 15);

INSERT INTO Monster (name, pv, mana, initiative, strength, attack, loot_id, xp)
VALUES 
('Loup Noir', 40, 5, 15, 10, 'Morsure vicieuse', 'Croc de Loup Noir', 20);

--Création des loots
INSERT INTO Loot (name, item_id, quantity)
VALUES 
('Cuir de Sanglier', NULL, 1);-- Remplacez NULL par l'ID de l'objet dans la table Items si disponible

INSERT INTO Loot (name, item_id, quantity)
VALUES 
('Croc de Loup Noir', NULL, 1);  -- Remplacez NULL par l'ID de l'objet dans la table Items si disponible
