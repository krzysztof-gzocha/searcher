<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class TextCriteria implements CriteriaInterface
{
    /**
     * @var string|null
     */
    private $text;

    /**
     * @param string $text
     */
    public function __construct(string $text = null)
    {
        $this->text = $text;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text = null)
    {
        $this->text = $text;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->text !== null && 0 < mb_strlen($this->text);
    }
}
