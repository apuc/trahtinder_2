# Просмотр профилей

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
            api/watched-profiles/viewed-profile
        </td>
        <td>
            Сохронить/обновить просмотр профиля
        </td>
    </tr>
    <tr>
        <td>
            api/watched-profiles/delete-view
        </td>
        <td>
           Удалить просмотр профиля
        </td>
    </tr>
</table>

### Просмотр профиля

`http://yii-tinder.loc/api/watched-profiles/viewed-profile`
<p>
    Для сохранения просмотра профиля необходимо отправить <b>POST</b> запрос на URL http://yii-tinder.loc/api/watched-profiles/viewed-profile
    Для обновления данных просмотра необходимо отправить запрос с id уже просмотренного профиля (candidate_profile_id)
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
            status
        </td>
        <td>
            10 - лайк;
            20 - звёздочка; 
            30 - дизлайк
        </td>
    </tr>
    <tr>
        <td>
            candidate_profile_id
        </td>
        <td>
            id профиля кандидата
        </td>
    </tr>
    <tr>
        <td>
            user_profile_id
        </td>
        <td>
            id профиля пользователя   
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://yii-tinder.loc/api/watched-profiles/viewed-profile`

<p>
    Возвращает объект <b>Профиль пользователя</b>:
</p>

```json5
{
  "message": "Profile viewed!",
  "data": {
    "id": 11,
    "status": "20",
    "user_profile_id": "15",
    "candidate_profile_id": "11",
    "created_at": 1666705453,
    "updated_at": 1666705453,
    "mutual": true
  }
}
```

<p>
    Параметр "mutual" показывает поставил ли просматриваемый вами профиль вам лайк
</p>


### Удалить просмотр профиля

`http://yii-tinder.loc/api/watched-profiles/delete-view`
<p>
    Для удаления просмотра профиля необходимо отправить <b>POST</b> запрос на URL http://yii-tinder.loc/api/watched-profiles/delete-view
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
            candidate_profile_id
        </td>
        <td>
            id профиля кандидата
        </td>
    </tr>
    <tr>
        <td>
            user_profile_id
        </td>
        <td>
            id профиля пользователя   
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://yii-tinder.loc/api/watched-profiles/delete-view`

<p>
    Пример сообщения при удачном удалении:
</p>

```json5
{
  "message": "Success!",
  "data": "View is deleted!"
}
```