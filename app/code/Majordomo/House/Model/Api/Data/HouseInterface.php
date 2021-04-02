<?php


namespace Majordomo\House\Model\Api\Data;


interface HouseInterface
{

    public function getHouseId():int;
    public function setHouseId(int $houseId);

    public function getName():string;
    public function setName(string $name);

    public function getCreatedAt();
    public function setCreatedAt($createdAt);

    public function getModifiedAt();
    public function setModifiedAt($modifiedAt);
}