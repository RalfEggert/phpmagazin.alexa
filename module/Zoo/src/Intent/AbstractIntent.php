<?php
/**
 * PHP Magazin Alexa mit PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/RalfEggert/phpmagazin.alexa
 *
 */

namespace Zoo\Intent;

use TravelloAlexaLibrary\Intent\AbstractIntent as BaseAbstractIntent;

/**
 * Class AbstractIntent
 *
 * @package Zoo\Intent
 */
abstract class AbstractIntent extends BaseAbstractIntent
{
    /** @var array */
    private $animalList = [];

    /**
     * @param array $animalList
     */
    public function setAnimalList(array $animalList)
    {
        $this->animalList = $animalList;
    }

    /**
     * @return array
     */
    protected function getAnimalList(): array
    {
        return $this->animalList;
    }
}
