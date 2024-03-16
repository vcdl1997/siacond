<?php

abstract class Repository
{
    protected $model;
    public $conn;

    function __construct(
        Model $model,
        PDO $conn
    )
    {
        $this->model = $model;
        $this->conn = $conn;
    }

    public function defaultSqlCommand(string $crudOperation,  Model $model = null) :void
    {
        $stmt = $this->conn->prepare($this->buildDefaultSqlCommand($crudOperation));
        $stmt->execute($this->getParametersByCrudOperation($crudOperation, $model));

        if($stmt->rowCount() == 0){
            throw new DatabaseErrorException(SQLError::getMessage('UNSUCCESSFUL_COMMAND'));
        }
    }
 
    private function buildDefaultSqlCommand(string $crudOperation) :string
    {
        if(!in_array($crudOperation, ['INSERT', 'UPDATE', 'DELETE'])){
            throw new OutOfRangeException(SQLError::getMessage('UNSUPPORTED_COMMAND'));
        }
        
        $table = $this->model->getTable();
        $primaryKey = $this->model->getPrimaryKey();
        $arrPrimaryKey = is_array($primaryKey) ? $primaryKey : explode(",", $primaryKey);
        $arrFillable = array_keys($this->model->getFillableFields());
        $arrChangeable = array_values($this->model->getMutableFields());
        $sql = "";

        if(empty($table)){
            throw new ModelException(ModelError::getMessage('EMPTY_TABLE_NAME'));
        }

        switch($crudOperation)
        {
            case 'INSERT':
                if(empty($arrFillable)){
                    throw new ModelException(ModelError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
                }

                $sql = "{$crudOperation} INTO " . $table . " (" . implode(", ", $arrFillable) . ") VALUES (";

                foreach ($arrFillable as $index => $field) {
                    $comma = $index < count($arrFillable)-1 ? "," : ")";
                    $sql .= ":{$field}{$comma}";
                }
            break;

            case 'UPDATE':
                if(empty($arrChangeable) || empty($arrPrimaryKey)){
                    throw new ModelException(ModelError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
                }

                $sql = "{$crudOperation} {$table} SET";

                foreach ($arrChangeable as $index => $field) {
                    $comma = $index < count($arrChangeable)-1 ? ", " : "";
                    $sql .= "{$field} = :{$field}{$comma}";
                }

                $sql .= " WHERE ";

                foreach ($arrPrimaryKey as $index => $primaryKey) {
                    $and = $index < count($arrFillable)-1 ? " AND " : "";
                    $sql .= "{$primaryKey} = :{$primaryKey}{$and}";
                }
            break;

            case 'DELETE':
                if(empty($arrPrimaryKey)){
                    throw new ModelException(ModelError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
                }

                $sql = "DELETE FROM " . $table . " WHERE ";
                
                foreach ($arrPrimaryKey as $index => $primaryKey) {
                    $and = $index < count($arrFillable)-1 ? " AND " : "";
                    $sql .= "{$primaryKey} = :{$primaryKey}{$and}";
                }
            break;
        }

        return $sql;
    }

    public function isEquals(Model $object) :bool
    {
        $reflection = new ReflectionClass($this->model);
        $propsModel = array_values(array_filter(array_map(function($property){
            return $property->getName();
        }, $reflection->getProperties())));

        $reflection = new ReflectionClass($object);
        $propsObject = array_values(array_filter(array_map(function($property){
            return $property->getName();
        }, $reflection->getProperties())));

        return count(array_diff($propsObject, $propsModel)) == 0;
    }

    private function getParametersByCrudOperation(string $crudOperation, Model $object) :array
    {
        if(!in_array($crudOperation, ['INSERT', 'UPDATE', 'DELETE'])){
            throw new OutOfRangeException(SQLError::getMessage('UNSUPPORTED_COMMAND'));
        }

        switch($crudOperation)
        {
            case 'INSERT': 
                return $this->getParametersFillable($object);
            
            case 'UPDATE': 
                return $this->getParametersMutable($object);
            
            case 'DELETE': 
                return $this->getParametersDeletion($object);
        }
    }

    private function getParametersFillable(Model $object) :array
    {
        $params = [];

        foreach($this->model->getFillableFields() as $param => $value){
            $params[":{$param}"] = $object->{$value}();
        }

        return $params;
    }

    private function getParametersMutable(Model $object) :array
    {
        $params = [];
        $arrPrimaryKey = $this->model->getPrimaryKey();

        if(empty($arrPrimaryKey)){
            throw new ModelException(ModelError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
        }

        foreach($arrPrimaryKey as $param => $value){
            $primayKey = $object->{$value}();
            
            if(empty($primayKey)){
                throw new ModelException(ModelError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
            }

            $params[":{$param}"] = $primayKey;
        }

        foreach($this->model->getMutableFields() as $param => $value){
            $params[":{$param}"] = $object->{$value}();
        }

        return $params;
    }

    private function getParametersDeletion(Model $object) :array
    {
        $params = [];
        $arrPrimaryKey = $this->model->getPrimaryKey();

        if(empty($arrPrimaryKey)){
            throw new ModelException(ModelError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
        }

        foreach($arrPrimaryKey as $param => $value){
            $primayKey = $object->{$value}();
            
            if(empty($primayKey)){
                throw new ModelException(ModelError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
            }

            $params[":{$param}"] = $primayKey;
        }

        return $params;
    }
}