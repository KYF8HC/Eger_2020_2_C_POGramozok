# Funkcionális Specifiáció

## Áttekintés:
- Mozis alkalmazás, ahol egy mozinak a filmkínálatát láthatjuk illetve felhasználói fiókot is létre lehet hozni annak érdekében, hogy ne csak a mozikínálatot láthassuk hanem akár jegyet is tudjunk foglalni a filmekre.
A filmekre kattintva látható lesz hogy van-e még szabad hely abban a teremben és ha van akkor melyik sorban vagy sorokban vannak szabad helyek . 


## Jelenlegi helyzet:
- Szeretnénk létrehozni egy mozis alkalmazást aminek minden funkciója megfelően müködik és megfelel az elvárásoknak is .
  a megrendelő szeretne egy pár dolgot extraként , az oldalon ne csak a mozi filmeket és az előadás dátumait lehessen megtekinteni ,hanem akár jegyet is lehessen foglalni egy adott filmre , minden széket jelenitsen meg a program illetve a már lefoglalt székeket is jelenitse meg egy külön szinnel ,vagy jelzéssel , hogy azokra a székekre ne leheseen kétszer jegyet venni.

## Követelménylista
|modul|név|kifejtés|
|---|---|---|
|Jogosultság|Bejelntkezési felület|A felhasználó az email címe és a jelszavasegítségével bejelentkezhet -Ha a megadott email cím vagy jelszó nemmegfelelő,akkor a felhasználó hibaüzenetet kap.|
|Jogosultság|Regisztráció|A felhasználó a felhasználói nevének, emailcímének és jelszavának megadásával regisztrálja magát.|
|Jogosultság|Jogosultsági szintek| Admin : Rendszerhozzáférés, filmek feltöltése , kezelése. Felhasználó: filmek megtekintése , jegyfogaláls , regisztrálás|
|Modifikáció|Jegy módosítás|A felhasználó módosítani tudja a jegy fogalálst egy bizonyos idő korláton belül.|
|Modifikáció|Jelszó módosítás|A felhasználó belépés után módosítani tudja jleszavát a régi jelszó megadása után.|
|Modifikáció|footer|Az elérhetőségi iconok és linkek változhatnak|
|Modifikáció|elfelejtett jelszó|Ha a felhasználó elfelejtette a felhasználónevét, vagy jelszavát akkor ezzel az opcióval egy Adminhoz tud fordulni|
|Jogosultság|Admin felület|Felület az admin fiókkal rendelkező felhasználó számára. Tartalmaz egy felületet az új filmek feltöltéséhez.|

##  Jelenlegi üzleti folyamatok modellje
- Projektünk célja eggyrészt hogy a mozinak a filmkínálatáról akár online is lehessen tájokozódni illetve, hogy az időpontokkal is tisztában lehessenek az emberek. Szeretnénk ezzel megszüntetni a mozi jegypánztárát megrohamozó tömeget és a hosszas várakozási időt  csökkenteni. 
  
##  Igényelt üzleti folyamatok modellje
- Android studio
- Java, SQL, illetve PHP nyelvek alkalmazása

##  Használati esetek
- Admin felhasználó, tudja szerkeszteni az alkalmazás tartalmát, hogy mindig napra kész legyen , és mindig időben tudjon tájékozodni a felhasználó a filmekről és az időpontokról.
- Felhasználó megnyitja az alkalmazást és választhat a menüpontokból, hogy melyik filmre kiváncsi vagy szeretne belépni a felhasználó profiljába.

