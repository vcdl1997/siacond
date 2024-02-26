<?php

class Condominium extends Model
{
    const TABLE = 'TB_CONDOMINIUM';
    const ID = 'ID';
    const FANTASY_NAME = 'FANTASY_NAME';
    const CORPORATE_NAME = 'CORPORATE_NAME';
    const LOGO = 'LOGO';
    const ACTIVE = 'ACTIVE';  

    private $id;
    private $fantasyName;
    private $corporateName;
    private $logo;
    private $active;
    
    public static function build() :Condominium
    {
        return new Condominium();
    }

    public function fantasyName(mixed $fantasyName = null) :Condominium
    {
        $this->setFantasyName($fantasyName ?? "");
        return $this;
    }

    public function corporateName(mixed $corporateName = null) :Condominium
    {
        $this->setCorporateName($corporateName ?? "");
        return $this;
    }

    public function logo(mixed $logo = null) :Condominium
    {
        $this->setLogo($logo ?? "");
        return $this;
    }

    public function active(mixed $active = null) :Condominium
    {
        $this->setActive($active ?? true);
        return $this;
    }

    public function getId() :int
    {
    	return $this->id;
    }

    public function setId(int $id) :void
    {
    	$this->id = $id;
    }

    public function getFantasyName() :string
    {
    	return $this->fantasyName;
    }

    public function setFantasyName(string $fantasyName) :void
    {
    	$this->fantasyName = $fantasyName;
    }

    public function getCorporateName() :string
    {
    	return $this->corporateName;
    }

    public function setCorporateName(string $corporateName) :void
    {
    	$this->corporateName = $corporateName;
    }

    public function getLogo() :string
    {
    	return $this->logo;
    }

    public function setLogo(string $logo) :void
    {
    	$this->logo = $logo;
    }

    public function getActive() :bool
    {
    	return $this->active;
    }

    public function setActive(bool $active) :void
    {
    	$this->active = $active;
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
            self::FANTASY_NAME => 'getFantasyName',
            self::CORPORATE_NAME => 'getCorporateName',
            self::LOGO => 'getLogo',
            self::ACTIVE => 'getActive',
        ];
    }

    public function getMutableFields() :array
    {
        return [
            self::FANTASY_NAME => 'getFantasyName',
            self::CORPORATE_NAME => 'getCorporateName',
            self::LOGO => 'getLogo',
            self::ACTIVE => 'getActive',
        ];
    }

    public function toString() :string
    {
        return json_encode(get_object_vars($this));
    }
}