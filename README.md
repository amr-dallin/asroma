# asroma

Веб-приложение генерирует таблицу чемпионата Италии для сайта [as-roma.ru](https://as-roma.ru).

## Источник данных

Данные берутся со страницы [https://www.bbc.com/sport/football/italian-serie-a/table](https://www.bbc.com/sport/football/italian-serie-a/table).
Ссылка на источник и дата парсинга сохраняются в файле данных (data.json).
Без особых усилий можно сменить источник данных.

## Структура приложения

upload.php - скрип парсинга источника данных и генерации файла данных (data.json). Файл запускается cron'ом (0 * * * 0,1,3,6)

data.json - файл данных, содержащий следующую структуру данных:

    {
        "table":
            [
                {
                    "teamName":"Juventus",
                    "played":"24",
                    "points":"57"
                },
                ...
            ],
        "info":
            {
                "author":"Marat Dallin",
                "authorSite":"https:\/\/dallin.uz",
                "authorEmail":"mail@dallin.uz",
                "created":"2020-02-21T20:09:07+05:00",
                "source":"https:\/\/www.bbc.com\/sport\/football\/italian-serie-a\/table"
            }
    }

table.js - файл генерирует таблицу чемпионата Италии на страницах сайта [as-roma.ru](https://as-roma.ru), используя данные из data.json

## Установка

Необходимо заменить

```html
<div class="rate">
...
</div>
```

на

```html
<script src="//api.dallin.uz/asroma/table.js" async></script>
<div id="asromaTable"></div>
```

## Результат

![result screenshot](/examples/result.png)

## Дополнительно

- Файл data.json располагается на другом домене и для получения данных используется технология XMLHttpRequest, которая может работать некорректно в устаревших браузерах. Желательно, расположить файлы upload.php и data.json на домене сайта и генерировать таблицу с помощью php;
- Класс стилей .rate ограничивает тег div высотой в 330px. Это приводит к тому, что вся таблица не отображается на странице. Для отображения полной таблицы, необходимо поработать с файлом style.css, изменить высоту [изображения](https://www.as-roma.ru/images_new/rate.png) и увеличить количество отображаемых новостей до 15.
