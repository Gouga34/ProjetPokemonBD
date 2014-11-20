
drop table Concept;
drop table Utilisateur;
drop type Utilisateur_t;
drop type GroupeConcept_t;
drop type GroupeSynonyme_t;
drop type GroupeTerme_t;
drop type Concept_t;
drop type TermeVedette_t;
drop type Synonyme_t;



/*Création des types*********************************************************************************************/


create or replace type TermeVedette_t as Object
(
	idTerme int,
	nomTerme VARCHAR(30),
	description VARCHAR(200)

);
/

create or replace type Synonyme_t as Object
(
	idSynonyme int,
	nomSynonyme VARCHAR(30)

);
/

create type Concept_t
/

/*Creation des tableaux*/
create or replace type GroupeConcept_t as table of Concept_t;
/
create or replace type GroupeTerme_t as table of TermeVedette_t;
/
create or replace type GroupeSynonyme_t as table of Synonyme_t;
/




/*Création type utilisateur */
create or replace type Concept_t as Object
(
	idConcept int,
	nomConcept VARCHAR(30),
	description VARCHAR(200),
	fils GroupeConcept_t,
	parents GroupeConcept_t
);
/

create or replace type GroupeConcept_t as table of Concept_t;
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
	constraint admin check (admin BETWEEN 0 and 1)
)
nested table concepts store as listeConcepts,
nested table termes store as listeTermes,
nested table synonymes store as listeSynonymes
;
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

