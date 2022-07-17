//Swiper
const swiper = new Swiper('.swiper-container', {
  slidesPerView: 1,
  loop: true,
  pagination: {
  el: '.swiper-pagination',
  clickable: true,
  },
  navigation: {
  nextEl: '.swiper-button-next',
  prevEl: '.swiper-button-prev'
  }
})

//убираем обновление страницы при клику на ссылки
document.querySelectorAll('.faq__item-link').forEach(el => {
  el.addEventListener('click', (event) => {
    event.preventDefault()
  })
});

//Accordion
document.querySelectorAll('.accordion').forEach(el => {
  el.addEventListener('click', () => {
    const content = el.nextElementSibling;
    if (content.style.maxHeight) {
      document.querySelectorAll('.accordion-content').forEach(el => el.style.maxHeight = null);
      document.querySelectorAll('.faq__item-svg').forEach(el => el.classList.remove('faq__item-svg-active'));
      el.childNodes[3].classList.remove('faq__item-svg-active');
      document.querySelectorAll('.faq__item-svg-ellipse').forEach(el => el.classList.remove('faq__item-svg-ellipse-active'));
      el.childNodes[3].childNodes[1].classList.remove('faq__item-svg-ellipse-active');
    } else {
      document.querySelectorAll('.accordion-content').forEach(el => el.style.maxHeight = null);
      content.style.maxHeight = content.scrollHeight + 'px';
      document.querySelectorAll('.faq__item-svg').forEach(el => el.classList.remove('faq__item-svg-active'));
      el.childNodes[3].classList.add('faq__item-svg-active');
      document.querySelectorAll('.faq__item-svg-ellipse').forEach(el => el.classList.remove('faq__item-svg-ellipse-active'));
      el.childNodes[3].childNodes[1].classList.add('faq__item-svg-ellipse-active');
    }
  })
})

//вешаем событие на бургер
document.querySelector('.menu-button').addEventListener('click', () => {
  document.querySelector('.menu').classList.toggle('menu-hidden');
})