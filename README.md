# digitree-test
Aby uruchomić projekt należy wykonać polecenia:

```
git repo clone roshed/digitree-test
cd digitree-test
composer update
composer install
```

Fakowe uzupełnienie bazy:
php bin/console doctrine:fixtures:load

# Dokumentacja
**Lista**
/user/list

**Dodawanie**
/user/add
Należy postem przesłać **name**,**surname**.

**Edytowanie**
/user/edit
Należy putem przesłać **name**,**surname**,**id**.

**Usuwanie**
Należy deletem przesłać /user/remove/id/{id}



