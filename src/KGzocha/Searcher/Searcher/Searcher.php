<?php

namespace KGzocha\Searcher\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\Event\Dispatcher\EventDispatcherInterface;
use KGzocha\Searcher\Event\Events;
use KGzocha\Searcher\Event\PostImposedEvent;
use KGzocha\Searcher\Event\PreImposedEvent;
use KGzocha\Searcher\Event\ResultsEvent;
use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollectionInterface;
use KGzocha\Searcher\Model\FilterModel\Collection\FilterModelCollectionInterface;
use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

class Searcher implements SearcherInterface
{
    /**
     * @var FilterImposerCollectionInterface
     */
    private $filterImposerCollection;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param FilterImposerCollectionInterface $filterImposerCollection
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        FilterImposerCollectionInterface $filterImposerCollection,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->filterImposerCollection = $filterImposerCollection;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function search(
        FilterModelCollectionInterface $filterCollection,
        SearchingContextInterface $searchingContext
    ) {
        $this->dispatchPreImposedEvent($searchingContext);
        foreach ($filterCollection->getImposedModels() as $filterModel) {
            $this->searchForModel($filterModel, $searchingContext);
        }
        $this->dispatchPostImposedEvent($searchingContext);
        $searchingResults = $searchingContext->getResults();
        $this->dispatchResultEvent($searchingContext, $searchingResults);

        return $searchingResults;
    }

    /**
     * @param FilterModelInterface $filterModel
     * @param SearchingContextInterface $searchingContext
     */
    private function searchForModel(
        FilterModelInterface $filterModel,
        SearchingContextInterface $searchingContext
    ) {
        $imposers = $this
            ->filterImposerCollection
            ->getFilterImposersForContext($searchingContext);

        foreach ($imposers as $imposer) {
            if ($imposer->supportsModel($filterModel)) {
                $imposer->imposeFilter($filterModel, $searchingContext);
            }
        }
    }

    /**
     * @param SearchingContextInterface $searchingContext
     */
    private function dispatchPreImposedEvent(
        SearchingContextInterface $searchingContext
    ) {
        $this->eventDispatcher->dispatch(
            Events::PRE_IMPOSED,
            new PreImposedEvent(
                $this->filterImposerCollection,
                $searchingContext
            )
        );
    }

    /**
     * @param SearchingContextInterface $searchingContext
     */
    private function dispatchPostImposedEvent(
        SearchingContextInterface $searchingContext
    ) {
        $this->eventDispatcher->dispatch(
            Events::POST_IMPOSED,
            new PostImposedEvent(
                $this->filterImposerCollection,
                $searchingContext
            )
        );
    }

    /**
     * @param SearchingContextInterface $searchingContext
     * @param mixed $results
     */
    private function dispatchResultEvent(
        SearchingContextInterface $searchingContext,
        $results
    ) {
        $this->eventDispatcher->dispatch(
            Events::RESULTS,
            new ResultsEvent(
                $this->filterImposerCollection,
                $searchingContext,
                $results
            )
        );
    }
}
