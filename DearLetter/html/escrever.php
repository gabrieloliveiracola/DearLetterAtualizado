    <?php
    session_start();
    require_once "../model/Auditoria.php";
    require_once "../model/Bilhete.php";
    require_once "../model/Usuario.php";
    require_once "../configs/utils.php";
    require_once "../configs/methods.php";
        if (isMetodo("POST")) {
            if (parametrosValidos($_POST, ["texto","cor","destinatario"])) {
                // O idUser da mensagem é o valor que está armazenado na sessão
                $idUser = $_SESSION["idUser"];
                $texto = $_POST["texto"];
                $cor = $_POST["cor"];
                $destinatario = $_POST["destinatario"];
                date_default_timezone_set('America/Sao_Paulo');
                $data = date("Y-m-d");
                $hora = date('H:i:s');
    
                    if (Bilhete::cadastrar($idUser, $texto, $cor, $destinatario, $data, $hora)) {
                        echo"<div class='alert alert-success' role='alert'>
                            <h4 class='alert-heading'>Publicado!</h4>
                            <p>Seu Bilhete já se encontra na página inicial!.</p>
                        </div>";
            
                    } else {
                        echo"<p>cadastro não realizado</p>";
                    }
                } else {
                echo"<p>parametros não encontrados</p>";
            }
    
            // if (parametrosValidos($_POST, ["ip","user_agent"])) {
            //     echo "<p> estou entrando aqui!!! </p>";
            //     if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //         $ip = $_POST[ip];
            //         // $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            //         // echo "<p> $ip </p>";
            //     } else {
            //         $ip = $_SERVER['REMOTE_ADDR'];
            //         echo "<p> $ip </p>";
            //     }
            //     $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
            //     $idUser = $_SESSION["idUser"];
    
            //     date_default_timezone_set('America/Sao_Paulo');
            //     $data = date("Y-m-d");
    
            //     $hora = date('H:i:s');
            //     Auditoria::cadastrarAuditoria($ip, $user_agent, $idUser, $data, $hora);
    
            // }else{
            //     echo "parametros invalidos!!!!!";
            // }
        }

        require_once "../html/verificadorLogin.php";
    ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/escrever.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/icon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> 
    <title>Dear Letter</title>
</head>
<body style="background-color: #EAECF1;">
    <header>
        <nav class="navbar navbar-light bg-faded" style="background-color: #98B1ED;">
            <div class="container-fluid">
                <div id="logo">
                    <a class="navbar-brand" href="./index.php">
                        <img src="../img/logo.png" alt="" width="50px">
                    </a>
                </div>
                <div id="nome">
                    <h1 style="font-family: 'Courier New', Courier, monospace; margin: auto; margin-left: 110px;">Dear Letter</h1>
                </div>
                <div id="buttons">
                    <div id="home">
                        <a href="./index.php"><img src="../img/casa (2).png" alt="" width="40px"></a>
                    </div>
                    <div id="escrever">
                        <a href="#"><img src="../img/pena (1).png" alt="" width="40px"></a>
                    </div>
                    <div id="perfil">
                        <div class="dropdown">
                            <a data-bs-toggle="dropdown" aria-expanded="false" href=""><img src="../img/do-utilizador.png" alt="" width="40px"></a>
                                    <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton" style="left: auto; right: 0;">
                                        <li><a class="dropdown-item text-primary" href="./perfil.php">Meu Perfil</a></li>
                                        <li><a class="dropdown-item text-danger" href="logout.php">Log-out</a></li>
                                    </ul>
                        </div>
                    </div>
                </div> 
            </div>
          </nav>
        </header>

    <div id="content">
        <div id="col-middle">
            <br><br>
            <h2><b>Destinatário:</b></h2>
            <p>Para quem a sua mensagem <br> é destinada?</p>
            <form action="" method="POST">
            
            <!-- input do destinatario -->
            <input type="text" name="destinatario" id="destinatario">
            <br>
            <h2><b>Mensagem:</b></h2>
            <p>Sua mensagem deve possuir até <br>100 caracteres</p>
            <div id="color-card" style="background-color: #a89f9f;" >
                    <div id="options">
                        <img src="../img/pontos.png" alt="" width="30px">
                    </div>
                    <div id="white-card" style="background-color: white;">
                        <!-- input da mensagem -->
                        <textarea name="texto" id="msg" maxlength="100" cols="30" rows="10"></textarea>
                    </div>
                    <div id="dest" style="margin: auto;" class="text-center">
                        <br><br><br>
                    </div>
                </div>
                <h2><b>Cor:</b></h2>
                <!-- input da cor -->
                <input type="color" name="cor" id="cor">
                <br>
                <button id="button" name="enviar" type="submit"><b>Publicar</b></button>
            </form>
        </div>
        <div id="col-left">
            <img src="../img/img1-removebg-preview.png" alt="" width="450px">
        </div>
        <div id="col-right">
            <img src="../img//img2-removebg-preview.png" alt="" width="450px" >
        </div>
    </div>
    
    <footer>
        
    </footer>
</body>
</html>