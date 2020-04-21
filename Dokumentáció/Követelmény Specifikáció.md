# Követelmény Specifiáció

## 1.Áttekintés:
-Az alkalmazás egy ,mozi film kinálatát fogja megjeleníteni , regisztráció nélkül is meg fognak jelenni a filmek , de csak regisztrált felhasználok fogják látni , hogy van-e még hely egy adott filmre és egyértelműen csak ők fogják tudni lefoglalni a jegyeket. Ez egy letölthető alkalmazás lesz előszőr csak gépre , ha időnk engedi akár a későbbiekben androidra is meg tudjuk majd valósítani. 

## 2.Jelenlegi helyzet:
- Célunk egy naprakész alkalmazás létrehozása , ami egy mozi film listáját fogja tárolni , be lehet jelentkezni és jegyet is lehet lesz foglalni.

## 3. Vágyálom Rendszer:
- Projektünk célja, hogy létre tudjunk hozni egy stabil lábakon álló alkalmazást elsősorban számítógépre, de tervben van több platformra
fejlesztés is(pl. Android, IOS). Regisztráció után látható lesz melyi filmre van még jegy illetve le is lehetlesz foglalni a hely jegyeket is. 
  
## 4.Funkcionális Követelmények
- A projekt admin felületéhez csak az arra jogosult felhasználók léphetnek be és ott testre szabva a mozi teljes kínálatát és azok specifikációit.
- A normál felhasználó regisztráció után korlátozott jogosultságokkal rendelkezik, ami a jegyfoglalásban és a filmek véleményezésében merül ki.
  
## 5.Rendszerre vonatkozó törvények, szabványok, ajánlások

## 6. Jelenlegi üzleti folyamatok modellje
- Mostanra újra divat lett moziba járni, az emberek egy része inkább beül egy filmre és kifizeti azt, mint hogy lekalózkodja azt.
Alkalmazásunk minden mozi rendszerébe beépíthető, könnyen elérhető és áttekinthető a vásárlók által is. A nézők értékelni tudják a filmeket és hozzászólásokat is írhatnak ahhoz, amit minden más felhasználó megtekinthet.

## 7. Igényelt üzleti folyamatok modellje
- A megrendelő egy admin felületbe lépéssel módosíthatja a mozi kínálatát, filmeket tud feltölteni majd beárazni, időpontot és korhatárt tud hozzá rendelni. Ezen kívül szabad kezet kap az értékelések felülbírálásában is.
- A vásárlók(nézők) ugyancsak bejelentkezve tudnak helyet foglalni egy-egy filmre, és értékelni is tudják azt.

## 8. Követelménylista

|Modul|Név|Kifejezés|
|---|---|---|
|Jogosultság|Bejelentkezési felület|A felhasználó az e-mail címe és jelszava segítségével bejelentkezhet. Ha ez nem megfelelő, akkor hibaüzenetet dob a program.|
|Jogosultság|Regisztráció|A felhasználó a felhasználói nevének, e-mail címének és jelszavának megadásával regisztrálja magát.|
|Jogosultság|Jogosultsági szintek|Admin: Rendszerhozzáférés, filmek és azok funkcióinak feltöltése, vélemények elbírálása. Felhasználó: Regisztrálás, bejelentkezés, filmek specifikációjának megtekintése, jegyfoglalás, véleményezés.|
|Jogosultság|Admin felület|Felület az admin fiókkal rendelkező felhasználó számára. Egy olyan felületet tartalmaz, ahol új filmeket lehet feltölteni és hozzászólásokat lehet törölni.
|Modifikáció|Jegy módosítása| A felhasználó egy adott időkorláton belül módosíthatja a jegyfoglalást, vagy akár le is mondhatja a foglalást.|
|Modifikáció|Jelszó módosítás|A felhasználó módosíthatja az előre megadott jelszavát másra. Hibát dob ha ugyanarra próbálja megváltoztatni.|
|Modifikáció|Felhasználónév módosítása|A felhasználó módosíthatja az előre megadott felhasználói nevét. Hibát dob ha ugyanarra próbálja megváltoztatni.|
|Modifikáció| Elfelejtett felhasználónév/jelszó| Ha elfelejti a felhasználónevét vagy jelszavát, ezzel az opcióval egy adminhoz fordulhat segítségkérés gyanánt.|

## 9. Riportok
Hogyan kellene működnie a rendszernek?
 Admin felhasználó szemontjából: A login felületen belép az admin, a következő felületen pedig új filmet adhat hozzá a mozijához vagy hozzászólásokat törölhet.
 Átlagos felhasználó szempontjából: Sign up felületen regsiztrál felhasználónév, jelszó és e-mail cím segítségével. 
Login felületen belép, a következő felületen pedig jegyfoglalást hajthat végre a felsorolt filmekre(kosárba helyezi azt).
Ha nem megfelelően hajtotta végre a jegyfoglalást vagy változtatni szeretne azon, lehetősége van adott időkorláton belül megváltoztatni hogy melyik filmre és hova szeretne beülni. Lehetősége van még eltörölni a jegyfoglalást is.
Ezen kívül hozzászólásokat írhat a filmekhez, ahol látja a többi felhasználó hozzászólásait is.
