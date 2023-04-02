let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active')
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}

subImages = document.querySelectorAll('.update-recipe .image-container .sub-images img');
mainImage = document.querySelector('.update-recipe .image-container .main-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      let src = images.getAttribute('src');
      mainImage.src = src;
   }
});