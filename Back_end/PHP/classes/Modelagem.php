    <?php

    class Modelagem {
        private $modelagem_id;
        private $tipo_molde;
        private $codigo_molde;

        function __construct($modelagem_id, $tipo_molde, $codigo_molde) {
            $this->modelagem_id = $modelagem_id;
            $this->tipo_molde = $tipo_molde;
            $this->codigo_molde = $codigo_molde;
        }


        // ----------- GETTERS -----------
        public function getModelagemId() {
            return $this->modelagem_id;
        }

        public function getTipoMolde() {
            return $this->tipo_molde;
        }

        public function getCodigoMolde() {
            return $this->codigo_molde;
        }

        // ----------- SETTERS -----------

        public function setModelagemId($modelagem_id) {
            $this->modelagem_id = $modelagem_id;
        }

        public function setTipoMolde($tipo_molde) {
            $this->tipo_molde = $tipo_molde;
        }

        public function setCodigoMolde($codigo_molde) {
            $this->codigo_molde = $codigo_molde;
        }

        public function inserirModelagem($conn) {
            try{

                $sql = "INSERT INTO modelagem (tipo_molde, codigo_molde) 
                        VALUES (:tipo_molde, :codigo_molde)";


                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':tipo_molde', $this->tipo_molde);
                $stmt->bindParam(':codigo_molde', $this->codigo_molde);

                if ($stmt->execute()) {
                    echo "✅ Modelagem cadastrada com sucesso!";
                } else {
                    echo "❌ Erro ao cadastrar modelagem.";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
    
        // ----------- DELETAR DO BANCO -----------
        public function deletarModelagem($conn) {
            try {
                if (empty($this->modelagem_id)) {
                    echo "❌ ID da modelagem não informado.";
                    return false;
                }

                $sql = "DELETE FROM modelagem WHERE modelagem_id = :modelagem_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':modelagem_id', $this->modelagem_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo "✅ Modelagem removida com sucesso!";
                        return true;
                    } else {
                        echo "⚠️ Nenhuma modelagem encontrada com o ID informado.";
                        return false;
                    }
                } else {
                    echo "❌ Erro ao deletar modelagem.";
                    return false;
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return false;
            }
        }

        // ----------- EDITAR NO BANCO -----------
        public function editarModelagem($conn) {
            try {
                if (empty($this->modelagem_id)) {
                    echo "❌ ID da modelagem não informado.";
                    return false;
                }

                $sql = "UPDATE modelagem SET
                            tipo_molde = :tipo_molde,
                            codigo_molde = :codigo_molde
                        WHERE modelagem_id = :modelagem_id";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':tipo_molde', $this->tipo_molde);
                $stmt->bindParam(':codigo_molde', $this->codigo_molde);
                $stmt->bindParam(':modelagem_id', $this->modelagem_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo "✅ Modelagem atualizada com sucesso!";
                        return true;
                    } else {
                        echo "⚠️ Nenhuma alteração detectada ou modelagem não encontrada.";
                        return false;
                    }
                } else {
                    echo "❌ Erro ao atualizar modelagem.";
                    return false;
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return false;
            }
        }
    }

    ?>