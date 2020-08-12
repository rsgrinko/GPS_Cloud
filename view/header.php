<html>
<head>
<title><?=$_SYSTEM['title'];?></title>
 <style>
   body {
    background: #FFFFFF url(img/background.jpg); /* Цвет фона и путь к файлу */
    color: #000000; /* Цвет текста */
   }
   #menu{
    background: #FFFFFF url(img/fon_menu.png); /* Цвет фона и путь к файлу */
    color: #000000; /* Цвет текста */
   }


  </style>
<?php
if($_SYSTEM['map']=='enable') {
?>

<script src="https://api-maps.yandex.ru/2.1/?apikey=012a7dcd-4ad7-4354-85f8-e2f43a1c848c&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    function init(){
    var myMap = new ymaps.Map("map", { center: <?=getLastGpsPoint($_SESSION['devid'], $_SESSION['eptime']);?>, zoom: 15 }),
        

lastPoint = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: <?=getLastGpsPoint($_SESSION['devid'], $_SESSION['eptime']);?>
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: 'трекер',
                hintContent: 'Последняя координата'
            }
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#blackStretchyIcon',
            // Метку можно перемещать.
            draggable: false
        }
        );
        
        
        
        
        ////////////
var myTrack = new ymaps.Polyline([
<?
echo prepareTrack($_SESSION['devid'], $_SESSION['eptime'],'');
?>
], {
balloonContent: "маршрут"
}, {
// Отключаем кнопку закрытия балуна.
balloonCloseButton: true,
// Цвет линии.
strokeColor: "#AA00FF",
// Ширина линии.
strokeWidth: 8,
// Коэффициент прозрачности.
strokeOpacity: 1
});
        ///////////


myMap.geoObjects
.add(lastPoint)
.add(myTrack)

.add(new ymaps.Placemark(<?=getFirstGpsPoint($_SESSION['devid'], $_SESSION['eptime']);?>, {
balloonContent: 'Точка старта'
}, {
preset: 'islands#circleIcon',
iconColor: '#0000FF'
}))


        
    }
</script>
<?php
}
?>
</head>
<body>
    
<h1><center>Спутниковая система мониторинга</center></h1>
<table border="1px" width="100%">
<tr>
<td width="25%" id="menu"><?php include 'right_menu.php';?></td><td width="75%">
