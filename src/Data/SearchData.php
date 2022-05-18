<?php

namespace App\Data;

class SearchData
{
    /**
     * @var string
     */
    public $inputSearch = '';

    /**
     * @var string
     */
    public $category = '';

    /**
     * @var null|integer
     */
    public $maxPrice;

    /**
     * @var null|integer
     */
    public $minPrice;

    /**
     * @var null|integer
     */
    public $maxMarketCap;

    /**
     * @var null|integer
     */
    public $minMarketCap;
}
