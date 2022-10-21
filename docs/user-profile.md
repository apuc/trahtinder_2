# Профиль ользователя

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
            api/user-profile/profile
        </td>
        <td>
            Данные профиля
        </td>
    </tr>
    <tr>
        <td>
            api/user-profile/create
        </td>
        <td>
            Создать профиль
        </td>
    </tr>
    <tr>
        <td>
            api/user-profile/update
        </td>
        <td>
            Обновить профиль
        </td>
    </tr>
    <tr>
        <td>
            user-profile/set-photo
        </td>
        <td>
            Загрузить/обновить фото
        </td>
    </tr>
</table>

### Данные профиля

`http://yii-tinder.loc/api/user-profile/profile`
<p>
    Для получения данных профиля пользователя необходимо отправить <b>GET</b> запрос на URL http://yii-tinder.loc/api/user-profile/profile
</p>

<p>
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user-profile/profile`

<p>
    Возвращает объект <b>Профиль пользователя</b>:
</p>

```json5
{
  "message": "Profile",
  "data": {
    "name": "name111",
    "gender": 20,
    "city_id": 1,
    "looking_for": 30,
    "photo": "N/A",
    "birthday": "1992-10-21 00:00:00",
    "min_age": 18,
    "max_age": 22
  }
}
```

### Создать профиль

`http://yii-tinder.loc/api/user-profile/create`
<p>
    Для создания нового профиля пользователя необходимо отправить <b>POST</b> запрос на URL http://yii-tinder.loc/api/user-profile/create
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
            name
        </td>
        <td>
            Имя пользователя
        </td>
    </tr>
    <tr>
        <td>
            gender
        </td>
        <td>
            Пол пользователя(20-жещина, 30-мужчина)  
        </td>
    </tr>
    <tr>
        <td>
            looking_for
        </td>
        <td>
            Пол партнёра(20-жещина, 30-мужчина)   
        </td>
    </tr>
    <tr>
        <td>
            city_id
        </td>
        <td>
            ID города 
        </td>
    </tr>
    <tr>
        <td>
            birthday
        </td>
        <td>
            Дата рождения(формат: y:m:d) 
        </td>
    </tr>
    <tr>
        <td>
            min_age
        </td>
        <td>
            Минимальный возраст партнёра 
        </td>
    </tr>
    <tr>
        <td>
            max_age
        </td>
        <td>
            Максимальный возраст партнёра
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user-profile/create`

<p>
    Возвращает объект <b>Профиль пользователя</b>:
</p>

```json5
{
  "message": "Profile is created!",
  "data": {
    "name": "name111",
    "gender": "20",
    "city_id": "1",
    "looking_for": "30",
    "photo": "N/A",
    "birthday": "1992-10-21",
    "min_age": "18",
    "max_age": "22"
  }
}
```

### Обновить профиль

`http://yii-tinder.loc/api/user-profile/update`

<p>
    Для обновления данных профиля необходимо отправить <b>POST</b> запрос
    на URL http://yii-tinder.loc/api/user-profile/update.
</p>
<p> 
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user/login?email=11refUserjjfff@mfdf.com&password=123456789`

<p>
    Возможные параметры:
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
            name
        </td>
        <td>
            Имя пользователя
        </td>
    </tr>
    <tr>
        <td>
            gender
        </td>
        <td>
            Пол пользователя(20-жещина, 30-мужчина)  
        </td>
    </tr>
    <tr>
        <td>
            looking_for
        </td>
        <td>
            Пол партнёра(20-жещина, 30-мужчина)   
        </td>
    </tr>
    <tr>
        <td>
            city_id
        </td>
        <td>
            ID города 
        </td>
    </tr>
    <tr>
        <td>
            birthday
        </td>
        <td>
            Дата рождения(формат: y:m:d) 
        </td>
    </tr>
     <tr>
        <td>
            min_age
        </td>
        <td>
            Минимальный возраст партнёра 
        </td>
    </tr>
    <tr>
        <td>
            max_age
        </td>
        <td>
            Максимальный возраст партнёра
        </td>
    </tr>
</table>

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Profile is updated!",
  "data": {
    "name": "upN55555",
    "gender": "30",
    "city_id": "1",
    "looking_for": "20",
    "photo": "N/A",
    "birthday": "2001-10-28",
    "min_age": "18",
    "max_age": 22
  }
}
```

### Загрузить/обновить фото

`http://yii-tinder.loc/api/user-profile/update`

<p>
    Для загрузки/обновления фото профиля необходимо отправить <b>POST</b> запрос
    на URL http://yii-tinder.loc/api/user-profile/set-photo.
</p>
<p> 
    Пример запроса:
</p>

`http://yii-tinder.loc/api/user/login?email=11refUserjjfff@mfdf.com&password=123456789`

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
            photo
        </td>
        <td>
            Файл фотографии
        </td>
    </tr>
</table>

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Photo is set!",
  "data": "/uploads/profile-photo/cf3713220627eef33af9e75f997ddc2a.png"
}
```