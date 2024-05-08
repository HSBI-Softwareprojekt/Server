#Puddle Partners Server


##Installation Linux (Ubuntu)
- Port 80 auf dem Router freigeben (TCP/UDP)
- (Anleitung folgt bald)

##Installation Windows (nur zum testen!)
- Port 80 auf dem Router freigeben (TCP/UDP)
- Port 80 als Firewall Ausnahme konfigurieren (wird bei der installation vom Apache Webserver automatisch abgefragt)
- Xampp 8.2.12 herunterladen und installieren (Apache Webserver, PHP, phpMyAdmin, der Rest wird nicht benötigt)
- In den Xampp installationsordner gehen "C:\Xampp\" den Ordner "htdcos" öffnen und alle Datein entfernen
- Im Ordner "htdocs" einen neuen Ordner "puddle_partners" anlegen und die PHP Datein in diesen Ordner kopieren
- Xampp Controlpanel öffnen und Apache Webserver und MySQL starten
- Im Xampp Controlpanel bei MySQL auf den Button "Admin" klicken, es öffnet sich der Webbrowser => phpMyAdmin
- Neue leere Datenbank puddle_partners anlegen
- Bei der Datenbank puddle_partners auf "Importieren" klicken und unter "Zu importierende Datei" auf "Datei auswählen", es öffnet sich ein Fenster mit dem die Datei "puddle_partners.sql" ausgewählt wird
- Anschließend unten rechts auf den Button "OK" klicken