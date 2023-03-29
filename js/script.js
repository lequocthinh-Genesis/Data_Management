let userBox = document.querySelector('.user-box');
let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');
let videoBtn = document.querySelectorAll('.vid-btn');


document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
}


videoBtn.forEach(btn =>{
    btn.addEventListener('click', ()=>{
        document.querySelector('.controls .active').classList.remove('active');
        btn.classList.add('active');
        let src = btn.getAttribute('data-src');
        document.querySelector('#video-slider').src = src;
    });
});

menu.addEventListener('click', () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});


window.onscroll = () =>{
    userBox.classList.remove('active');
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}




function money() {
    var money = document.getElementsByClassName("product-money");
    var l = money.length;
    var i;
    for(i = 0 ; i < l ; i++){
        var t = parseFloat(money[i].innerHTML);
        money[i].innerHTML = t.toLocaleString('vi', {style : 'currency', currency : 'VND'});
    }

}

money();