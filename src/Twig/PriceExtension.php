<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PriceExtension extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'price'])
        ];
    }

    public function price($value, $decimalSeparator = ',', $thousandSeparator = ' ', $currency = '€')
    {
        return number_format($value / 100, 2, $decimalSeparator, $thousandSeparator) . ' ' . $currency;
    }

}