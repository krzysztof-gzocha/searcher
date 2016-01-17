<?php

namespace KGzocha\Searcher\Test\Event\Dispatcher;

use KGzocha\Searcher\Event\Dispatcher\EventDispatcher;
use KGzocha\Searcher\Event\Listener\ListenerInterface;
use KGzocha\Searcher\Event\SearcherEventInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\Event\Dispatcher
 */
class EventDispatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testAddListener()
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener($this->getListener(true));
        $dispatcher->addListener($this->getListener(true));
        $dispatcher->addListener($this->getListener(true));

        $this->assertCount(3, $dispatcher->getListeners());
    }

    public function testDispatcher()
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener($this->getListener(false, 0));
        $dispatcher->addListener($this->getListener(false, 0));
        $dispatcher->addListener($this->getListener(false, 0));
        $dispatcher->addListener($this->getListener(false, 0));
        $dispatcher->addListener($this->getListener(true, 1));
        $dispatcher->addListener($this->getListener(false, 0));
        $dispatcher->addListener($this->getListener(false, 0));

        $dispatcher->dispatch('some event', $this->getEvent());
    }

    /**
     * @param bool $supports
     * @param int $handleCalledTimes
     *
     * @return ListenerInterface
     */
    private function getListener($supports, $handleCalledTimes = 0)
    {
        $listener = $this
            ->getMock(ListenerInterface::class);

        $listener
            ->expects($this->any())
            ->method('supports')
            ->willReturn($supports);

        $listener
            ->expects($this->exactly($handleCalledTimes))
            ->method('handle');

        return $listener;
    }

    /**
     * @return SearcherEventInterface
     */
    private function getEvent()
    {
        return $this->getMockForAbstractClass(SearcherEventInterface::class);
    }
}
