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

use Interop\Container\ContainerInterface;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\TextHelper\TextHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AnimalIntentFactory
 *
 * @package Zoo\Intent
 */
class AnimalIntentFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return AnimalIntent
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $alexaRequest  = $container->get(AlexaRequest::class);
        $alexaResponse = $container->get(AlexaResponse::class);
        $textHelper    = $container->get(TextHelper::class);

        $animalList = include PROJECT_ROOT . '/data/zoo/animals.php';

        /** @var AnimalIntent $intent */
        $intent = new $requestedName($alexaRequest, $alexaResponse, $textHelper);
        $intent->setAnimalList($animalList);

        return $intent;
    }
}
