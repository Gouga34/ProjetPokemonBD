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



/***REQUETES ********************************************************************************************************************/

/*creation utilisateur*/ 
    INSERT INTO Utilisateur (login, mdp, mail, admin) VALUES ('$log','$psw','$email','$admn');
    INSERT INTO Utilisateur (login, mdp, mail, admin) VALUES ('Falindir', '1234', 'toto@gmail.com', 1);
    INSERT INTO Utilisateur (login, mdp, mail, admin) VALUES ('Manu', '5678', 'titi@gmail.com', 0); 


/*modif utilisateur (admin)*/
    UPDATE Utilisateur SET admin=1 WHERE login='Manu'; 

/*creation termeVedette*/
    INSERT INTO termeVedette (idTerme, nomTerme, description) VALUES(0,'Gobou','Gobou est un pokemon eau mignon <3');
    INSERT INTO termeVedette (idTerme, nomTerme, description) VALUES(1,'Entei','Best woofi ever ! <3');
    insert into termeVedette(idTerme,nomTerme,description) VALUES(2,'Dresseurs','les dresseurs pokemon');

/*creation synonyme*/
    INSERT INTO Synonyme (idSynonyme, nomSynonyme) VALUES (0,'Boubou');
    INSERT INTO Synonyme (idSynonyme, nomSynonyme) VALUES (1'Waf');

/*creation concept*/
    INSERT INTO Concept (idConcept, nomConcept, description, vedette) VALUES (0, 'Pokemon', 'Un concept pokemon', (select REF(T) from TermeVedette T where idTerme = 0));
    INSERT INTO Concept (idConcept, nomConcept, description, vedette) VALUES (1, 'Pokemon2', 'Un concept pokemon 2', (select REF(T) from TermeVedette T where idTerme = 1));
    INSERT INTO Concept (idConcept, nomConcept, description, vedette) VALUES (2, 'Dresseurs', 'Les dresseurs du dessin animé', (select REF(T) from TermeVedette T where idTerme = 2));
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

/*Lier un synonyme à son possesseur*/
    UPDATE Utilisateur
       set synonymes = GroupeSynonyme_t((SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = 0))
     where login = 'Manu';  
    
    INSERT INTO TABLE (SELECT Synonymes FROM Utilisateur WHERE login = 'Manu')
    VALUES ((SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = 1));
      
/*Lier un terme à son possesseur*/
	UPDATE Utilisateur
	   set termes = GroupeTerme_t((SELECT ref(t) FROM TermeVedette t WHERE t.idTerme = 0))
	 where login = 'Manu'; 
	    
	INSERT INTO TABLE (SELECT termes FROM Utilisateur WHERE login = 'Manu')
	VALUES ((SELECT ref(t) FROM TermeVedette t WHERE t.idTerme = 1));

/*Lier un synonyme à son terme*/
	UPDATE TermeVedette
	   set synonymes = GroupeSynonyme_t((SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = 0))
	 where idTerme = 0;
	    
	INSERT INTO TABLE (SELECT synonymes FROM TermeVedette WHERE idTerme = 0)
	VALUES ((SELECT ref(s) FROM Synonyme s WHERE s.idSynonyme = 1));

/*Ajouter un parent à un concept*/
	UPDATE Concept
	   set parents = GroupeConcept_t((SELECT ref(c) FROM Concept c WHERE c.idConcept = 1))
	 where idConcept = 2;
	    
	INSERT INTO TABLE (SELECT parents FROM Concept WHERE idConcept = 2)
	VALUES ((SELECT ref(c) FROM Concept c WHERE c.idConcept = 0));

/* Lier un concept à son fils */

	UPDATE Concept
	   set fils = GroupeConcept_t((SELECT ref(c) FROM Concept c WHERE c.idConcept = 1))
	 where idConcept = 0;
	    
	INSERT INTO TABLE (SELECT fils FROM Concept WHERE idConcept = 0)
	VALUES ((SELECT ref(c) FROM Concept c WHERE c.idConcept = 0));
    
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

/*Récupérerla vedette d'un concept*/
	select deref(vedette) from concept where idConcept=0;

/*avoir liste synonyme appartenant à un utilisateur*/  
	select deref(value(listeSynonymes)) from utilisateur u, table(u.synonymes) listeSynonymes;

/*avoir liste synonymes d'un terme*/
	SELECT deref(VALUE(listeSynonymes))
	FROM TermeVedette t, TABLE(t.synonymes) listeSynonymes
	WHERE t.idTerme = 0;

/*avoir liste termes appartenant à un utilisateur*/
	select deref(value(listeTermes)) from utilisateur u, table(u.termes) listeTermes;

/*avoir les parents d'un concept*/
	select deref(value(listeParents)) from concept c, table(c.parents) listeParents;

/*avoir les fils d'un concept*/
	SELECT deref(VALUE(listeFils)) FROM Concept c, TABLE(c.fils) listeFils WHERE c.idConcept = 0;








