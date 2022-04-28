
Ilmaandmete kuvamise rakendus (tehtud koolitööna)

Sissejuhatus

Rakendus kuvab kasutajale avalehel Kehtna kooli ida- ja lääneküljes olevate termomeetrite viimased mõõtmisandmed, lisaks jooksva päeva päikesetõusu ja -loojangu aja.

Läänes ja Idas lehtedel kuvatakse vastava külje salvestatud mõõtmisandmed valitud kuupäeval läbi mõõtmisajaloo. Kuvatakse andmed kokkulepitud tundide kohta. Kasutaja saab valida teda huvitava kuupäeva, lehe laadimisel kuvatakse jooksva kuupäeva andmed.

Lehel Äratus saab seada üles alarmi, valides aja (5 kuni 60 min, sammuga 5 min) ja alarmi käivitamisel mängitava heli.

Lehel Raadio sab kasutaja valida valikust raadiojaama, millise online kanalit ta soovib kuulata.

Lehel Ilm kuvatakse lehelt openweathermap.org asukoha Kehtna ilmaandmed jooksval päeval ja prognoos järgmiseks 24 tunniks (3 tunnise sammuga).

Rakenduse seadistamine

Peale kõikide failide salvestamist tuleb teha järgmised seadistused:

Fail settings_sample.php ümbernimetada settings.php.

Seadistada andmebaasiühendus:

define('HOST', '.......'); // Sisesta andmebaasiserveri nimi
define('USERNAME', '..........'); // Sisesta kasutajanimi
define('PASSWORD', '.............'); // Sisesta parool
define('DBNAME', '.............'); // Määra andmebaasi nimi


Lisaks saab soovi korral settings.php failis määrata:
- lehel Ilm kuvatava asukoha andmed  openweathermap.org jaoks
- lehtede Läänes ja Idas kohta saab määrata, mis tundide temperatuure kuvatakse
- Äratuse lehe kohta saab seadistada min ja maks äratuse aja ning sammu
- Raadio lehe jaoks saab seadistada kuni neli online raadiojaama

