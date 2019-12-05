pipeline {
	agent none
	stages {
		stage('PHP 7.2') {
			agent {
				docker {
				    image 'php:7.2-alpine'
				    args '-u root --privileged'
				}
			}
			steps {
				sh 'apk add --no-cache php7-phpdbg'
				sh 'curl -sS https://getcomposer.org/installer | php'
				sh 'php composer.phar install
				sh 'php composer.phar run-script coverage -- --coverage-text --colors=never'
			}
		}
		stage('PHP 7.3') {
			agent {
				docker {
					image 'php:7.3-alpine'
					args '-u root --privileged'
				}
			}
			steps {
				sh 'apk add --no-cache php7-phpdbg'
				sh 'curl -sS https://getcomposer.org/installer | php'
				sh 'php composer.phar install
				sh 'php composer.phar run-script coverage -- --coverage-text --colors=never'
			}
		}
		stage('PHP 7.4') {
			agent {
				docker {
					image 'php:7.4-alpine'
					args '-u root --privileged'
				}
			}
			steps {
				sh 'apk add --no-cache php7-phpdbg'
				sh 'curl -sS https://getcomposer.org/installer | php'
				sh 'php composer.phar install
				sh 'php composer.phar run-script coverage -- --coverage-text --colors=never'
			}
		}
	}
}