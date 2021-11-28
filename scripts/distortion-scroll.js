let speed = 0;

let elements = [...document.querySelectorAll('.n')];
window.addEventListener('scroll', (e) => {
    speed += e.deltaY * 0.0003;
})

document.querySelector('#footerCopyRight').innerHTML = `
<p class="text-sm font-semibold text-gray-600">
    © Burger Mafia &#8212; ${new Date().getFullYear()}
</p>
`