<?php
/**
 * PHP Magazin Alexa mit PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/RalfEggert/phpmagazin.alexa
 *
 */

use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Container\ErrorHandlerFactory;
use Zend\Expressive\Container\ErrorResponseGeneratorFactory;
use Zend\Expressive\Container\NotFoundDelegateFactory;
use Zend\Expressive\Container\NotFoundHandlerFactory;
use Zend\Expressive\Delegate\DefaultDelegate;
use Zend\Expressive\Delegate\NotFoundDelegate;
use Zend\Expressive\Helper\ServerUrlHelper;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\ServerUrlMiddlewareFactory;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Helper\UrlHelperFactory;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddlewareFactory;
use Zend\Expressive\Middleware\ErrorResponseGenerator;
use Zend\Expressive\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Middleware\NotFoundHandler;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Router\ZendRouter;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Expressive\ZendView\HelperPluginManagerFactory;
use Zend\Expressive\ZendView\ZendViewRendererFactory;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Stratigility\Middleware\ErrorHandler;
use Zend\Stratigility\Middleware\OriginalMessages;
use Zend\View\HelperPluginManager;

return [
    'dependencies' => [
        'aliases'    => [
            DefaultDelegate::class => NotFoundDelegate::class,
        ],
        'invokables' => [
            RouterInterface::class => ZendRouter::class,
        ],
        'factories'  => [
            Application::class => ApplicationFactory::class,

            TemplateRendererInterface::class => ZendViewRendererFactory::class,

            HelperPluginManager::class => HelperPluginManagerFactory::class,

            ImplicitHeadMiddleware::class    => InvokableFactory::class,
            ImplicitOptionsMiddleware::class => InvokableFactory::class,
            OriginalMessages::class          => InvokableFactory::class,

            ServerUrlHelper::class     => InvokableFactory::class,
            UrlHelper::class           => UrlHelperFactory::class,
            ServerUrlMiddleware::class => ServerUrlMiddlewareFactory::class,
            UrlHelperMiddleware::class => UrlHelperMiddlewareFactory::class,

            ErrorHandler::class           => ErrorHandlerFactory::class,
            ErrorResponseGenerator::class => ErrorResponseGeneratorFactory::class,
            NotFoundDelegate::class       => NotFoundDelegateFactory::class,
            NotFoundHandler::class        => NotFoundHandlerFactory::class,
        ],
    ],
];
