<?php
/**
 * Copyright (c) 2021. All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\SeoCanonicalBundleProductFrontend\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class GetAssociatedCanonicalBundleProductConfig implements GetAssociatedCanonicalBundleProductConfigInterface
{
    /**
     * XML path for default distance provider configuration value
     */
    private const XML_PATH_CANONICAL_GENERAL_ASSOCIATED_CANONICAL_BUNDLE_PRODUCT = 'hryvinskyi_seo/canonical/associated_canonical_bundle_product';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * GetDistanceProviderCode constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritdoc
     */
    public function execute(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CANONICAL_GENERAL_ASSOCIATED_CANONICAL_BUNDLE_PRODUCT);
    }
}
