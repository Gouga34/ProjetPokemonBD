
drop table Utilisateur;
drop table Concept;
drop type Utilisateur_t;
drop table TermeVedette;
drop type Concept_t;
drop type GroupeTerme_t;
drop type TermeVedette_t;
drop type GroupeConcept_t;
drop table Synonyme;
drop type GroupeSynonyme_t;
drop type Synonyme_t;



/*Création des types*********************************************************************************************/

/*OK*/
create or replace type Synonyme_t as Object
(
	idSynonyme int,
	nomSynonyme VARCHAR(30)

);
/

/*OK*/
create type Concept_t;
/

/*OK*/
create or replace type GroupeSynonyme_t as table of Synonyme_t;
/

/*OK*/
create or replace type TermeVedette_t as Object
(
	idTerme int,
	nomTerme VARCHAR(30),
	description VARCHAR(200),
	synonymes GroupeSynonyme_t
);
/

/*OK*/
create or replace type GroupeTerme_t as table of TermeVedette_t;
/

create  type GroupeConcept_t as table of Concept_t;
/

create type Concept_t as Object
(
	idConcept int,
	nomConcept VARCHAR(30),
	description VARCHAR(200),
	fils GroupeConcept_t,
	parents GroupeConcept_t
);
/



create or replace type Utilisateur_t as Object /*type utilisateur surement inutile*/
(
	login VARCHAR(30),
	mdp VARCHAR(30),
	mail VARCHAR(50),
	admin number(1), /*0 : utilisateur 1 : admin*/
	concepts GroupeConcept_t,
	termes GroupeTerme_t,
	synonymes GroupeSynonyme_t
);
/



/*Création des tables***************************************************************************************/
create table Utilisateur of Utilisateur_t
(
	constraint cp_utilisateur primary key(login),
	constraint notN_mdp check (mdp IS NOT NULL),
	constraint notN_mail check (mail IS NOT NULL),
	constraint notN_admin check (admin IS NOT NULL),
	constraint unic_mail unique (mail),
	constraint forme_mail check (mail LIKE '%@%.%'),
	constraint value_admin check (admin BETWEEN 0 and 1),
	constraint default_admin admin DEFAULT (0)
)
nested table concepts store as listeConcepts,
nested table termes store as listeTermes,
nested table synonymes store as listeSynonymes
;


create table TermeVedette of TermeVedette_t
(
	constraint cp_termeVedette primary key (idTerme),
	constraint notN_nomTerme check (nomTerme IS NOT NULL)
)
nested table synonymes store as listeSynonymes;

create table Synonyme of Synonyme_t
(
	constraint cp_synonyme check(idSynonyme IS NOT NULL),
	constraint notN_nomSynonyme check (nomSynonyme IS NOT NULL)
);


/*Création de table concept pas finie*/
create table Concept of Concept_t
(
	constraint cp_concept primary key (idConcept),
	/*constraint autoin_concept AUTO_INCREMENT (idConcept),*/
	constraint notN_nomConcept check (nomConcept IS NOT NULL),
	constraint notN_description check (description IS NOT NULL)
)
nested table fils store as listeFils,
nested table parents store as listeParents
;
