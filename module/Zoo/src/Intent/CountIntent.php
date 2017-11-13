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

use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class CountIntent
 *
 * @package Zoo\Intent
 */
class CountIntent extends AbstractIntent
{
    const NAME = 'CountIntent';

    /**
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        $count = $this->getAnimalCount();

        $zooMessage = $this->getTextHelper()->getCountMessage($count);

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($zooMessage)
        );

        $this->getAlexaResponse()->setCard(
            new Standard(
                $this->getTextHelper()->getCountTitle(),
                $zooMessage,
                $smallImageUrl,
                $largeImageUrl
            )
        );

        return $this->getAlexaResponse();
    }

    /**
     * @return string
     */
    private function getAnimalCount()
    {
        $locale = $this->getAlexaRequest()->getRequest()->getLocale();

        $count = 0;

        foreach ($this->getAnimalList()[$locale] as $type => $typeList) {
            $count += count($typeList);
        }

        return $count;
    }
}
