// document.addEventListener("DOMContentLoaded", function() {
//     const banner = document.querySelector(".movie-banner");
//     const images = document.querySelectorAll(".movie-banner img");
//     let currentIndex = 0;

//     function nextImage() {
//         images[currentIndex].style.left = "-100%";
//         currentIndex = (currentIndex + 1) % images.length;
//         images[currentIndex].style.left = "0";
//     }

//     // Initial setup
//     images[currentIndex].style.left = "0";
//     setInterval(nextImage, 3000); // Change image every 3 seconds
// });

//Login pop-up form 
function openLoginForm() {
  document.getElementById("myFormlogin").style.display = "block";
}

function closeLoginForm() {
  document.getElementById("myFormlogin").style.display = "none";
}

function openLogoutForm() {
  document.getElementById("myFormlogout").style.display = "block";
}

function closeLogoutForm() {
  document.getElementById("myFormlogout").style.display = "none";
}



//Movie Carousell
let slideIndex = 1;
showSlides(slideIndex);

const slideInterval = 3000; // 5000 milliseconds (5 seconds)
let autoSlide;

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

// Start the automatic slideshow
function startAutoSlide() {
  autoSlide = setInterval(function () {
    plusSlides(1); // Change to the next slide
  }, slideInterval);
}

// Stop the automatic slideshow (e.g., when user interacts with manual navigation)
function stopAutoSlide() {
  clearInterval(autoSlide);
}

// Initialize the automatic slideshow
startAutoSlide();

