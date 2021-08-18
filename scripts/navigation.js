const sideBarNaviationLinks = document.querySelectorAll('.option-aside');

const sections = ["Dashboard", "Orders", "Deliveries", "Inventory", "Kitchen", "Suppliers", "Crew", "Settings"];

let previousSection = 0;

sideBarNaviationLinks.forEach((ele, index) => {
    ele.addEventListener('click', () => {
        document.querySelector(`.${sections[previousSection]}`).classList.remove('z-base');
        document.querySelector(`.${sections[previousSection]}`).classList.remove('overflow-y-auto');
        document.querySelector(`.${sections[previousSection]}`).classList.remove('overflow-hidden');
        document.querySelector(`.${sections[index]}`).classList.add('z-base');
        document.querySelector(`.${sections[index]}`).classList.add('overflow-y-auto');
        document.querySelector(`.${sections[index]}`).classList.remove('overflow-hidden');
        previousSection = index;
    })
})