<?php

/*
 **************************************
 *
 * includes/config.inc.php
 * -------------
 * last modified:	2007-01-13
 * -------------
 *
 * project:	chCounter
 * version:	3.1.3
 * copyright:	© 2005 Christoph Bachner
 *               since 2006-21-12 Bert Koern
 * license:	GPL vs2.0 or higher [ see docs/license.txt ]
 * contact:	http://chCounter.org/
 *
 **************************************

*/


//
// Datenbank-Zugangsdaten
// Your database data
// Données d'accès pour la base de données
//
$_CHC_DBCONFIG = array(

	'server' => 'localhost',		// database server | Server | Server
	'user' => '',			// database account | Benutzername | mot d'utilisateur
	'password' => '',			// database password | Passwort | mot de passe
	'database' => '',			// database name | Datenbankname | nom de la base de données

	// Prefix of the chCounter database tables:
	// Präfix der chCounter Datenbanktabellen:
	// Préfixe des tableaux de la base de données du chCounter:
	'tables_prefix' => 'chc_'

);

?>