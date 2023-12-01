btnAdd = document.getElementById("btn-add-pizza");
formAdd = document.getElementById("formulario-admin");

btnAdd.addEventListener("click", function () {
    formAdd.classList.toggle("hidden");
    window.location.href = "#formulario-admin";
});