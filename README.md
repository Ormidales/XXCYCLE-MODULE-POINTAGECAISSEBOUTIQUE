# XXCYCLE-MODULE-POINTAGECAISSEBOUTIQUE
## Version 1.2.3

Ceci est un fichier PHP pour un module PrestaShop. Il définit une classe appelée PointageEncaissementBoutique qui étend la classe Module fournie par PrestaShop. Le module ajoute une interface personnalisée dans le back-office d'un magasin PrestaShop qui permet aux commerçants de suivre les paiements, en particulier ceux effectués par carte de crédit. Le module définit plusieurs méthodes, notamment install, uninstall, getContent et postProcess. Les méthodes install et uninstall sont utilisées pour installer et désinstaller le module, respectivement. La méthode getContent est appelée lors de l'accès à la page de configuration du module et renvoie le formulaire qui permet aux utilisateurs de configurer le module. La méthode postProcess est appelée lorsque le formulaire est soumis et qu'elle enregistre les paramètres de configuration.

---

Ce code est un module PrestaShop qui fournit une interface pour le suivi des recettes en espèces d'un magasin particulier, en particulier les cartes de crédit. Le module crée un nouvel onglet dans la section d'administration du magasin PrestaShop où les utilisateurs peuvent voir et gérer les commandes et leurs informations de paiement. Le module utilise le gestionnaire de dépendances Composer pour inclure les bibliothèques requises et définir un script d'installation qui crée de nouvelles tables de base de données et enregistre un nouvel onglet dans la section d'administration du magasin.

---

## pointage.html.twig

```twig
{% extends '@PrestaShop/Admin/layout.html.twig' %}

{% block content %}

<script src="https://cdn.tailwindcss.com"></script>

<style>
table,
td {
    border: 1px solid #333;
	padding: 5px;
}

thead,
tfoot {
    background-color: #333;
    color: #fff;
	padding: 5px;
}
textarea {
  resize: vertical;
}
</style>

	<div class="w-full bg-gray-50 p-3 rounded-lg overflow-auto">
		<div class="w-full px-3 py-2 bg-gray-600 flex items-center mb-4 rounded-lg">
			<p class="text-white text-[20px]">Date</p>
			<form class="ml-3 flex inline">
				<input type="date" class="w-[40vh] h-[3vh]">
				<select class="ml-2 w-[15vh] h-[3vh]">
					<option>ESPECE</option>
					<option>CARTE BLEU</option>
					<option>CHEQUE</option>
				</select>
				<select class="ml-2 w-[15vh] h-[3vh]">
					<option>Boutique</option>
				</select>
				<input type="submit" value="Charger" class="ml-2 bg-blue-500 px-4 py-1 rounded-lg text-white">
			</form>
		</div>
		<p class="text-black text-[16px]">Liste des encaissements :</p>
		<div class="w-full flex gap-3 overflow-auto relative">
			<div class="w-3/4">
				<table class="w-full rounded-lg">
					<thead>
						<tr>
							<th class="p-1">Mode</th>
							<th class="p-1">Type</th>
							<th class="p-1 flex items-center justify-between">
								<p>Montant</p>
								<div>
									<p class="hidden">0</p>
									<input id="select-all" type="checkbox">
								</div>
							</th>
							<th class="p-1">Montant Encaissé</th>
							<th class="p-1">Facture</th>
							<th class="p-1">Date</th>
							<th class="p-1">Vendeur</th>
						</tr>
					</thead>
					<tbody>
					{% for item in data %}	
						<tr>
							<td>
								<select class="w-[12vh] h-[3vh]">
									<option>ESPECE</option>
									<option>CARTE BLEU</option>
									<option>CHEQUE</option>
								</select>
							</td>
							<td></td>
							<td>
								<div class="w-full flex inline items-center justify-between">
									<p>{{item.amount}}</p>
									<input type="checkbox">
								</div>
							</td>
							<td>
								<div class="w-full">
									<input type="text" value="{{item.amount}}" class="border border-black">
								</div>
							</td>
							<td></td>
							<td>{{item.date_add}}</td>
							<td></td>
						</tr>
					{% endfor %}
					</tbody>
				</table>
			</div>
			<div id="sidebar" class="w-1/4 sticky top-0">
				<div class="w-full border border-black rounded-lg bg-gray-100">
					<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
						<p class="text-black text-[14px]">Nombre de Tickets</p>
						<p class="text-black text-[14px] font-bold">4</p>
					</div>
					<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
						<p class="text-black text-[14px]">Total Théorique</p>
						<p id="total-theorique" class="text-black text-[14px] font-bold">0.00</p>
					</div>
					<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
						<p class="text-black text-[14px]">Total Coché</p>
						<div class="flex items-center">
							<p id="total-coche" class="text-black text-[14px] font-bold">0.00</p>
							<p class="text-black text-[14px] font-bold ml-1">€</p>
						</div>
					</div>
					<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
						<p class="text-black text-[14px]">Différence</p>
						<p class="text-black text-[14px] font-bold">598.94</p>
					</div>
					<div class="w-full px-4 py-2 pb-4">
						<p class="text-black text-[14px]">Commentaire</p>
						<textarea class="mt-2 w-full h-[20vh] border border-black"></textarea>
						<input type="submit" value="Valider" class="mt-2 bg-blue-500 px-3 py-1 rounded-lg text-white">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
</script>

<script>
  // Écoutez les changements dans les cases à cocher
  document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', updateTotal);
  });

  function updateTotal() {
    // Sélectionnez toutes les cases à cocher cochées
    const checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

    // Ajouter les valeurs correspondantes des cases à cocher cochées
    let total = 0;
    checkedCheckboxes.forEach(checkbox => {
      // Obtenez la valeur de l'élément parent de la case à cocher.
      const amount = checkbox.parentElement.querySelector('p').innerText;
      total += parseFloat(amount);
    });

    // Afficher le total
    document.querySelector('#total-coche').innerText = total;
  }

  // Écoutez les clics sur la case à cocher "select-all".
  document.querySelector('#select-all').addEventListener('click', selectAll);

  function selectAll() {
    // Sélectionnez toutes les cases à cocher.
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    // Cocher ou décocher toutes les cases à cocher en fonction de l'état de la case à cocher "Sélectionner tout".
    const isChecked = document.querySelector('#select-all').checked;
    checkboxes.forEach(checkbox => {
      checkbox.checked = isChecked;
    });
  }
</script>

{% endblock %}
```

