# Over A5 PHP
<p>deze repository bevat het vierde deel van de code van het voorbeeld van de module</p>

## Gebruik
<p>Deze repository kun je gebruiken om een verse Laravel installatie om te zetten naar het derde voorbeeld.</p>

<p>Alle bestanden die hier staan kun je toevoegen aan je Laravel installatie, met uitzondering van web.add. De inhoud daarvan moet je toevoegen aan de web.php van je Laravel installatie. </p>

## Toevoegen aan een nieuwe installatie van Laravel
<p>Uitvoeren op de cmd prompt in de laravel installatie map als er <b>cmd:</b> voorstaat.

1. <b>cmd:</b>laravel new step4 
2. Ga naar de map step4
3. <b>cmd:</b>composer require laravel/ui --dev
4. <b>cmd:</b>composer require laravelcollective/html
5. <b>cmd:</b>php artisan ui bootstrap
6. <b>cmd:</b>php artisan ui vue --auth
7. <b>cmd:</b>npm install
8. <b>cmd:</b>npm run dev
9. De inhoud van deze repository toevoegen
10. .env bestand maken met de gewenste gegevens erin. Ook controleren of de database bestaat.
11. web.php aanpassen: de inhoud van web.add toevoegen
12. <b>cmd:</b>php artisan migrate 

En dan kun je de installatie testen als je 
<b>cmd:</b>php artisan serve
start en vervolgens je webbrowser opent op http://localhost:8000
