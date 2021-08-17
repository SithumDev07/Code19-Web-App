const options = document.querySelectorAll('.option');
const slide = document.querySelector('.underline-slide');

options.forEach((ele, index) => {
    ele.addEventListener('click', () => {
      slide.style.left = 100/options.length*index + '%';
    })
})


const optionsDelivery = document.querySelectorAll('.option-delivery');
const slideDelivery = document.querySelector('.underline-slide-delivery');

optionsDelivery.forEach((ele, index) => {
    ele.addEventListener('click', () => {
      slideDelivery.style.left = 100/optionsDelivery.length*index + '%';
    })
}) 

const exportBtn = document.querySelector('#export');
const exported = document.querySelector('.exported');

exportBtn.addEventListener('click', () => {
  exported.classList.toggle('hidden')
  exported.classList.toggle('flex')
})

const exportDelivery = document.querySelector('#exportDelivery');
const exportedDelivery = document.querySelector('.exportedDelivery');

exportDelivery.addEventListener('click', () => {
  exportedDelivery.classList.toggle('hidden')
  exportedDelivery.classList.toggle('flex')
})

function getPosition(element) {
  var xPosition = 0;
  var yPosition = 0;

  while(element) {
      xPosition += (element.offsetLeft - element.scrollLeft + element.clientLeft);
      yPosition += (element.offsetTop - element.scrollTop + element.clientTop);
      element = element.offsetParent;
  }

  return { x: xPosition, y: yPosition };
}

const stickyContainer = document.querySelector('#stickyContainer');
const stickySearch = document.querySelector('#stickySearch');
const stickySearchDelivery = document.querySelector('#stickySearchDelivery');
const stickyContainerDelivery = document.querySelector('#stickyContainerDelivery');

// console.log(getPosition(stickySearchDelivery));

// stickyContainer.addEventListener('scroll', () => {
//   if(getPosition(stickySearch).y <= 128) {
//     stickySearch.querySelector('input').classList.add('bg-white');
//     stickySearch.querySelector('input').classList.add('shadow-xl');
//     stickySearch.querySelector('input').classList.remove('border');

//     stickySearch.querySelector('#filter').classList.remove('bg-transparent');
//     stickySearch.querySelector('#filter').classList.add('bg-black');
//     stickySearch.querySelector('#filter').classList.remove('text-gray-500');
//     stickySearch.querySelector('#filter').classList.add('text-gray-100');
//     stickySearch.querySelector('#filter').classList.add('shadow-xl');

//     exportBtn.classList.remove('bg-transparent');
//     exportBtn.classList.add('bg-black');
//     exportBtn.classList.remove('text-gray-500');
//     exportBtn.classList.add('text-gray-100');
//     exportBtn.classList.add('shadow-xl');

//   } else {
//     stickySearch.querySelector('input').classList.remove('bg-white');
//     stickySearch.querySelector('input').classList.remove('shadow-xl');
//     stickySearch.querySelector('input').classList.add('border');

//     stickySearch.querySelector('#filter').classList.add('bg-transparent');
//     stickySearch.querySelector('#filter').classList.remove('bg-black');
//     stickySearch.querySelector('#filter').classList.add('text-gray-500');
//     stickySearch.querySelector('#filter').classList.remove('text-gray-100');
//     stickySearch.querySelector('#filter').classList.remove('shadow-xl');

//     exportBtn.classList.add('bg-transparent');
//     exportBtn.classList.remove('bg-black');
//     exportBtn.classList.add('text-gray-500');
//     exportBtn.classList.remove('text-gray-100');
//     exportBtn.classList.remove('shadow-xl');
//   }
// })

stickyHandler(stickySearch, stickyContainer, 128, 'filter', 'export');
stickyHandler(stickySearchDelivery, stickyContainerDelivery, 128, 'filterDelivery', 'exportDelivery');


function stickyHandler(stickyParent, stickyContainer, topValue, filterButton, exportButton) {

  stickyContainer.addEventListener('scroll', () => {


    if(getPosition(stickyParent).y <= topValue) {
      stickyParent.querySelector('input').classList.add('bg-white');
      stickyParent.querySelector('input').classList.add('shadow-xl');
      stickyParent.querySelector('input').classList.remove('border');
  
      stickyParent.querySelector(`#${filterButton}`).classList.remove('bg-transparent');
      stickyParent.querySelector(`#${filterButton}`).classList.add('bg-black');
      stickyParent.querySelector(`#${filterButton}`).classList.remove('text-gray-500');
      stickyParent.querySelector(`#${filterButton}`).classList.add('text-gray-100');
      stickyParent.querySelector(`#${filterButton}`).classList.add('shadow-xl');

      stickyParent.querySelector(`#${exportButton}`).classList.remove('bg-transparent');
      stickyParent.querySelector(`#${exportButton}`).classList.add('bg-black');
      stickyParent.querySelector(`#${exportButton}`).classList.remove('text-gray-500');
      stickyParent.querySelector(`#${exportButton}`).classList.add('text-gray-100');
      stickyParent.querySelector(`#${exportButton}`).classList.add('shadow-xl');
  
  
    } else {
      stickyParent.querySelector('input').classList.remove('bg-white');
      stickyParent.querySelector('input').classList.remove('shadow-xl');
      stickyParent.querySelector('input').classList.add('border');
  
      stickyParent.querySelector(`#${filterButton}`).classList.add('bg-transparent');
      stickyParent.querySelector(`#${filterButton}`).classList.remove('bg-black');
      stickyParent.querySelector(`#${filterButton}`).classList.add('text-gray-500');
      stickyParent.querySelector(`#${filterButton}`).classList.remove('text-gray-100');
      stickyParent.querySelector(`#${filterButton}`).classList.remove('shadow-xl');

      stickyParent.querySelector(`#${exportButton}`).classList.add('bg-transparent');
      stickyParent.querySelector(`#${exportButton}`).classList.remove('bg-black');
      stickyParent.querySelector(`#${exportButton}`).classList.add('text-gray-500');
      stickyParent.querySelector(`#${exportButton}`).classList.remove('text-gray-100');
      stickyParent.querySelector(`#${exportButton}`).classList.remove('shadow-xl');
  
    }
  })
  
}

