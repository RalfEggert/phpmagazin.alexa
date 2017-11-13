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

use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class AnimalIntent
 *
 * @package Zoo\Intent
 */
class AnimalIntent extends AbstractIntent
{
    const NAME = 'AnimalIntent';

    /** @var array */
    private $animalList = [];

    /** @var array */
    private $sessionAnimals = [];

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

    /**
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        $this->sessionAnimals = $this->getAlexaResponse()->getSessionContainer()->getAttribute('animals');

        $randomAnimal = $this->getRandomAnimal();

        $zooMessage = $this->getTextHelper()->getAnimalMessage($randomAnimal);

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($zooMessage)
        );

        $this->getAlexaResponse()->setCard(
            new Standard(
                $this->getTextHelper()->getAnimalTitle(),
                $zooMessage,
                $smallImageUrl,
                $largeImageUrl
            )
        );

        $this->getAlexaResponse()->getSessionContainer()->setAttribute('animals', $this->sessionAnimals);

        return $this->getAlexaResponse();
    }

    /**
     * @return string
     */
    private function getRandomAnimal()
    {
        $locale = $this->getAlexaRequest()->getRequest()->getLocale();

        do {
            $randomType      = array_rand($this->getAnimalList()[$locale]);
            $randomAnimalKey = array_rand($this->getAnimalList()[$locale][$randomType]);
            $randomAnimal    = $this->getAnimalList()[$locale][$randomType][$randomAnimalKey];
        } while (in_array($randomAnimal, $this->sessionAnimals));

        if (count($this->sessionAnimals) >= 5) {
            array_shift($this->sessionAnimals);
        }

        $this->sessionAnimals[] = $randomAnimal;

        return $randomAnimal;
    }
}
