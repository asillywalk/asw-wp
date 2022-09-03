dev:
	@ddev start
	@ddev composer install
	@ddev exec npm i
	@ddev exec npm run watch

build:
	@ddev start
	@ddev composer install
	@ddev exec npm i
	@ddev exec npm run build

favicons:
	@ddev exec npm run build:favicons

log:
	@tail -n 60 -f public/wp-content/debug.log

lint:
	@ddev exec npm run lint
	@ddev composer lint


#===============================================================================
#== CI AREA ····································································
#_______________________________________________________________________________

test:
	npm i &&\
	npm run lint

ci-test-php:
	composer lint

ci-build:
	npm i &&\
	npm run build &&\
	npm run build:favicons
