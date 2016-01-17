<?php

namespace KGzocha\Searcher\Event\Dispatcher;

use KGzocha\Searcher\Event\Listener\ListenerInterface;
use KGzocha\Searcher\Event\SearcherEventInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Event\Dispatcher
 */
class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var ListenerInterface[]
     */
    private $listeners;

    public function __construct()
    {
        $this->listeners = [];
    }

    /**
     * @param string $name
     * @param SearcherEventInterface $event
     */
    public function dispatch($name, SearcherEventInterface $event)
    {
        foreach ($this->getListeners() as $listener) {
            if ($listener->supports($name)) {
                $listener->handle($event);
            }
        }
    }

    /**
     * @return ListenerInterface[]
     */
    public function getListeners()
    {
        return $this->listeners;
    }

    /**
     * @param ListenerInterface $listeners
     */
    public function addListener(ListenerInterface $listeners)
    {
        $this->listeners[] = $listeners;
    }
}
