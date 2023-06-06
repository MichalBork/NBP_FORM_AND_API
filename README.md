## NBP_FORM_AND_API

Projekt dostępny jest pod adresem (http://3.219.203.189/)



# Najwazniejsze funkcje i uzyte rozwiazania

## System routingu

W pliku index.php znajduje sie statycznie wywołana metoda statyczna klasy Router, która odpowiada za wywołanie
odpowiedniej metody kontrolera w zależności od ścieżki. W pliku routes.php znajduje się tablica routingu, która zawiera
ścieżki i odpowiadające im metody kontrolera. W przypadku nie znalezienia ścieżki w tablicy routingu wywoływana jest
metoda statyczna klasy Router, która odpowiada za wywołanie metody kontrolera.

## Odpytywanie API NBP i pobieranie danych dla tabel w widoku
Projekt posiada dwa widoki jeden z lista dostepnych walut, a drugi formularz do przewalutowania z historią danego dnia.
Do pierwszego widoku pobierane są dane z API NBP, a następnie zapisywane do bazy danych, po czym wyświetlane są
najnowsze dostępne dane.

Odpytywanie odbywa się za pomocą Crona, który wywołuje skrypt php, który pobiera dane z API NBP i zapisuje do bazy
danych raz dziennie o godzinie 12:00.

## Najważniejsze klasy i ich funkcje

#### Controller

Każdy controller dziedziczy klase `AbstractController` która definiuje metody zwracania danych. Możemy zwrócić dane w
formacie json lub html. W przypadku zwracania danych w formacie html, możemy zwrócić dane z widoku, który jest
zdefiniowany w folderze `templates`.

#### Http/Request

Tutaj znajduje się ApiClient odpowiedzialny za komunikacje z API NBP. Wykorzystuje on biblioteke GuzzleHttp.

#### Http/Response

Znajduje się tutaj klasa odpowiedzialna za zwracanie danych w formacie json. Wykorzystuje tutaj wzorzec fabryki dla
zwracania danych w odpowiednim formacie.

#### Logger

Statyczny Logger, który zapisuje logi do pliku.

#### Repository

Każde repository dziedziczy po `AbstractRepository` które rozpoczyna połączenie z bazą danych. Znajdują się tutaj
uniwersalne metody do pobierania danych z bazy danych.

#### Service

Tutaj odbywa się logika biznesowa. Znajdują się tutaj metody do pobierania danych z API NBP oraz zapisywania danych do
bazy danych.
