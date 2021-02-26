# HOW TO

1. git clone https://github.com/scibiszPiotr/cwiczenie
2. cd cwiczenie && docker-compose up -d
3. php artisan migrate:fresh --seed
4. php artisan serve --port 8080

###DB connection: <br>
127.0.0.1
db name: laravel</br> 
port: 3306</br>
login: root</br>
pass: root</br>

### Dlaczego taka technologia
Przygotowałem POC przy użyciu Laravela. Wybrałem tak, ponieważ na codzień pracuję z Larvą, więc spędzę najmniej czasu nad zadaniem wybierając technologię, którą w tym momencie znam najbardziej. Zwłaszcza że jest to zadanie rekrutacyjne, a nie biznesowy projekt, więc nie będzie używany na codziennie. 

Jako db mySQL, gdyż jest wystarczający do tego zadania oraz łatwy w użyciu.

Jako prezentację danych wybieram API, ponieważ budowanie frontu nawet przy pomocy bootstrapa jest czasochłonne, dodatkowo nie jestem forntendowcem i nigdy nim nie będę ;), więc front wyglądałby jak przygotowany przez typowego programistę - kwadratowo ;)
A API można wykorzystać np. do React, czy jako mikro-serwis.

### Dostępne url'e
1. Widok pojedyńczego produktu.
   Do jego stworzenia wybrałem ORM, ponieważ jest to zapytanie o jeden produkt, więc jest to zapytanie, dość proste. Dodatkowo korzystając z ORM mamy do dyspozycji wszystkie jego możliwość. W tym wypadku ORM nie spowalnia pobierania wyników z db.
  - http://localhost:8080/product/{id}
  - http://localhost:8080/api/product/{id}

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

W tym zadaniu nie posłużyłem się ORM, ponieważ byłby mniej wydajny. Świetnie sprawdza się do CRUD, ale nie do filtrowania większej ilości rekordów.

### Jakie klasy są przygotowane w ramach zadania:
 1.  Aby wygenerować db oraz nepełnić ją danymi wykożystałem mechanim migracji oraz seeder.
 - pliki migracji znajdują się w `database/migrations`
 - pliki seeder'a znajdują się w `database/seeders`, a aby seeder potrafił wygenerować dane należało stworzyć factories, które znajdują się w `database/factories`
 2. routing jest oczywiście w `routes/api.php` oraz `web.php`
 3. controllers znajdują się w `app/Http/Controllers`
 4. validator danych dla url z filtrem znaduje się w `app/Http/Requests`
 5. modele znajdują się w `app/Models`
 6. serwis do pobierania danych oraz projektor umieściłem w `app/Services`

### Struktura db
Na podstawie mojego zrozumienia opisu zadania przygotowałem strukturę db. <br>
Baza składa się z 3 tablic, `products`, `variants` i `attributes`.
Założyłem nadrzędność tablicy `products`, którą połączyłem relacją one to many z tablicą `variants`. Również taką relacją one to many połączyłem tablicę `variants` i `attributes`.
Użyłem takiego podejścia, gdyż założyłem, że każdy produkt w bazie jest unikatowy.
