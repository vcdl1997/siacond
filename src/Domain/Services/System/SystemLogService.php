<?php

class SystemLogService
{
    private $systemLog;
    private $systemLogRepository;

    function __construct(SystemLog $systemLog)
    {
        $this->systemLog = $systemLog;
        $this->systemLogRepository = new SystemLogRepository($systemLog);
    }

    public function handleException(Exception $exception) :void
    {
        $this->store($this->systemLog);
        $this->response($exception);
    }

    private function store(SystemLog $systemLog) :void
    {
        $params = $this->systemLogRepository->getParamsFillable($this->systemLog);
        $stmt = $this->systemLogRepository->buildDefaultSqlCommand('INSERT');
        $stmt->execute($params);

        if($stmt->rowCount() == 0){
            $error = DatabaseError::getMessage('UNSUCCESSFUL_INSERT') . "“" . get_class($systemLog) . "”";
            throw new DatabaseErrorException($error);
        }
    }

    private function response(Exception $exception) :void
    {
        switch(get_class($exception)){
            case "BusinessException":
                JSON::response($exception->getMessage(), HttpStatusCode::BAD_REQUEST);

            case "NotFoundException":
                JSON::response($exception->getMessage(), HttpStatusCode::NOT_FOUND);

            case "JSONException":
            case "InvalidParameterException": 
            case "IOException":
            case "OutOfRangeException":
            case "RuntimeException": 
                JSON::response($exception->getMessage(), HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }
}