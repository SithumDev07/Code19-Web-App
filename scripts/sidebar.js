const dashboardSide = document.querySelector('#dashboardSide');
const ordersSide = document.querySelector('#ordersSide');

const dashboard = document.querySelector('.dashboard');

ordersSide.addEventListener('click', () => {
    dashboard.classList.remove('z-4')
    dashboard.classList.add('z-3')
})