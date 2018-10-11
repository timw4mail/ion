pipeline {
	agent none
	stages {
		stage('PHP 7.0') {
			agent {
				docker {
					image 'php:7-alpine'
					args '-u root --privileged'
				}
			}
			steps {
				sh 'chmod +x ./build/docker_install.sh'
				sh 'sh build/docker_install.sh'
				sh 'apk add --no-cache php7-phpdbg'
				sh 'curl -sS https://getcomposer.org/installer | php'
				sh 'php composer.phar install --ignore-platform-reqs'
				sh 'php composer.phar run-script coverage -- --coverage-text'
			}
		}
		stage('PHP 7.1') {
			agent {
				docker {
				    image 'php:7.1-alpine'
				    args '-u root --privileged'
				}
			}
			steps {
				sh 'chmod +x ./build/docker_install.sh'
				sh 'sh build/docker_install.sh'
				sh 'apk add --no-cache php7-phpdbg'
				sh 'curl -sS https://getcomposer.org/installer | php'
				sh 'php composer.phar install --ignore-platform-reqs'
				sh 'php composer.phar run-script coverage -- --coverage-text'
			}
		}
		stage('PHP 7.2') {
			agent {
				docker {
				    image 'php:7.2-alpine'
				    args '-u root --privileged'
				}
			}
			steps {
				sh 'chmod +x ./build/docker_install.sh'
				sh 'sh build/docker_install.sh'
				sh 'apk add --no-cache php7-phpdbg'
				sh 'curl -sS https://getcomposer.org/installer | php'
				sh 'php composer.phar install --ignore-platform-reqs'
				sh 'php composer.phar run-script coverage -- --coverage-text'
			}
		}
	}
}