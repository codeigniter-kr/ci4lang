
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
- Compare the original release language (En) value with the `comment` of the user language pack.

# language pack work
- See Korean Language Pack.
![image](https://user-images.githubusercontent.com/5427199/178419849-f0b5f4da-723b-4f5a-b123-2f39d73260ea.png)

# screenshot
![image](https://user-images.githubusercontent.com/5427199/178733471-39818fcf-6507-43bc-8f13-18f32263c5b2.png)

```
Worked with legacy for simplicity check.
```
