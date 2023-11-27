btnPedido = document.getElementById("pedido");
formPedido = document.getElementById("form-pedido");
btnPedido.addEventListener("click", function () {
  formPedido.classList.toggle("hide");
  btnPedido.classList.toggle("hide");
});
