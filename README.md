# Puddle Partners Server


## Installation Linux (Ubuntu 24.04 LTS)
- Port 80 auf dem Router freigeben (TCP/UDP)
- Konsole öffnen
- Den Befehl "sudo apt install apache2" ausführen
- Den Befehl "sudo apt install php libapache2-mod-php" ausführen
- Den Befehl "sudo apt install mysql-server" ausführen
- Den Befehl "sudo systemctl start mysql.service" ausführen
- Den Befehl "sudo apt install phpmyadmin" ausführen (Dialog 1: apache2 auswhählen, Dialog 2: Ja, Dialog 3: Passwort setzen)
- Den Befehl "sudo ln -s /etc/phpmyadmin/apache.conf /etc/apache2/conf-available/phpmyadmin.conf" ausführen
- Den Befehl "sudo a2enconf phpmyadmin.conf" ausführen
- Den Befehl "sudo systemctl reload apache2.service" ausführen
- Der Web- und Datenbankserver ist nun vollständig installiert
- In der Konsole den Befehl "sudo mysql -u root" ausführen
- Datenbank Befehl "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'yourpassword';" ausführen
- Den Befehl "sudo chmod 777 /var/www/html" ausführen (Schreibrechte)
- Den Ordner unter "/var/www/html" öffnen und alle Datein entfernen
- Im Ordner "/var/www/html" einen neuen Ordner mit dem Namen "puddle_partners" anlegen und die PHP Datein aus dem Ordner "files" in den Ordner "puddle_partners" kopieren
- Im Webbrowser die Seite "localhost/phpmyadmin/" aufrufen
- Mit "root" und "yourpassword" anmelden
- Neue leere Datenbank puddle_partners anlegen
- Klicken Sie auf die Datenbank "puddle_partners", klicken Sie oben in der Menüleiste der Datenbank "puddle_partners" auf "Importieren", unter "Zu importierende Datei" auf "Datei auswählen" klicken, wählen Sie die Datei "puddle_partners.sql" aus, anschließend unten rechts auf den Button "OK" klicken

## Tests Linux
- Nach der erfolgreichen Installation befinden sich die Test PHP Skripte im Ordner "var\www\html\puddle_partners\test\"
- Starten Sie das Skript test_register.php in dem Sie in der Browser Adresszeile die Webseite "localhost/puddle_partners/test/test_register.php" aufrufen
- Starten Sie das Skript test_login.php in dem Sie in der Browser Adresszeile die Webseite "localhost/puddle_partners/test/test_login.php" aufrufen

## Installation Windows (nicht empfohlen)
- Port 80 auf dem Router freigeben (TCP/UDP)
- Port 80 als Firewall Ausnahme konfigurieren (wird bei der installation vom Apache Webserver automatisch abgefragt)
- Xampp 8.2.12 herunterladen und installieren (Apache Webserver, PHP, phpMyAdmin, der Rest wird nicht benötigt)
- In den Xampp Installationsordner gehen "C:\Xampp\" den Ordner "htdocs" öffnen und alle Datein entfernen
- Im Ordner "htdocs" einen neuen Ordner "puddle_partners" anlegen und die PHP Datein aus dem Ordner "files" in den Ordner "puddle_partners" kopieren
- Xampp Controlpanel öffnen und Apache Webserver und MySQL starten
- Im Xampp Controlpanel unter MySQL auf den Button "Admin" klicken, es öffnet sich der Webbrowser => phpMyAdmin
- Neue leere Datenbank puddle_partners anlegen
- Klicken Sie auf die Datenbank "puddle_partners", klicken Sie oben in der Menüleiste der Datenbank "puddle_partners" auf "Importieren", unter "Zu importierende Datei" auf "Datei auswählen" klicken, wählen Sie die Datei "puddle_partners.sql" aus, anschließend unten rechts auf den Button "OK" klicken

## Tests Windows
- Nach der erfolgreichen Installation befinden sich die Test PHP Skripte im Ordner "C:\xampp\htdocs\puddle_partners\test\"
- Starten Sie das Skript test_register.php in dem Sie in der Browser Adresszeile die Webseite "localhost/puddle_partners/test/test_register.php" aufrufen
- Starten Sie das Skript test_login.php in dem Sie in der Browser Adresszeile die Webseite "localhost/puddle_partners/test/test_login.php" aufrufen