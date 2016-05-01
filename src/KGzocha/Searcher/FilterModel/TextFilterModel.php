<?php

namespace KGzocha\Searcher\FilterModel;

class TextFilterModel implements FilterModelInterface
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
     * @return TextFilterModel
     */
    public function setText($text)
    {
        $this->text = (string) $text;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isImposed()
    {
        return $this->text !== null && 0 < mb_strlen($this->text);
    }
}
