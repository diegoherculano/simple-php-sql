<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        main {
            color: red;
        }
    </style>
</head>
<body>
    <form action="">
        Empresa:<input type="text" name="nomeEmpresa">
        Diretor:<input type="text" name="nomeDiretor">
        <input type="submit" value="Cadastrar">
        <br><br>
    </form>
    <?php
        require_once "banco.php";
        $empresas = $banco->query("select * from clientes");
        echo "Seu banco tem cadastrado $empresas->num_rows empresas.<br>";
        echo "<br>Empresas cadastradas:<br>";
        $nomeEmpresa = isset($_GET['nomeEmpresa']);
        $nomeDiretor = isset($_GET['nomeDiretor']);
        if($nomeDiretor){
            $nomeEmpresa = $_GET['nomeEmpresa'];
            $nomeDiretor = $_GET['nomeDiretor'];
            $cadastro = "insert into clientes (nomeEmpresa, nomeDiretor) values ('$nomeEmpresa', '$nomeDiretor')";
        }
        $passe = 1;
        while ($reg = $empresas->fetch_object()){
            echo "<br>Empresa: $reg->nomeEmpresa";
            echo "<br>Direitor: $reg->nomeDiretor<br>";
            if ($nomeEmpresa == $reg->nomeEmpresa){
                $passe = 0;
            }
        }
        if ($passe == 1){
            if(isset($_GET['nomeEmpresa'])){
                if ($banco->query($cadastro) === TRUE){
                    echo "Cadastro concluído!";
                } else {
                    echo "Erro: $cadastro <br> $banco->error";
                }
            }
        } else { 
            if (isset($_GET['nomeEmpresa'])){
                echo "Impossível cadastrar. Empresa já existente.";
            }
        }
    ?>
</body>
</html>