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
            api/user/request-password-reset
        </td>
        <td>
            Сбросить пароль
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
    "id": 20,
    "username": "regTest1123",
    "email": "1123refUserjjfff@mfdf.com",
    "access_token": null,
    "access_token_expired_at": null
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
    Возвращает объект <b>Профиля</b> и токен доступа с датой окончания действия токена.
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
    "id": 13,
    "username": "regTest",
    "email": "refUserjjfff@mfdf.com",
    "access_token": null,
    "access_token_expired_at": null
  }
}
```

### Сброс Пароля

`http://yii-tinder.loc/api/user/request-password-reset`

<p>
    Для сброса пароля пользователя необходимо отправить <b>POST</b> запрос
    на URL http://yii-tinder.loc/api/user/request-password-reset.
</p>
<p> 
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user/request-password-reset`

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
</table>

<p>
    В случаи успеха возвращает сообщение об успешной отправке сообщения для сброса пароля на электронную почту пользователя.
</p>

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Successful!",
  "data": "Check your email for further instructions."
}
```
