<?php
/**
 * Register Event Handler
 * Designed for v1.5.1
 * 
 * @author Mobanbase.com
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}
    
$autoLoadConfig[70][] = array(
    'autoType' => 'class',
    'loadFile' => 'observers/class.multi_observers.php'
);
$autoLoadConfig[70][] = array(
    'autoType' => 'classInstantiate',
    'className' => 'MultiObservers',
    'objectName' => 'multiObservers'
);