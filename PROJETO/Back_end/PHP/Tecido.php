<?php

class Tecido {
    private $tecido_id;
    private $nome_tecido;
    private $cor;
    private $peso_metros;
    private $composicao;
    private $gramatura;
    private $fornecedor_id;

    public function __construct($tecido_id, $nome_tecido, $cor, $peso_metros, $composicao, $gramatura, $fornecedor_id) {
        $this->tecido_id = $tecido_id;
        $this->nome_tecido = $nome_tecido;
        $this->cor = $cor;
        $this->peso_metros = $peso_metros;
        $this->composicao = $composicao;
        $this->gramatura = $gramatura;
        $this->fornecedor_id = $fornecedor_id;
    }

    public function inserirTecido($conn) {
        try {
            $sql = "INSERT INTO tecido (nome_tecido, cor, peso_metros, composicao, gramatura, fornecedor_id)
                    VALUES (:nome_tecido, :cor, :peso_metros, :composicao, :gramatura, :fornecedor_id)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nome_tecido', $this->nome_tecido);
            $stmt->bindParam(':cor', $this->cor);
            $stmt->bindParam(':peso_metros', $this->peso_metros);
            $stmt->bindParam(':composicao', $this->composicao);
            $stmt->bindParam(':gramatura', $this->gramatura);
            $stmt->bindParam(':fornecedor_id', $this->fornecedor_id);

            if ($stmt->execute()) {
                echo "✅ Tecido cadastrado com sucesso!";
            } else {
                echo "❌ Erro ao cadastrar tecido.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
