create database filRouge;
use filRouge;

create table droit (
id_droit int auto_increment primary key not null,
nom_droit varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table utilisateur(
id_util int auto_increment primary key not null,
mdp_util varchar(100),
pseudo_util varchar(50),
nom_util varchar(50),
prenom_util varchar(50),
email_util varchar(50),
id_droit int not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table operation (
id_operation int auto_increment primary key not null,
date_operation date,
montant_operation float,
nom_operation varchar(50),
id_categorie_global int not null,
id_categorie_utilisateur int null,
id_util int not null,
id_balance int not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table balance (
id_balance int auto_increment primary key not null,
isPositive tinyint(1) default null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table categorie_utilisateur(
id_categorie_utilisateur int auto_increment primary key not null,
nom_categorie_utilisateur varchar(50),
id_categorie_global int not null,
id_util int not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table categorie_global(
id_categorie_global int auto_increment primary key not null,
nom_categorie_global varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table diagramme(
id_diagramme int auto_increment primary key not null,
nom_diagramme varchar(50),
id_util int not null,
id_frequence int not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table frequence(
id_frequence int auto_increment primary key not null,
liste_frequence varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table ajouter(
id_diagramme int not null,
id_categorie_utilisateur int not null,
budget float null,
primary key (id_diagramme,id_categorie_utilisateur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table avoir(
id_diagramme int not null,
id_categorie_global int not null,
budget float null,
primary key (id_diagramme,id_categorie_global)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


---------------------------------------- ajout des contraintes ---------------------


-------------------------- contrainte pour la table d'association //////////ajouter
-- id_diagramme
alter table ajouter
add constraint fk_ajouter_diagramme
foreign key (id_diagramme)
references diagramme(id_diagramme);
-- id_categorie_utilisateur
alter table ajouter
add constraint fk_ajouter_categorie_utilisateur
foreign key (id_categorie_utilisateur)
references categorie_utilisateur(id_categorie_utilisateur);


-------------------------- contrainte pour la table d'association //////////avoir
-- id_diagramme
alter table avoir
add constraint fk_avoir_diagramme
foreign key (id_diagramme)
references diagramme(id_diagramme);
-- id_categorie_utilisateur
alter table avoir
add constraint fk_avoir_categorie_utilisateur
foreign key (id_categorie_global)
references categorie_global(id_categorie_global);

---------------------------------------- contrainte pour la table ///////////categorie utilisateur

-- id  categorie_global
alter table categorie_utilisateur
add constraint fk_ranger_categorie_global
foreign key (id_categorie_global)
references categorie_global(id_categorie_global);

-- id  util
alter table categorie_utilisateur
add constraint fk_creer_utilisateur
foreign key (id_util)
references utilisateur(id_util);

---------------------------------------- contrainte pour la table /////////// diagramme
-- id  frequence
alter table diagramme
add constraint fk_repeter_frequence
foreign key (id_frequence)
references frequence(id_frequence);

-- id  utilisateur
alter table diagramme
add constraint fk_concevoir_utilisateur
foreign key (id_util)
references utilisateur(id_util);


---------------------------------------- contrainte pour la table /////////// utilisateur
-- id  droit
alter table utilisateur
add constraint fk_posseder_droit
foreign key (id_droit)
references droit(id_droit);

--------------------------------------------- contrainte de la table operation

-- id_categorie_global
alter table operation 
add constraint fk_operer_categorie_global
foreign key(id_categorie_global)
references categorie_global(id_categorie_global);

-- id_categorie_utilisateur
alter table operation 
add constraint fk_associer_categorie_utilisateur
foreign key(id_categorie_utilisateur)
references categorie_utilisateur(id_categorie_utilisateur);

-- id_balance 
alter table operation 
add constraint fk_etre_balance
foreign key(id_balance)
references balance (id_balance);

-- id_util
alter table operation 
add constraint fk_depenser_utilisateur
foreign key(id_util)
references utilisateur (id_util);


insert into droit (nom_droit) values 
("Utilisateur"),
("Admin");

insert into frequence (liste_frequence) values 
("jour"),
("mois"),
("bimestriel"),
("trimestriel"),
("quadrimestriel"),
("semestriel "),
("annuel");






