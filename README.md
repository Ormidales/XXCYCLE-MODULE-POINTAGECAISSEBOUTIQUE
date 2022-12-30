---

# XXCYCLE-MODULE-POINTAGECAISSEBOUTIQUE
## Version 1.4.1

Ce code PHP est une extension pour le CMS PrestaShop qui ajoute une nouvelle fonctionnalité de pointage et d'encaissement de boutique dans l'interface d'administration de PrestaShop. La fonctionnalité est accessible via une nouvelle page dans l'interface d'administration, accessible via le menu "Modules" puis "Pointage Encaissement Boutique".

La page d'accueil de la fonctionnalité comprend un formulaire permettant de sélectionner une date, un mode (nom de la boutique) et un type de paiement. Lorsque le formulaire est soumis, la page affiche une liste de données filtrée en fonction de ces critères de filtrage. Les données incluent la date et l'heure de chaque paiement, le nom de la boutique, le type de paiement, le montant du paiement et le nom du client associé au paiement.

La page d'accueil et le formulaire sont gérés par les méthodes createForm_PointageEncaissementBoutique_Accueil_Afficher et createForm_PointageEncaissementBoutique_Accueil_Creation. La méthode createForm_PointageEncaissementBoutique_Pointage_Afficher gère l'affichage de la liste de données filtrée. Toutes les méthodes sont des actions de contrôleur dans une application Symfony et utilisent des templates Twig pour afficher le contenu HTML.

La fonctionnalité utilise également une méthode selectData_PointageEncaissementBoutique_All pour récupérer les données de la base de données de PrestaShop. Cette méthode utilise une requête SQL avec des paramètres de filtrage pour sélectionner les données appropriées de la base de données.

En résumé, cette extension ajoute une nouvelle fonctionnalité de pointage et d'encaissement de boutique dans l'interface d'administration de PrestaShop, permettant de filtrer une liste de données de paiement en fonction de la date, du nom de la boutique et du type de paiement.

---

![Capture d’écran 2022-12-30 164355](https://user-images.githubusercontent.com/46538211/210088220-fa2e8773-daf4-4b24-9efa-e08c712cd393.png)
![Capture d’écran 2022-12-30 164442](https://user-images.githubusercontent.com/46538211/210088233-3d2437da-f6ce-4dd7-a10e-1162da22c335.png)
![Capture d’écran 2022-12-30 164456](https://user-images.githubusercontent.com/46538211/210088244-c68dbc3e-4f0b-468e-8921-954c9493ba2c.png)
![Capture d’écran 2022-12-30 164720](https://user-images.githubusercontent.com/46538211/210088256-072a63e7-8bae-4377-81dc-076ee714e92f.png)

---

### Copyright©1999-2012 XXcycle Tous droits réservés.

---
