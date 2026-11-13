CREATE TABLE Sites (
	idSite INT UNSIGNED NOT NULL AUTO_INCREMENT,
	ville VARCHAR(50) NOT NULL,
	CONSTRAINT pk_sites PRIMARY KEY(idSite)
)ENGINE=InnoDB;

CREATE TABLE Parcelles (
	idParcelle INT UNSIGNED NOT NULL AUTO_INCREMENT,
	longueur INT UNSIGNED NOT NULL,
	largeur INT UNSIGNED NOT NULL,
	CONSTRAINT pk_parcelles PRIMARY KEY(idParcelle),
	CONSTRAINT fk_parcelles_site FOREIGN KEY(idSite) REFERENCES Sites(idEntreprise)
)ENGINE=InnoDB;

CREATE TABLE Objets (
	idObjet INT UNSIGNED NOT NULL AUTO_INCREMENT,
	designation VARCHAR(255) NOT NULL,
	categorie VARCHAR(50) NOT NULL,
	completude VARCHAR(50) NOT NULL,
	conservation TIME UNSIGNED NOT NULL,
	dateDecouverte DATE NOT NULL,
	CONSTRAINT pk_objets PRIMARY KEY(idObjet),
	CONSTRAINT fk_objets_parcelle FOREIGN KEY(idParcelle) REFERENCES Parcelles(idParcelle),
	CONSTRAINT fk_objets_equipe FOREIGN KEY(idEquipe) REFERENCES Equipes(idEquipe) 
)ENGINE=InnoDB;

CREATE TABLE Equipes (
	idEquipe INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nomEquipe VARCHAR(50) NOT NULL, 
	sigleEquipe TINYTEXT NOT NULL,
	CONSTRAINT pk_equipes PRIMARY KEY(idEquipe),
	CONSTRAINT fk_equipes_chercheur FOREIGN KEY(idChercheur) REFERENCES Chercheurs(idChercheur)
)ENGINE=InnoDB;

CREATE TABLE Chercheurs (
	idChercheur INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nomChercheur VARCHAR(50) NOT NULL,
	prenomChercheur VARCHAR(50) NOT NULL,
	fonction VARCHAR(50) NOT NULL,
	CONSTRAINT pk_chercheurs PRIMARY KEY(idChercheur),
	CONSTRAINT fk_chercheurs_equipe FOREIGN KEY(idEquipe) REFERENCES Equipes(idEquipe)
)ENGINE=InnoDB;

CREATE TABLE Fouilles (
	refParcelle INT UNSIGNED NOT NULL AUTO_INCREMENT,
	refEquipe INT UNSIGNED NOT NULL AUTO_INCREMENT,
	dateFouille DATE NOT NULL,
	CONSTRAINT pk_dateFouille PRIMARY KEY(dateFouille),
	CONSTRAINT fk_fouilles_parcelle FOREIGN KEY(idParcelle) REFERENCES Parcelles(idParcelle),
	CONSTRAINT fk_fouilles_equipe FOREIGN KEY(idEquipe) REFERENCES Equipes(idEquipe)
)ENGINE=InnoDB;