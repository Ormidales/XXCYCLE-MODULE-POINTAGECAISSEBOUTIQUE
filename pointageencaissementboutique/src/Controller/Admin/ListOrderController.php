<?php

declare(strict_types=1);

namespace PrestaShop\Module\PointageEncaissementBoutique\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use PrestaShop\PrestaShop\Adapter\Entity\Db;

class ListOrderController extends FrameworkBundleAdminController
{

    // /**
    //  * @Route("/pointage_encaissement/{date}", name="pointage_encaissement")
    //  */
    // public function index($date)
    // {
    //     // Connect to the database and retrieve the data using the provided MySQL query
    //     $data = "SELECT * FROM ps_order_payment";

    //     // Pass the data to the Twig template
    //     return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage.html.twig', [
    //         'date' => $date,
    //         'data' => $data,
    //     ]);
    // }

    // public function indexAction()
    // {
    //     $data = $this->index('LIMIT 10');
    //     return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage.html.twig',
    //     [
    //         'data' => $data,
    //         'ok' => false
    //     ]);
    // }

    const TAB_CLASS_NAME = 'PointageEncaissementBoutiqueListOrderController';
    
    public function connectionSQL($condition)
    {
        // Connexion à la base de données
        $db = Db::getInstance();

        // // Préparation de la requête
        // $requete = "SELECT ps_orders.id_order, 
        //                    CONCAT(livraison.firstname, ' ', livraison.lastname) as nom, 
        //                    carrier.name as livraison, 
        //                    CAST(ps_orders.total_paid_tax_incl as decimal(20,2)) as montant,
        //                    date_format(payment.date_add,\"%d-%m-%Y\") as date,
        //                    SUM(detail.product_quantity) as quantity,
        //                    SUM(detail.product_quantity_in_stock) as quantity_stock,
        //                    CONCAT(SUM(detail.product_quantity_in_stock), '/', SUM(detail.product_quantity)) as dispo,
        //                    payment.payment_method as payment_method,
        //                    payment.amount as amount,
        //                    payment.id_order_payment as id_transaction,
        //                    history.id_employee as employee
        //                    /*payment_detail.type as type_transaction*/
        //             FROM ps_orders
        //             INNER JOIN ps_address facturation ON facturation.id_address = ps_orders.id_address_invoice
        //             INNER JOIN ps_address livraison ON livraison.id_address = ps_orders.id_address_delivery
        //             INNER JOIN ps_customer customer ON customer.id_customer = ps_orders.id_customer
        //             INNER JOIN ps_carrier carrier ON carrier.id_carrier = ps_orders.id_carrier
        //             INNER JOIN ps_order_detail detail ON detail.id_order = ps_orders.id_order
        //             INNER JOIN ps_order_payment payment ON payment.order_reference = ps_orders.reference
        //             INNER JOIN ps_order_history history ON history.id_order = ps_orders.id_order
        //             /*INNER JOIN ps_order_payment_detail payment_detail ON payment_detail.code = ps_orders.payment AND payment_detail.id_order_payment = payment.id_order_payment*/
        //             WHERE ps_orders.valid = 1
        //             " . $condition . "
        //             AND ps_orders.current_state IN (SELECT id_order_state FROM ps_order_state WHERE paid = 1 and shipped = 0 and deleted = 0)    
        //             GROUP BY ps_orders.id_order
        //             ORDER BY ps_orders.date_add DESC;"
        // ;

        // $requete = "SELECT *
        // FROM ps_orders
        // INNER JOIN ps_order_payment payment ON payment.order_reference = ps_orders.reference
        // /*INNER JOIN ps_order_payment_detail payment_detail ON payment_detail.code = ps_orders.payment*/
        // ORDER BY ps_orders.id_order ASC
        // LIMIT 10";

        // REQUETE DE TEST
        $requete = "SELECT CAST(ps_orders.total_paid_real as decimal(20,2)) as montant, CAST(payment.amount as decimal(20,2)) as montant_payment
        FROM ps_orders
        INNER JOIN ps_order_payment payment ON payment.order_reference = ps_orders.reference
        -- WHERE ps_order_payment.date_add = 
        ORDER BY id_order ASC
        LIMIT 50";

        // -> Récupération du repository de l'entité "Jour"
        // $jourRepository = $this->getDoctrine()->getRepository(Jour::class);

        // -> Récupération des données pour chaque jour de la semaine
        // $lundi = $jourRepository->findOneBy(['nom' => 'lundi']);
        // $mardi = $jourRepository->findOneBy(['nom' => 'mardi']);
        // $mercredi = $jourRepository->findOneBy(['nom' => 'mercredi']);
        // $jeudi = $jourRepository->findOneBy(['nom' => 'jeudi']);
        // $vendredi = $jourRepository->findOneBy(['nom' => 'vendredi']);
        // $samedi = $jourRepository->findOneBy(['nom' => 'samedi']);
        // $dimanche = $jourRepository->findOneBy(['nom' => 'dimanche']);
        
        return $db->executeS($requete);
    }

    public function indexAction()
    {
        $data = $this->connectionSQL("");
        return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage.html.twig',
        [
            'data' => $data,
            'ok' => false
        ]);
    }
}
