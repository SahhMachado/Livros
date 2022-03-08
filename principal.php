<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Bem vindo(a)!";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <style> 
    body{
        background-color: lightcyan;
    }
    div{
        background-color: lightblue;
        padding: 30px;
        font-size: 20px;
        font-weight: bold;
        border-radius: 100px; 
    }
    div:hover{
        background-color: #ccffe6;
    }
    a{
        text-decoration: none;
    }
    .icones{
        display: table-cell;
        float: right;
        width: 25px;
        margin-left: 40px;
    }
    h2{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color:  #0d6efd;
    }
    </style>
</head>
<body>
    <br><br>
    <center><h2>Seja bem vindo(a)! <br> Selecione abaixo a opção desejada.</h2></center>
    <br><br>
    <div>
        <a href="createUsuario.php" class="nav">Cadastrar Usuário 
            <img src="img/addUsuario.svg" alt="" class="icones"></a>
    </div>
    <br>
    <div>
        <a href="createEditora.php" class="nav">Cadastrar Editora
            <img src="img/edit.svg" alt="" class="icones"></a>
    </div>
    <br>
    <div>
        <a href="createLivro.php" class="nav">Cadastrar Livro
            <img src="img/addLivro.svg" alt="" class="icones"></a>
    </div>
    <br>
    <div>
        <a href="createCompra.php" class="nav">Cadastrar Compra
            <img src="img/addCompra.svg" alt="" class="icones"></a>
        </div>
    <br>
    <div>
        <a href="readEditora.php" class="nav">Editoras
            <img src="img/editora.svg" alt="" class="icones"></a>
    </div>
    <br>
    <div>
        <a href="readUsuario.php" class="nav">Usuários
            <img src="img/usuarios.svg" alt="" class="icones"></a>
    </div>
    <br>
    <div>
        <a href="readLivro.php" class="nav">Livros
            <img src="img/livros.svg" alt="" class="icones"></a>
    </div>
    <br>
    <div>
        <a href="readCompra.php" class="nav">Compras
            <img src="img/compras.svg" alt="" class="icones"></a>
    </div>
    <br>
    <br>
</body>
</html>