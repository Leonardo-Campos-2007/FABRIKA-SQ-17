<?php
include_once 'BANCO/banco.php';

class Cerigrafia
{
    public $id_cerigrafia;
    public $tamanho;
    public $cor;

    function __construct($tamanho, $cor)
    {
        $this->tamanho = $tamanho;
        $this->cor = $cor;
    }

    function inserir()
    {
        $banco = new Banco();
        $conn = $banco->conectar();
        try {
            $stmt = $conn->prepare("INSERT INTO cerigrafia (tamanho, cor) VALUES (:tamanho, :cor)");
            $stmt->bindParam(':tamanho', $this->tamanho);
            $stmt->bindParam(':cor', $this->cor);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $result = false;
        }

        $banco->fecharConexao();
        return $result;
    }

    function editar()
    {
        if (empty($this->id_cerigrafia)) {
            return false;
        }

        $banco = new Banco();
        $conn = $banco->conectar();

        try {
            $stmt = $conn->prepare("UPDATE cerigrafia SET tamanho = :tamanho, cor = :cor WHERE id_cerigrafia = :id_cerigrafia");
            $stmt->bindParam(':tamanho', $this->tamanho);
            $stmt->bindParam(':cor', $this->cor);
            $stmt->bindParam(':id_cerigrafia', $this->id_cerigrafia, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar cerigrafia: " . $e->getMessage();
            $result = false;
        }

        $banco->fecharConexao();
        return $result;
    }

    function deletar()
    {
        if (empty($this->id_cerigrafia)) {
            return false;
        }

        $banco = new Banco();
        $conn = $banco->conectar();

        try {
            $stmt = $conn->prepare("DELETE FROM cerigrafia WHERE id_cerigrafia = :id_cerigrafia");
            $stmt->bindParam(':id_cerigrafia', $this->id_cerigrafia, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao deletar cerigrafia: " . $e->getMessage();
            $result = false;
        }

        $banco->fecharConexao();
        return $result;
    }

    static function carregar($id_cerigrafia)
    {
        $banco = new Banco();
        $conn = $banco->conectar();

        try {
            $stmt = $conn->prepare("SELECT * FROM cerigrafia WHERE id_cerigrafia = :id_cerigrafia");
            $stmt->bindParam(':id_cerigrafia', $id_cerigrafia, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $cerigrafia = new Cerigrafia($data['tamanho'], $data['cor']);
                $cerigrafia->id_cerigrafia = $data['id_cerigrafia'];
                return $cerigrafia;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erro ao carregar cerigrafia: " . $e->getMessage();
            return null;
        } finally {
            $banco->fecharConexao();
        }
    }

    function getIdCerigrafia()
    {
        return $this->id_cerigrafia;
    }

    function setIdCerigrafia($id_cerigrafia)
    {
        $this->id_cerigrafia = $id_cerigrafia;
    }
}

?>
