<?php

abstract class Repository
{
    protected $model;
    protected $conn;

    function __construct(Model $model)
    {
        $this->model = $model;
        $this->conn = Database::getConnection();
    }

    public function buildDefaultSqlCommand(string $crudOperation) :PDOStatement
    {
        if(!in_array($crudOperation, ['INSERT', 'UPDATE', 'DELETE'])){
            throw new OutOfRangeException(SQLError::getMessage('UNSUPPORTED_COMMAND'));
        }
        
        $table = $this->model->getTable();
        $primaryKey = $this->model->getPrimaryKey();
        $arrPrimaryKey = is_array($primaryKey) ? $primaryKey : explode(",", $primaryKey);
        $arrFillable = array_keys($this->model->getFillable());
        $arrChangeable = array_values($this->model->getChangeable());
        $sql = "";

        if(empty($table)){
            throw new DatabaseErrorException(SQLError::getMessage('EMPTY_TABLE_NAME'));
        }

        switch($crudOperation)
        {
            case 'INSERT':
                if(empty($arrFillable)){
                    throw new DatabaseErrorException(SQLError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
                }

                $sql = "{$crudOperation} INTO " . $table . " (" . implode(", ", $arrFillable) . ") VALUES (";

                foreach ($arrFillable as $index => $field) {
                    $comma = $index < count($arrFillable)-1 ? "," : ")";
                    $sql .= ":{$field}{$comma}";
                }
            break;

            case 'UPDATE':
                if(empty($arrChangeable) || empty($arrPrimaryKey)){
                    throw new DatabaseErrorException(SQLError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
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
                    throw new DatabaseErrorException(SQLError::getMessage('THERE_ARE_NO_MANIPULABLE_FIELDS'));
                }

                $sql = "DELETE FROM " . $table . " WHERE ";
                
                foreach ($arrPrimaryKey as $index => $primaryKey) {
                    $and = $index < count($arrFillable)-1 ? " AND " : "";
                    $sql .= "{$primaryKey} = :{$primaryKey}{$and}";
                }
            break;
        }

        $stmt = $this->conn->prepare($sql);

        return $stmt;
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

    public function getParamsFillable(Model $object) :array
    {
        $params = [];

        foreach($this->model->getFillable() as $param => $value){
            $params[":{$param}"] = $object->{$value}();
        }

        return $params;
    }
}