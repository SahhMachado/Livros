<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cadastrar Editora</title>
    <script>
        function validaPagina(){
    		var objNome = document.getElementById("nome");
    		if (objNome.value == ""){
    			alert("Informe o nome");
    			objNome.focus();
    			return false;
    		}
    		return true;
    	} 
    </script>
    <?php
    include_once "acao2.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
    $idE = isset($_GET['idE']) ? $_GET['idE'] : "";
    if ($idE > 0)
        $dados = buscarDados($idE);
}
?>
<style>
   body{
      margin: 20px;
      background-color: lightcyan;
   }
   .cons{
      font-size: 20px;
      font-weight: bold;
   }
   input{
      background-color: lightblue;
   }
</style>
</head>
<body>
</br></br>
<a href="readEditora.php" class="cons">Consulta</a>
</br></br>
    <form method="post" action="acao2.php">
    <br>
    <div class="form-group">
        <label for="id">ID:</label><br>
           <input readonly name="idE" id="idE" type="text" value="<?php if ($acao == "editar") echo $dados['idE']; else echo 0;?>"><br>
        </div> 

        <div class="form-group">
        <label for="nome">NOME:</label><br>
           <input required=true  name="nome" id="nome" type="text" value="<?php if ($acao == "editar") echo $dados['nome'];?>"><br>
        </div>

        <div class="form-group">
        <label for="dataFundacao">DATA DE FUNDAÇÃO:</label><br>
           <input required=true name="dataFundacao" id="dataFundacao" type="text" value="<?php if ($acao == "editar") echo $dados['dataFundacao'];?>"><br>
        </div>
        <button name="acao" value="salvar" id="acao" type="submit" 
        onclick="return validaPagina();">
                Salvar
                </button>
    </form>
</body>
</html>