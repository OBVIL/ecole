# Administration

http://obvil.paris-sorbonne.fr/corpus/ecole/pull.php<br/>
Avec le mot de passe fixé ci-dessous, appuyez sur le bouton mettre à jour.

Le programme délivrera deux séquences d’informations

* les messages de la mise à jour distante : un git pull.
* la liste des fichiers qui seront transformés, avec si nécessaires les messages d’erreurs, souvent, fichier XML mal formé, ou message très verbeux de transformation kindle (exigeante : pas de lien mort, langue &lt;TEI xml:lang="fr">.


# Installation web avec accès SSH

La procédure suivante a été testée sur les serveurs OBVIL. Un administrateur averti saura transposer à son architecture (notamment, “corpus” est le nom du corpus = le nom de l’entrepôt)

A l’issue de l’installation décrite plus bas, l’arbre de fichiers aboutira à ceci :

```
Livrable/ (pour epub, lecture seule, git clone https://github.com/oeuvres/Livrable.git)
Teinte/ (publication web, lecture seule, git clone https://github.com/oeuvres/Teinte)

corpus/ (le corpus, accessible en écriture au serveur apache)
   _conf.php (source du fichier de configuration)
   .htaccess (redirections Apache pour URL propres)
   conf.php (fichier de configuration modifié, avec le mot de passe)
   index.php (page de publication)
   pull.php (page d’administration)
   
   # dossier générés
   
   article/ (les textes affichés)
   toc/ (dossier généré, les tables des matières)
   epub/ (livres électroniques ouvert, epub)
   kindle/ (livres électroniques kindle, mobi)
   xml/ (sources XML/TEI des textes)
```
   
```sh
# Dans le dossier web de votre serveur hhtp.
# Créer à l’avance le dossier de destination avec les bons droits
mkdir corpus
# assurez-vous que le dossier appartient à un groupe où vous êtes
# donnez-vous les droits d’y écrire
# l’option +s permet de propager le nom du groupe dans le dossier
# plus facile à faire maintenant qu’après
chmod g+sw corpus
# Aller chercher les sources de cet entrepôt
git clone https://github.com/obvil/corpus
# rentrer dans le dossier
cd corpus
# donner des droits d’écriture à votre serveur sur ce dossier, ici, l’utilisateur apache
# . permet de toucher les fichiers cachés, et notamment, ce qui est dans .git
sudo chown -R apache .
# copier la conf par défaut 
cp _conf.php conf.php
# modifier le mot de passe 
vi conf.php
```

Dans la ligne<br/>
"pass" => ""<br/>
remplacer null par une chaîne entre guillemets<br/>
"pass" => "MonMotDePasseQueJeNeRetiensJamais"

Aller voir votre site dans un navigateur, ex:
<br/>http://obvil.paris-sorbonne.fr/corpus/corpus
<br/>Si aucun texte apparaît, c’est normal, vous êtes invité à visiter la page d’administration
<br/>http://obvil.paris-sorbonne.fr/corpus/corpus/pull.php


## Erreurs rencontrées

Dans l’interface web de mise à jour

error: cannot open .git/FETCH_HEAD: Permission denied
<br/>Problème de droits, Apache ne peut pas écrire dans le dossier git
<br/>solution, dans le dossier :
<br/>sudo chown -R apache .

article/ impossible à créer.
<br/>Problème de droits, Apache ne peut pas écrire dans le dossier git
<br/>solution, dans le dossier
<br/>sudo chown -R apache .

```
From https://github.com/OBVIL/corpus
   3d04adf..be29dad  gh-pages   -> origin/gh-pages
error: Your local changes to the following files would be overwritten by merge:
	.htaccess
Please, commit your changes or stash them before you can merge.
Aborting
Updating 3d04adf..be29dad
```
Vous avez changé vous même un fichier sur votre serveur, par FTP ou SSH, il n’est plus synchrone avec le Git, le supprimer du serveur et l’établir comme vous le souhaitez dans le git.
