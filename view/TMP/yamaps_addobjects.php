myMap.geoObjects
.add(lastPoint)
.add(myTrack)

.add(new ymaps.Placemark(<?php include 'firstpoint.php'; ?>, {
balloonContent: 'Точка старта'
}, {
preset: 'islands#circleIcon',
iconColor: '#0000FF'
}))
