<?php

declare(strict_types=1);


namespace PrestaShop\Module\PointageEncaissementBoutique\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use PrestaShop\PrestaShop\Adapter\Entity\Db;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TaskController extends AbstractController
{
    const TAB_CLASS_NAME = "PointageEncaissementBoutiqueTaskController";

    public function createForm_PointageEncaissementBoutique_Pointage_Afficher(Request $request)
    {
        if (isset($_REQUEST['form_date']) && isset($_REQUEST['form_mode']) && isset($_REQUEST['form_type'])){  
            $task = null;
            $date = $_REQUEST['form_date']; 
            $type = $_REQUEST['form_type'];
            $mode = $_REQUEST['form_mode'];
            $data = $this->selectData_PointageEncaissementBoutique_All("AND date_format(p.date_add,\"%Y-%m-%d\") = '$date' AND shop.name = '$mode' AND payment.payment_method = '$type'");

            return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/pointage.html.twig', [
                'data' => $data,
                'date' => $date,
            ]);     
        }
    }

    public function createForm_PointageEncaissementBoutique_Accueil_Afficher(Request $request)
    {
        $task = null;

        $formSelect = $this->createForm_PointageEncaissementBoutique_Accueil_Creation();
        $formSelect->handleRequest($request);

        if ($formSelect->get('form_date')->getData() != null && $formSelect->get('form_mode')->getData() != null && $formSelect->get('form_type')->getData() != null && $formSelect->get('form_submit')->isSubmitted()){
            $task = $formSelect->getData();
            return $this->redirectToRoute('xx_pointage_encaissement', array('form_date' => $task['form_date'], 'form_mode' => $task['form_mode'], 'form_type' => $task['form_type']));
        }

        return $this->render('@Modules/pointageencaissementboutique/views/templates/admin/acceuil.html.twig', [
            'formSelect' => $formSelect->createView(),
        ]);
    }

    public function createForm_PointageEncaissementBoutique_Accueil_Creation()
    {
        $form = $this->createFormBuilder(null, [
            'method' => 'GET',
            'allow_extra_fields' => true,
            'attr' => [
                'class' => 'grid grid-cols-4 text-white'
            ]
            ])
            ->add('form_date', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'string'
            ])
            ->add('form_type', ChoiceType::class, [
                'choices' => [
                    'CB + PNF' => 'CB',
                    'CHEQUE' => 'Chèque',
                    'ESPECE' => 'EspÃ¨ce',
                    'CREDIT CLIENT' => 'Credit Client',
                    'VIREMENT' => 'Virement',
                    'PAYPAL' => 'Paypal',
                    '1EURO' => '1euro',
                    'LCR' => 'LCR',
                ],
                'attr' => [
                    'class' => 'h-[4vh] w-[18vh] border border-black text-black px-2'
                ],
                'label' => 'Choisir le mode de paiement voulue :'
            ])
            ->add('form_mode', ChoiceType::class, [
                'choices' => [
                    'Boutique' => 'aliceboutique',
                    'Internet (alicemontredon.xxcycle.com)' => 'alicemontredon.xxcycle.com',
                    'Internet (alicemontredon.xxcycle.fr)' => 'alicemontredon.xxcycle.fr',
                ],
                'attr' => [
                    'class' => 'h-[4vh] w-[18vh] border border-black text-black px-2'
                ],
                'label' => 'Choisir le lieu voulue :'
            ])
            ->add('form_submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]) 
            ->getForm();
        

        return $form;
    }

    public function createForm_PointageEncaissementBoutique_Pointage_Creation()
    {
        $form = $this->createFormBuilder(null, [
            'method' => 'GET',
            'allow_extra_fields' => true,
            'attr' => [
                'class' => 'grid grid-cols-4 text-white'
            ]
            ])
            ->add('form_date', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'string'
            ])
            ->add('form_type', ChoiceType::class, [
                'choices' => [
                    'CB + PNF' => 'CB',
                    'CHEQUE' => 'Chèque',
                    'ESPECE' => 'EspÃ¨ce',
                    'CREDIT CLIENT' => 'Credit Client',
                    'VIREMENT' => 'Virement',
                    'PAYPAL' => 'Paypal',
                    '1EURO' => '1euro',
                    'LCR' => 'LCR',
                ],
                'attr' => [
                    'class' => 'h-[4vh] w-[18vh] border border-black text-black px-2'
                ],
                'label' => 'Choisir le mode de paiement voulue :'
            ])
            ->add('form_mode', ChoiceType::class, [
                'choices' => [
                    'Boutique' => 'aliceboutique',
                    'Internet (alicemontredon.xxcycle.com)' => 'alicemontredon.xxcycle.com',
                    'Internet (alicemontredon.xxcycle.fr)' => 'alicemontredon.xxcycle.fr',
                ],
                'attr' => [
                    'class' => 'h-[4vh] w-[18vh] border border-black text-black px-2'
                ],
                'label' => 'Choisir le lieu voulue :'
            ])
            ->add('form_submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]) 
            ->getForm();
        

        return $form;
    }

    public function selectData_PointageEncaissementBoutique_All($condition)
    {
        $db = Db::getInstance();

        $requete = "SELECT p.id_order, /* ON RECUPERE id_order DE ps_orders */
                           p.date_add, /* ON RECUPERE date_add DE ps_orders */
                           CAST(payment.amount as decimal(20,2)) as montant, /* ON RECUPERE amount DE ps_order_payment ET ON LE NOMME montant */
                           payment.payment_method as methode_paiement,
                           CAST(p.total_paid_real as decimal(20,2)) as montant_payment, /* ON RECUPERE total_paid_real DE ps_orders ET ON LE NOMME montant_payment */
                           date_format(p.date_add,\"%d-%m-%Y\") as date_facturation, /* ON RECUPERE amount DE ps_order_payment ET ON LE NOMME montant */
                           payment_detail.type as type_order, /* ON RECUPERE type DE ps_order_payment ET ON LE NOMME type_order */
                           CONCAT(' ', employee.firstname, ' ', employee.lastname, ' ') as nom_employee, /* ON RECUPERE firstname ET lastname DE ps_employee ET ON LE NOMME nom_employee */
                           CONCAT(' ', customer.firstname, ' ', customer.lastname, ' ') as nom_customer, /* ON RECUPERE firstname ET lastname DE ps_customer ET ON LE NOMME nom_customer */
                           payment_detail.pointage as pointage
        FROM ps_orders as p /* LA TABLE SERA ps_orders QUE L'ON RENOMME p */
        INNER JOIN ps_order_payment payment ON payment.order_reference = p.reference /* ON JOINT LA TABLE ps_order_payment QUE L'ON RENOMME payment */
        INNER JOIN ps_order_payment_detail payment_detail ON payment_detail.id_order_payment = payment.id_order_payment /* ON JOINT LA TABLE ps_order_payment_detail QUE L'ON RENOMME payment_detail */
        INNER JOIN ps_order_history history ON history.id_order = p.id_order /* ON JOINT LA TABLE ps_order_history QUE L'ON RENOMME history */
        INNER JOIN ps_employee employee ON employee.id_employee = history.id_employee /* ON JOINT LA TABLE ps_employee QUE L'ON RENOMME employee */
        INNER JOIN ps_customer customer ON customer.id_customer = p.id_customer /* ON JOINT LA TABLE ps_customer QUE L'ON RENOMME customer */
        INNER JOIN ps_shop shop ON shop.id_shop = p.id_shop /* ON JOINT LA TABLE ps_shop QUE L'ON RENOMME shop */
        INNER JOIN ps_shop_group shop_group ON shop_group.id_shop_group = shop.id_shop_group /* ON JOINT LA TABLE ps_shop QUE L'ON RENOMME shop */
        WHERE p.id_order >0 /* FILTRES : SI p EST VALIDE ET p EST PAYÉ / EXPEDIÉ / PAS ENVOIE MAIL / PAS DE LIVRAISON / FACTURE */
        " . $condition . " /* CONDITIONS QUE L'ON RAJOUTE SI ON EN A BESOIN */
        GROUP BY p.date_add /* GROUPÉ PAR ps_orders.id_order */
        ORDER BY p.date_add DESC /* ORDONNÉ PAR p.date_add */
        ";

        return $db->executeS($requete);
    }
}