<?php
include_once 'BANCO/banco.php';

class ficha_tecnica
{
    public $id_ficha_tecnica;
    public $id_modelagem;
    public $id_tecido;
    public $id_cerigrafia;
    public $id_aviamento;
    public $id_beneficiamento;

    function __construct($id_modelagem = null, $id_tecido = null, $id_cerigrafia = null, $id_aviamento = null, $id_beneficiamento = null)
    {
        $this->id_modelagem = $id_modelagem;
        $this->id_tecido =  $id_tecido;
        $this->id_cerigrafia = $id_cerigrafia;
        $this->id_aviamento = $id_aviamento;
        $this->id_beneficiamento = $id_beneficiamento;
    }

   
    public function juntarFichaTecnica()
    {
        $banco = new Banco();
        $conn = $banco->conectar();

        try {
            // Caso 1: buscar detalhado por id
            if (!empty($this->id_ficha_tecnica)) {
                $sql = "
                    SELECT f.*,
                           m.tipo_molde    AS modelagem_tipo_molde,
                           m.codigo_molde  AS modelagem_codigo_molde,
                           m.tamanho       AS modelagem_tamanho,
                           t.nome          AS tecido_nome,
                           t.cor           AS tecido_cor,
                           t.peso_metro    AS tecido_peso_metro,
                           c.digital       AS cerigrafia_digital,
                           c.bordado       AS cerigrafia_bordado,
                           c.sublimacao    AS cerigrafia_sublimacao,
                           c.serigrafia    AS cerigrafia_serigrafia,
                           a.nome          AS aviamento_nome,
                           a.cor           AS aviamento_cor,
                           a.peso_quantidade AS aviamento_peso_quantidade,
                           b.descricao     AS beneficiamento_descricao
                    FROM ficha_tecnica f
                    LEFT JOIN modelagem m ON f.id_modelagem = m.id_modelagem
                    LEFT JOIN tecido t ON f.id_tecido = t.id_tecido
                    LEFT JOIN cerigrafia c ON f.id_cerigrafia = c.id_cerigrafia
                    LEFT JOIN aviamento a ON f.id_aviamento = a.id_aviamento
                    LEFT JOIN beneficiamento b ON f.id_beneficiamento = b.id_beneficiamento
                    WHERE f.id_ficha_tecnica = :id_ficha_tecnica
                    LIMIT 1
                ";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_ficha_tecnica', $this->id_ficha_tecnica, PDO::PARAM_INT);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $banco->fecharConexao();

                return $result ?: null;
            }

            // Caso 2: inserir nova ficha técnica
            $sql = "
                INSERT INTO ficha_tecnica (id_modelagem, id_tecido, id_cerigrafia, id_aviamento, id_beneficiamento)
                VALUES (:id_modelagem, :id_tecido, :id_cerigrafia, :id_aviamento, :id_beneficiamento)
            ";

            $stmt = $conn->prepare($sql);

            // usamos bindValue para permitir valores null caso algum id não tenha sido informado
            $stmt->bindValue(':id_modelagem', $this->id_modelagem !== null ? (int)$this->id_modelagem : null, PDO::PARAM_INT);
            $stmt->bindValue(':id_tecido', $this->id_tecido !== null ? (int)$this->id_tecido : null, PDO::PARAM_INT);
            $stmt->bindValue(':id_cerigrafia', $this->id_cerigrafia !== null ? (int)$this->id_cerigrafia : null, PDO::PARAM_INT);
            $stmt->bindValue(':id_aviamento', $this->id_aviamento !== null ? (int)$this->id_aviamento : null, PDO::PARAM_INT);
            $stmt->bindValue(':id_beneficiamento', $this->id_beneficiamento !== null ? (int)$this->id_beneficiamento : null, PDO::PARAM_INT);

            $executou = $stmt->execute();

            if ($executou) {
                $this->id_ficha_tecnica = $conn->lastInsertId();
                $banco->fecharConexao();
                return $this->id_ficha_tecnica;
            } else {
                $banco->fecharConexao();
                return false;
            }
        } catch (PDOException $e) {
            // Em ambiente de desenvolvimento você pode exibir o erro; em produção, logue-o.
            echo "Erro em juntarFichaTecnica: " . $e->getMessage();
            if ($conn && $conn->inTransaction()) {
                $conn->rollBack();
            }
            $banco->fecharConexao();
            return false;
        }
    }

    public function deletarficha()
    {
        if (empty($this->id_ficha_tecnica)) {
            return false;
        }

        $banco = new Banco();
        $conn = $banco->conectar();

        try {
            $stmt = $conn->prepare("DELETE FROM ficha_tecnica WHERE id_ficha_tecnica = :id_ficha_tecnica");
            $stmt->bindParam(':id_ficha_tecnica', $this->id_ficha_tecnica, PDO::PARAM_INT);

            $result = $stmt->execute();

            $banco->fecharConexao();

            return $result;
        } catch (PDOException $e) {
            echo "Erro ao deletar ficha técnica: " . $e->getMessage();
            return false;
        }
    }
}
