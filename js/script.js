// Obtén los elementos del DOM
const popup = document.getElementById("popup");
const openPopupBtn = document.getElementById("openPopup");
const closePopupBtn = document.getElementById("closePopup");

// Abre la ventana emergente cuando el usuario haga clic en el botón
openPopupBtn.onclick = function() {
    popup.style.display = "block"; // Muestra la ventana emergente
}

// Cierra la ventana emergente cuando el usuario haga clic en el botón de cerrar
closePopupBtn.onclick = function() {
    popup.style.display = "none"; // Oculta la ventana emergente
}

// Cierra la ventana emergente si el usuario hace clic fuera de ella
window.onclick = function(event) {
    if (event.target === popup) {
        popup.style.display = "none"; // Oculta la ventana emergente si se hace clic fuera
    }
}
