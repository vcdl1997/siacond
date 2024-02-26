<?php

class CondominiumDto extends BaseDto
{
    private $id;
    private $fantasyName;
    private $logo;

    public function getId() :int
    {
        return $this->id;
    }

    public function setId(string $id) :void
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

    public function getLogo() :string
    {
        return $this->logo;
    }

    public function setLogo(string $logo) :void
    {
        $this->logo = $logo;
    }
}