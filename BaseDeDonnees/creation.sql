

drop table Utilisateur;
drop table Concept;
drop table TermeVedette;
drop table Synonyme;
drop type Utilisateur_t;
drop type Concept_t force;
drop type GroupeTerme_t;
drop type TermeVedette_t;
drop type GroupeConcept_t;
drop type GroupeSynonyme_t;
drop type Synonyme_t;



/*Création des types*********************************************************************************************/

create or replace type Synonyme_t as Object
(
	nomSynonyme VARCHAR(30)
);
/

create type Concept_t;
/

create or replace type GroupeSynonyme_t as table of ref Synonyme_t;
/

create or replace type TermeVedette_t as Object
(
	nomTerme VARCHAR(30),
	description VARCHAR(200),
	synonymes GroupeSynonyme_t
);
/


create or replace type GroupeTerme_t as table of ref TermeVedette_t;
/

create  type GroupeConcept_t as table of ref Concept_t;
/


create or replace type Concept_t as Object
(
	nomConcept VARCHAR(30),
	description VARCHAR(200),
	fils GroupeConcept_t,
	parents GroupeConcept_t,
	vedette REF TermeVedette_t
);
/

create or replace type Utilisateur_t as Object /*type utilisateur surement inutile*/
(
	login VARCHAR(30),
	mdp VARCHAR(100),
	mail VARCHAR(50),
	admin number(1), /*0 : utilisateur 1 : admin*/
	concepts GroupeConcept_t,
	synonymes GroupeSynonyme_t,
	termes GroupeTerme_t

);
/



/*Création des tables***************************************************************************************/

create table Synonyme of Synonyme_t
(
	constraint cp_synonyme primary key (nomSynonyme),
	constraint notN_nomSynonyme check (nomSynonyme IS NOT NULL)
);

create table TermeVedette of TermeVedette_t
(
	constraint cp_termeVedette primary key (nomTerme),
	constraint notN_nomTerme check (nomTerme IS NOT NULL)
)
nested table synonymes store as listeSynonymesTerme;

create table Concept of Concept_t
(
	constraint cp_concept primary key (nomConcept),
	constraint notN_nomConcept check (nomConcept IS NOT NULL),
	constraint notN_description check (description IS NOT NULL),
	constraint notN_vedette check (vedette IS NOT NULL)
)
nested table fils store as listeFilsConcept,
nested table parents store as listeParentsConcept
;

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
nested table concepts store as listeConceptsUtilisateur,
nested table synonymes store as listeSynonymesUtilisateur,
nested table termes store as listeTermesUtilisateur 
;



