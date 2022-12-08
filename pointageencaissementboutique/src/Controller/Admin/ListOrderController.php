<?php

declare(strict_types=1);

namespace PrestaShop\Module\PointageEncaissementBoutique\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use PrestaShop\PrestaShop\Adapter\Entity\Db;

class ListOrderController extends FrameworkBundleAdminController
{

    const TAB_CLASS_NAME = 'PointageEncaissementBoutiqueListOrderController';
    
    public function connectionSQL($condition)
    {
        // Connexion à la base de données
        $db = Db::getInstance();

        // Préparation de la requête
        $requete = "SELECT ps_orders.id_order, 
                           CONCAT(livraison.firstname, ' ', livraison.lastname) as nom, 
                           pays_facturation.name as pays,
                           carrier.name as livraison, 
                           CAST(ps_orders.total_paid_tax_incl as decimal(20,2)) as montant,
                           date_format(ps_orders.date_add,\"%d-%m-%Y\") as date,
                           SUM(detail.product_quantity) as quantity,
                           SUM(detail.product_quantity_in_stock) as quantity_stock,
                           CONCAT(SUM(detail.product_quantity_in_stock), '/', SUM(detail.product_quantity)) as dispo
                    FROM ps_orders
                    INNER JOIN ps_address facturation ON facturation.id_address = ps_orders.id_address_invoice
                    INNER JOIN ps_address livraison ON livraison.id_address = ps_orders.id_address_delivery
                    INNER JOIN ps_country_lang pays_facturation ON pays_facturation.id_country = facturation.id_country AND pays_facturation.id_lang = 1
                    INNER JOIN ps_country_lang pays_livraison ON pays_livraison.id_country = livraison.id_country AND pays_livraison.id_lang = 1
                    INNER JOIN ps_customer customer ON customer.id_customer = ps_orders.id_customer
                    INNER JOIN ps_carrier carrier ON carrier.id_carrier = ps_orders.id_carrier
                    INNER JOIN ps_order_detail detail ON detail.id_order = ps_orders.id_order
                    WHERE ps_orders.valid = 1
                    " . $condition . "
                    AND ps_orders.current_state IN (SELECT id_order_state FROM ps_order_state WHERE paid = 1 and shipped = 0 and deleted = 0)    
                    GROUP BY ps_orders.id_order
                    ORDER BY ps_orders.date_add DESC;"
        ;
        
        return $db->executeS($requete);
    }

    public function indexAction()
    {
        $data = $this->connectionSQL("");
        return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage.html.twig',
        [
            'data' => $data,
            'ok' => false
        ]
    );
    }
}
