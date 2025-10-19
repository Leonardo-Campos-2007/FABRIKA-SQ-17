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
    }

    ?>