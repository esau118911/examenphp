<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Cálculo de Intereses Compuestos</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
  </head>
  <body>

<div class="container-fluid">
  <div class="row">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2 class="mt-5">Cálculo de Intereses Compuestos</h2>
      <form>
        <div class="mb-3">
          <label class="form-label">Principal</label>
          <input type="text" id="principal" min="0" value="0" class="form-control" placeholder="Principal"  aria-describedby="Principal">

        </div>
        <div class="mb-3">
          <label class="form-label">Tasa Anual</label>
          <input type="number" id="tasa_anual" min="0" value="0" step="any" class="form-control" placeholder="Tasa Anual" >
        </div>
        <div class="mb-3">
          <label class="form-label">Periódos</label>
          <input type="number" id="periodos"  min="0" value="0"  class="form-control" placeholder="Tasa Anual" >
        </div>
        <div class="mb-3">
          <label  class="form-label">Monto Total</label>
          <input type="number" id="monto_total"    class="form-control" placeholder="Monto Total" >
        </div>
      </form>
      <button id="calcular"  class="btn btn-primary">Calcular</button>
     <h2 class="mt-4">Integration API Chuck Norris</h2>
     <button id="consultar"  class="btn btn-primary">Consultar Proxy</button>
     <div class="card mt-3" style="width: 18rem;">
       
        <div class="card-body">
          <h5 class="card-title" id="titulo">Presiona el Botón</h5>
          <p class="card-text" id="descripcion"></p>

        </div>
      </div>
    </main>
    
  </div>

</div>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script>

  //FUNCIONALIDAD PARA CONSUMIR SERVICIO DE CALCULO DE INTERESES COMPUESTO
 let btnCalcular = document.getElementById("calcular"); 
 let btnConsultar = document.getElementById("consultar"); 
 let inputPrincipal = document.getElementById('principal');
 let inputTasa_anual = document.getElementById('tasa_anual');
 let inputPeriodos = document.getElementById('periodos');
 let inputMonto = document.getElementById('monto_total');

 let labelTitulo = document.getElementById('titulo');
 let labelDescripcion = document.getElementById('descripcion');

 btnCalcular.addEventListener("click", () => {
      let datos = {
      principal:  inputPrincipal.value ,
      tasa_anual: inputTasa_anual.value, 
      periodos:   inputPeriodos.value
    }
   
    fetch('http://localhost/calcular-intereses', {
    method: "POST",
    body: JSON.stringify(datos),
    headers: {
      "Content-type": "application/json;charset=UTF-8",
      "Authorization" : "7c985b51b09d1b3f3816c12dc7b3a791",
      "Access-Control-Allow-Origin" : "*"}
    })
    .then(response => response.json()) 
    .then(function(json){
      inputMonto.value=json.monto_total;
    })
    .catch(err => console.log(err));

});

//FUNCIONALIDAD DE PROXY
btnConsultar.addEventListener("click", () => {
   
    fetch('http://localhost/Chuck-norris', {
    method: "GET",
    headers: {
      "Content-type": "application/json;charset=UTF-8",
      "Authorization" : "7c985b51b09d1b3f3816c12dc7b3a791",
      "Access-Control-Allow-Origin" : "*"}
    })
    .then(response => response.json()) 
    .then(function(json){
      let newLabel = document.createElement('label');
      let newLabel2 = document.createElement('label');
      newLabel.innerHTML =json.created_at;
      newLabel2.innerHTML =json.value;
      labelTitulo.appendChild(newLabel);
      labelDescripcion.appendChild(newLabel2);
     
    })
    .catch(err => console.log(err));

});
</script>
</body>
</html>
