<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'dude');

// Project repository
set('repository', 'git@gitlab.com:lauronianjohn/dude.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('104.248.184.81')
->user('dude')
->identityFile('~/.ssh/dude')
    ->set('deploy_path', '/var/www/reveloease.co');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

task('deploy:update_code', function () {
    upload('.', '{{release_path}}');
});