var myTrack = new ymaps.Polyline([
<?php
if($coordinates = @file_get_contents('../coordinates.txt')){
$coordinates = substr($coordinates,0,-2);
echo $coordinates;
} else {
echo '[54.195387, 37.618035]';
}
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
