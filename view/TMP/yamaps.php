<script type="text/javascript">
    ymaps.ready(init);
    function init(){
    var myMap = new ymaps.Map("map", { center: [54.287900, 37.606783], zoom: 12 }),
    myGeoObject = new ymaps.GeoObject({
    // Описание геометрии.
    geometry: {
               type: "Point",
               coordinates: [54.276248, 37.605211]
              },
            // Свойства.
            properties: {
            // Контент метки.
             iconContent: 'Внеплановая остановка 15 минут',
             hintContent: 'Закончилось топливо'
            }
              }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#blackStretchyIcon',
            // Метку можно перемещать.
            draggable: true
             }
             );
        

        
        
        
 var myPolyline = new ymaps.Polyline([
            // Указываем координаты вершин ломаной.
            [54.293595, 37.607677],
            [54.292709, 37.606828],
            [54.292220, 37.606077],
            [54.288477, 37.604166],
            [54.288264, 37.604416],
            [54.288069, 37.605163],
            [54.287900, 37.606783],
            [54.287596, 37.607031],
            [54.287255, 37.607140],
            [54.276248, 37.605211],
            [54.270991, 37.596794],
            [54.270677, 37.596465],
            [54.227594, 37.628530]
           
        ], {
            // Описываем свойства геообъекта.
            // Содержимое балуна.
            balloonContent: "маршрут"
        }, {
            // Задаем опции геообъекта.
            // Отключаем кнопку закрытия балуна.
            balloonCloseButton: false,
            // Цвет линии.
            strokeColor: "#FF0000",
            // Ширина линии.
            strokeWidth: 4,
            // Коэффициент прозрачности.
            strokeOpacity: 1
        });
        
         var myPolyline2 = new ymaps.Polyline([
            // Указываем координаты вершин ломаной.
            //берем координаты из трека устройства

<?php
include 'coordinates.php';
?>
           
        ], {
            // Описываем свойства геообъекта.
            // Содержимое балуна.
            balloonContent: "маршрут"
        }, {
            // Задаем опции геообъекта.
            // Отключаем кнопку закрытия балуна.
            balloonCloseButton: false,
            // Цвет линии.
            strokeColor: "#00FF00",
            // Ширина линии.
            strokeWidth: 4,
            // Коэффициент прозрачности.
            strokeOpacity: 1
        });
            
         myMap.geoObjects
        .add(myGeoObject)
        .add(myPolyline)   
        .add(myPolyline2) 
        .add(new ymaps.Placemark([54.293595, 37.607677], {
            balloonContent: 'автомобиль логиста',
            iconCaption: 'Р182НМ71'
        }, {
            preset: 'islands#blueCircleDotIconWithCaption',
            iconCaptionMaxWidth: '100'
        }))
        
    }
</script>
