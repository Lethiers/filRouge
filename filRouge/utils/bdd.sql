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
email_util varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table operation (
id_operation int auto_increment primary key not null,
nom_operation varchar(50),
date_operation date,
montant_operation float
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table balance (
id_balance int auto_increment primary key not null,
isPositive bool
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table categorie_utilisateur(
id_categorie_utilisateur int auto_increment primary key not null,
nom_categorie_utilisateur varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table categorie_global(
id_categorie_global int auto_increment primary key not null,
nom_categorie_global varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table diagramme(
id_diagramme int auto_increment primary key not null,
nom_diagramme varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table prevision_depense(
id_prevision_depense int auto_increment primary key not null,
montant_prevision_depense varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table revenu (
id_revenu int auto_increment primary key not null,
nom_revenu varchar(50) not null,
montant_revenu float not null

)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table depense (
id_depense int auto_increment primary key not null,
nom_depense varchar(50) not null,
montant_depense float not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;









create table afficher (
id_diagramme int not null,
id_categorie_global int not null,
primary key(id_diagramme,id_categorie_global)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;









/*
alter table diagramme
add constraint fk_avoir_utilisateur
foreign key (id_util)
references utilisateur (id_util);

alter table utilisateur
add constraint fk_posseder_droit
foreign key (id_droit)
references droit (id_droit);

alter table utilisateur
add constraint fk_domicilier_adresse
foreign key (id_adresse)
references adresse (id_adresse);


alter table adresse
add constraint fk_habiter_ville
foreign key (id_ville)
references ville (id_ville);

alter table resider
add constraint fk_resider_ville
foreign key (id_ville)
references ville (id_ville);

alter table resider
add constraint fk_resider_cp
foreign key(id_cp)
references cp (id_cp);
*/