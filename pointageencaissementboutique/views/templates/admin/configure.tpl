{*
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
*}

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

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

<div class="panel">
	<div class="moduleconfig-header">
		<div>
			<h1>Pointage Encaissement Boutique</h1>
		</div>
	</div>

	<hr />

	<div class="moduleconfig-content">
		<div class="w-full mt-2">
			<p class="text-black text-[18px]"><span class="text-[15px] text-white font-bold bg-zinc-900 px-3 py-1 rounded-lg">v1.3.0</span> | 20/12/2022</p>
			<div class="mt-5">
				<p class="text-black text-[12px]">Lien vers Module : <a href="http://alicemontredon.xxcycle.fr/admin_xx/index.php/modules/pointage_encaissement">http://alicemontredon.xxcycle.fr/admin_xx/index.php/modules/pointage_encaissement</a></p>
				<p class="text-black text-[12px]">Lien vers Github : <a href="https://github.com/Ormidales/XXCYCLE-MODULE-POINTAGECAISSEBOUTIQUE">https://github.com/Ormidales/XXCYCLE-MODULE-POINTAGECAISSEBOUTIQUE</a></p>
				<p class="text-black text-[12px]">Lien vers Trello Github : <a href="https://github.com/users/Ormidales/projects/2/views/1">https://github.com/users/Ormidales/projects/2/views/1</a></p>
			</div>
			<div class="w-full border-t border-gray-200 mb-4 mt-4"></div>
			<p class="text-black text-[14px]">
			Ce code est un module PrestaShop qui fournit une interface pour le suivi des recettes en espèces d'un magasin particulier, en particulier les cartes de crédit. Le module crée un nouvel onglet dans la section d'administration du magasin PrestaShop où les utilisateurs peuvent voir et gérer les commandes et leurs informations de paiement. Le module utilise le gestionnaire de dépendances Composer pour inclure les bibliothèques requises et définir un script d'installation qui crée de nouvelles tables de base de données et enregistre un nouvel onglet dans la section d'administration du magasin.</p>
			<div class="w-full border-t border-gray-200 mb-4 mt-4"></div>
			<p class="text-black text-[14px]">Ceci est un fichier PHP pour un module PrestaShop. Il définit une classe appelée PointageEncaissementBoutique qui étend la classe Module fournie par PrestaShop. Le module ajoute une interface personnalisée dans le back-office d'un magasin PrestaShop qui permet aux commerçants de suivre les paiements, en particulier ceux effectués par carte de crédit. Le module définit plusieurs méthodes, notamment install, uninstall, getContent et postProcess. Les méthodes install et uninstall sont utilisées pour installer et désinstaller le module, respectivement. La méthode getContent est appelée lors de l'accès à la page de configuration du module et renvoie le formulaire qui permet aux utilisateurs de configurer le module. La méthode postProcess est appelée lorsque le formulaire est soumis et qu'elle enregistre les paramètres de configuration.</p>
			<div class="w-full border-t border-gray-200 mt-4"></div>
			<div class="mt-5 w-full grid grid-cols-2 gap-5">
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/207831676-69741244-a5b8-4b1f-952b-37ade2c541a6.png"><img src="https://user-images.githubusercontent.com/46538211/207831676-69741244-a5b8-4b1f-952b-37ade2c541a6.png" class="w-full"></a>
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/207828079-a3677847-2631-454d-be9c-4bb4d8afc84e.png"><img src="https://user-images.githubusercontent.com/46538211/207828079-a3677847-2631-454d-be9c-4bb4d8afc84e.png" class="w-full"></a>
			</div>
			<div class="mt-5 w-full grid grid-cols-2 gap-5">
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/207828260-d6cbac94-ed21-49d7-98a5-7f097083e5b3.png"><img src="https://user-images.githubusercontent.com/46538211/207828260-d6cbac94-ed21-49d7-98a5-7f097083e5b3.png" class="w-full"></a>
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/207828311-67dc41eb-c507-40b2-871d-b0051c9de6b9.png"><img src="https://user-images.githubusercontent.com/46538211/207828311-67dc41eb-c507-40b2-871d-b0051c9de6b9.png" class="w-full"></a>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
