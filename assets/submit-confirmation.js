const submitId = document.getElementById("submit-cta");
const conf = document.getElementById("confirmation");
const cancel = document.getElementById("cancel-sub");

submitId.addEventListener("click", () => {
  conf.classList.add("conf-active");

  cancel.addEventListener("click", () => {
    conf.classList.remove("conf-active");
  });
});

conf.addEventListener("click", () => {
  console.log("clicked");
});
