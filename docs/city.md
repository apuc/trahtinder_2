# Города

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
            api/city/city
        </td>
        <td>
            Получение списка городов
        </td>
    </tr>
</table>

### Получение тегов

`http://yii-tinder.loc/api/city/city`
<p>
    Для получения списка городов необходимо отправить <b>GET</b> запрос на URL http://yii-tinder.loc/api/city/city
</p>
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
            city_id
        </td>
        <td>
            При передачи id города будут возвращены данные одного города.
            Без этого параметра метод возвращает данные всех городов.
        </td>
    </tr>
</table>
<p>
    Пример запроса:
</p>

`http://yii-tinder.loc/api/city/city?city_id=1`

<p>
    Пример возвращаемых данных
</p>

```json5
{
  "message": "Cities list",
  "data": [
    {
      "title": "city1"
    },
    {
      "title": "city2"
    }
  ]
}
```
