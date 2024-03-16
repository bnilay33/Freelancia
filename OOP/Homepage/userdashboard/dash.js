const body = document.querySelector("body"),

      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}




sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

//logout  profile

// variable
let modal = document.querySelector(".modal-container");
let btn = document.getElementById("lg");
let closeBtn = document.querySelectorAll(".btn");
// EventListener
btn.addEventListener("click", () => {
  modal.classList.add("show");
});

closeBtn.forEach((eachBtn) => {
  eachBtn.addEventListener("click", () => {
    modal.classList.remove("show");
  });
});

window.onclick = function (event) {
  if (event.target == modal) {
    modal.classList.remove("show");
  }
};



//dlt profile


// variable
let modal1 = document.querySelector(".modal-container1");
let btn1 = document.getElementById("dl");
let closeBtn1 = document.querySelectorAll(".btn1");

// EventListener
btn1.addEventListener("click", () => {
  modal1.classList.add("show");
});

closeBtn1.forEach((eachBtn1) => {
  eachBtn1.addEventListener("click", () => {
    modal1.classList.remove("show");
  });
});

window.onclick = function (event) {
  if (event.target == modal1) {
    modal1.classList.remove("show");
  }
};


