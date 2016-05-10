<?php

namespace KGzocha\Searcher\QueryCriteria;

class TextQueryCriteria implements QueryCriteriaInterface
{
    /**
     * @var string
     */
    private $text;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return TextQueryCriteria
     */
    public function setText($text)
    {
        $this->text = (string) $text;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->text !== null && 0 < mb_strlen($this->text);
    }
}
