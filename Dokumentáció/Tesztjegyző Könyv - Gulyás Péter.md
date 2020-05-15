## Regisztráció tesztelése
#### Tesztelő: Gulyás Péter
#### 2020.05.15.

### Nem létező email címmel való regisztráció tesztelése:
- Elvárt működés: Ha nem létző email címmel akarok regisztrál egy hiba üzenet jelenik meg: "Please enter valid email!".
- Történt működés: A rendszer létrehozza az új felhasználót hibás email címmel is.
##### Hibás működés

### 6 karakternél rövidebb jelszóval történő regisztráció:
- Elvárt müködés: egy hiba üzenet jelenik meg: "Password should be at least 6 character long!".
- Történt működés: hiba üzenetet kaptunk miszerint a jelszó legalább 6 karakter hoszzú kell legyen.
##### Helyes működés

## Bejelentkezés tesztelése: 
#### Tesztelő: Gulyás Péter
#### 2020.05.15.

### Hibás jelszóval történő bejelentkezés: 
- Elvárt működés: a felhasználó nem lép be, hanem egy hiba üzenetet kap: "Invalid credential!".
- Történt működés: a felhasználó hiba üzenetet kapott.
##### Helyes működés.

## Felhasználói adatok frissítésének tesztelése:
#### Tesztelő: Gulyás Péter
#### 2020.05.15.

### Nem létező email címre frissítés:
- Elvárt működés: Ha nem létző email címre akarom leváltani a jelenlegit egy hiba üzenet jelenik meg: "Please enter valid email!".
- Történt működés: A rendszer frissítette a felhasználó email címét a hibásra.
##### Hibás működés

### Kijelentkezés:
- Elvárt működés: a gombra kattintva a felhasználót a bejelentkező felületre irányítja át.
- Történt működés: a felhasználót átirányította a bejelentkező felületre.
##### Helyes működés

### Profil törlése esetén:
- Elvárt működés: a gombra kattintva megjelenik egy üzenet ahol meg kell erősítenie a felhasználónak a törlést,
ha az igenre kattint akkor a regisztrációs felületre irányítja át.
- Történt működés: megjelent az üzenet,
a megerősítés után a felhasználót a regisztrációs felületre irányította,
majd törölte az adatbázisból.
##### Helyes működés
