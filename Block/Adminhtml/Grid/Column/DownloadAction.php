<?php
/**
 * Magepow 
 * @category    Magepow 
 * @copyright   Copyright (c) 2014 Magepow (http://www.magepow.com/) 
 * @license     http://www.magepow.com/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2020-09-30 17:38:38
 * @@Function:
 */
namespace Magepow\FacebookShopIntegration\Block\Adminhtml\Grid\Column;

class DownloadAction extends \Magento\Backend\Block\Widget\Grid\Column
{
    /**
     * Add to column download link
     *
     * @return array
     */
    public function getFrameCallback()
    {
        return [$this, 'getDownloadLink'];
    }

    /**
     * Return download csv link
     *
     * @param string                                 $value value
     * @param \Magento\Framework\Model\AbstractModel $row   row
     *
     * @return string
     */
    public function getDownloadLink($value, $row)
    {
        $fileNameArray = explode("/",(string) $row->getData('message'));
        $fileName = "";
        if(isset($fileNameArray[4])) {
            $fileName = $fileNameArray[4];
        }

        if($row->getData('generated_by') == 'cron') {
            return '';
        }

        return '<a href="'.$this->getUrl('*/csvlog/download', ['filename'=> $fileName]).'" title="'.__("Download CSV File").'">'. __("Download"). '</a>';
    }
}
