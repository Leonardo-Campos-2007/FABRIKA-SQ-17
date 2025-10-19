<?php

class Beneficiamento {

    private $beneficiamento_id;
    private $digital;
    private $bordado;
    private $sublimacao;
    private $serigrafia;

    function __construct($beneficiamento_id, $digital, $bordado, $sublimacao, $serigrafia) {
        $this->beneficiamento_id = $beneficiamento_id;
        $this->digital = $digital;
        $this->bordado = $bordado;
        $this->sublimacao = $sublimacao;
        $this->serigrafia = $serigrafia;
    }

    // ----------- GETTERS -----------

    public function getBeneficiamentoId() {
        return $this->beneficiamento_id;
    }

    public function getDigital() {
        return $this->digital;
    }

    public function getBordado() {
        return $this->bordado;
    }

    public function getSublimacao() {
        return $this->sublimacao;
    }

    public function getSerigrafia() {
        return $this->serigrafia;
    }
    // ----------- SETTERS -----------

    public function setBeneficiamentoId($beneficiamento_id) {
        $this->beneficiamento_id = $beneficiamento_id;
    }

    public function setDigital($digital) {
        $this->digital = $digital;
    }

    public function setBordado($bordado) {
        $this->bordado = $bordado;
    }

    public function setSublimacao($sublimacao) {
        $this->sublimacao = $sublimacao;
    }

    public function setSerigrafia($serigrafia) {
        $this->serigrafia = $serigrafia;
    }

    public function inserirBeneficiamento($conn) {
        try {
            $sql = "INSERT INTO beneficiamento (digital, bordado, sublimacao, serigrafia) 
                    VALUES (:digital, :bordado, :sublimacao, :serigrafia)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':digital', $this->digital);
            $stmt->bindParam(':bordado', $this->bordado);
            $stmt->bindParam(':sublimacao', $this->sublimacao);
            $stmt->bindParam(':serigrafia', $this->serigrafia);

            if ($stmt->execute()) {
                echo "✅ Beneficiamento cadastrado com sucesso!";
            } else {
                echo "❌ Erro ao cadastrar beneficiamento.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}