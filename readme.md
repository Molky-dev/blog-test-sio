<h1>Installer le blog avec symfony sur Debian</h1>

<h2>Prérequis</h2>

<ul>
<li>Un serveur web (apache, nginx, etc.)</li>
<li>PHP 8.2 ou supérieur</li>
<li>Composer 2.5.8>=</li>
</ul>

<h2>Installation des paquets prérequis</h2>

<p>Mettre à jour le APT</p>

<pre><code>sudo apt update
</code></pre>

<p>Installation de SQLite et Apache</p>

<pre><code>sudo apt install apache2 sqlite3
</code></pre>

<p>Installation de composer</p>

<pre><code>sudo apt install composer
</code></pre>

<pre><code>composer require symfony/asset
</code></pre>

<h1>Installer CURL et Symfony</h1>

<p>Installer CURL</p>

<pre><code>sudo apt install curl
</code></pre>

<p>Installer Symfony</p>

<pre><code>curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
sudo apt install symfony-cli
</code></pre>

<p>Installer PHP et les extensions nécessaires</p>

<pre><code>sudo dpkg -l | grep php | tee packages.txt
sudo add-apt-repository ppa:ondrej/php # Press enter when prompted.
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-{bz2,curl,mbstring,intl, xml, zip}
sudo apt install libapache2-mod-php8.2
</code></pre>

<h2>Installation</h2>

<p>Cloner le projet dans le dossier de votre choix</p>

<pre><code>git clone
</code></pre>

<p>Installer les dépendances</p>

<pre><code>composer install
</code></pre>

<p>Créer la base de données</p>

<pre><code>php bin/console doctrine:database:create
</code></pre>

<p>Créer les tables</p>

<pre><code>php bin/console doctrine:migrations:migrate
</code></pre>

<p>Charger les données de test</p>

<pre><code>php bin/console doctrine:fixtures:load
</code></pre>



<span>Pensez à vérifier la configuration du site apache</span>

<p>Vous pouvez maintenant accéder au blog à l'adresse suivante : <a href="http://localhost:8000">http://localhost:8000</a></p>
