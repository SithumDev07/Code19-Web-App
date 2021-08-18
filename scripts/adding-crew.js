const recuitEmployee = document.querySelector('#recuitEmployee');

let toggleText = true;
recuitEmployee.addEventListener('click', () => {
    console.log('Working');
    document.querySelector('.transformin-icon').classList.toggle('translate-icon');
    if(toggleText) {
        document.querySelector('.change-text-crew').innerHTML = "Cancel";
    } else {
        document.querySelector('.change-text-crew').innerHTML = "Recruit Employee";
    }
    toggleText = !toggleText;
    document.querySelector('.add-crew-form').classList.toggle('hidden');
    document.querySelector('.add-crew-form').classList.toggle('flex');
})