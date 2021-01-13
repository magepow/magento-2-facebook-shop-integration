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
namespace Magepow\FacebookShopIntegration\Model\Config;

class CronConfig {
    /**
     * Path for store value of cron expression
     *
     */
    const CRON_STRING_PATH = 'crontab/default/jobs/facebook_shop_integration_cron_job/schedule/cron_expr';

    /**
     * @var \Magento\Framework\App\Config\ValueFactory
     */
    protected $_configValueFactory;

    /**
     * @var string
     */
    protected $_runModelPath = '';

    /**
     * CronConfig constructor.
     * @param \Magento\Framework\App\Config\ValueFactory $configValueFactory
     * @param string $runModelPath
     */
    public function __construct(
        \Magento\Framework\App\Config\ValueFactory $configValueFactory,
        $runModelPath = ''
    ) {
        $this->_runModelPath = $runModelPath;
        $this->_configValueFactory = $configValueFactory;
    }

    /**
     * {@inheritdoc}
     *
     * @return $this
     * @throws \Exception
     */
    public function afterAfterSave(\Magento\Backup\Model\Config\Backend\Cron $subject, $result)
    {
        $time = $subject->getData('groups/general/fields/schedule_csv_time/value');
        $frequency = $subject->getData('groups/general/fields/schedule_csv_frequency/value');

        $cronExprArray = [
            (int)$time[1], //Minute
            (int)$time[0], //Hour
            $frequency == \Magento\Cron\Model\Config\Source\Frequency::CRON_MONTHLY ? '1' : '*', //Day of the Month
            '*', //Month of the Year
            $frequency == \Magento\Cron\Model\Config\Source\Frequency::CRON_WEEKLY ? '1' : '*', //Day of the Week
        ];
        
        $cronExprString = join(' ', $cronExprArray);

        try {
            $this->_configValueFactory->create()->load(
                self::CRON_STRING_PATH,
                'path'
            )->setValue(
                $cronExprString
            )->setPath(
                self::CRON_STRING_PATH
            )->save();
        } catch (\Exception $e) {
            throw new \Exception(__('We can\'t save the cron expression.'));
        }
    }
}
