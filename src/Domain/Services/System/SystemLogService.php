<?php

class SystemLogService
{
    private $systemLog;
    private $systemLogRepository;

    function __construct(
        SystemLog $systemLog,
        PDO $conn
    )
    {
        $this->systemLog = $systemLog;
        $this->systemLogRepository = new SystemLogRepository(null, $conn);
    }

    public function handleException(Exception $exception) :void
    {
        $this->store($this->systemLog);
        $this->response($exception);
    }

    private function store(SystemLog $systemLog) :void
    {
        $this->systemLogRepository->defaultSqlCommand('INSERT', $systemLog);
    }

    private function response(Exception $exception) :void
    {
        $data = [
            'message' => trim(preg_replace('/\s+/', ' ', $exception->getMessage()))
        ];
        
        switch(get_class($exception)){
            case "BusinessException":
                JSON::response($data, HttpStatusCode::BAD_REQUEST);

            case "JsonException":
                JSON::response($data, HttpStatusCode::UNAUTHORIZED);

            case "NotFoundException":
                JSON::response($data, HttpStatusCode::NOT_FOUND);

            case "InvalidArgumentException": 
                JSON::response($data, HttpStatusCode::UNPROCESSABLE_ENTITY);

            case "ModelException":
            case "DatabaseErrorException":
            case "IOException":
            case "OutOfRangeException":
            case "RuntimeException": 
                if($exception->getMessage() == RouteError::getMessage('NOT_FOUND')){
                    $data['errorType'] = 'Route';
                }
                JSON::response($data, HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }
}