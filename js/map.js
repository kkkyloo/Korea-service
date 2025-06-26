document.addEventListener('DOMContentLoaded', function () {
  setTimeout(initYandexMap, 5000);
});

document.addEventListener('scroll', initYandexMapOnEvent);
document.addEventListener('mousemove', initYandexMapOnEvent);
document.addEventListener('touchstart', initYandexMapOnEvent);

function initYandexMapOnEvent(e) {
  initYandexMap();
  e.currentTarget.removeEventListener(e.type, initYandexMapOnEvent);
}

function initYandexMap() {
  if (window.yandexMapDidInit) {
    return false;
  }
  window.yandexMapDidInit = true;

  document.getElementById('YandexMap').src = 'https://yandex.ru/map-widget/v1/org/koreya_servis/99747400872/prices/?ll=39.589742%2C47.209935&z=17';

 

}