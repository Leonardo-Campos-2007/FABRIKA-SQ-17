<?php
declare(strict_types=1);

class Tecido {
    private ?int $tecido_id;
    private string $nome_tecido;
    private string $cor;
    private float $peso_metros;
    private string $composicao;
    private float $gramatura;
    private int $fornecedor_id;

    public function __construct(
        ?int $tecido_id,
        string $nome_tecido,
        string $cor,
        float $peso_metros,
        string $composicao,
        float $gramatura,
        int $fornecedor_id
    ) {
        $this->setTecidoId($tecido_id);
        $this->setNomeTecido($nome_tecido);
        $this->setCor($cor);
        $this->setPesoMetros($peso_metros);
        $this->setComposicao($composicao);
        $this->setGramatura($gramatura);
        $this->setFornecedorId($fornecedor_id);
    }

    // ----------- GETTERS -----------
    public function getTecidoId(): ?int { return $this->tecido_id; }
    public function getNomeTecido(): string { return $this->nome_tecido; }
    public function getCor(): string { return $this->cor; }
    public function getPesoMetros(): float { return $this->peso_metros; }
    public function getComposicao(): string { return $this->composicao; }
    public function getGramatura(): float { return $this->gramatura; }
    public function getFornecedorId(): int { return $this->fornecedor_id; }

    // ----------- SETTERS -----------
    public function setTecidoId(?int $tecido_id): void {
        $this->tecido_id = $tecido_id;
    }

    public function setNomeTecido(string $nome_tecido): void {
        if (empty(trim($nome_tecido))) {
            throw new InvalidArgumentException("O nome do tecido não pode estar vazio.");
        }
        $this->nome_tecido = trim($nome_tecido);
    }

    public function setCor(string $cor): void {
        if (empty(trim($cor))) {
            throw new InvalidArgumentException("A cor do tecido é obrigatória.");
        }
        $this->cor = trim($cor);
    }

    public function setPesoMetros(float $peso_metros): void {
        if ($peso_metros <= 0) {
            throw new InvalidArgumentException("O peso em metros deve ser maior que zero.");
        }
        $this->peso_metros = $peso_metros;
    }

    public function setComposicao(string $composicao): void {
        if (empty(trim($composicao))) {
            throw new InvalidArgumentException("A composição do tecido é obrigatória.");
        }
        $this->composicao = trim($composicao);
    }

    public function setGramatura(float $gramatura): void {
        if ($gramatura <= 0) {
            throw new InvalidArgumentException("A gramatura deve ser maior que zero.");
        }
        $this->gramatura = $gramatura;
    }

    public function setFornecedorId(int $fornecedor_id): void {
        if ($fornecedor_id <= 0) {
            throw new InvalidArgumentException("O ID do fornecedor é inválido.");
        }
        $this->fornecedor_id = $fornecedor_id;
    }
}


    // ----------- INSERÇÃO NO BANCO -----------
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

    // ----------- EDITAR NO BANCO -----------
    public function editarTecido($conn) {
        try {
            if (empty($this->tecido_id)) {
                echo "❌ ID do tecido não informado.";
                return false;
            }

            $sql = "UPDATE tecido SET
                        nome_tecido = :nome_tecido,
                        cor = :cor,
                        peso_metros = :peso_metros,
                        composicao = :composicao,
                        gramatura = :gramatura,
                        fornecedor_id = :fornecedor_id
                    WHERE tecido_id = :tecido_id";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nome_tecido', $this->nome_tecido);
            $stmt->bindParam(':cor', $this->cor);
            $stmt->bindParam(':peso_metros', $this->peso_metros);
            $stmt->bindParam(':composicao', $this->composicao);
            $stmt->bindParam(':gramatura', $this->gramatura);
            $stmt->bindParam(':fornecedor_id', $this->fornecedor_id, PDO::PARAM_INT);
            $stmt->bindParam(':tecido_id', $this->tecido_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo "✅ Tecido atualizado com sucesso!";
                    return true;
                } else {
                    // rowCount pode ser 0 se os dados não mudaram
                    echo "⚠️ Nenhuma alteração detectada ou tecido não encontrado.";
                    return false;
                }
            } else {
                echo "❌ Erro ao atualizar tecido.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
    // ----------- DELETAR DO BANCO -----------
    public function deletarTecido($conn) {
        try {
            if (empty($this->tecido_id)) {
                echo "❌ ID do tecido não informado.";
                return false;
            }

            $sql = "DELETE FROM tecido WHERE tecido_id = :tecido_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':tecido_id', $this->tecido_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // checar número de linhas afetadas
                if ($stmt->rowCount() > 0) {
                    echo "✅ Tecido removido com sucesso!";
                    return true;
                } else {
                    echo "⚠️ Nenhum tecido encontrado com o ID informado.";
                    return false;
                }
            } else {
                echo "❌ Erro ao deletar tecido.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
}
?>
