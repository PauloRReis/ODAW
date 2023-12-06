<!DOCTYPE HTML>
<html>  
<body>
<style>
.error {color: #FF0000;}
</style>

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    
</html>
<body>
  <button id="add">Add 5 + 3</button>
  <div id="result"></div>
  <script>
    let btn = document.getElementById("add");
    let x = 5;
    let y = 3;

    btn.addEventListener("click", function(){
      fetch("http://localhost/Trabalho02/add_teste_func.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: `x=${x}&y=${y}`,
      })
      .then((response) => response.text())
      .then((res) => (document.getElementById("result").innerHTML = res));
    })
  </script>
</body>
</html>