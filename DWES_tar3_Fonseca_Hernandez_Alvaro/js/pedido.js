let optionID = 1;
btnPedido = document.getElementById("pedido");
hidePedido = document.getElementById("hide-pedido");


function newPizza() {
  formPedido = document.getElementById("pizzas-a-pedir");

  let nuevoDiv = document.createElement("div");
  nuevoDiv.setAttribute("class", "pizzas-pedido");

  let nuevoSelect = document.createElement("select");
  nuevoSelect.setAttribute("name", "pizza[]");
  nuevoSelect.innerHTML = document.querySelector(".select-pizza").innerHTML;
  nuevoDiv.appendChild(nuevoSelect);

  let newLabel = document.createElement("label");
  newLabel.setAttribute("for", "pizza" + optionID);
  nuevoDiv.appendChild(newLabel);

  let newInput = document.createElement("input");
  newInput.setAttribute("type", "number");
  newInput.setAttribute("name", "pizza" + optionID);
  newInput.setAttribute("id", "pizza" + optionID);
  newInput.setAttribute("min", "1");
  newInput.setAttribute("name", "cantidades[]");
  newInput.setAttribute("placeholder", "Cantidad");
  newInput.setAttribute("value", "1");
  nuevoDiv.appendChild(newInput);

  let newButton = document.createElement("button");
  newButton.setAttribute("type", "button");
  newButton.setAttribute("class", "btn btn-danger");
  newButton.setAttribute("onclick", "deleteRow()");
  newButton.innerHTML = "X";
  nuevoDiv.appendChild(newButton);

  formPedido.appendChild(nuevoDiv);
}

function obtainPizzas() {
  let pizzas = [];
  let selectPizzas = document.getElementsByName("pizza[]");
  for (let i = 0; i < selectPizzas.length; i++) {
    pizzas.push(selectPizzas[i].value);
  }
  return pizzas;
}

function cancelar(){
  
  hidePedido.classList.toggle("hide");
  btnPedido.classList.toggle("hide");
}

function deleteRow() {
  let row = event.target.parentNode;
  row.parentNode.removeChild(row);
}

btnPedido.addEventListener("click", function () {
  hidePedido.classList.toggle("hide");
  btnPedido.classList.toggle("hide");
});
btnAddPizza = document.getElementById("add-pizza-pedido");
btnAddPizza.addEventListener("click", newPizza);
