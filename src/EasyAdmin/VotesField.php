<?php

namespace App\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Contracts\Translation\TranslatableInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * @author Yoel Velasquez Valencia <yoel.velasquez.valenca@gmail.com>
 */
final class VotesField implements FieldInterface
{
    use FieldTrait;

    public const OPTION_NUMBER_FORMAT = 'numberFormat';
    
    public static function new(string $propertyName, $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('admin/field/integer.html.twig')
            ->setFormType(IntegerType::class)
            ->addCssClass('field-integer')
            ->setDefaultColumns('col-md-4 col-xxl-3')
            ->setCustomOption(self::OPTION_NUMBER_FORMAT, null);
    }

    /*
    // this format is passed directly to the first argument of `sprintf()` to format the integer before displaying it
    public function setNumberFormat(string $sprintfFormat): self
    {
        $this->setCustomOption(self::OPTION_NUMBER_FORMAT, $sprintfFormat);

        return $this;
    }
    */
}