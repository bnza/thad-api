<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class VocabularySuTypeEntryProvider extends BaseProvider
{
    private array $vocSuType = [
        [
            'value' => 'accumulation',
        ],
        [
            'value' => 'cut',
        ],
        [
            'value' => 'filling',
        ],
        [
            'value' => 'floor',
        ],
        [
            'value' => 'installation',
        ],
        [
            'value' => 'skeleton',
        ],
        [
            'value' => 'trodden floor',
        ],
        [
            'value' => 'wall',
        ],
    ];

    private array $vocSuPreservationState = [
        [
            'value' => 'poor',
        ],
        [
            'value' => 'fair',
        ],
        [
            'value' => 'good',
        ],
        [
            'value' => 'excellent',
        ],
    ];

    public function getVocabularyProperty(string $vocProperty, string $property, int $i, bool $throw = false): mixed
    {
        --$i;
        if (!property_exists($this, $vocProperty)) {
            throw new \InvalidArgumentException("No such vocabulary \"$vocProperty\"");
        }
        $vocabulary = $this->{$vocProperty};
        if (!array_key_exists($i, $vocabulary)) {
            throw new \InvalidArgumentException("No such index [$i] in vocabulary \"$vocProperty\"");
        }
        if (!array_key_exists($property, $vocabulary[$i])) {
            if ($throw) {
                throw new \LogicException("Property \"$property\" must be set in a vocabulary");
            }

            return null;
        }

        return $vocabulary[$i][$property];
    }
}
