<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Controller\Mui\Export;

use Magento\Framework\App\Action\Context;
use Magento\Ui\Model\Export\ConvertToXml;
use Magento\Framework\App\Response\Http\FileFactory;

/**
 * Class GridToXml used to export the grid data in to xml.
 */
class GridToXml extends \Magento\Customer\Controller\AbstractAccount
{
    /**
     * @var ConvertToXml
     */
    protected $convertToXml;

    /**
     * @var FileFactory
     */
    protected $httpFile;

    /**
     * @param Context $context
     * @param ConvertToXml $convertToXml
     * @param FileFactory $httpFile
     */
    public function __construct(
        Context $context,
        ConvertToXml $convertToXml,
        FileFactory $httpFile
    ) {
        parent::__construct($context);
        $this->convertToXml = $convertToXml;
        $this->httpFile = $httpFile;
    }

    /**
     * Export Ui list data to XML
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        return $this->httpFile->create(
            'export.xml',
            $this->convertToXml->getXmlFile(),
            'var'
        );
    }
}
