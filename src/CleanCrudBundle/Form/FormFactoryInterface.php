<?php
namespace CleanCrudBundle\Form;

use Symfony\Component\Form\FormInterface;
use CleanCrudBundle\Entity\EntityInterface;

interface FormFactoryInterface
{
    public function setForm(FormInterface $form);

    public function setEntity(EntityInterface $entity);

    public function buildForm();
}
