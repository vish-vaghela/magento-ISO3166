<?php
/**
 * Copyright © Dhairvi Solutions. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dhairvi\ISO3166\Model;

use Magento\Framework\File\Csv;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Module\Dir\Reader;
use Psr\Log\LoggerInterface;

/**
 * Class Collection
 */
class Collection extends AbstractModel
{
    /**
     * @var Reader
    */
    protected $moduleReader;

    /**
     * @var File
     */
    protected $fileDriver;

    /**
     * @var Csv
     */
    protected $csvParser;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Collection constructor.
     * @param Reader $moduleReader
     * @param File $fileDriver
     * @param Csv $csvParser
     * @param LoggerInterface $logger
     */
    public function __construct(
        Reader $moduleReader,
        File $fileDriver,
        Csv $csvParser,
        LoggerInterface $logger
    ) {
        $this->moduleReader = $moduleReader;
        $this->fileDriver = $fileDriver;
        $this->csvParser = $csvParser;
        $this->logger = $logger;
    }

    public function getRwModuleDir()
    {
        $etcDir = $this->moduleReader->getModuleDir(
            \Magento\Framework\Module\Dir::MODULE_ETC_DIR,
            'Dhairvi_ISO3166'
        );

        return $etcDir;
    }

    public function getFileData($fulldata = true, $keyIndex = 0, $valueIndex = 1)
    {
        $data = [];
        $file = $this->getRwModuleDir().'/iso_3166_data.csv';

        try {
             if ($this->fileDriver->isExists($file)) {
                $this->csvParser->setDelimiter(',');
                if ($fulldata) {
                    $data = $this->csvParser->getData($file, $keyIndex, $valueIndex);
                } else {
                    $data = $this->csvParser->getDataPairs($file, $keyIndex, $valueIndex);
                }
                return $data;
            } else {
                $this->logger->info('ISO 3166 FIND DOES NOT FOUND');
                return false;
            }
        } catch (FileSystemException $e) {
            $this->logger->info($e->getMessage());
            return false;
        }
    }

    public function getCollection()
    {
        $data = $this->getFileData();

        return $data;
    }

    /**
     * Get Country Numeric Code by Alpha-2 Code
     * 
     * @param $code
     * @return mixed|string
     */
    public function getNumericCodeByCountryCode($code)
    {
        $code = strtoupper($code);
        $data = $this->getFileData(false,2,4);
        
        return !empty($data[$code]) ? $data[$code] : '';
    }

    /**
     * Get Country Numeric Code by Alpha-3 Code
     * 
     * @param $code
     * @return mixed|string
     */
    public function getNumericCodeByCountryCode3($code)
    {
        $code = strtoupper($code);
        $data = $this->getFileData(false,3,4);
        
        return !empty($data[$code]) ? $data[$code] : '';
    }

    /**
     * Get Alpha-2 Code by Numeric Code
     * 
     * @param $code
     * @return mixed|string
     */
    public function getCountryTwoDigitCodeByNumericCode($code)
    {
         $data = $this->getFileData(false,4,2);

         return !empty($data[$code]) ? $data[$code] : '';
    }

    /**
     * Get Alpha-3 Code by Numeric Code
     * @param $code
     * @return mixed|string
     */
    public function getCountryThreeDigitCodeByNumericCode($code)
    {
         $data = $this->getFileData(false,4,3);

         return !empty($data[$code]) ? $data[$code] : '';
    }

    /**
     * Get Country Name by Numeric Code
     * 
     * @param $code
     * @return mixed|string
     */
    public function getCountryNameByNumericCode($code)
    {
         $data = $this->getFileData(false,4,0);

         return !empty($data[$code]) ? $data[$code] : '';
    }

    /**
     * Get Country Name by Two Digit Code
     * 
     * @param $code
     * @return mixed|string
     */
    public function getCountryNamebyTwoDigitCode($code)
    {
        $code = strtoupper($code);
        $data = $this->getFileData(false,2,0);
        
        return !empty($data[$code]) ? $data[$code] : '';
    }

    /**
     * Get Country Name by Numeric Code
     * 
     * @param $code
     * @return mixed|string
     */
    public function getCountryNamebyThreeDigitCode($code)
    {
        $code = strtoupper($code);
        $data = $this->getFileData(false,3,0);
        
        return !empty($data[$code]) ? $data[$code] : '';
    }
}
