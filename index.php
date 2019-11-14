<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro Simples</title>
</head>
<body>
    <form action="">
        Nome da empresa: <input type="text" name="nomeEmpresa">
        Nome do Dono: <input type="text" name="nomeDono">
        <input type="submit" value="Cadastrar">
    </form>
    <br>
    <?php
        $banco = mysqli_connect("localhost", "root", "", "dadosempresas");
        if (mysqli_connect_errno($banco)){
            echo "Erro ao conectar ao Banco de dados." . mysqli_connect_error();
        }

        if (isset($_GET['nomeEmpresa'])){
            $nomeEmpresa = $_GET['nomeEmpresa'];
            $nomeDono = $_GET['nomeDono'];            
        } 

        $passe = 1;
       
        $query = $banco->query("select * from clientes");
        echo "Há um total de " . $query->num_rows . " empresas cadastradas.<br><br>";
        while ($row = $query->fetch_assoc()){
            if (isset($_GET['nomeEmpresa'])){
                if($_GET['nomeEmpresa'] == $row['nomeEmpresa']){
                    $passe = 0;
                }
            }
            echo "Nome da empresa: " . $row['nomeEmpresa'] . "<br>";
            echo "Nome do dono: " . $row['nomeDono'] . "<br><br>";
        }     

        if(isset($_GET['nomeEmpresa'])){
            if ($passe == 1){
                $banco->query("insert into clientes (nomeEmpresa, nomeDono) values ('$nomeEmpresa', '$nomeDono')");
                echo "Você cadastrou $nomeEmpresa e $nomeDono. <br><br>";
                
            } else {
                echo "Impossível cadastrar $nomeEmpresa, já existe! <br><br>";
            }
        }
        
        
    ?>
    <a href="http://localhost/php/">Atualizar</a>
</body>
</html>