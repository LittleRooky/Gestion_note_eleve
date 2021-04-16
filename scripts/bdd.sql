create table rubrique (
	id int auto_increment,
	nom varchar(50) not null,
	primary key(id)
);

create table options (
	id int auto_increment,
	nom varchar(50) not null,
	lien varchar(255) not null,
	idr int not null,
	primary key(id),
	foreign key (idr) references rubrique(id)
);

create table utilisateur (
	pseudo varchar(30),
	nom varchar(50) not null,
	prenom varchar(100) not null,
	password varchar(15) not null,
	primary key(pseudo)
);

create table avoir (
	ido int not null,
	pseudo varchar(30) not null,
	primary key(ido, pseudo),
	foreign key (ido) references options(id),
	foreign key (pseudo) references utilisateur(pseudo)
);

create table eleve (
	pseudo varchar(30) not null,
	classe enum ('STS1-SIO', 'STS1-SLAM', 'STS1-SISR', 'STS2-SLAM', 'STS2-SISR') not null,
	primary key(pseudo),
	foreign key (pseudo) references utilisateur(pseudo)
);

create table employe (
	pseudo varchar(30) not null,
	poste enum ('PROVISEUR', 'SECRÉTAIRE', 'PROFESSEUR', 'VIE SCOLAIRE') not null,
	primary key(pseudo),
	foreign key (pseudo) references utilisateur(pseudo)
);

create table matiere (
	id int auto_increment,
	nom varchar(255) not null,
	annee enum('STS1-SIO', 'STS2-SIO') not null,
	coefficient int default 1,
	primary key(id)
);

create table suivre (
	pseudo varchar(30) not null,
	idm int not null,
	note decimal(5, 2) not null,
	primary key(pseudo, idm, note),
	foreign key (pseudo) references eleve(pseudo),
	foreign key (idm) references matiere(id)
);
insert into rubrique (nom) values ('RUBRIQUE 1');
insert into rubrique (nom) values ('RUBRIQUE 2');
insert into rubrique (nom) values ('RUBRIQUE 3');

insert into options (nom, idr, lien) values ("Option 1 rub1", 1, "#");
insert into options (nom, idr, lien) values ("Option 2 rub1", 1, "#");
insert into options (nom, idr, lien) values ("Option 3 rub1", 1, "#");
insert into options (nom, idr, lien) values ("Option 1 rub2", 2, "#");
insert into options (nom, idr, lien) values ("Option 1 rub3", 3, "#");
insert into options (nom, idr, lien) values ("Option 2 rub3", 3, "#");