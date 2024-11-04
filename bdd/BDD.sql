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
