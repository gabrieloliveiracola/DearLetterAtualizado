<?php
require_once __DIR__ . "/../configs/BancoDados.php";

class Bilhete
{
    public static function cadastrar($idUser, $texto, $cor, $destinatario, $data, $hora)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO bilhete(idUser, texto, cor, destinatario, data, hora) VALUES (?,?,?,?,?,?)");
            $stmt->execute([$idUser, $texto, $cor, $destinatario, $data, $hora]);
            
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    
    public static function listarTodos(){
        try{
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("
                select * from bilhete order by data desc, hora desc;
            ");
            $sql->execute();
    
            return $sql->fetchAll();
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
    
    
        //Listar os bilhetes de um determinado destinatario
        public static function bilhetesDestinatario($destinatario){
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    SELECT * FROM bilhete WHERE destinatario = ? order by data desc, hora desc;
                ");
                $sql->execute([$destinatario]);
    
                return $sql->fetchAll();
            }catch(Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
        
    
        //Listar os bilhetes de um determinado usuario
        public static function bilhetesUsuario($idUser){
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    SELECT b.* FROM bilhete b, usuario u WHERE  u.idUser = ? and b.idUser = u.idUser order by data desc, hora desc;
                ");
                $sql->execute([$idUser]);
    
                return $sql->fetchAll();
            }catch(Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
    public static function deleteById($id, $idUser)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("DELETE FROM bilhete WHERE id = ? AND idUser = ?");
            $stmt->execute([$id, $idUser]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public static function removeById($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("DELETE FROM bilhete WHERE id = ?" );
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeBilhete($id){
        try{
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("
                select count(*) from bilhete where id = ?
            ");
            $sql->execute([$id]);

            if($sql->fetchColumn() > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function bilheteId($id){
        try {
            $conexao = Conexao::getConexao();
            $sql = $conexao->prepare("
                SELECT * FROM bilhete WHERE id = ?;
            ");
            $sql->execute([$id]);
    
            return $sql->fetchAll();
        }catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
