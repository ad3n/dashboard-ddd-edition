<?php
namespace CleanCrudBundle\Entity;

class EntityFactory implements EntityFactoryInterface
{
    protected $entities = array();

    public function addEntity(EntityInterface $entity)
    {
        $this->entities[$entity->getEntityName()] = $entity;

        return $this;
    }

    public function get($entityName)
    {
        if ($this->has($entityName)) {
            return $this->entities[$entityName];
        }
    }

    public function has($entityName)
    {
        return array_key_exists($entityName, $this->entities);
    }
}
