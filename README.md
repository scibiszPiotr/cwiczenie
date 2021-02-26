HOW TO

1. cd docker && docker-compose up -d
2. php artisan migrate:fresh --seed
3. php artisan serve --port 8080


DB:
<p>127.0.0.1</p>
<p>db name: laravel</p> 
<p>port: 3306</p>
<p>login: root</p>
<p>pass: root</p>

Przygotowałem POC przy użyciu Laravela. Wybrałem tak, ponieważ na codzień pracuję z Larvą, więc spędzę najmniej czasu nad zadaniem wybierając technologię, którą w tym momencie znam najbardziej. Zwłaszcza że jest to zadanie rekrutacyjne, a nie biznesowy projekt. 

Jako db mySQL, gdyż jest wystarczający do tego zadania.

Jako prezentację danych wybieram API, ponieważ budowanie frontu nawet przy pomocy bootstrapa jest czasochłonne, dodatkowo nie jestem forntendowcem i nigdy nim nie będę, więc front wyglądał by jak przygotowany przez typowego programistę - kwadratowo ;)
A API można wykorzystać np. do React.

Widok pojedyńczego produktu. Do jego stworzenia wybrałem ORM, ponieważ jest to odpytanie o jeden produkt więc jest to zapytanie które nie sprawdza wszystkich rekordów w bazie tylko sięga po komkretne. W tym wypadku ORM nie spowalnia pobierania wyników z db.
Widok pojedyńczego produktu: http://localhost:8080/product/{id} lub API: http://127.0.0.1:8080/api/product/{id}
