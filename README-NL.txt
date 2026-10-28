MARITIEM TEYLINGEN NOORDWIJK — PHP LEDENLOGIN (STARTSET)

BELANGRIJK
- Dit pakket is een startpunt. Het is nog niet klaar om zonder configuratie online te zetten.
- De hosting moet PHP ondersteunen en HTTPS moet actief zijn.
- Deze login beveiligt alleen PHP-pagina's die de sessiecontrole uitvoeren.
- Zet gevoelige documenten niet als openbaar bestand in de webmap. Google Drive-links met
  "iedereen met de link" blijven bijvoorbeeld toegankelijk voor iedereen die de link heeft.
- Verwijder of hernoem de oude leden.html pas nadat de nieuwe pagina getest is.

BESTANDEN
- login.php: inlogscherm en wachtwoordcontrole
- leden.php: voorbeeld van een afgeschermde ledenpagina
- logout.php: uitloggen
- leden-config.example.php: voorbeeld van de configuratie; niet rechtstreeks gebruiken

INSTALLATIE
1. Controleer bij de hostingpartij of PHP beschikbaar is en welke PHP-versie wordt ondersteund.
2. Maak via FTP een map buiten de openbare website-map (document root), bijvoorbeeld:
   /home/JOUW_ACCOUNT/private/
   De exacte locatie verschilt per hostingpakket. Vraag de hostingpartij om het juiste pad
   als je alleen FTP-toegang hebt.
3. Upload daar een bestand genaamd leden-config.php met deze inhoud:
   <?php
   return [
       'password_hash' => 'PLAK_HIER_DE_HASH',
   ];
   Dit bestand moet buiten de openbare webmap staan en niet via een URL bereikbaar zijn.
4. Genereer een hash op een vertrouwde PHP-omgeving met:
   <?php echo password_hash('KIES_EEN_NIEUW_UNIEK_WACHTWOORD', PASSWORD_DEFAULT), PHP_EOL;
   Voer dit lokaal uit of laat de hostingpartij dit voor je doen. Zet het wachtwoord zelf niet
   in een publiek bestand of in een bericht.
5. Pas bovenaan login.php de regel $configPath aan naar het volledige pad van dat bestand,
   bijvoorbeeld /home/JOUW_ACCOUNT/private/leden-config.php (voorbeeldpad; niet zomaar kopiëren).
6. Upload login.php, leden.php en logout.php naar de openbare map waar de website staat.
7. Verplaats de inhoud van leden.html naar leden.php, binnen de beveiligde pagina. Zorg dat
   de oude leden.html niet meer beschikbaar is, anders omzeilt men de login.
8. Test in een privévenster: zonder login moet leden.php naar login.php sturen; na inloggen
   moet de ledenpagina verschijnen; uitloggen moet de toegang beëindigen.

NOG NIET AUTOMATISCH GEREGELD
- Bestaande documentbestanden en externe links worden hiermee niet afgeschermd.
- Voor documenten die echt privé moeten blijven, moeten de bestanden buiten de openbare map
  staan en via een gecontroleerde PHP-download worden aangeboden, of moeten de deelrechten
  bij de documentprovider beperkt worden.
- Er is basisvertraging bij een fout wachtwoord, maar geen volwaardige rate limiting.
- Stel sessiecookies en HTTPS correct in bij de hosting; laat dit zo nodig door de hostingpartij
  controleren.
