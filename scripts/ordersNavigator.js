
const options = document.querySelectorAll('.option');
const slide = document.querySelector('.underline-slide');

const optionsDelivery = document.querySelectorAll('.option-delivery');
const slideDelivery = document.querySelector('.underline-slide-delivery');

const optionsCrew = document.querySelectorAll('.option-crew');
const slideCrew = document.querySelector('.underline-slide-crew');


const optionsSettings = document.querySelectorAll('.option-settings');
const slideSettings = document.querySelector('.underline-slide-settings');
    
tabNavigator(optionsCrew, slideCrew, 0);
tabNavigator(optionsDelivery, slideDelivery, 0);
tabNavigator(options, slide, 0);
tabNavigator(optionsSettings, slideSettings, 0);
    
let previous = 0;
function tabNavigator(options, slide, start) {
    options.forEach((ele, index) => {
      ele.addEventListener('click', () => {
        if(start == 0) {
          options[0].classList.remove('text-yellow-500')
          options[0].classList.add('text-gray-500')
          options[0].classList.remove('font-bold')
          ele.classList.remove('text-gray-500');
          ele.classList.add('text-yellow-500');
          ele.classList.add('font-bold');
          slide.style.left = 100/options.length*index + '%';
          previous = index;
          start = 1
        } else {
          options[previous].classList.remove('text-yellow-500')
          options[previous].classList.add('text-gray-500')
          options[previous].classList.remove('font-bold')
          ele.classList.remove('text-gray-500');
          ele.classList.add('text-yellow-500');
          ele.classList.add('font-bold');
          slide.style.left = 100/options.length*index + '%';
          previous = index;
          start = 1
        }
      })
    }) 

}

const optionsAside = document.querySelectorAll('.option-aside');
const slideAside = document.querySelector('.slide-aside');

sideNavigator(optionsAside, slideAside)

let previousSide = 0;
function sideNavigator(options, slide) {
  options.forEach((ele, index) => {
    ele.addEventListener('click', () => {
      slide.style.top = 100/options.length*index + '%';
      previousSide = index;
    })
}) 
}

// Export Area

const exportBtn = document.querySelector('#export');
const exported = document.querySelector('.exported');

const exportDelivery = document.querySelector('#exportDelivery');
const exportedDelivery = document.querySelector('.exportedDelivery');

const exportInventory = document.querySelector('#exportInventory');
const exportedInventory = document.querySelector('.exportedInventory');

const exportKitchen = document.querySelector('#exportKitchen');
const exportedKitchen = document.querySelector('.exportedKitchen');

const exportSuppliers = document.querySelector('#exportSuppliers');
const exportedSuppliers = document.querySelector('.exportedSuppliers');

const exportCrew = document.querySelector('#exportCrew');
const exportedCrew = document.querySelector('.exportedCrew');


exportDropDown(exportInventory, exportedInventory);
exportDropDown(exportDelivery, exportedDelivery);
exportDropDown(exportBtn, exported);
exportDropDown(exportKitchen, exportedKitchen);
exportDropDown(exportSuppliers, exportedSuppliers);
exportDropDown(exportCrew, exportedCrew);


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
const stickySearchKitchen = document.querySelector('#stickySearchKitchen');
const stickyContainerKitchen = document.querySelector('#stickyContainerKitchen');
const stickySearchSuppliers = document.querySelector('#stickySearchSuppliers');
const stickyContainerSuppliers = document.querySelector('#stickyContainerSuppliers');
const stickySearchCrew = document.querySelector('#stickySearchCrew');
const stickyContainerCrew = document.querySelector('#stickyContainerCrew');


const topValue = getPosition(stickySearch).y;

stickyHandler(stickySearch, stickyContainer, 'filter', 'export');
stickyHandler(stickySearchDelivery, stickyContainerDelivery, 'filterDelivery', 'exportDelivery');
stickyHandler(stickySearchInventory, stickyContainerInventory, 'filterInventory', 'exportInventory');
stickyHandler(stickySearchKitchen, stickyContainerKitchen, 'filterKitchen', 'exportKitchen');
stickyHandler(stickySearchSuppliers, stickyContainerSuppliers, 'filterSuppliers', 'exportSuppliers');
stickyHandler(stickySearchCrew, stickyContainerCrew, 'filterCrew', 'exportCrew');



function stickyHandler(stickyParent, stickyContainer, filterButton, exportButton) {
  
  stickyContainer.addEventListener('scroll', () => {
    
    // console.log(topValue, " ", getPosition(stickyParent).y);

    if(getPosition(stickyParent).y + topValue/4 < topValue) {
      stickyParent.querySelector('input').classList.add('bg-white');
      stickyParent.querySelector('input').classList.add('bg-opacity-90');
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
      stickyParent.querySelector('input').classList.remove('bg-opacity-90');
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

