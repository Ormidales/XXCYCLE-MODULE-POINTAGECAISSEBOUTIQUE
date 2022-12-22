<?php

declare(strict_types=1);

namespace PrestaShop\Module\PointageEncaissementBoutique\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShop\PrestaShop\Adapter\Entity\Db;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
                           payment.payment_method as methode_paiement,
                           CAST(p.total_paid_real as decimal(20,2)) as montant_payment, /* ON RECUPERE total_paid_real DE ps_orders ET ON LE NOMME montant_payment */
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
        INNER JOIN ps_shop shop ON shop.id_shop = p.id_shop /* ON JOINT LA TABLE ps_shop QUE L'ON RENOMME shop */
        INNER JOIN ps_shop_group shop_group ON shop_group.id_shop_group = shop.id_shop_group /* ON JOINT LA TABLE ps_shop QUE L'ON RENOMME shop */
        WHERE p.id_order >0 /* FILTRES : SI p EST VALIDE ET p EST PAYÉ / EXPEDIÉ / PAS ENVOIE MAIL / PAS DE LIVRAISON / FACTURE */
        " . $condition . /* CONDITIONS QUE L'ON RAJOUTE SI ON EN A BESOIN */ " 
        GROUP BY p.date_add /* GROUPÉ PAR ps_orders.id_order */
        ORDER BY p.date_add DESC /* ORDONNÉ PAR ps_orders.date_add */
        -- LIMIT 50 /* ON LIMITE LES LIGNES DE LA TABLE A 50 */
        ";
        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
         return $db->executeS($requete); /* ON EXECUTE LA REQUETE */
    }

    /**
    * @Route("/pointage_encaissement/type/mode/date", name="pointage_encaissement_date")
    */
    public function IndexAction(Request $request)
    {
        // retrieve form values
        $date = $request->get('date');
        
        // METHODE POUR AVOIR LE NOM DE LA BOUTIQUE
        if($request->get('type') == 'BOUTIQUE')
        {
            $type = 'aliceboutique';
        }
        elseif($request->get('type') == 'INTERNET-COM')
        {
            $type = 'alicemontredon.xxcycle.com';
        }
        elseif($request->get('type') == 'INTERNET-FR')
        {
            $type = 'alicemontredon.xxcycle.fr';
        }

        // METHODE POUR AVOIR LE MODE DE PAIEMENT
        if($request->get('mode') == 'CB')
        {
            $mode = 'CB';
        }
        elseif($request->get('mode') == 'CHEQUE')
        {
            $mode = 'Cheque';
        }
        elseif($request->get('mode') == 'ESPECE')
        {
            $mode = 'Espece';
        }
        elseif($request->get('mode') == 'CREDITCLIENT')
        {
            $mode = 'CreditClient';
        }
        elseif($request->get('mode') == 'VIREMENT')
        {
            $mode = 'Virement';
        }
        elseif($request->get('mode') == 'PAYPAL')
        {
            $mode = 'Paypal';
        }
        elseif($request->get('mode') == '1EURO')
        {
            $mode = '1EURO';
        }
        elseif($request->get('mode') == 'LCR')
        {
            $mode = 'LCR';
        }
        else{
            $mode = 'CB';
        }

        // CONNECTION SQL AVEC LES CONDITIONS VOULUES
        $data = $this->connectionSQL("AND date_format(p.date_add,\"%d-%m-%Y\") = '$date' AND shop.name = '$type' AND payment.payment_method = '$mode'", $date, $type, $mode);

        // ON CREER LA VIEW
        return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage.html.twig', [
            'data' => $data,
        ]);
    }
}