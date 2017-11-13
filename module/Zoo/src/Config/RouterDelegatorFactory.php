<?php
/**
 * PHP Magazin Alexa mit PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/RalfEggert/phpmagazin.alexa
 *
 */

/**
 * PHP Magazin Alexa mit PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/RalfEggert/phpmagazin.alexa
 *
 */

namespace Zoo\Config;

use Interop\Container\ContainerInterface;
use TravelloAlexaZf\Action\HtmlPageAction;
use TravelloAlexaZf\Action\SkillAction;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zoo\ConfigProvider;

/**
 * Class RouterDelegatorFactory
 *
 * @package Zoo\Config
 */
class RouterDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $name
     * @param callable           $callback
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        /** @var Application $application */
        $application = $callback();

        $application->post('/zoo', SkillAction::class, 'zoo')
            ->setOptions(['defaults' => ['skillName' => ConfigProvider::NAME]]);

        $application->get('/zoo/privacy', HtmlPageAction::class, 'zoo-privacy')
            ->setOptions(['defaults' => ['template' => 'zoo::privacy']]);

        return $application;
    }
}
