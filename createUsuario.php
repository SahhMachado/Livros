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
    include_once "acao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
    $idU = isset($_GET['idU']) ? $_GET['idU'] : "";
    if ($idU > 0)
        $dados = buscarDados($idU);
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
   <a href="readUsuario.php" class="cons">Consulta</a>
</br></br>
    <form method="post" action="acao.php">
    <br>
    <div class="form-group">
        <label for="id">ID:</label><br>
           <input readonly name="idU" id="idU" type="text" value="<?php if ($acao == "editar") echo $dados['idU']; else echo 0;?>"><br>
        </div> 

        <div class="form-group">
        <label for="nome">NOME:</label><br>
           <input required=true  name="nome" id="nome" type="text" value="<?php if ($acao == "editar") echo $dados['nome'];?>"><br>
        </div>

        <div class="form-group">
        <label for="dataNascimento">DATA DE NASCIMENTO:</label><br>
           <input required=true name="dataNascimento" id="dataNascimento" type="text" value="<?php if ($acao == "editar") echo $dados['dataNascimento']; ?>"><br>
        </div> 

        <div class="form-group">
        <label for="email">EMAIL:</label><br>
           <input required=true name="email" id="email" type="text" value="<?php if ($acao == "editar") echo $dados['email']; ?>"><br>
        </div> 

        <div class="form-group">
        <label for="senha">SENHA:</label><br>
           <input required=true name="senha" id="senha" type="text" value="<?php if ($acao == "editar") echo $dados['senha']; ?>"><br>
        </div> 

        <div class="form-group">
        <label for="telefone">TELEFONE:</label><br>
           <input required=true name="telefone" id="telefone" type="text" value="<?php if ($acao == "editar") echo $dados['telefone'];?>"><br>
        </div>
        <button name="acao" value="salvar" id="acao" type="submit" 
        onclick="return validaPagina();">
                Salvar
                </button>
    </form>
</body>
</html>