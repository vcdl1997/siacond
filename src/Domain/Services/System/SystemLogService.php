<?php

class SystemLogService
{
    private $systemLog;
    private $systemLogRepository;

    function __construct(SystemLog $systemLog = new SystemLog())
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
        $this->systemLogRepository->defaultSqlCommand('INSERT', $systemLog);
    }

    private function response(Exception $exception) :void
    {
        switch(get_class($exception)){
            case "BusinessException":
                JSON::response(['message' => $exception->getMessage()], HttpStatusCode::BAD_REQUEST);

            case "NotFoundException":
                JSON::response(['message' => $exception->getMessage()], HttpStatusCode::NOT_FOUND);

            case "InvalidArgumentException": 
                JSON::response(['message' => $exception->getMessage()], HttpStatusCode::UNPROCESSABLE_ENTITY);

            case "ModelException":
            case "DatabaseErrorException":
            case "JSONException":
            case "IOException":
            case "OutOfRangeException":
            case "RuntimeException": 
                JSON::response(['message' => $exception->getMessage()], HttpStatusCode::INTERNAL_SERVER_ERROR);
        }
    }
}