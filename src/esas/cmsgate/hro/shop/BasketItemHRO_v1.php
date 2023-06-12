<?php


namespace esas\cmsgate\hro\shop;


use esas\cmsgate\utils\htmlbuilder\Attributes as attribute;
use esas\cmsgate\utils\htmlbuilder\Elements as element;
use esas\cmsgate\utils\htmlbuilder\presets\BootstrapPreset as bootstrap;


class BasketItemHRO_v1 implements BasketItemHRO
{
    protected $image;
    protected $productId;
    protected $productName;
    protected $productSKU;
    protected $productDescription;
    protected $price;
    protected $currency;
    protected $count;
    protected $countInputId;
    protected $maxCount;
    protected $productLink;

    /**
     * @inheritDoc
     */
    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setProductName($productName) {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setProductSKU($productSKU) {
        $this->productSKU = $productSKU;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setProductDescription($productDescription) {
        $this->productDescription = $productDescription;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCount($count) {
        $this->count = $count;
        return $this;
    }

    public function setCountInputId($countInputId) {
        $this->countInputId = $countInputId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMaxCount($maxCount) {
        $this->maxCount = $maxCount;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setProductLink($productLink) {
        $this->productLink = $productLink;
        return $this;
    }

    public static function builder() {
        return new BasketItemHRO_v1();
    }

    public function build() {
        return
            bootstrap::elementRowExt("gy-2",
                $this->elementColumnImg(),
                $this->elementColumnNameAmdDetails(),
                $this->elementColumnPrice(),
                $this->elementColumnCount(),
                $this->elementColumnTotal()
            );
    }

    public function elementColumnImg() {
        return bootstrap::elementDiv("col-4 col-md-2",
            element::img(
                attribute::src($this->image),
                attribute::clazz('img-thumbnail'),
                attribute::width('200')
            )
        );
    }

    public function elementColumnNameAmdDetails() {
        return bootstrap::elementDiv("col-8 col-md-4",
            element::h5($this->productName),
            element::p($this->productDescription)
        );
    }

    public function elementColumnPrice() {
        return bootstrap::elementDiv("col-4 col-sm-5 col-md-2",
            element::h6(
                attribute::clazz('mt-2'),
                $this->price . ' ' . $this->currency),
            bootstrap::elementPMuted('Цена за 1 шт'),
            element::input(
                attribute::type('hidden'),
                attribute::id($this->productPriceId()),
                attribute::value($this->price),
                attribute::clazz('basket_item_price')
            )
        );
    }

    public function elementColumnCount() {
        return bootstrap::elementDiv("col-3 col-sm-2",
            element::input(
                attribute::type('number'),
                attribute::id($this->productCountId()),
                attribute::clazz('form-control basket_item_count'),
                attribute::onInput("multiply('" . $this->productPriceId() . "', '" . $this->productCountId() . "', '" . $this->productTotalId() . "' )"),
                attribute::value($this->count),
                attribute::max($this->maxCount),
                attribute::name($this->countInputId),
                attribute::min(0)
            ),
            bootstrap::elementPMuted('шт')
        );
    }

    public function elementColumnTotal() {
        return bootstrap::elementDiv("col-4 col-sm-5 col-md-2",
            element::h6(
                attribute::clazz('mt-2'),
                element::span(
                    attribute::id($this->productTotalId()),
                    attribute::clazz('basket_item_total'),
                    $this->price * $this->count
                ),
                ' ' . $this->currency
            ),
            bootstrap::elementPMuted('Стоимость')
        );
    }

    public function productPriceId() {
        return 'product_price_' . $this->productId;
    }

    public function productCountId() {
        return 'product_count_' . $this->productId;
    }

    public function productTotalId() {
        return 'product_total_' . $this->productId;
    }
}