---

## pointageencaissementboutique.php

```php
<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use PrestaShop\Module\PointageEncaissementBoutique\Controller\Admin\ListOrderController;

class PointageEncaissementBoutique extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'pointageencaissementboutique';
        $this->tab = 'administration';
        $this->version = '1.2.1';
        $this->author = 'Hugo DOUEIL';
        $this->need_instance = 1;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Pointage Encaissement Boutique');
        $this->description = $this->l('Interface de pointage des encaissements de la boutique en particulier des cartes bleues.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall my module ?');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('POINTAGEENCAISSEMENTBOUTIQUE_LIVE_MODE', false);

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() && $this->manuallyInstallTab();
    }

    private function manuallyInstallTab(): bool
    {
        $controllerClassName = ListOrderController::TAB_CLASS_NAME;
        $tabId = (int) Tab::getIdFromClassName($controllerClassName);
        if (!$tabId) {
            $tabId = null;
        }

        $tab = new Tab($tabId);
        $tab->active = 1;
        $tab->class_name = $controllerClassName;
        $tab->route_name = 'xx_pointage_encaissement';
        $tab->name = [];
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = $this->trans('Pointage Encaissement Boutique', [], 'Modules.Pointageencaissementboutique.Admin', $lang['locale']);
        }
        $tab->icon = 'build';
        $tab->id_parent = (int) Tab::getIdFromClassName('IMPROVE');
        $tab->module = $this->name;
        return true;

    }

    public function uninstall()
    {
        Configuration::deleteByName('POINTAGEENCAISSEMENTBOUTIQUE_LIVE_MODE');

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

    private function uninstallTab()
    {
        return parent::uninstall() && $this->uninstallTab();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitPointageEncaissementBoutiqueModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPointageEncaissementBoutiqueModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'POINTAGEENCAISSEMENTBOUTIQUE_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'POINTAGEENCAISSEMENTBOUTIQUE_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'POINTAGEENCAISSEMENTBOUTIQUE_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'POINTAGEENCAISSEMENTBOUTIQUE_LIVE_MODE' => Configuration::get('POINTAGEENCAISSEMENTBOUTIQUE_LIVE_MODE', true),
            'POINTAGEENCAISSEMENTBOUTIQUE_ACCOUNT_EMAIL' => Configuration::get('POINTAGEENCAISSEMENTBOUTIQUE_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'POINTAGEENCAISSEMENTBOUTIQUE_ACCOUNT_PASSWORD' => Configuration::get('POINTAGEENCAISSEMENTBOUTIQUE_ACCOUNT_PASSWORD', null),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookActionAdminControllerSetMedia()
    {
        /* Place your code here. */
    }
}
```

---

## ListOrderController.php

```php
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
```

---

![Capture d’écran 2022-12-08 162921](https://user-images.githubusercontent.com/46538211/206487462-40f7312c-8cc6-4df5-9e60-6fb079a33dbd.png)
