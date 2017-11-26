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
use TravelloAlexaLibrary\Configuration\SkillConfiguration;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\TextHelper\TextHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AbstractIntentFactory
 *
 * @package Zoo\Intent
 */
class AbstractIntentFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return AbstractIntent
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $alexaRequest       = $container->get(AlexaRequest::class);
        $alexaResponse      = $container->get(AlexaResponse::class);
        $textHelper         = $container->get(TextHelper::class);
        $skillConfiguration = $container->get(SkillConfiguration::class);

        $animalList = include PROJECT_ROOT . '/data/zoo/animals.php';

        /** @var AbstractIntent $intent */
        $intent = new $requestedName($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);
        $intent->setAnimalList($animalList);

        return $intent;
    }
}
