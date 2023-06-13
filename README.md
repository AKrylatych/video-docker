# video-docker
Mokomosios e. paslaugų sistemų projektavimo praktikos egzamino darbas 
# Užduotis
Interneto svetainėje žmogus įkelia video failą ir nurodo savo el. paštą. Nuotrauka įkeliama į serverį kaip failas, įrašomas įrašas į DB kad toks vartotojas (pagal paštą) įkėlė tokį failą, o duotu adresu išsiunčiamas el. laiškas su patvirtinimu. 
# Technologijos
Konteinerinės technologijos
Šiam darbui bus naudojamai podman konteineriai esantys Cherryservers VDS serveryje.
# Sistemos pajėgumas
Iki 500 operacijų per dieną

# Sistemos sandara:
Numatyta, kad kiekvienas komponentas bus savo konteneryje.
- API
- Svetainė
- NGINX tarpinis serveris
- PostgreSQL duomenų bazė
- PGAdmin
- Postfix 

# Paruošimo instrukcijos
Numatyta, kad programa bus diegiama naudojant "Podman" konteinerių tvarkymo programą, tačiau galima tą atlikti ir su "Docker". 

Taip pat yra numatoma, kad turite domeną, kurio nustatymus galite konfigūruoti. Domenas palengvins programos pasiekimą vartotojams, leis pašto serveriui korektiškai veikti. 
1. Klonuoti GitHub repozitoriją
2. Sukonfigūruoti tarpinį serverį
3. Sukonfigūruoti API
4. Sukonfigūruoti svetainę
5. Sukonfigūruoti duomenų bazę
