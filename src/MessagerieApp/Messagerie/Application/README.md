### Couche Applicative

La couche applicative manipule deux types de données :
* les aggrégats du domaine, construits par des fabriques du domaine respectant toutes les règles asssociées.
* les types primitifs ou value object ou DTO pour permettre la fabrication des objets précédemment cités.

La couche applicative étant plus haut que la couche infrastructure, elle peut instancier de l'infra.  
Si l'infrastructure instanciée implémente les interfaces du domaine, les opérations de facto contractualisées permettent la transmission hyperplannique de la sémantique associée aux symboles associés au métier.

