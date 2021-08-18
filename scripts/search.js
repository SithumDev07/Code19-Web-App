const searchEl = document.querySelector('.search-pop')

const AllOptions = ["Dashboard", "Orders", "Deliveries", "Inventory", "Kitchen", "Suppliers", "Crew", "Settings"];
const requiredClasses = ["w-full", "h-12", "border-b", "border-gray-60", "p-2", "flex", "items-center", "justify-between"]

const svgIcon = document.querySelector('.exit-icon')

AllOptions.forEach((ele, index) => {
    const newButton = document.createElement("button");
    requiredClasses.forEach((element, indexClass) => {
        newButton.classList.add(`${requiredClasses[indexClass]}`);
    })
    const newContent = document.createTextNode(`${AllOptions[index]}`);
    newButton.appendChild(newContent)
    newButton.appendChild(svgIcon)
    searchEl.appendChild(newButton)
})


const searchInput = document.querySelector('.searchInputMain')

searchInput.addEventListener('keyup', (e) => {
    searchEl.classList.remove('hidden')
})