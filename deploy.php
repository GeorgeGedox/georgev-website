<?php
namespace Deployer;

require 'recipe/laravel.php';

set('application', 'georgev-website');
set('repository', 'git@github.com:GeorgeGedox/georgev-website.git');

set('git_tty', false);
set('allow_anonymous_stats', false);

set('deploy_server', null);
$serverHost = "{{ deploy_server }}";

// Hosts
host('Production Server')
    ->hostname($serverHost)
    ->user('deployer')
    ->port(22)
    ->forwardAgent(true)
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->stage('production')
    ->roles('app')
    ->set('deploy_path', '/var/www/georgev.design')
    ->set('branch', 'master')
    ->set('http_user', 'www-data');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
