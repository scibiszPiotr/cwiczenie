# HOW TO

1. `git clone https://github.com/scibiszPiotr/cwiczenie`
2. `cd cwiczenie && composer install && cp .env.example .env`
3. `docker-compose up -d`
4. `php artisan migrate:fresh --seed`
5. `php artisan serve --port 8080`

###DB connection: <br>
host: `127.0.0.1` <br>
db name: `laravel`</br> 
port: `3306`</br>
login: `root`</br>
pass: `root`</br>

### Dlaczego taka technologia
Przygotowałem POC przy użyciu Laravela. Wybrałem tak, ponieważ na codzień pracuję z Larvą, więc spędzę najmniej czasu nad zadaniem wybierając technologię, którą w tym momencie znam najbardziej. Zwłaszcza że jest to zadanie rekrutacyjne, a nie biznesowy projekt, więc nie będzie używany na codziennie. 

Jako db MySQL, gdyż jest wystarczający do tego zadania oraz łatwy w użyciu.

Jako prezentację danych wybieram API, ponieważ budowanie frontu nawet przy pomocy bootstrapa jest czasochłonne, dodatkowo nie jestem forntendowcem ;)
A API można wykorzystać np. do React, czy jako mikro-serwis.

### Dostępne url'e
1. Widok pojedynczego produktu.
 - Do jego stworzenia wybrałem ORM, ponieważ jest to zapytanie o jeden produkt, więc jest to zapytanie, dość proste. Dodatkowo korzystając z ORM mamy do dyspozycji wszystkie jego możliwość, które są przydatne, jeśli tworzymy front w blade.
   http://localhost:8080/product/{id}

 - Widok pojedynczego produktu by API <br>
    Tutaj użyłem zapytania sql, a nie ORM. Powód jest prosty, strona przy użyciu ORM miała TTFB około 160 ms, a przy zapytaniu sql 60 ms.
  http://localhost:8080/api/product/{id}

2. Filtrowanie i sortowanie wszystkich produktów.
Url do filtrowania wyników po parametrach:
   - http://localhost:8080/api/products <br>
Url w query przyjmuje parametry: <br>

Fields  | Type
------------- | -------------
description  | text
a_name  | text
a_value | text
order | DESC/ASC
orderBy | price/rate

### Jakie klasy są przygotowane w ramach zadania:
 1.  Aby wygenerować db oraz nepełnić ją danymi wykorzystałem mechanizm migracji i seeder.
 - pliki migracji znajdują się w `database/migrations`
 - pliki seeder'a znajdują się w `database/seeders`, a aby seeder potrafił wygenerować dane, należało stworzyć factories, które znajdują się w `database/factories`
 2. routing jest oczywiście w `routes/api.php` oraz `web.php`
 3. controllers znajdują się w `app/Http/Controllers`
 4. validator danych dla url z filtrem znaduje się w `app/Http/Requests`
 5. modele znajdują się w `app/Models`
 6. serwis do pobierania danych oraz projektor umieściłem w `app/Services`

### Struktura db
Na podstawie mojego zrozumienia opisu zadania, przygotowałem strukturę db. <br>
Baza składa się z 3 tablic, `products`, `variants` i `attributes`.
Założyłem nadrzędność tablicy `products`, którą połączyłem relacją one to many z tablicą `variants`. Również taką relacją one to many połączyłem tablicę `variants` i `attributes`.
Użyłem takiego podejścia, gdyż założyłem, że każdy projekt ma określoną ilość sztuk (może być to 1 szt czt też 1000 szt). Myślę, że realnym przykładem tego podejścia jest sprzedaż aut przez dilera. np.
Mamy do sprzedania auta VW - czyli produkt. Każdy VW może być sprzedany w wybranym wariancie, czyli modelu (Golf, Polo, T-Rok). A każdy z tych wariantów można indywidualnie zmodyfikować na życzenie klienta, czyli atrybuty (kolor tapicerki, kolor nadwozia, rodzaj silnika).

Wybierając takie rozwiązanie, zmniejszamy ilość rekordów w bazie, ponieważ mamy 3 pozycje `produkts`, a nie 300. Idąc dalej mamy mniej rekordów w tablicy `variants` i dużo mniej rekordów w `attributes`. Mniejsza ilość rekordów to krótszy czas pobierania wyników. Unikamy też szybkiego puchnięcia db przy dodawaniu kolejnych produktów jako pojedyńcze wpisy. 

### Mechanizm aktualizacji ofert
Przy opisanym podejściu aktualizacja oferty mogłaby odbywać się poprzez dodanie kolejnej kolumny w tablicy products. Jeśli ktoś wkładałby produkt do koszyka, to w tej kolumnie można zapisać ilość produktów znajdujących się w koszyku. Oczywiście max wartość kolumny nie może być większa od ilości produktów. 
Dopiero w momencie zakupy zmniejszałaby się ilość produktu oraz ilość zablokowanego produktu. <br>
Takie podejście rozwiązuje wyścig przy zakupie. Pozwala również, na pokazywanie ile jest jeszcze dostępnych produktów. 
