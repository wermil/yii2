<?php

use frontend\layouts\helpers\AdminLteHelper;
use yii\helpers\Url;

?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <?= AdminLteHelper::sidebarItem('/dashboard/main', Url::current(), 'fas fa-chart-line', 'Dashboard') ?>
            <li class="treeview <?= AdminLteHelper::sidebarDefineActiveTreeviewItem(['/user/administration'], Url::current()) ?>">
                <?= AdminLteHelper::sidebarTreeviewItem('fas fa-cogs', 'Administration') ?>
                <ul class="treeview-menu">
                    <?= AdminLteHelper::sidebarItem('/user/administration', Url::current(), 'fas fa-users', 'Users') ?>
                </ul>
            </li>
        </ul>
</aside>
