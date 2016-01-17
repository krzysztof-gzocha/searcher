<?php

namespace KGzocha\Searcher\Event\Listener;

use KGzocha\Searcher\Event\SearcherEventInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Event\Listener
 */
interface ListenerInterface
{
    /**
     * @param string $name
     *
     * @return bool
     */
    public function supports($name);

    /**
     * @param SearcherEventInterface $event
     */
    public function handle(SearcherEventInterface $event);
}
