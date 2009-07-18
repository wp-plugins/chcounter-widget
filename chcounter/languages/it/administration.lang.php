<?php

/*
 **************************************
 *
 * languages/it/administration.lang.php
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


$_CHC_LANG = !isset( $_CHC_LANG ) ? array() : $_CHC_LANG;
$_CHC_LANG = array_merge( $_CHC_LANG, array(



	/* main (./administration/index.php) */
	'administration' => 'PdC Amministratori',
	'logs' => 'Log',
	'news' => 'News',
	'help' => 'Aiuto &amp; Contatti',
	'logout' => 'Logout',
	'statistics' => 'Statistiche',
	'settings' => 'Impostazioni',
	'login' => 'Login',
	'logout_successful' => 'Logout effettuato.',
	'logout_not_successful' => 'Logout fallito.',
	'logout_affirmation' => 'Clicca sul pulsante per sloggarti.<br />Il cookie per il login automatico sarà cancellato (se presente).',
	'security_alert_install_directory' => '<span style="color: #FF0000">Importante:</span><br />Per favore cancella la cartella "install" immediatamente per evitare problemi di sicurezza.',
	'welcome_message' => 'Benvenuto nel PdC Amministratori di chCounter!',


	/* News (./administration/new.inc.php) */
	'error_contacting_news_file' => 'Errore: impossibile caricare il file delle news da http://chcounter.org',
	'no_news_available_at_present' => 'Nessuna news per il momento.',


	/* Logs (./administration/logs.inc.php) */
	'date_time' => 'Data, ora',
	'visitor_details' => 'Dettagli visitatore (PdC Amministratori)',
	'no_visitors_logged_yet' => 'Nessun visitatore nel database per ora.',


	/* detailed user information (./administration/visitor_details.php) */
	'browser\'s_language_settings' => 'Lingua impostata nei browser',
	'not_available' => 'non disponibile',
	'preferred:' => 'preferito:',
	'javascript' => 'JavaScript',
	'js_available_and_activated' => 'disponibile e attivo',
	'js_not_available_or_deactivated' => 'non disponibile o non attivo',
	'visited_pages' => 'Pagine viste',
	'close_window' => 'Chiudi finestra',

	/* Settings */
	'general_settings' => 'Generale',
	'global_settings' => 'Impostazioni globali',
	'user_management' => 'Gestione account',
	'counter' => 'Contatore',
	'counter_settings' => 'Impostazioni',
	'edit_counter_records' => 'Forza i valori del contatore',
	'general' => 'Generale',
	'(de)activate_statistics' => '(Dis)Attiva statistiche',
	'database_operations:' => 'Operazioni su database:',
	'reset_statistics' => 'Reset statistiche',
	'data_cleanup' => 'Pulizia dati',
	'lists:' => 'Liste:',
	'blacklists' => 'Blacklist',
	'exclusion_lists' => 'Lista ignorati',
	'hideout_lists' => 'Lista nascosti',
	'statistics_display' => 'Visualizzazione statistiche:',
	'access_authorisations' => 'Autorizzazioni di accesso',
	'top/latest' => 'Primi/ultimi&hellip;',
	'referrers,_search_engines_and_keywords' => 'Referrer, motori e chiavi di ricerca',
	'visitors_details' => 'Dettagli visitatori',
	'all_lists' => 'Mostra tutti',
	'pages_and_currently_online' => 'Pagine &amp; online',
	'wrong_password' => 'La password non è corretta!',
	'configuration_updated' => 'Le impostazioni sono state salvate.',
	'please_fill_out_each_required_field' => 'Compila ogni campo!',
	'settings_description_guest_login' => 'Utilizzando l\'account guest, utenti diversi dall\'amministratore possono visualizzare le statistiche anche se queste sono disattivate per gli utenti "normali". Lasciando questo campo in bianco si disattiva l\'account guest.',
	'settings_description_admin_login' => 'Qui puoi cambiare il tuo nome utente e la tua password. Se non vuoi cambiare la password, lascia ogni campo password in bianco.',
	'save_settings' => 'Salva impostazioni',
	'administrator' => 'Amministratore',
	'guest_login' => 'Account guest',
	'name:' => 'Nome:',
	'old_password:' => 'Vecchia password:',
	'new_password:' => 'Nuova password:',
	'new_password_(repetition):' => 'Nuova password:<br />(conferma)',
	'general_counter_settings' => 'Impostazioni generali counter',
	'URLs' => 'URL',
	'hp_url' => 'URL sito:',
	'url_of_counter_directory' => 'URL della cartella di chCounter:',
	'charset' => 'Set di caratteri',
	'homepage_charset:' => 'Set di caratteri del sito:',
	'default_counter_visibility:' => 'Visibilità del contatore (se non specificato nella pagina):',
	'counter_status_statistic_pages:' => 'Stato del contatore di pagine:',
	'counting_settings' => 'Comportamento del contatore',
	'description_blocking_mode' => 'Non contare nuovamente un visitatore:',
	'for_x_seconds' => 'per %s secondi',
	'until_the_end_of_day' => 'fino a fine giornata',
	'description_user_online_timespan' => 'Tempo di inattività durante il quale un utente è mostrato "online":<br />(in sec.)',
	'time_settings' => 'Impostazioni data/ora',
	'time_zone' => 'Fusorario:',
	'enable_daylight_saving_time:' => 'Ora legale:',
	'use_admin_blocking_cookie' => 'Evita che l\'amministratore sia conteggiato (con cookie):',
	'do_not_count_robots' => 'Non conteggiare i robot (ad esempio gli spider dei motori di ricerca):',
	'language_settings' => 'Impostazioni lingua',
	'default_language' => 'Linguaggio predefinito del contatore e delle statistiche:',
	'administration_language' => 'Linguaggio del PdC amministratori:',
	'yyyy-mm-dd' => 'aaaa-mm-gg', // d=day, m=month, Y=Year  | please do not change the positions, only translate the abbreviations, if necessary
	'simultaneously_online' => 'Online simultaneamente',
	'delete_log_entries_after:' => 'Cancella le <a href="index.php?cat=logs">righe di log</a> dopo:',
	'delete_log_entries_after:unit:hours' => 'ore',
	'delete_log_entries_after:unit:days' => 'giorni',
	'ignore_strings_with_a_length_less_than:' => 'Ignora le parole con meno di:',
	'pages_statistic_page_titles' => 'Statistiche pagina: titoli',
	'remove_the_complete_query_string' => 'rimuovi tutta la stringa della query',
	'only_keep_the_following_variables:' => 'mantieni solo le variabili seguenti:',
	'remove_the_following_variables:' => 'rimuovi le variabili seguenti:',
	'query_string_variables:' => 'Variabili della stringa della query (separate da \'; \'):',
	'description_(de)activate_search_for_page_titles' => 'Il contatore cerca per default il titolo della pagina nel file dentro il quale in contatore è incluso (vedi <i>install/readme_en.txt</i> per ulteriori dettagli). Questo può causare un carico sul server da non sottovalutare, quindi la ricerca del titolo può essere disattivata.',
	'search_for_page_titles:' => 'Cerca il titolo:',
	'pages_statistic_query_string_cleanup' => 'Statistiche pagina: pulizia della stringa della query',
	'description_page_query_string_cleanup' => 'La cosiddetta "stringa della query" (es. "<i>?variabile1=valore&amp;<br />variabile2=valore&amp;&hellip;</i>") può essere completamente o parzialmente rimossa prima di essere registrata per evitare occorrenze inutili e mantenere pulite le statistiche.<br /><br />Esempio: dalla pagina "<i>index.php?categoria=downloads&amp;ordinamento=crescente</i>" la variabile "<i>ordinamento</i>" può essere rimossa, risultato: "<i>index.php?categoria=downloads</i>".<br />La routine di installazione del contatore imposta qui alcune variabile superflue della sezione statistiche.',
	'keep_the_complete_query_string' => 'mantieni tutta la stringa della query',
	'purge_page_entries_now' => 'Ripulisci anche i dati già salvati nel database sulla base delle impostazioni appena inserite.<br /><b>Attenzione:</b> L\'azione è irreversibile!',
	'referrers_statistic_query_string_cleanup' => 'Statistiche referrer: pulizia della stringa della query',
	'description_remove_referrer_query_string' => 'La stringa della query può essere rimossa anche dai referrer. La stringa <i>completa</i> sarà rimossa, ma solitamente questo non è necessario nè consigliato.',
	'remove_query_string:' => 'Rimuovi la stringa della query:',
	'description_blacklists' => 'Se un visitatore rientra in questa lista, non sarà conteggiato.<br />Un valore per riga, % come carattere jolly.',
	'IPs:' => 'IP:',
	'hosts:' => 'Host:',
	'user_agents:' => 'User agent:',
	'referrers:' => 'Referrer:',
	'description_exclusion_lists' => 'I valori che rientrano in queste liste non saranno registrati. <br />Un valore per riga, % come carattere jolly.',
	'pages_(relative_from_hp_root):' => 'Pagine (percorso a partire dalla URL del sito):',
	'search_engines:' => 'Motori di ricerca:',
	'search_keywords:' => 'Chiavi di ricerca:',
	'search_phrases:' => 'Frasi di ricerca:',
	'screen_resolutions:' => 'Risoluzioni:',
	'description_hideout_lists' => 'I valori che rientrano in queste liste non saranno visualizzati. Dal momento che non vengono eliminati dal database, possono essere mostrati nuovamente quando necessario.<br />Un valore per riga, % come carattere jolly.',
	'browsers:' => 'Browser:',
	'operating_systems:' => 'Sistemi operativi:',
	'robots:' => 'Robot:',
	'referring_domains:' => 'Domini referrer:',
	'description_(de)activate_statistics' => 'Le singole statistiche possono essere disattivate, ad es. per ridurre lo spazio necessario su disco (non saranno memorizzati nuovi valori).<br /><b>Attenzione:</b> Le statistiche disattivate sono ancora visibili nella sezione statistiche. Per rimuoverle, le linee corrispondenti vanno cancellate dal file template.<br /><br />Queste statistiche sono <b>attive</b>:',
	'log_data' => 'Log',
	'user_agents,browsers,os,robots' => 'User agent/Browser/Sistemi operativi/robot',
	'pages_statistic' => 'Statistiche pagine',
	'countries_languages_hosts_statistic' => 'Paesi/Lingue/TLD domini',
	'search_engines_and_keywords' => 'Motori &amp; chiavi di ricerca',
	'reset_stats' => 'Resetta statistiche',
	'description_reset_stats' => 'Queste statistiche possono essere resettate:',
	'reset_statistics_now' => 'Resetta ora',
	'access_statistics' => 'Statistiche di accesso',
	'search_keywords_phrases' => 'Chiavi di ricerca',
	'visitors,page_views_per_day' => 'Visitatori/Letture al giorno',
	'page_views_per_visitor' => 'Letture per visitatore',
	'reset_confirmation' => 'Vuoi veramente resettare le statistiche selezionate?',
	'statistics_were_reset' => 'Le statistiche selezionate sono state resettate.',
	'countries_statistic' => 'Statistiche paesi',
	'languages_statistic' => 'Statistiche lingue',
	'hosts_statistic' => 'Statistiche TLD domini',
	'check_all' => 'seleziona tutte',
	'uncheck_all' => 'deseleziona tutte',
	'general_cleanup' => 'Pulizia generale dati',
	'description_general_cleanup' => 'Per ridurre il numero di query, i dati obsoleti (righe di log e dati temporanei dei visitatori) non vengono cancellati subito ma ad intervalli.<br />Qui puoi eseguire una pulizia indipendentemente dall\'intervallo - questo <u>non</u> è solitamente necessario.',
	'perform_cleanup' => 'Pulisci il database',
	'user_agents,referrers_cleanup' => 'Pulizia speciale degli user agents e dei referrer',
	'description_user_agents,referrers_cleanup' => 'Dopo un po\' di tempo alcune occorrenze con bassa incidenza possono sprecare spazio e aumentare i tempi di risposta del database. Queste rare occorrenze possono essere cancellate e unite alla voce "altri" - le statistiche totali non saranno falsate.',
	'regular_cleanup' => 'Pulizia regolare delle occorrenze rare:',
	'immediate_cleanup' => 'Pulizia una-tantum:',
	'type:' => 'Tipo:',
	'max_incidences:' => 'Incidenza massima:',
	'days_passed_since_last_incidence:' => 'Giorni passati dall\'ultima occorrenza:',
	'cleanup:type_and_number_of_entries' => "%1\$s (%2\$s occorrenze in tutto)",
	'cleanup_performed' => 'La pulizia è stata eseguita.',
	'cleanup_performed_(x_rows_deleted)' => 'La pulizia è stata eseguita (%s occorrenze eliminate).',
	'description_access_authorisations' => 'Le pagine seguenti sono accessibili solo all\'amministratore e all\'account guest:',
	'statistics_main_page' => 'Sommario',
	'referrers/referring_domains:common_settings' => 'Domini referrer: impostazioni generali',
	'hyperlink_URLs:' => 'URL dei link:',
	'number_of_displayed_entries:' => 'Numero di righe visualizzate:',
	'abbreviate_referrers_after:' => 'Taglia i referrer dopo',
	'x_signs_(0_=_never)' => '%s caratteri (0 = mai)',
	'(0_=_never)' => '(0 = mai)',
	'abbreviation_sign:' => 'Segno di abbreviazione:',
	'force_wordwrap_after:' => 'Forza a capo dopo:',
	'settings_description_referrers,_search_engines_and_keywords' => '<i>Queste impostazioni si applicano alla categoria "<a href="../stats/index.php?cat=referrers">Referrer</a>" della sezione statistiche.</i>',
	'settings_description_latest_top' => '<i>Queste impostazioni si applicano alla categoria "<a href="../stats/index.php">Sommario</a>" della sezione statistiche.</i>',
	'top_...' => 'I primi&hellip;',
	'latest_...' => 'Gli ultimi&hellip;',
	'settings_description_visitors_details' => '<i>Queste impostazioni si applicano alla categoria "<a href="../stats/index.php?cat=visitors_details">Dettagli visitatori</a>" della sezione statistiche.</i>',
	'settings_description_pages' => '<i>Queste impostazioni si applicano alla categoria "<a href="../stats/index.php?cat=pages">Pagine</a>" della sezione statistiche.</i>',
	'show_page_title:' => 'Mostra il titolo della pagina (se disponibile):',
	'currently_online' => 'Online',
	'online_users_ip_format:' => "Visualizza IP:",
	'do_not_show_IPs' => 'non visualizzare alcun IP',
	'force_wordwrap_of_page_name_after:' => 'Forza il titolo della pagina a capo dopo',
	'settings_description_logs' => '<i>Queste impostazioni si applicano alla categoria "<a href="./index.php?cat=logs">Log data</a>" del PdC amministratori.</i>',
	'entries_per_log_page:' => 'Righe per ogni pagina di log:',
	'display_the_entries_on_each_log_page:' => 'Ordinamento:',
	'settings_description_all_lists' => '<i>Queste impostazioni si applicano alla categoria "<a href="../stats/index.php?list_all">Mostra tutti</a>" della sezione statistiche.</i>',
	'settings_description_access_statistics' => '<i>Queste impostazioni si applicano alla categoria "<a href="../stats/index.php?cat=access_statistics">Statistiche accesso</a>".</i>',
	'vertical-bar_diagramm_representation:' => 'Rappresentazione dei diagrammi verticali:',
	'description_vertical-bar_diagramm_representation:absolute' => 'a seconda delle proporzioni',
	'description_vertical-bar_diagramm_representation:relative' => 'relativo al valore più alto',
	'pages_statistic_data_source' => 'Pages statistic: data source',
	'description_pages_statistic_data_source' => 'Here you can define which sources should be used to detect the path of the requested pages (only when including the counter with PHP). Explanations of the possibilities can be found in the <a href="http://www.php.net/manual/en/reserved.variables.php#reserved.variables.server" target="_blank">PHP Manual</a>.',
	'use_PHP_SELF_or_REQUEST_URI:' => 'Use for the pages statistic:',
	'exclude_robots_from_the_javascript_statistic' => 'Exclude robots from the javascript statistic.',
	'entry_and_exit_pages' => 'Entry and exit pages',
	'the_requested_visitor_does_not_exist' => 'The requested visitor does not exist in the log data.',	
	'settings_description_downloads_and_hyperlinks' => '<i>Queste impostazioni si applicano alla categoria "<a href="../stats/index.php?cat=downloads_and_hyperlinks">Downloads &amp; hyperlinks</a>" della sezione statistiche.</i>',


	// help
	'contact' => 'Contatti',
	'obtain_inclusion_code:' => 'Ricava codice di inclusione:',
	'PHP' => 'PHP',
	'JavaScript' => 'JavaScript',
	'description_support' => 'More informations and helps see on the chCounterhomepage&nbsp;<a href="http://chcounter.org/" target="_blank"><b>http://chcounter.org</b></a><br /><br />If you need help or want to utter suggestions or critique, visit the <a href="http://phorum.excelhost.de/index.php?42" target="_blank"><b>chCounter-Forum</b></a>.<br /><br />Alternatively you can contact me via email to <a href="http://chcounter.org/index.php?s=kontakt" target="_blank">on this internetsite seen emailadress</a> .<br /><br /><font color="#FF0000">In case of a problem with the chCounter, please check <b>first</b> the <b>install guide</b>, <b>readme file</b> and <b>FAQs</b> and in the </font><font color="red"><a href="http://phorum.excelhost.de/index.php?42" target="_blank"><b><font color="#FF0000">chCounter-forum </font></b></a></font><font color="#FF0000"> for a solution.</font><br /><br />Info:<br />This chCounter based on the chCounter3.1.1 of Christoph Bachner<br /><br />greethings<br />Berti<br /><br />If you will translate the language-files of the chCounter - I like it.<br />Please contact me <a href="http://chcounter.org/index.php?s=kontakt" target="_blank">on this internetsite seen emailadress</a>',
	'counter_inclusion_via_PHP' => 'Inclusione del counter con PHP',
	'description_php_include_code' => 'Qui puoi generare il codice PHP per includere il contatore.',
	'important:' => 'Importante:',
	'notice_file_extension' => 'Tieni presente che solitamente l\'estensione del file deve essere ".php" per poter eseguire il codice. Vedi la guida di installazione per un suggerimento su come eseguire PHP in un file ".html".',
	'notice_individual_template_and_indentation' => 'Se un template individuale è specificato, il codice PHP generato non deve mai essere indentato!',
	'visible' => 'visibile',
	'invisible' => 'invisibile',
	'active' => 'attivo',
	'inactive' => 'inattivo',
	'optional_page_title:' => 'Titolo pagina (opzionale):',
	'optional_individual_template:' => 'Template individuale (opzionale):',
	'generate_php_code' => 'Genera codice PHP',
	'counter_inclusion_via_JavaScript' => 'Inclusione counter con JavaScript',
	'description_js_include_code' => 'Qui puoi generare il codice JavaScript per includere il contatore.',
	'notice_advantages_of_including_with_php' => '<b>Quando</b> possibile, il contatore dovrebbe essere incluso con PHP. Se JavaScript viene usato, tutti i visitori con JavaScript disattivato e tutti i robot/spider non saranno conteggiati.',
	'generate_JavaScript_code' => 'Genera codice JavaScript',
	'generated_code' => 'Codice generato:',
	
	
	// Downloads & Hyperlinks
	'download_feature_is_deactivated' => 'The download counting feature is deactivated!',
	'new_download' => 'Add a new download.',
	'upload_date' => 'Upload date',
	'name' => 'Name',
	'ID' => 'ID',
	'URL' => 'URL',
	'upload' => 'Upload',
	'last_download' => 'Last download',
	'edit' => 'edit',
	'delete' => 'delete',
	'to_the_overall_view' => '-&gt; To the overall_view.',
	'back_to_the_overall_view' => 'Back to the overall_view.',
	'download_successfully_inserted' => 'The Download was inserted successfully.',
	'download_could_not_be_inserted' => 'The Download could not be inserted.',
	'insert_a_new_download' => 'Insert a new download:',
	'please_fill_out_every_field' => 'Please fill out each field!',
	'insert_download' => 'Insert the download',
	'entry_successfully_updated' => 'The entry was updated successfully.',
	'entry_could_not_be_updated' => 'The entry could not be updated.',
	'could_not_find_the_requested_entry' => 'The requested entry could not be found.',
	'edit_a_download_entry' => 'Edit a download entry:',
	'number_of_downloads' => 'Number of downloads',
	'time_of_upload' => 'Time of uploads',
	'save_entry' => 'Save entry',
	'entry_successfully_deleted' => 'The entry was deleted successfully.',
	'entry_could_not_be_deleted' => 'The entry could not be deleted.',
	'entries_successfully_deleted' => 'The entries were deleted successfully.',
	'entries_could_not_be_deleted' => 'The entries could be deleted.',
	'delete_entry?' => 'Delete entry?',
	'delete_entry_now' => 'Delete entry now',
	'delete_the_selected_entries' => 'Delete the selected entries',
	'delete_entries' => 'Delete entries',
	'delete_many_entries_confirmation' => 'Do you want to finally delete the following entries?',
	'delete_all_displayed_entries_now' => 'Yes, delete now all the listed entries.',
	'HTML_Code' => 'HTML code',
	'general_URL_for_download_counting:' => 'General URL for linking to a download file:',
	'general_URL_for_hyperlink_counting:' => 'General URL of a hyperlink entry:',
	
	'hyperlink_feature_is_deactivated' => 'The hyperlink counting feature ist deactivated!',
	'new_hyperlink' => 'Insert a new download.',
	'added' => 'added',
	'last_click' => 'Last click',
	'insert_a_new_hyperlink' => 'Insert a new hyperlink:',
	'insert_hyperlink' => 'Insert the hyperlink',
	'hyperlink_successfully_inserted' => 'The hyperlink was inserted successfully.',
	'hyperlink_could_not_be_inserted' => 'The hyperlink could not be inserted.',
	'edit_a_hyperlink_entry' => 'Edit hyperlink entry:',
	'number_of_clicks' => 'Number of clicks',
	'number_of_clicks' => 'Total clicks',

) );

?>