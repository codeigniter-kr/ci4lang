
# 설치방법
```bash
$ git clone https://github.com/codeigniter-kr/ci4lang
$ composer install
```

# 언어팩 작업
- 한국어 언어팩을 참조하세요.
![image](https://user-images.githubusercontent.com/5427199/178419849-f0b5f4da-723b-4f5a-b123-2f39d73260ea.png)

# 설명
- 메인 언어팩(en)의 값과 번역 하고자 하는 언어팩의 주석을 비교하여 변겅을 체크합니다.
- 메인 언어팩(en)과 번역팩의 상호 키를 대조합니다.

---

# CLI
## CLI 실행
```bash
$ php cli
```

## CLI 스크린샷
![image](https://user-images.githubusercontent.com/5427199/178884548-11f65862-6f5d-45ea-b05a-f7e7f6ec3c9f.png)

---

# WEB
## `index.php` 수정
- 언어체크: https://github.com/codeigniter4/translations#repository-information
```
$ci4lang = new Ci4lang\Ci4langClass('your locale');
```

## 실행
```bash
$ php -S 0.0.0.0:8000 index.php
```

## 접속
- 브라우저 : https://localhost:8000

## 스크린샷
![image](https://user-images.githubusercontent.com/5427199/178733471-39818fcf-6507-43bc-8f13-18f32263c5b2.png)

---

# 주저리
```
언어팩 변경 내역을 쉽게 체크 하기 위한 레거시 코드로 이루어진 프로젝트 입니다.
```
