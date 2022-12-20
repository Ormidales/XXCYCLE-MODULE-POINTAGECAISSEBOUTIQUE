<?php

declare(strict_types=1);

namespace PrestaShop\Module\PointageEncaissementBoutique\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShop\PrestaShop\Adapter\Entity\Db;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/pointage_encaissement", name="pointage_encaissement")
 */
class ListOrderController extends FrameworkBundleAdminController
{
    const TAB_CLASS_NAME = 'PointageEncaissementBoutiqueListOrderController';
    
    public function connectionSQL($condition)
    {
        $db = Db::getInstance(); /* ON SE CONNECTE A LA BASE DE DONNÉE */

        // --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // REQUETE POUR VOIR TOUTS LES EMPLOYES DE LA TABLE ps_employee
        // $requete = "SELECT ps_employee.id_employee, CONCAT(ps_employee.firstname, ' ', ps_employee.lastname, ' (', ps_employee.email, ') ') as nom_employee FROM ps_employee";
        // --------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        // -----------------------------------------------
        // REQUETE POUR VOIR LES STATES DES COMMANDES
        // $requete = "SELECT * FROM ps_order_state";
        // -----------------------------------------------

        // -------------------------------------------
        // REQUETE POUR VOIR LES SHOPS
        // $requete = "SELECT * FROM ps_shop";
        // -------------------------------------------

        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        $requete = "SELECT p.id_order, /* ON RECUPERE id_order DE ps_orders */
                           p.date_add, /* ON RECUPERE date_add DE ps_orders */
                           CAST(payment.amount as decimal(20,2)) as montant, /* ON RECUPERE amount DE ps_order_payment ET ON LE NOMME montant */
                           p.total_paid_real as montant_payment, /* ON RECUPERE total_paid_real DE ps_orders ET ON LE NOMME montant_payment */
                           date_format(p.date_add,\"%d-%m-%Y\") as date_facturation, /* ON RECUPERE amount DE ps_order_payment ET ON LE NOMME montant */
                           payment_detail.type as type_order, /* ON RECUPERE type DE ps_order_payment ET ON LE NOMME type_order */
                           CONCAT(' ', employee.firstname, ' ', employee.lastname, ' (', employee.email, ') ') as nom_employee, /* ON RECUPERE firstname ET lastname DE ps_employee ET ON LE NOMME nom_employee */
                           CONCAT(' ', customer.firstname, ' ', customer.lastname, ' (', customer.email, ') ') as nom_customer /* ON RECUPERE firstname ET lastname DE ps_customer ET ON LE NOMME nom_customer */
        FROM ps_orders as p /* LA TABLE SERA ps_orders QUE L'ON RENOMME p */
        INNER JOIN ps_order_payment payment ON payment.order_reference = p.reference /* ON JOINT LA TABLE ps_order_payment QUE L'ON RENOMME payment */
        INNER JOIN ps_order_payment_detail payment_detail ON payment_detail.id_order_payment = payment.id_order_payment /* ON JOINT LA TABLE ps_order_payment_detail QUE L'ON RENOMME payment_detail */
        INNER JOIN ps_order_history history ON history.id_order = p.id_order /* ON JOINT LA TABLE ps_order_history QUE L'ON RENOMME history */
        INNER JOIN ps_employee employee ON employee.id_employee = history.id_employee /* ON JOINT LA TABLE ps_employee QUE L'ON RENOMME employee */
        INNER JOIN ps_customer customer ON customer.id_customer = p.id_customer /* ON JOINT LA TABLE ps_customer QUE L'ON RENOMME customer */
        WHERE p.id_order >1 /* FILTRES : SI p EST VALIDE ET p EST PAYÉ / EXPEDIÉ / PAS ENVOIE MAIL / PAS DE LIVRAISON / FACTURE */
        " . $condition . " 
        GROUP BY p.date_add /* GROUPÉ PAR ps_orders.id_order */
        ORDER BY p.date_add DESC /* ORDONNÉ PAR ps_orders.date_add */
        -- LIMIT 50 /* ON LIMITE LES LIGNES DE LA TABLE A 50 */
        ";
        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
         return $db->executeS($requete); /* ON EXECUTE LA REQUETE */
    }

    /**
     * @Route("/pointage_encaissement", name="pointage_encaissement")
     */
    public function indexAction(Request $request) /* FONCTION POUR AFFICHER LA VUE TWIG pointage.html.twig AVEC LA TABLE FAITE AU DESSUS ET EN MEME TEMPS RECUPERER LA DATE DANS L'URL */
    {
        // Handle form submission
        if ($request->isMethod('POST')) {
            // Retrieve form data
            $date = $request->request->get('date');
            $type = $request->request->get('type');
            $mode = $request->request->get('mode');

            $date = $request->attributes->get('date'); /* ON RECUPERE LA DATE DANS L'URL */
            $data = $this->connectionSQL("AND date_format(p.date_add,\"%d-%m-%Y\") = '$date'"); /* ON RAJOUTE UN AND DANS LE WHERE DE LA REQUETE POUR JUSTE AVOIR LES DONNES DU JOUR VOULU */

            // Redirect to new route with parameters
            return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage_filtre.html.twig', /* ON REND LA VUE TWIG */ [
                'data' => $data, /* DATA (nouveau parametre) = DATA (ancien parametre) */
                'date' => $date,
                'type' => $type,
                'mode' => $mode,
            ]);
        }

        $date = $request->attributes->get('date'); /* ON RECUPERE LA DATE DANS L'URL */
        $data = $this->connectionSQL("AND date_format(p.date_add,\"%d-%m-%Y\") = '$date'"); /* ON RAJOUTE UN AND DANS LE WHERE DE LA REQUETE POUR JUSTE AVOIR LES DONNES DU JOUR VOULU */
        return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage.html.twig', /* ON REND LA VUE TWIG */
        [
            'data' => $data, /* DATA (nouveau parametre) = DATA (ancien parametre) */
        ]);
    }

    public function indexActionFiltre(Request $request) /* FONCTION POUR AFFICHER LA VUE TWIG pointage_filtre.html.twig AVEC LA TABLE FAITE AU DESSUS ET EN MEME TEMPS RECUPERER LA DATE DANS L'URL */
    {
        // Handle form submission
        if ($request->isMethod('POST')) {
            // Retrieve form data
            $date = $request->request->get('date');
            $type = $request->request->get('type');
            $mode = $request->request->get('mode');

            $data = $this->connectionSQL("AND date_format(p.date_add,\"%d-%m-%Y\") = '$date'"); /* ON RAJOUTE UN AND DANS LE WHERE DE LA REQUETE POUR JUSTE AVOIR LES DONNES DU JOUR VOULU */

            // Redirect to new route with parameters
            return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage_filtre.html.twig', /* ON REND LA VUE TWIG */ [
                'data' => $data, /* DATA (nouveau parametre) = DATA (ancien parametre) */
                'date' => $date,
                'type' => $type,
                'mode' => $mode,
            ]);
        }

        $date = $request->attributes->get('date'); /* ON RECUPERE LA DATE DANS L'URL */
        $data = $this->connectionSQL("AND date_format(p.date_add,\"%d-%m-%Y\") = '$date'"); /* ON RAJOUTE UN AND DANS LE WHERE DE LA REQUETE POUR JUSTE AVOIR LES DONNES DU JOUR VOULU */
        return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage_filtre.html.twig', /* ON REND LA VUE TWIG */
        [
            'data' => $data, /* DATA (nouveau parametre) = DATA (ancien parametre) */
        ]);
    }
}
