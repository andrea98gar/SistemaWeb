function comprobardatos(){
    var nombre = document.getElementById("nombre").value;

    window.alert(nombre );
  }

  function comprobarBD(){
    var username = document.forms["identificacion"].username.value;
    var password = document.forms["identificacion"].pass.value;
    alert("username");
  }

  function cerrarSesion(){


    window.location="index.php";


  }
