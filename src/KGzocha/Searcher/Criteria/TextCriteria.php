<?php

namespace KGzocha\Searcher\Criteria;

class TextCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    private $text;

    /**
     * @param string $text
     */
    public function __construct($text = null)
    {
        $this->text = $text;
    }

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
     * @return TextCriteria
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
