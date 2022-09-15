# Praca_dyplomowa
Jest to projekt będący symulacją sklepu internetowego zawierającego produkty jak i informacje na temat artykułów prozdrowotnych pszczelich. Aplikacja posiada możliwość rejestracji, logowania, zarządzania bazą danych jako administrator, zarządzania własnym kontem jako użytkownik. Posiada również symulowany zakup za pomocą Stripe API, wyszukiwarkę produktów bądź artykułów za pomocą głosu(API) lub pisma. Po operacjach związanych z kontami użytkowników wysyłane są również wiadomości e-mail za pomocą phpmailera. 

Projekt posiada problem ze ścieżkami którego nie byłem w stanie poprawić - zła konstrukcja ścieżek, brak pliku jako root poza resztą katologów. Z tego powodu projekt nie został wrzucony na żaden hosting. 

Ze względu na to że kilkukrotnie wychodziłem poza aplikacje i wchodziłem do niej z powrotem (jako odwoływanie się do ścieżek), projekt musi znajdować się w 
htdocs/Praca_dyplomowa np. C:\xampp\htdocs\Praca_dyplomowa

Plikiem służącym jako strona główna od którego można obsługiwać stronę, czyli mój root, jest: Frontend/Main/index.php

Nie można również zmieniać nazwy folderu w którym znajduję się aplikacja ponieważ odwołuje się po nazwie Praca_dyplomowa.
Posiadając niezmienioną nazwę folderu z aplikacją w odpowiednim miejscu, wszystko powinno działać jak należy. 
