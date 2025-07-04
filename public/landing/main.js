// import './style.css'
// import Swiper from 'swiper'
// import { Navigation, Pagination, Autoplay } from 'swiper/modules'
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';


// Initialize Swiper
const swiper = new Swiper('.swiper', {
  modules: [Navigation, Pagination, Autoplay],
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  effect: 'slide',
  speed: 800,
})
