<?php
namespace CubicMushroom\Tools\ProjectToolbelt\Codeception;

use Codeception\Scenario;
use CubicMushroom\Tools\ProjectToolbelt\Codeception\Helper\Composer;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
 */
class FunctionalWizard extends \Codeception\Actor
{
    use _generated\FunctionalWizardActions;
}
