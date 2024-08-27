<?php
class BancodeDados {
    private $host = "localhost";
    private $port = 3306; // Porta padrão para MySQL
    private $user = "root";
    private $senha = "prof@etec";
    private $banco = "supcom";
    public $con;

    function conecta() {
        $this->con = mysqli_connect($this->host, $this->user, $this->senha, $this->banco, $this->port);
        if(!$this->con){
            die("<script>alert('Problemas com a conexão!'); window.location.href='index.php'</script>");
        }
    }

    function fechar() {
        mysqli_close($this->con);
    }
}
?>