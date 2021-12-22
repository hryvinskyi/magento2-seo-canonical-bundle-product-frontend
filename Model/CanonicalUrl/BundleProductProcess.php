<?php
/**
 * Copyright (c) 2021. All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\SeoCanonicalBundleProductFrontend\Model\CanonicalUrl;

use Hryvinskyi\SeoCanonicalApi\Api\CanonicalUrl\ProcessInterface;
use Hryvinskyi\SeoCanonicalApi\Api\CheckIsProductEnabledInterface;
use Hryvinskyi\SeoCanonicalBundleProductFrontend\Model\GetAssociatedCanonicalBundleProductConfigInterface;
use Magento\Bundle\Model\Product\Type;

class BundleProductProcess implements ProcessInterface
{
    /**
     * @var GetAssociatedCanonicalBundleProductConfigInterface
     */
    private $config;

    /**
     * @var Type
     */
    private $productTypeBundle;

    /**
     * @var CheckIsProductEnabledInterface
     */
    private $checkIsProductEnabled;

    /**
     * @param GetAssociatedCanonicalBundleProductConfigInterface $config
     * @param Type $productTypeBundle
     * @param CheckIsProductEnabledInterface $checkIsProductEnabled
     */
    public function __construct(
        GetAssociatedCanonicalBundleProductConfigInterface $config,
        Type $productTypeBundle,
        CheckIsProductEnabledInterface $checkIsProductEnabled
    ) {
        $this->config = $config;
        $this->productTypeBundle = $productTypeBundle;
        $this->checkIsProductEnabled = $checkIsProductEnabled;
    }

    /**
     * @inheritDoc
     */
    public function execute(array &$data): void
    {
        if (isset($data['associatedProductId']) === false && $this->config->execute() === true
            && ($parentBundleProductIds = $this->productTypeBundle->getParentIdsByChild($data['productId']))
            && isset($parentBundleProductIds[0])
            && $this->checkIsProductEnabled->executeById((int)$parentBundleProductIds[0])
        ) {
            $data['associatedProductId'] = $parentBundleProductIds[0];
        }
    }
}
