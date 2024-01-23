Make copy of .env-example.

Commands to run:
npm i
composer install
./vendor/bin/sail up
./vendor/bin/sail key:generate
./vendor/bin/sail migrate
npm run dev
