Class Fornecedor {

    private $fornecedor_id;
    private $nome_fornecedor;
    private $razao_social;
    private $cnpj;

    funcion __construct($fornecedor_id, $nome_fornecedor, $razao_social, $cnpj) {
        $this->fornecedor_id = $fornecedor_id;
        $this->nome_fornecedor = $nome_fornecedor;
        $this->razao_social = $razao_social;
        $this->cnpj = $cnpj;
    }   

}