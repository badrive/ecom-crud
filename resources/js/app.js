import './bootstrap';

let imgfile = document.querySelector("#imgfile");
let imgurl = document.querySelector("#imgurl");

let btnfile = document.querySelector("#btnfile");
let btnurl = document.querySelector("#btnurl");

btnurl.addEventListener('click', ()=> {
    imgurl.classList.remove("d-none")
    imgfile.classList.add("d-none")
    btnurl.classList.add("d-none")
    btnfile.classList.remove("d-none")
});

btnfile.addEventListener('click', ()=> {
    imgurl.classList.add("d-none")
    imgfile.classList.remove("d-none")
    btnurl.classList.remove("d-none")
    btnfile.classList.add("d-none")
});