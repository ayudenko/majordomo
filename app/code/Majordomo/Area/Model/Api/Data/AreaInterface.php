<?php


namespace Majordomo\Area\Model\Api\Data;


interface AreaInterface
{

    public function getAreaId():int;
    public function setAreaId(int $areaId);

    public function getName():string;
    public function setName(string $name);

    public function getCreatedAt();
    public function setCreatedAt($createdAt);

    public function getModifiedAt();
    public function setModifiedAt($modifiedAt);
}
