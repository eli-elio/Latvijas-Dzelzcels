# Latvijas Dzelzceļa uzdevums

Vispirms tika izveidots jauns projekts, kas tika savienots ar [MySQL](https://www.mysql.com/) datubāzi, kurā izveidota jauna datubāzes tabula [nkp25](https://github.com/laumags/Latvijas-Dzelzcels/blob/master/nkp25.sql).

Tad uzrakstīju PHP skriptu [nkp25.php](https://github.com/laumags/Latvijas-Dzelzcels/blob/master/nkp25.php), kas paņēma datus no teksta faila un salika datubāzē.

Parsēšanai tika uzrakstīta funkcija `parseInt`, kas nomainīja datu tipu uz `integer` un sadalīja vajadzīgo teksta daļu.

Konteinera numurs `container_number` un īpašnieka administrācijas kods `owner_administration_code` tika saglabāts kā `CHAR` datu tips, bet dislokācijas datums un laiks tika glabāts kā `DATETIME`.
