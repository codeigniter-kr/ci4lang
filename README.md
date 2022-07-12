
# installation
```bash
$ git clone https://github.com/codeigniter-kr/ci4lang
$ composer install
```

# `index.php` modify
- check: https://github.com/codeigniter4/translations#repository-information
```
$ci4lang = new Ci4lang\Ci4langClass('your locale');
```

# run
```base
$ php -S 0.0.0.0:8000 index.php
```

# connect
- browser : https://localhost:8000

# how it works
- Compare the original release language (En) value with the `comment' of the user language pack.

# language pack work
- See Korean Language Pack.
![image](https://user-images.githubusercontent.com/5427199/178419849-f0b5f4da-723b-4f5a-b123-2f39d73260ea.png)


# screenshot
![CleanShot 2022-07-12 at 14 30 43](https://user-images.githubusercontent.com/5427199/178416303-43539f7c-9d51-42e1-b773-1be9222893eb.png)


```
Worked with legacy for simplicity check.
```
