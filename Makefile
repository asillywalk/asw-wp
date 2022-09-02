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
