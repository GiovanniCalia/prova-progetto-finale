Progetto Laravel con login
Inizializzazione
Creare la cartella del progetto
Entrare dal terminale nella cartella
composer create-project --prefer-dist laravel/laravel:^7.0 .
Only for Laravel <= 7
composer remove fzaninotto/faker
composer require fakerphp/faker
Se volete usare la laravel-debugbar
composer require barryvdh/laravel-debugbar --dev
composer require laravel/ui:^2.4
php artisan ui vue --auth
(eventuali altre librerie per altre cose come: gestione ruoli, generazione slug)
Su package.json modificare:
"bootstrap": "^4.0.0", in "bootstrap": "^5.1.3", (o comunque la versione che si vuole usare)
"popper.js": "^1.12", in "@popperjs/core": "^2.11.5",
Su resorces/js/bootstrap.js commentare:
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
npm install
php artisan make:model --all Post
Spostare il file app/Http/Controllers/HomeController.php nella cartella Admin
Nel file appena spostato:
modificare namespace App\Http\Controllers; in namespace App\Http\Controllers\Admin;
aggiungere una riga nuova con use App\Http\Controllers\Controller; (alternativa)
Cancellare il controller generato in app/Http/Controllers
php artisan make:controller --model=Post Admin/PostController (fine alternativa)
composer dump-autoload
Nel file app/Providers/RouteServiceProvider.php modificare:
public const HOME = '/home'; in public const HOME = '/admin'; (oppure quello che avete messo voi)
Se serve modificare il file app/Http/Middleware/Authenticate.php:
return route('login'); con la route che volete voi
Database
Creare il database da phpMyAdmin oppure da linea di comando o come volete
Nel file .env aggiornare i dati del database (quelli che iniziano con DB_) e giacchè anche APP_NAME col nome della vostra app
Aggiornare i file delle migrations
Aggiornare il file DatabaseSeeder.php aggiungendo $this->call(ModelSeeder::class); per ogni model di cui abbiamo il seeder
Aggiornare i file dei seeders
agiungere use Faker\Generator as Faker;
modificare public function run() a public function run(Faker $faker)
(slugs cercate nei file del progetto per dettagli)
Nel model impostare la proprietà $fillable con le colonne che possono essere "mass assigned"
Views
Organizzare la cartella resources/views con:
una sottocartella admin (con le sottocartelle per ciascun model risorsa) e spostare home.blade.php dentro admin
una sottocartella guests
Avviare l'ambiente locale
npm run watch
php artisan serve
CHIUDERE TUTTE LE TAB IN VISUAL STUDIO CODE

Relazioni

Creare tutti i Model & Co. che ci servono (migration, seeder, controller, ...): php artisan make:model --all ModelName
Relazioni one-to-many: Devono essere definite sia sulla migration che su ciascuno dei due model interessati:

nella migration va specificata la foreign key:
create la colonna che conterrà la foreign key: $table->unsignedBigInteger('model_id')
definire la foreign key: $table->foreign('model_id')->references('id')->on('tableNameOfModel')
nei models va definita un nuovo metodo:
ModelA:
public function modelbs () { return $this->hasMany('App\ModelB'); }
ModelB (ha la chiave esterna):
public function modela () { return $this->belongsTo('App\ModelA'); }
Relazioni many-to-many:

create una migration per la tabella ponte (senza model) con nome tipo create_post_tag_table (i nomi dei models vanno inseriti al singolare e in ordine alfabetico)

nella migration vanno specificate le due foreign keys: $table->unsignedBigInteger('post_id'); $table->foreign('post_id')->references('id')->on('posts');

$table->unsignedBigInteger('tag_id'); $table->foreign('tag_id')->references('id')->on('tags');

$table->primary(['post_id', 'tag_id']);

nei models va definita un nuovo metodo:

Post: public function tags() { return $this->belongsToMany('App\Tag'); }
Tag: public function posts() { return $this->belongsToMany('App\Post'); }
Implementare Vue

separare js per il front office e per il back office in webpack.mix.js: mix.js('resources/js/admin.js', 'public/js')
.js('resources/js/front.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css');

nelle view andare ad usare i file js e css corretti:

<script src="{{ asset('js/admin.js') }}" defer></script>
oppure

<script src="{{ asset('js/front.js') }}" defer></script>
e gli stili

require('./bootstrap');

window.Vue = require('vue'); window.Axios = require('axios');

import App from './views/App.vue';

const app = new Vue({ el: '#app', render: h => h(App), });

se serve il router:

npm install vue-router@3

fare una cartella Pages dove mettere i componenti specifici delle pagine

aggiornare il file front.js: import VueRouter from 'vue-router'; // import di tutte le pagine

Vue.use(VueRouter);

const router = new VueRouter({ mode: 'history', routes: [ { path: '/', name: 'home', component: PageHome, }, // ... { path: '/blog/:slug', name: 'postShow', component: PostShow, props: true, }, { path: '*', name: 'page404', component: Page404, }, ], });

const app = new Vue({ el: '#app', render: h => h(App), router, });

a questo punto usare:

https://v2.vuejs.org/v2/guide/
https://router.vuejs.org/
https://laravel.com/docs/7.x/