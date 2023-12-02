btnAdd = document.getElementById("btn-add-pizza");
formAdd = document.getElementById("formulario-admin");

// Obtener la tabla y sus filas
const tabla = document.getElementById("tabla-pizzas");
const filas = tabla.getElementsByTagName("tr");

// Recorrer las filas y agregar un evento click a cada una
const botonesEditar = document.querySelectorAll(".editarBtn");

// Asignar un evento de clic a cada botón
botonesEditar.forEach(function (boton) {
  boton.addEventListener("click", function () {
    document.getElementById("form-btn").innerText = "Guardar Cambios";
    document.getElementById("form-btn").classList.add("btn-edit");
    // Obtener la fila actual
    var fila = this.closest("tr");

    // Obtener datos de la fila
    let id = fila.cells[0].textContent;
    let nombre = fila.cells[1].textContent;
    let ingredientes = fila.cells[2].textContent;
    let coste = fila.cells[3].textContent;
    let precio = fila.cells[4].textContent;

    // Llenar el formulario con los datos
    document.getElementById("id").value = id;
    document.getElementById("nombre").value = nombre;
    document.getElementById("coste").value = coste;
    document.getElementById("precio").value = precio;
    document.getElementById("ingredientes").value = ingredientes;
    document.getElementById("accion").value = "edit";
    console.log(document.getElementById("accion").value);

    // Mostrar el formulario
    formAdd.classList.remove("hidden");
  });
});

btnAdd.addEventListener("click", function () {
  clearForm();
  document.getElementById("form-btn").innerText = "Añadir";
  document.getElementById("form-btn").classList.remove("btn-edit");
  formAdd.classList.remove("hidden");
  window.location.href = "#formulario-admin";
});

function cancelarFormulario() {
  formAdd.classList.add("hidden");
  clearForm();
}

function clearForm() {
  //Ponemos los valores del formulario a vacio
  document.getElementById("id").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("coste").value = "";
  document.getElementById("precio").value = "";
  document.getElementById("ingredientes").value = "";
  document.getElementById("accion").value = "add";
}
