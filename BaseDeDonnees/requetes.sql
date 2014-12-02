/***requetes.sql***/

/* rlwrap sqlplus login/mdp@venus/master */


/*aideTable*/
SELECT * FROM tab ; /*liste toutes les tables*/
DESC NomTable; /*liste touts les attributs de la table*/

SELECT * FROM Concept;
SELECT * FROM TermeVedette;
SELECT * FROM Utilisateur;

/*Pour un meilleur affichage*/
set linesize 250; 



/***REQUETES OK ********************************************************************************************************************/

/*creation utilisateur*/ 
    INSERT INTO Utilisateur (login, mdp, mail, admin) VALUES ('$log','$psw','$email','$admn');
    INSERT INTO Utilisateur (login, mdp, mail, admin) VALUES ('Falindir', '1234', 'toto@gmail.com', 1);
    INSERT INTO Utilisateur (login, mdp, mail, admin) VALUES ('Manu', '5678', 'titi@gmail.com', 0); 


/*modif utilisateur (admin)*/
    UPDATE Utilisateur SET admin=1 WHERE login='Manu'; 

/*creation termeVedette*/
    INSERT INTO termeVedette (idTerme, nomTerme, description) VALUES(0,'Gobou','Gobou est un pokemon eau mignon <3');
    INSERT INTO termeVedette (idTerme, nomTerme, description) VALUES(1,'Entei','Best woofi ever ! <3');

/*creation synonyme*/
    INSERT INTO Synonyme (idSynonyme, nomSynonyme) VALUES (0,'Boubou');

/*creation concept*/
    INSERT INTO Concept (idConcept, nomConcept, description, vedette) VALUES (0, 'Pokemon', 'Un concept pokemon', (select REF(T) from TermeVedette T where idTerme = 0));
    INSERT INTO Concept (idConcept, nomConcept, description, vedette) VALUES (1, 'Pokemon2', 'Un concept pokemon 2', (select REF(T) from TermeVedette T where idTerme = 1));
    /* Afficher le terme associé au concept */ select c.vedette.nomTerme from Concept c where c.idConcept=0;
    
    /*modification du concept*/
    UPDATE Concept SET vedette = (select REF(T) from TermeVedette T where idTerme = 1) WHERE Concept.idConcept=0;



/*Lier un concept à son possesseur*/

/* on doit commencer par faire un update pour la première valeur, des insert pour les suivantes */

    UPDATE Utilisateur
       set concepts = GroupeConcept_t((SELECT ref(c) FROM Concept c WHERE c.idConcept = 0))
     where login = 'Manu';  
    
    INSERT INTO TABLE (SELECT concepts FROM Utilisateur WHERE login = 'Manu')
    VALUES ((SELECT ref(c) FROM Concept c WHERE c.idConcept = 1));

    
    select nomConcept from
    (select u.concepts from Utilisateur u where u.login = 'Manu');
      
    
/*modif utilisateur(mdp)*/
    UPDATE Utilisateur SET mdp='53' WHERE login='Manu';

/*recherche concept*/ /*A TESTER*/
    SELECT * FROM Concept WHERE nomConcept LIKE '$nomConcept';
    SELECT * FROM Concept WHERE nomConcept LIKE 'Femme';

/*modif terme (description)*/
    UPDATE TermeVedette SET description='BouBou <3' WHERE idTerme=0;

/*modif concept (description)*/ 
    UPDATE Concept SET description='nvDesc' WHERE idConcept=0;

/*recherche terme*/
    SELECT * FROM TermeVedette WHERE nomTerme LIKE 'Gobou';

/* Suppimer termeVedette */
    DELETE FROM termeVedette WHERE idterme = 0;

/* Supprimer synonyme */
    DELETE FROM synonyme WHERE idsynonyme = 0;

/* Supprimer utilisateur */
    DELETE FROM utilisateur WHERE login = 'Manu';


/**REQUETES PAS ENCORE OK**********************************************************************************************************/


/*ajout de concept à un utilisateur*/


/*Lier un synonyme à son terme*/


/*Lier un synonyme à son possesseur*/


/*Lier un terme à son possesseur*/

/*avoir liste synonymes d'un terme*/ /*A tester quand on aura "lier un synonyme à son terme"*/

SELECT t.synonymes
FROM TermeVedette t
WHERE t.nomTerme = '$nomTerme';

/*avoir liste termes appartenant à un utilisateur*/ /*A tester quand on aura "lier un terme à son possesseur"*/

SELECT U.termes
FROM Utilisateur U
WHERE U.login='$log';

/*avoir liste synonyme appartenant à un utilisateur*/  /*A tester quand on aura "lier un synonyme à son possesseur"*/

SELECT U.synonymes
FROM Utilisateur U
WHERE U.login='$log';

/*avoir les fils d'un concept*/

SELECT c.fils[1].nomConcept from Concept c where c.idConcept=0; //geoffrey je rage ici

select c.nomConcept from THE (select u.concepts from utilisateur u where login = 'Manu') c;

SELECT e.nom FROM THE ( SELECT employes
FROM departements WHERE numdep = 1 ) e ;


/**CODE ACTUEL DE LA BD*********************************************************************************************************/



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
	idSynonyme int,
	nomSynonyme VARCHAR(30)
);
/

create type Concept_t;
/

create or replace type GroupeSynonyme_t as table of ref Synonyme_t;
/

create or replace type TermeVedette_t as Object
(
	idTerme int,
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
	idConcept int,
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
	constraint cp_synonyme primary key (idSynonyme),
	constraint notN_nomSynonyme check (nomSynonyme IS NOT NULL)
);

create table TermeVedette of TermeVedette_t
(
	constraint cp_termeVedette primary key (idTerme),
	constraint notN_nomTerme check (nomTerme IS NOT NULL)
)
nested table synonymes store as listeSynonymesTerme;

create table Concept of Concept_t
(
	constraint cp_concept primary key (idConcept),
	/*constraint autoin_concept AUTO_INCREMENT (idConcept),*/
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






