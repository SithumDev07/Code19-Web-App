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

// exportBtn.addEventListener('click', () => {
//   exported.classList.toggle('hidden')
//   exported.classList.toggle('flex')
// })

const exportDelivery = document.querySelector('#exportDelivery');
const exportedDelivery = document.querySelector('.exportedDelivery');

const exportInventory = document.querySelector('#exportInventory');
const exportedInventory = document.querySelector('.exportedInventory');

// exportDelivery.addEventListener('click', () => {
//   exportedDelivery.classList.toggle('hidden')
//   exportedDelivery.classList.toggle('flex')
// })

exportDropDown(exportInventory, exportedInventory);
exportDropDown(exportDelivery, exportedDelivery);
exportDropDown(exportBtn, exported);


function exportDropDown(button, menu) {
  button.addEventListener('click', () => {
    menu.classList.toggle('hidden')
    menu.classList.toggle('flex')
  })
}


// Sticky Controllers

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
const stickySearchInventory = document.querySelector('#stickySearchInventory');
const stickyContainerInventory = document.querySelector('#stickyContainerInventory');


stickyHandler(stickySearch, stickyContainer, 128, 'filter', 'export');
stickyHandler(stickySearchDelivery, stickyContainerDelivery, 128, 'filterDelivery', 'exportDelivery');
stickyHandler(stickySearchInventory, stickyContainerInventory, 128, 'filterInventory', 'exportInventory');


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

