# FreeAsso wordpress plugin
---

Ce plugin permet de récupérer certains éléments de l'administration gérée par FreeAsso.

## Description

### Statistiques

* Le nombre d'amis (membres effectuant des dons réguliers, tous programmes confondus),
* Le nombre d'animaux présents dans les différents programmes,
* Des variables saisies directement dans l'administration FreeAsso,

### Animaux

* Une liste d'animaux selon certains critères (cf ci-dessous pour les filtres)
* La fiche d'un animal

### Données des filtres

## Partie technique

### Insérer une donnée issue des statistiques directement dans le template

Il est possible d'ajouter une information directement dans le template, via du code PHP

```
    ...
    <?php $freeassoStats = Freeasso_Api_Stats::getFactory();?>
    ...
    <p>Kalaweit a déjà <?php echo $freeassoStats->getAmis(); ?> amis;<p>
    ...
```

* getAmis
* getGibbons
* getHectares

Par défaut ces méthodes retournent le résultat formaté. Pour avoir la valeur brute, il faut passer "false" en paramètre.

### Insérer une donnée issue des statistiques via une substitution

Il est également possible d'utiliser une chaine de remplacement à placer dans le contenu. Il suffit ensuite d'appeler un hook sur le bon élément.

```
    add_filter('the_content', ['Freeasso', 'filterStats']);
```

Il faut suivre le pattern de remplacement ci-dessous :

```
[[:FREEASSO_AMIS:]]
```
* FREEASSO_AMIS
* FREEASSO_GIBBONS
* FREEASSO_HECTARES
