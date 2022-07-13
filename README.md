
# 설치방법
```bash
$ git clone https://github.com/codeigniter-kr/ci4lang
$ composer install
```

# `index.php` 수정
- 언어체크: https://github.com/codeigniter4/translations#repository-information
```
$ci4lang = new Ci4lang\Ci4langClass('your locale');
```

# 실행
```base
$ php -S 0.0.0.0:8000 index.php
```

# 접속
- 브라우저 : https://localhost:8000

# 동작방식
- Compare the original release language (En) value with the `comment` of the user language pack.

# 언어팩 작업
- See Korean Language Pack.
![image](https://user-images.githubusercontent.com/5427199/178419849-f0b5f4da-723b-4f5a-b123-2f39d73260ea.png)

# 스크린샷
![image](https://user-images.githubusercontent.com/5427199/178733471-39818fcf-6507-43bc-8f13-18f32263c5b2.png)

```
언어팩 변경 내역을 쉽게 체크 하기 위한 레거시 코드로 이루어진 프로젝트 입니다.
```
