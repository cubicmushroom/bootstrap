<?php

use CubicMushroom\Tools\ProjectToolbelt\Codeception\FunctionalWizard;

/** @var \Codeception\Scenario $scenario */
$I = new FunctionalWizard($scenario);
$I->wantTo('bootstrap a new, empty project');

$I->haveInitialisedComposer();

$I->cleanDir(TEST_ROOT);
$I->runTheCommand('bootstrap', ['path' => TEST_ROOT]);
$I->seeOutput('Bootstrapping project in '.TEST_ROOT);
$I->seeOutput('Creating package.json file');
$I->seeFileFound('package.json', TEST_ROOT);
//$I->seeOutput('Creating gulpfile.js file');
//$I->seeFileFound('gulpfile.js', TEST_ROOT);
//$I->seeFileFound('index.js', TEST_ROOT.'/node_modules/gulp');
//$I->seeFileFound('index.js', TEST_ROOT.'/node_modules/gulp-cm-phpspec-tasks');
//$I->seeFileFound('index.js', TEST_ROOT.'/node_modules/gulp-codeception');
//$I->seeFileFound('index.js', TEST_ROOT.'/node_modules/gulp-notify');