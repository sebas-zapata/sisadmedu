const btnScrollTop = document.getElementById("btnScrollTop");

// Mostrar el botón cuando se baja cierta cantidad
window.addEventListener("scroll", () => {
  if (window.scrollY > 150) {
    btnScrollTop.style.display = "block";
  } else {
    btnScrollTop.style.display = "none";
  }
});

// Al hacer clic, hacer scroll suave hacia arriba
btnScrollTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});
