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
        $requete = "SELECT ps_order_payment.id_order_payment,
                           ps_order_payment.amount,
                           ps_order_payment.date_add,
                           orders.id_order
        FROM ps_order_payment 
        INNER JOIN ps_orders orders ON orders.reference = ps_order_payment.order_reference 
        " . $condition . "
        GROUP BY ps_order_payment.id_order_payment
        ORDER BY ps_order_payment.date_add DESC
        LIMIT 25;
        ";


        
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
