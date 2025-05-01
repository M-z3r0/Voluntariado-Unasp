/* Modal de doações */
const modal = document.getElementById("donationModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
openModalBtn.onclick = function() {
    modal.style.display = "block";
}
closeModalBtn.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

/* */