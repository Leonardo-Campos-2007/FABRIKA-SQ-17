<?php
include_once 'cerigrafia.php';

function cadastrarCerigrafia($tamanho, $cor)
{
    $cerigrafia = new Cerigrafia($tamanho, $cor);
    return $cerigrafia->inserir();
}

function editarCerigrafia($id_cerigrafia, $tamanho, $cor)
{
    $cerigrafia = Cerigrafia::carregar($id_cerigrafia);
    
    if ($cerigrafia == null) {
        return false;
    }
    
    $cerigrafia->tamanho = $tamanho;
    $cerigrafia->cor = $cor;
    
    return $cerigrafia->editar();
}

function deletarCerigrafia($id_cerigrafia)
{
    $cerigrafia = Cerigrafia::carregar($id_cerigrafia);
    
    if ($cerigrafia == null) {
        return false;
    }
    
    return $cerigrafia->deletar();
}

function deletarCerigrafiaPorId($id_cerigrafia)
{
    $cerigrafia = new Cerigrafia("", "");
    $cerigrafia->setIdCerigrafia($id_cerigrafia);
    return $cerigrafia->deletar();
}

function getCerigrafias()
{
    $banco = new Banco();
    $conn = $banco->conectar();
    
    try {
        $stmt = $conn->prepare("SELECT * FROM cerigrafia");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        echo "Erro ao buscar cerigrafias: " . $e->getMessage();
        return array();
    } finally {
        $banco->fecharConexao();
    }
}

?>
