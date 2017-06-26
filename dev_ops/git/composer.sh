#!/usr/bin/env bash

# Check if a composer.json file is present
if [ -f composer.json ]; then

    # Detect composer binary
    if which composer >/dev/null; then
        composer='composer'
    elif which composer.phar >/dev/null; then
        composer='composer.phar'
    else
        # Install composer
        curl -s http://getcomposer.org/installer | php >/dev/null
        composer='php composer.phar'
    fi

    # Run composer if composer.json is updated
    if [ ! -e composer.lock ] || [ composer.json -nt composer.lock ]; then

        # Install or update depending on lock file
        echo "Updating Composer packages"
        [ ! -f composer.lock ] && $composer install || $composer update

    else

        # Regenerating autoload files
        echo "Composer packages up to date"
        $composer dump-autoload

    fi
fi

changed_files="$(git diff-tree -r --name-only --no-commit-id ORIG_HEAD HEAD)"

check_run() {
	echo "$changed_files" | grep --quiet "$1" && eval "$2"
}

# update composer
check_run composer.json "php composer.phar dumpautoload -o"