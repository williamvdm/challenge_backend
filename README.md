


# DeliveryMatch challenge back-end
## Beschrijving
Deze repository bevat de REST API back-end geschreven in Symfony framework. De API zorgt ervoor dat pakketten kunnen worden aangemaakt in de front end en dat een pakket getraceerd kan worden aan de hand van een tracking nummer.

Link naar front end: https://github.com/williamvdm/challenge

## Benodigdheden
XAMPP: https://www.apachefriends.org/
Composer: https://getcomposer.org/download/
Git Bash: https://gitforwindows.org/
Scoop (voor Symfony/CLI): https://scoop.sh/
Symfony/CLI: in command prompt: scoop install symfony-cli


## Uitleg
### Opzetten project
1. Open C:\xampp\htdocs (of waar je xampp hebt geinstalleerd)
2. Verwijder alles in deze map
3. Open git bash in deze map 
	Windows 10: rechtermuisknop > Git Bash Here
	Windows 11: shift + rechtermuisknop > Git Bash Here
4. Voer dit command in: ```git clone https://github.com/williamvdm/challenge.git```
5. Druk op enter
6. Wanneer git klaar is, navigeer terug naar C:\xampp\htdocs (of waar je xampp hebt geinstalleerd).
7. Open git bash in deze map
8. Voer dit command in: ```git clone https://github.com/williamvdm/challenge_backend.git```
9. Druk op enter
10. Nu heb je beide repositories lokaal op je computer
11. Open de challenge_backend map
12. Open hier een terminal (of open het project in phpstorm en open daar een terminal)
13. Run composer install
14. Open de XAMPP control panel C:\xampp\xamp-control.exe
15. Klik op start bij mysql en apache
16. Om de database te installeren, open de challenge_backend map in een command prompt (of in phpstorm > onderaan console openen).
17. Voer dit in: ```php bin/console doctrine:database:create```
18. Druk op enter
19. Voer dit in: ```php bin/console doctrine:migrations:migrate```
20. Druk op enter.
21. Als het goed is is de database nu aangemaakt. Je kunt dit testen door in de browser te navigeren naar localhost/phpmyadmin. dm_db zou links in de lijst moeten staan.

### Server starten
1. Navigeer naar de challenge_backend map.
2. Open een command prompt (of in phpstorm > onderaan console openen).
3. Voer dit in: ```symfony server:start```
4. Druk op enter.
5. De server start nu. Nu kan je in de front end (localhost of 127.0.0.1 openen in browser) pakketten toevoegen en opvragen.
