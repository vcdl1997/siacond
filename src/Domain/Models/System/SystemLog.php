<?php

class SystemLog extends Model
{
    const TABLE = 'TB_SYSTEM_LOG';
    const ID = 'ID';
    const EXCEPTION = 'EXCEPTION';
    const MESSAGE = 'MESSAGE';
    const FILE = 'FILE';
    const LINE = 'LINE';
    const TRACE = 'TRACE';

    private $id;
    private $exception;
    private $message;
    private $file;
    private $line;
    private $trace;

    public static function build() :SystemLog
    {
        return new SystemLog();
    }

    public function exception(string $exception) :SystemLog
    {
        $this->setException($exception);
        return $this;
    }

    public function message(string $message) :SystemLog
    {
        $this->setMessage($message);
        return $this;
    }

    public function file(string $file) :SystemLog
    {
        $this->setFile($file);
        return $this;
    }

    public function line(int $file) :SystemLog
    {   
        $this->setLine($file);
        return $this;
    }

    public function trace(string $trace) :SystemLog
    {
        $this->setTrace($trace);
        return $this;
    }

    public function getId() :int
    {
    	return $this->id;
    }

    public function getException() :string
    {
    	return $this->exception;
    }

    public function setException(string $exception) :void
    {
    	$this->exception = $exception;
    }

    public function getMessage() :string
    {
    	return $this->message;
    }

    public function setMessage(string $message) :void
    {
    	$this->message = $message;
    }

    public function getFile() :string
    {
    	return $this->file;
    }

    public function setFile(string $file) :void
    {
    	$this->file = $file;
    }

    public function getLine() :int
    {
    	return $this->line;
    }

    public function setLine(int $line) :void
    {
    	$this->line = $line;
    }

    public function getTrace() :string
    {
    	return $this->trace;
    }

    public function setTrace(string $trace) :void
    {
    	$this->trace = $trace;
    }
    
    public function getTable() :string
    {
        return self::TABLE;
    }

    public function getPrimaryKey() :mixed
    {
        return self::ID;
    }

    public function getFillableFields() :array
    {
        return [
            self::EXCEPTION => "getException",
            self::MESSAGE => "getMessage",
            self::FILE => "getFile",
            self::LINE => "getLine",
            self::TRACE => "getTrace"
        ];
    }

    public function getMutableFields() :array
    {
        return [];
    }

    public function toString() :string
    {
        return json_encode(get_object_vars($this));
    }
}