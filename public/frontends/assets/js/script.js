const menuMore = document.querySelector('.menu-more');
const nav = document.querySelector('.nav-full.bg-wrap');
menuMore.addEventListener('click', function () {
  nav.classList.toggle('show');
  menuMore.classList.toggle('show');
});
document.addEventListener("DOMContentLoaded", function () {
  const menuBtn = document.getElementById("menuShow");
  const menuWrap = document.getElementById("menuWrapMobile");
  const closeBtn = document.getElementById("menuCloseMobile");

  // Mở menu
  menuBtn.addEventListener("click", () => {
    menuWrap.classList.add("active");
  });

  // Đóng menu
  closeBtn.addEventListener("click", () => {
    menuWrap.classList.remove("active");
  });

});




