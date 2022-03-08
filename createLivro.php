<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Cadastrar Usuário</title>
    <link rel="shortcut icon" href="img/favicon.ico">
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
    include_once "acao4.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
    $idL = isset($_GET['idL']) ? $_GET['idL'] : "";
    if ($idL > 0)
        $dados = buscarDados($idL);
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
   <a href="readLivro.php" class="cons">Consulta</a>
</br></br>
    <form method="post" action="acao4.php">
    <br>
    <div class="form-group">
        <label for="id">ID:</label><br>
           <input readonly name="idL" id="idL" type="text" value="<?php if ($acao == "editar") echo $dados['idL']; else echo 0;?>"><br>
        </div> 

        <div class="form-group">
        <label for="titulo">TÍTULO:</label><br>
           <input required=true  name="titulo" id="titulo" type="text" value="<?php if ($acao == "editar") echo $dados['titulo'];?>"><br>
        </div>

        <div class="form-group">
        <label for="genero">GÊNERO:</label><br>
           <input required=true name="genero" id="genero" type="text" value="<?php if ($acao == "editar") echo $dados['genero']; ?>"><br>
        </div> 

        <div class="form-group">
        <label for="anoPublicacao">Ano de Publicação:</label><br>
           <input required=true name="anoPublicacao" id="anoPublicacao" type="text" value="<?php if ($acao == "editar") echo $dados['anoPublicacao']; ?>"><br>
        </div>  

        <div class="form-group">
        <label for="autor">AUTOR:</label><br>
           <input required=true name="autor" id="autor" type="text" value="<?php if ($acao == "editar") echo $dados['autor'];?>"><br>
        </div>

        <div class="form-group">
        <label for="valor">VALOR:</label><br>
           <input required=true name="valor" id="valor" type="text" value="<?php if ($acao == "editar") echo $dados['valor'];?>"><br>
        </div>

        <div class="form-group">
        <label for="editora">EDITORA:</label><br>
           <input required=true name="idE" id="idE" type="text" value="<?php if ($acao == "editar") echo $dados['idE'];?>"><br>
        </div>
        <button name="acao" value="salvar" id="acao" type="submit" 
        onclick="return validaPagina();">
                Salvar
                </button>
    </form>
</body>
</html>