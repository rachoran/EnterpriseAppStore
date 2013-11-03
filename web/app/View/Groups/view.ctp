<?php

// Breadcrumbs
$this->Html->addCrumb('Groups', '/groups');
$this->Html->addCrumb($group['Group']['name'], '/groups/view/'.$group['Group']['id'].'/'.$group['Group']['name']);

