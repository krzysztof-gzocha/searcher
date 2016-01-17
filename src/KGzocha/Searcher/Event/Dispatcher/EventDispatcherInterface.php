<?php
namespace KGzocha\Searcher\Event\Dispatcher;

use KGzocha\Searcher\Event\SearcherEventInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Event\Dispatcher
 */
interface EventDispatcherInterface
{
    public function dispatch($name, SearcherEventInterface $event);
}
