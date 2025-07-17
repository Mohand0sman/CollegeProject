let links = document.querySelectorAll('.nav-link');

links.forEach((link) => {
    link.onclick = function () {
        links.forEach((l) => {
            l.classList.remove('active');
        })
        this.classList.add('active');
    }
})

window.onscroll = function () {
    if (scrollY < 500) {
        links.forEach((item) => {
            item.classList.remove(`active`);
        })
        links[0].classList.add(`active`)
    } else if (scrollY > 500 && scrollY < 1136) {
        links.forEach((item) => {
            item.classList.remove(`active`);
        })
        links[1].classList.add(`active`)
    } else if (scrollY > 1136 && scrollY < 2751) {
        links.forEach((item) => {
            item.classList.remove(`active`);
        })
        links[2].classList.add(`active`)
    } else if (scrollY > 2700 && scrollY < 3250) {
        links.forEach((item) => {
            item.classList.remove(`active`);
        })
        links[3].classList.add(`active`)
    } else if (scrollY > 3250) {
        links.forEach((item) => {
            item.classList.remove(`active`);
        })
        links[4].classList.add(`active`)
    }  
}
