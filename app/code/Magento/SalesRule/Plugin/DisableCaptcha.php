<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\SalesRule\Plugin;

use Magento\Captcha\Block\Captcha\Checkout\DisableCaptchaProcessor;
use Magento\Captcha\Helper\Data;

class DisableCaptcha
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param DisableCaptchaProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(DisableCaptchaProcessor $subject, array $jsLayout): array
    {
        if (!(bool)$this->helper->getConfig('enable')) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']
            ['afterMethods']['children']['discount']['children']['captcha']['config']['componentDisabled'] = true;
        }
        return $jsLayout;
    }
}
