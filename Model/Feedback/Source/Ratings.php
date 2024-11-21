<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model\Feedback\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Ratings is used tp get the Feedback rating options
 */
class Ratings implements OptionSourceInterface
{
    /**
     * @var \Hts\Marketplace\Model\Feedback
     */
    protected $marketplaceFeedback;

    /**
     * Constructor
     *
     * @param \Magento\Cms\Model\Page $cmsPage
     */
    public function __construct(\Hts\Marketplace\Model\Feedback $marketplaceFeedback)
    {
        $this->marketplaceFeedback = $marketplaceFeedback;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->marketplaceFeedback->getAllRatingOptions();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'row_label' =>  '<span class="mpfeedback"><span class="ratingslider-box">
                <span class="rating" style="width:'.$key.'%;"></span>
            </span></span>',
                'value' => $key,
            ];
        }
        return $options;
    }
}
