<?php

class Aviamento {
    private $aviamento_id;
    private $tipo_aviamento;
    private $cor;
    private $peso_quantidade;
    private $composicao;

    function __construct($aviamento_id, $tipo_aviamento, $cor, $peso_quantidade, $composicao) {
        $this->aviamento_id = $aviamento_id;
        $this->tipo_aviamento = $tipo_aviamento;
        $this->cor = $cor;
        $this->peso_quantidade = $peso_quantidade;
        $this->composicao = $composicao;
    }

    // ----------- GETTERS -----------

    public function getAviamentoId() {
        return $this->aviamento_id;
    }

    public function getTipoAviamento() {
        return $this->tipo_aviamento;
    }

    public function getCor() {
        return $this->cor;
    }

    public function getPesoQuantidade() {
        return $this->peso_quantidade;
    }

    public function getComposicao() {
        return $this->composicao;
    }

    // ----------- SETTERS -----------

    public function setAviamentoId($aviamento_id) {
        $this->aviamento_id = $aviamento_id;
    }

    public function setTipoAviamento($tipo_aviamento) {
        $this->tipo_aviamento = $tipo_aviamento;
    }

    public function setCor($cor) {
        $this->cor = $cor;
    }

    public function setPesoQuantidade($peso_quantidade) {
        $this->peso_quantidade = $peso_quantidade;
    }

    public function setComposicao($composicao) {
        $this->composicao = $composicao;
    }

    public function inserirAviamento($conn) {
        try {
            $sql = "INSERT INTO aviamento (tipo_aviamento, cor, peso_quantidade, composicao) 
                    VALUES (:tipo_aviamento, :cor, :peso_quantidade, :composicao)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':tipo_aviamento', $this->tipo_aviamento);
            $stmt->bindParam(':cor', $this->cor);
            $stmt->bindParam(':peso_quantidade', $this->peso_quantidade);
            $stmt->bindParam(':composicao', $this->composicao);

            if ($stmt->execute()) {
                echo "✅ Aviamento cadastrado com sucesso!";
            } else {
                echo "❌ Erro ao cadastrar aviamento.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // ----------- DELETAR DO BANCO -----------
    public function deletarAviamento($conn) {
        try {
            if (empty($this->aviamento_id)) {
                echo "❌ ID do aviamento não informado.";
                return false;
            }

            $sql = "DELETE FROM aviamento WHERE aviamento_id = :aviamento_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':aviamento_id', $this->aviamento_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo "✅ Aviamento removido com sucesso!";
                    return true;
                } else {
                    echo "⚠️ Nenhum aviamento encontrado com o ID informado.";
                    return false;
                }
            } else {
                echo "❌ Erro ao deletar aviamento.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

}