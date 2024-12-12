INSERT INTO nutzer ( Email, Vorname, Nachname,Kennwort)
VALUES  ("alice@example.com", "Tetiana","Luschina","ezuwq"),
    ("bob@example.com", "Marina","Nastorovich","wew89"),
    ("charlie@example.com", "Andrey","Borodin","qqwqw");

INSERT INTO `wohnungen` (`WohnungId`, `Stadt`, `Postleitzahl`, `Adresse`, `Zimmerzahl`, `Wohnflaeche`, `Etage`, `Kaltmiete`, `Nebenkosten`, `Kaution`, `Titel`, `Beschreibung`, `Haustiere`, `Baujahr`, `NutzerId`, `Wohnungstype`) VALUES ('2', 'Braunschweig', '307483', 'Georgstrasse 26/8', '5', '123', '78', '1200', '350', '3000', 'Luxuriöses Penthouse im 78 Etage', 'Luxuriöses Penthouse mit atemberaubendem Blick über die Stadt. Die großzügige Wohnung bietet ein offenes Wohnzimmer, eine moderne Küche und große Fenster, die viel Tageslicht einlassen. Drei Schlafzimmer, jedes mit eigenem Bad, sowie eine private Dachterrasse mit Pool und Garten machen dieses Penthouse zu einem exklusiven Rückzugsort.', '1', '2024', '1', '5');

INSERT INTO `favoriten` (`NutzerID`, `WohnungId`) VALUES ('1', '1');

INSERT INTO `bilder` (`BildId`, `BildLink`, `HauptBild`, `WohnungId`) VALUES ('1', 'img/Wohnung9/Build2.jpg', '1', '1');
INSERT INTO `bilder` (`BildId`, `BildLink`, `HauptBild`, `WohnungId`) VALUES ('2', 'img/Wohnung9/Build3.jpg', '0', '1');
INSERT INTO `bilder` (`BildId`, `BildLink`, `HauptBild`, `WohnungId`) VALUES ('3', 'img/Wohnung9/Build1.jpg', '0', '1');
INSERT INTO `bilder` (`BildId`, `BildLink`, `HauptBild`, `WohnungId`) VALUES ('4', 'img/Wohnung9/Build4.jpg', '0', '1');
INSERT INTO `bilder` (`BildId`, `BildLink`, `HauptBild`, `WohnungId`) VALUES ('5', 'img/Wohnung9/Build5.jpg', '0', '1');