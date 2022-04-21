<?php

namespace App\Tests\Behat\Context;

use App\Entity\Product;
use App\Factory\ProductFactory;
use App\Repository\ProductRepository;
use App\Tests\Behat\Service\Storage\Storage;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

class ProductContext implements Context
{
    private Storage $storage;
    private ProductFactory $productFactory;
    private ProductRepository $productRepository;

    public function __construct(
        Storage $storage,
        ProductFactory $productFactory,
        ProductRepository $productRepository
    ) {
        $this->storage = $storage;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    /**
     * @Given /^there is a (product?[^']+) "([^"]+)" priced at ([^"]+)$/
     * @Given /^there is(?:| also) (product?[^']+) "([^"]+)"$/
     */
    public function thereIsAProductPricedAt($identifier, $title, $price = 0)
    {
        $product = $this->productFactory->create($title, $price);

        $this->productRepository->add($product);

        $this->storage->put($identifier, $product);
    }

    /**
     * @Given /^(the (product?[^']+)) price is (\d+)$/
     */
    public function theProductPriceIs(Product $product, string $identifier, int $price)
    {
        $product->setPrice($price);

        $this->productRepository->add($product);

        $this->storage->put($identifier, $product);
    }

    /**
     * @Given /^(the ([^']+)) title is (\d+)$/
     */
    public function theProductTitleIs(Product $product, string $identifier, string $title)
    {
        $product->setTitle($title);

        $this->productRepository->add($product);

        $this->storage->put(
            $identifier,
            $product
        );
    }

    /**
     * @When /^(its) price is changed to (\d+)$/
     */
    public function itsPriceIsChangedTo(Product $product, $price)
    {
        $product->setPrice($price);

        $this->productRepository->add($product);

        $this->storage->put('product', $product);
    }

    /**
     * @Then /^(its) price is (\d+)$/
     */
    public function itsPriceIs(Product $product, $price)
    {
        $product = $this->productRepository->find($product->getId());

        Assert::assertEquals($price, $product->getPrice());
    }
}