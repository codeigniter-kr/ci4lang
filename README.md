
# 설치법
```bash
$ git clone https://github.com/codeigniter-kr/ci4lang
$ composer install
```

# `index.php` 수정
- check: https://github.com/codeigniter4/translations#repository-information
```
$ci4lang = new Ci4lang\Ci4langClass('your locale');
```

# 실행
```base
$ php -S 0.0.0.0:8000 index.php
```

# 접속
- 브라우저 : https://localhost:8000

# 동작 방식
- 원본 릴리즈 언의 팩의 번역 값과 사용자 언어팩의 주석을 대조한다.

# 언어팩 작업
![image](https://user-images.githubusercontent.com/5427199/178419849-f0b5f4da-723b-4f5a-b123-2f39d73260ea.png)


# 스크린샷
![CleanShot 2022-07-12 at 14 30 43](https://user-images.githubusercontent.com/5427199/178416303-43539f7c-9d51-42e1-b773-1be9222893eb.png)


```
단순 체크용 레거시 코드로 이루어져 있습니다.
```
