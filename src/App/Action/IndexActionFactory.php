<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 27.02.17
 * Time: 23:49
 */

namespace App\Action;


use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class IndexActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new IndexAction(
            $container->get(TemplateRendererInterface::class)
        );
    }
}