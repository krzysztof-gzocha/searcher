<?php

namespace KGzocha\Searcher\Model\FilterModel;

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
        $this->text = $text;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isImposed()
    {
        return is_string($this->text) && 0 < mb_strlen($this->text);
    }
}
