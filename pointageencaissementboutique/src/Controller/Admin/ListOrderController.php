<?php

declare(strict_types=1);

namespace PrestaShop\Module\PointageEncaissementBoutique\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use PrestaShop\PrestaShop\Adapter\Entity\Db;
use Symfony\Component\HttpFoundation\Request;

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

        // REQUETE DE TEST
        // $requete = "SELECT CONCAT(employee.firstname, ' ', employee.lastname) as nom, ps_orders.id_order
        // FROM ps_orders
        // INNER JOIN ps_order_history history ON history.id_order = ps_orders.id_order
        // INNER JOIN ps_employee employee ON employee.id_employee = history.id_employee
        // ORDER BY ps_orders.id_order ASC
        // LIMIT 10";

        // REQUETE DE TEST 2
        // $requete = "SELECT * FROM ps_employee LIMIT 10";

        $requete = "SELECT p.id_order, 
                           p.date_add, 
                           CAST(payment.amount as decimal(20,3)) as montant,
                           p.total_paid_real as montant_payment,
                           date_format(p.date_add,\"%d-%m-%Y\") as date_facturation,
                           payment_detail.type as type_order,
                           CONCAT(employee.firstname, ' ', employee.lastname, ' (', employee.email, ') ') as nom_employee
        FROM ps_orders as p
        INNER JOIN ps_order_payment payment ON payment.order_reference = p.reference
        INNER JOIN ps_order_payment_detail payment_detail ON payment_detail.id_order_payment = payment.id_order_payment
        INNER JOIN ps_order_history history ON history.id_order = p.id_order
        INNER JOIN ps_employee employee ON employee.id_employee = history.id_employee
        WHERE p.valid = 1 AND p.current_state IN (SELECT id_order_state FROM ps_order_state WHERE paid = 1 and shipped = 1)
        GROUP BY p.id_order
        ORDER BY p.date_add DESC
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

    // public function selectDateSQL()
    // {
    //     $db = Db::getInstance();

    //     $requete = "SELECT DISTINCT p.id_product_comment as comment,
    //                                 p.customer_name as name,
    //                                 p.id_product as product,
    //                                 lang.name as nameProduct,
    //                                 p.date_add as date,
    //                                 product.reference as reference,
    //                                 p.grade as note,
    //                                 p.title as titre,
    //                                 p.content as contenu,
    //                                 customer.email as mail,
    //                                 address.city as lieu,
    //                                 image_shop.id_image as image,
    //                                 p.validate as validate
    //                 FROM ps_product_comment p
    //                 LEFT JOIN ps_customer customer ON customer.id_customer = p.id_customer
    //                 LEFT JOIN ps_address address ON address.id_customer = p.id_customer
    //                 INNER JOIN ps_product_lang lang ON lang.id_product = p.id_product AND lang.id_lang = 1
    //                 INNER JOIN ps_product product ON product.id_product = p.id_product
    //                 INNER JOIN ps_image_shop image_shop ON image_shop.id_product = p.id_product AND image_shop.cover = 1 AND image_shop.id_shop = 1
    //                 WHERE p.validate=0
    //                 ORDER BY p.date_add DESC;";


    //     return $db->executeS($requete);
    // }

    // public function createFormValide(Request $request)
    // {
    //     $remplace = array();
    //     $condition = '';
    //     if (isset($_REQUEST['task'])){
    //         $condition = 'AND p.id_product_comment='.$_REQUEST['task'];           
    //     }
    //     $data = $this->selectCommentSQLWhere($condition);


    //     $formValide = $this->createFormValideComment($data);
    //     if (isset($_REQUEST['task'])){
    //         $formValide->setData(['hidden' => $_REQUEST['task']]);
    //     }
    //     $formValide->handleRequest($request);
        

    //     if ($formValide->get('valider_le_commentaire')->isSubmitted() && $formValide->get('valide_livraison')->getData() == true && $formValide->get('ajout_livraison')->getData() == true)
    //     {
    //         $grade = $formValide->get("classement_du_produit")->getData();
    //         $where = 'id_product_comment='.$formValide->get('hidden')->getData();
    //         $livraison = "'".$formValide->get('texte_commentaire')->getData()."//livraison//livraison : ".$formValide->get('texte_livraison')->getData()."'";

    //         $this->insertSqlValidateCommentContenu($grade, $where, $livraison);
    //         return $this->redirectToRoute('xx_validation_avis');

    //     }
    //     elseif ($formValide->get('valider_le_commentaire')->isSubmitted() && $formValide->get('valide_livraison')->getData() == true)
    //     {
    //         $grade = $formValide->get("classement_du_produit")->getData();
    //         $where = 'id_product_comment='.$formValide->get('hidden')->getData();
            
    //         $this->insertSqlValidateComment($grade, $where);
    //         return $this->redirectToRoute('xx_validation_avis');

    //     }
    //     elseif ($formValide->get('valider_le_commentaire')->isSubmitted() && $formValide->get('valide_livraison')->getData() != true)
    //     {
    //         $grade = $formValide->get("classement_du_produit")->getData();
    //         $where = 'id_product_comment='.$formValide->get('hidden')->getData();
    //         $contenu = "'".$formValide->get('texte_commentaire')->getData()."'";

    //         $this->insertSqlValidateCommentContenu($grade, $where, $contenu);
    //         return $this->redirectToRoute('xx_validation_avis');

    //     }

    //     if ($formValide->get('supprimer_le_commentaire')->isSubmitted()){
    //         $where = 'id_product_comment='.$formValide->get('hidden')->getData();

    //         $this->deleteSqlValidateComment($where);
    //         return $this->redirectToRoute('xx_validation_avis');
    //     }


    //     return $this->render('@Modules/validecommentaire/views/templates/admin/valide.html.twig', [
    //         'formValide' => $formValide->createView(),
    //     ]);
    // }
}
