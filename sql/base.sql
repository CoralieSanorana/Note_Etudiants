create database ITU;
use ITU;

create table eleve(
    id_eleve int primary key auto_increment,
    etu varchar(10) not null,
    nom varchar(200) not null,
    prenom varchar(200) not null,
    date_naissance date,
    lieu_naissance varchar(200)
);

CREATE table semestre(
    id_semestre int primary key auto_increment,
    semestre varchar(10),
    option int not null -- 0 si aucune option, 1 sinon
);

create table matiere(
    id_matiere int primary key auto_increment,
    ue varchar(20),
    intitule varchar(250)
);

create table inscription(
    id_inscription int primary key auto_increment,
    id_eleve int not null,
    id_semestre int not null,
    date_inscription datetime,
    foreign key (id_eleve) references eleve(id_eleve),
    foreign key (id_semestre) references semestre(id_semestre)
);

create table option(
    id_option int primary key auto_increment,
    option varchar(20)
);

create table config(
    id_config int primary key auto_increment,
    id_semestre int not null,
    id_option int,
    id_matiere int not null,
    credit int,
    foreign key (id_semestre) references semestre(id_semestre),
    foreign key (id_matiere) references matiere(id_matiere)
);

create table note(
    id_note int primary key auto_increment,
    id_eleve int not null,
    id_semestre int not null,
    id_matiere int not null,
    note decimal(10, 2),
    resultat varchar(5),
    foreign key (id_semestre) references semestre(id_semestre),
    foreign key (id_matiere) references matiere(id_matiere),
    foreign key (id_eleve) references eleve(id_eleve)
);

SELECT 
    e.*, 
    n.note, 
    n.resultat,
    s. 
    s.semestre, 
    c.id_option, 
    c.id_matiere, 
    m.intitule,
    c.credit
FROM eleve e
LEFT JOIN note n ON n.id_eleve = e.id_eleve
LEFT JOIN config c ON c.id_semestre = n.id_semestre AND c.id_matiere = n.id_matiere
LEFT JOIN semestre s ON s.id_semestre = c.id_semestre
LEFT JOIN matiere m ON m.id_matiere = c.id_matiere;