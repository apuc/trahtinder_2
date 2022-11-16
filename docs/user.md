# Пользователь

## Методы

<table>
    <tr>
        <th>
            Метод
        </th>
        <th>
            Описание
        </th>
    </tr>
    <tr>
        <td>
            api/user/create
        </td>
        <td>
            Регистрация
        </td>
    </tr>
    <tr>
        <td>
            api/user/login
        </td>
        <td>
            Авторизация
        </td>
    </tr>
    <tr>
        <td>
            api/user/refresh-access-token
        </td>
        <td>
            Обновление токена доступа
        </td>
    </tr>
</table>

### Регистрация

`http://yii-tinder.loc/api/user/create`
<p>
    Для регистрации нового пользователя необходимо отправить <b>POST</b> запрос на URL http://yii-tinder.loc/api/user/create
</p>
<p>
    Требуемые параметры параметры:
</p>
<table>
    <tr>
        <th>
            Параметры
        </th>
        <th>
            Значение
        </th>
    </tr>
    <tr>
        <td>
            username
        </td>
        <td>
            Имя пользователя
        </td>
    </tr>
    <tr>
        <td>
            email
        </td>
        <td>
            Почта  
        </td>
    </tr>
    <tr>
        <td>
            password
        </td>
        <td>
            Пароль 
        </td>
    </tr>
    <tr>
        <td>
            phone
        </td>
        <td>
            Телефон 
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user/create`

<p>
    Возвращает объект <b>Пользователь</b>. <br>
    Каждый объект <b>Пользователь</b> имеет такой вид:
</p>

```json5
{
  "message": "You are now a member!",
  "data": {
    "id": 21,
    "email": "token@mfdf.com",
    "access_token": "lTpV-D2h9qp81ncd6KF6NKSNxOCi8ncb",
    "access_token_expired_at": "2022-11-23",
    "refresh_token": "ymb2YjAxUb2xdg7PjVfFCBBl2sjGlTsS",
    "refresh_token_expired_at": "2022-12-16"
  }
}
```

### Авторизация

`http://yii-tinder.loc/api/user/login`

<p>
    Для того, чтобы получить данные авторизвции необходимо отправить <b>GET</b> запрос
    на URL http://yii-tinder.loc/api/user/login.
</p>
<p> 
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user/login?email=11refUserjjfff@mfdf.com&password=123456789`

<p>
    Возвращает объект <b>Пользователя</b> с токенами доступа и обновления, с датами окончания действия токенов.
</p>
<p>
    Требуемые параметры:
</p>
<table>
    <tr>
        <th>
            Параметры
        </th>
        <th>
            Значение
        </th>
    </tr>
    <tr>
        <td>
            email
        </td>
        <td>
            Почтовый адрес
        </td>
    </tr>
     <tr>
        <td>
            password
        </td>
        <td>
            Пароль
        </td>
    </tr>
</table>

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Authorization is successful!",
  "data": {
    "id": 20,
    "email": "01ref4Userjjfff@mfdf.com",
    "access_token": "fb06asn1ZIsOPibOJdMW40gRO9zyFnDR",
    "access_token_expired_at": "2022-11-23 00:00:00",
    "refresh_token": null,
    "refresh_token_expired_at": null
  }
}
```

### Обновление токена доступа

`http://yii-tinder.loc/api/user/refresh-access-token`

<p>
    Для обновления токена доступа необходимо отправить <b>GET</b> запрос
    на URL http://yii-tinder.loc/api/user/refresh-access-token.
</p>
<p> 
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user/refresh-access-token?refreshToken=_bnjL_-5LlkumpSB1tGWNBfWz6sq7cLt`

<p>
    Возвращает объект <b>Пользователя</b> с токенами доступа и обновления, с датами окончания действия токенов.
</p>
<p>
    Требуемые параметры:
</p>
<table>
    <tr>
        <th>
            Параметры
        </th>
        <th>
            Значение
        </th>
    </tr>
    <tr>
        <td>
            refreshToken
        </td>
        <td>
            Токен сброса
        </td>
    </tr>
</table>

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Token is refreshed!",
  "data": {
    "id": 21,
    "email": "token@mfdf.com",
    "access_token": "lTpV-D2h9qp81ncd6KF6NKSNxOCi8ncb",
    "access_token_expired_at": "2022-11-23",
    "refresh_token": "ymb2YjAxUb2xdg7PjVfFCBBl2sjGlTsS",
    "refresh_token_expired_at": "2022-12-16"
  }
}
```