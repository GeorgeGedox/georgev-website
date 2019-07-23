<?php
namespace Deployer;

require 'recipe/laravel.php';

set('application', 'georgev-website');
set('repository', 'git@github.com:GeorgeGedox/georgev-website.git');

set('git_tty', false);
set('allow_anonymous_stats', false);

set('deploy_server', null);

// Hosts
inventory('hosts.yml');
host('georgev.design')
    ->stage('production');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
