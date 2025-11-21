<?php
    include_once 'BANCO/banco.php';


    class Tecido{
        public $id_tecido;
        public $nome;
        public $cor;
        public $peso_metros;
        public $composicao;
        public $gramatura;
        public $fabricante;

        function __construct($nome, $cor, $peso_metros, $composicao, $gramatura, $fabricante){
            $this->nome = $nome;
            $this->cor =  $cor;
            $this->peso_metros = $peso_metros;
            $this->composicao = $composicao;
            $this->gramatura = $gramatura;
            $this->fabricante = $fabricante;
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("insert into tecido (nome, cor, peso_metros, composicao, gramatura, fabricante) values(:nome, :cor, :peso_metros, 
                :composicao, :gramatura, :fabricante)");
                $stmt->bindParam(':nome',$this->nome);
                $stmt->bindParam(':cor',$this->cor);
                $stmt->bindParam(':peso_metros',$this->peso_metros);
                $stmt->bindParam(':composicao',$this->composicao);
                $stmt->bindParam(':gramatura',$this->gramatura);
                $stmt->bindParam(':fabricante',$this->fabricante);
                
                $result = $stmt->execute();
                $banco->fecharConexao();

                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function getIdTecido(){
            return $this->id_tecido;
        }

        function setIdTecido($id_tecido){
            $this->id_tecido = $id_tecido;
        }

        static function carregar($id_tecido){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("select * from tecido where id_tecido = :id_tecido");
                $stmt->bindParam(':id_tecido',$id_tecido);
                $stmt->execute();
                $tecido = null;
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $v => $value){
                    $tecido = new Tecido($value['nome'], $value['cor'], $value['peso_metros'], $value['composicao'], $value['gramatura'], $value['fabricante']);
                    $tecido->setIdTecido( $value['id_tecido']);
                }
                return $tecido;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>