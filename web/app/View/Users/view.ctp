<?php

// Breadcrumbs
$this->Html->addCrumb('Users', '/users');
$this->Html->addCrumb($user['User']['fullname'], '/categories/view/'.$user['User']['id'].'/'.$user['User']['username']);

