<?php
declare(strict_types=1);
namespace In2code\Publications\ViewHelpers\Format;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class MonthNameFromNumberViewHelper
 */
class MonthNameFromNumberViewHelper extends AbstractViewHelper implements SingletonInterface
{

    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('month', 'string', 'Name or number', true);
        $this->registerArgument('limit', 'int', 'Optional limit for characters', false, 0);
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $month = $this->arguments['month'];
        if (MathUtility::canBeInterpretedAsInteger($month)) {
            $month = LocalizationUtility::translate('month.' . $month, 'publications');
        }
        if ($this->arguments['limit'] > 0 && strlen($month) > $this->arguments['limit']) {
            $month = substr($month, 0, (int)$this->arguments['limit']);
            $month .= '.';
        }
        return $month;
    }
}
