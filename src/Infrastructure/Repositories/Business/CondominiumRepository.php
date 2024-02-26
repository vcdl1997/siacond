<?php

class CondominiumRepository extends Repository
{
    function __construct(
        Condominium $model = new Condominium()
    )
    {
        parent::__construct($model);
    }

    public function listAll(array $filters) :array
    {
        $userId = Request::data_get($filters, 'userId');

        $sql = "
            SELECT 
                condominium." . Condominium::ID . " as id,
                condominium." . Condominium::FANTASY_NAME . " as fantasyName,
                condominium." . Condominium::LOGO . " as logo
            FROM " . Condominium::TABLE . " AS condominium
            LEFT JOIN " . UserCondominium::TABLE . " AS user_condominium ON user_condominium." . UserCondominium::CONDOMINIUM_ID . " = condominium." . Condominium::ID . "
            WHERE condominium." . Condominium::ACTIVE . " = :" . Condominium::ACTIVE
        ;

        $pdoFilters[":" . Condominium::ACTIVE] = true;

        if(!empty($userId)){
            $sql .= "\nAND user_condominium." . UserCondominium::USER_ID . " = :" . UserCondominium::USER_ID;
            $pdoFilters[":" . UserCondominium::USER_ID] = $userId;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($pdoFilters);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }
}