// Responsive sidebar nav Starts
const menu = document.getElementById("menu");
const dashboard = document.getElementById("dashboard");
const footer = document.getElementById("footer");
const nav = document.querySelector(".sidebar");
const navLinks = document.querySelectorAll(".nav-links li");

menu.addEventListener("click", () => {
  nav.classList.toggle("nav-active");
  dashboard.classList.toggle("nav-active");
  footer.classList.toggle("nav-active");
});
// Responsive sidebar nav Ends

// Active Menu
const activePage = window.location.pathname;
const navigationLinks = document.querySelectorAll("nav a").forEach((link) => {
  if (link.href.includes(`${activePage}`)) {
    link.classList.add("active");
  }
});

// Active Menu

// Chat
// const chat = document.getElementById("chat");
// const chatPanel = document.querySelector(".chat-panel");
// const chatBtn = document.querySelector(".chat-btn");

// chat.addEventListener("click", () => {
//   chatPanel.classList.toggle("chat-active");
//   chatBtn.classList.toggle("chat-btn-active");
// });

// Chat

// const deleteModal = () => {
//   const modal = document.getElementById("deletemodal");
//   const deleteBtn = document.getElementById("deletebtn");
//   const span = document.getElementsByClassName("close")[0];

//   deleteBtn.onclick = function () {
//     modal.style.display = "flex";
//   };

//   span.onclick = function () {
//     modal.style.display = "none";
//   };

//   window.onclick = function (event) {
//     if (event.target == modal) {
//       modal.style.display = "none";
//     }
//   };
// };

// const app = () => {
//   deleteModal();
// };

// app();

// const kkk = console.log(123);

// console.log(kkk);
