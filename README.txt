WVS Noordwijk / Maritiem Teylingen — websitepakket v3

Inhoud:
- index.html, zijldijk.html, noordwijk.html, activiteiten.html
- leden.html (nieuwe ledenpagina met eenvoudige wachtwoordprompt)
- styles.css, script.js

Belangrijk vóór publicatie:
1. Wachtwoord aanpassen in leden.html bij: const MEMBER_PASSWORD = 'Haven1977';
2. Voeg de Google Docs-links toe in leden.html. Zoek naar data-doc-link="1" enz. en vervang href="#" door de volledige Google Docs-URL. Pas ook de namen en omschrijvingen aan.
3. De map assets met logo, favicon en locatiebeelden moet behouden blijven. Plaats activiteitenfoto's in assets/activiteiten/ met de bestandsnamen die activiteiten.html gebruikt.
4. Deze wachtwoordcontrole gebeurt volledig in de browser en is NIET echte beveiliging. Iedereen die de broncode bekijkt kan het wachtwoord achterhalen. Deel via deze pagina dus geen gevoelige documenten. Stel in Google Drive bij elk document Delen > Algemene toegang in op Beperkt en geef de gewenste leden afzonderlijk toegang met hun Google-account. De Google Drive-rechten blijven de echte beveiliging, ook als iemand de link doorstuurt.
5. Om de ledenpagina beter te beveiligen, gebruik een site-login op serverniveau of een ledenplatform met accounts; een statische HTML-pagina kan dit niet veilig afdwingen.

Upload de HTML-, CSS- en JS-bestanden naar dezelfde hoofdmap op de webserver. Behoud de bestaande assets-map.
