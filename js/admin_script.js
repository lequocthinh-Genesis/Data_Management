let navbar = document.querySelector('.header .navbar');
let accountBox = document.querySelector('.header .account-box');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   accountBox.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   accountBox.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   accountBox.classList.remove('active');
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