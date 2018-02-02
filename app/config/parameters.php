<?php

$globalMenuPrefix = getenv('AFUP_GLOBAL_MENU_PREFIX');
if (false === $globalMenuPrefix) {
    $globalMenuPrefix = 'https://afup.org';
}
$container->setParameter('global_menu_prefix',  $globalMenuPrefix);
