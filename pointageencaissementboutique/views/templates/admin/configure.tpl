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
			<p class="text-black text-[18px]"><span class="text-[15px] text-white font-bold bg-zinc-900 px-3 py-1 rounded-lg">v1.4.1</span> | 30/12/2022</p>
			<div class="mt-5">
				<p class="text-black text-[12px]">Lien vers Module : <a href="http://alicemontredon.xxcycle.fr/admin_xx/index.php/modules/pointage_encaissement">http://alicemontredon.xxcycle.fr/admin_xx/index.php/modules/pointage_encaissement/liste/BOUTIQUE/ESPECES/15-10-2022</a></p>
				<p class="text-black text-[12px]">Lien vers Github : <a href="https://github.com/Ormidales/XXCYCLE-MODULE-POINTAGECAISSEBOUTIQUE">https://github.com/Ormidales/XXCYCLE-MODULE-POINTAGECAISSEBOUTIQUE</a></p>
				<p class="text-black text-[12px]">Lien vers Trello Github : <a href="https://github.com/users/Ormidales/projects/2/views/1">https://github.com/users/Ormidales/projects/2/views/1</a></p>
			</div>
			<div class="w-full border-t border-gray-200 mb-4 mt-4"></div>
			<p class="text-black text-[14px]">Ce code PHP d??finit une classe de contr??leur pour un module PrestaShop. La classe de contr??leur a une m??thode appel??e connectionSQL qui ??tablit une connexion ?? une base de donn??es en utilisant la classe Db et ex??cute une requ??te SQL complexe qui joint plusieurs tables ensemble et r??cup??re des donn??es ?? partir de celles-ci. La requ??te r??cup??re des informations sur les commandes, les paiements, les d??tails de paiement, l'historique des commandes, les employ??s et les clients ?? partir de la base de donn??es PrestaShop. La m??thode accepte ??galement un param??tre $condition, qui n'est pas utilis?? dans l'impl??mentation actuelle de la m??thode.</p>
			<div class="w-full border-t border-gray-200 mb-4 mt-4"></div>
			<p class="text-black text-[14px]">La m??thode connectionSQL est annot??e avec le d??corateur @Route, ce qui indique qu'elle peut ??tre accessible en tant que route dans la configuration de routage du module. Le chemin de la route est "/pointage_encaissement" et le nom de la route est "pointage_encaissement". La classe de contr??leur ??tend la classe FrameworkBundleAdminController, qui fournit un ensemble de base de fonctions et de services pour les contr??leurs dans l'espace d'administration de PrestaShop.</p>
			<div class="w-full border-t border-gray-200 mb-4 mt-4"></div>
			<p class="text-black text-[14px]">Il est ?? noter que la requ??te SQL utilise une syntaxe MySQL obsol??te, en particulier la fonction CONCAT et la fonction CAST avec le mot-cl?? AS. Dans les versions plus r??centes de MySQL, vous devriez utiliser la fonction CONCAT avec l'op??rateur || et la fonction CAST sans le mot-cl?? AS. Par exemple, CONCAT(ps_employee.firstname, ' ', ps_employee.lastname, ' (', ps_employee.email, ') ') devrait ??tre remplac?? par ps_employee.firstname || ' ' || ps_employee.lastname || ' (' || ps_employee.email || ') ', et CAST(payment.amount as decimal(20,2)) devrait ??tre remplac?? par CAST(payment.amount AS DECIMAL(20,2)).</p>
			<div class="w-full border-t border-gray-200 mt-4"></div>
			<div class="mt-5 w-full grid grid-cols-2 gap-5">
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/208654695-61940caa-5ceb-42b0-82d1-25e3a345d8d3.png"><img src="https://user-images.githubusercontent.com/46538211/208654695-61940caa-5ceb-42b0-82d1-25e3a345d8d3.png" class="w-full"></a>
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/208654860-2ad6545e-280d-4921-a0df-09760fa491e7.png"><img src="https://user-images.githubusercontent.com/46538211/208654860-2ad6545e-280d-4921-a0df-09760fa491e7.png" class="w-full"></a>
			</div>
			<div class="mt-5 w-full grid grid-cols-2 gap-5">
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/208654889-20375b26-2d86-4df5-8e8d-101799e5be5e.png"><img src="https://user-images.githubusercontent.com/46538211/208654889-20375b26-2d86-4df5-8e8d-101799e5be5e.png" class="w-full"></a>
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/208654927-49b5d1be-310e-4a3c-b895-85c36d54fc12.png"><img src="https://user-images.githubusercontent.com/46538211/208654927-49b5d1be-310e-4a3c-b895-85c36d54fc12.png" class="w-full"></a>
			</div>
			<div class="mt-5 w-full grid grid-cols-2 gap-5">
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/208654958-91778886-62fa-4056-b0eb-3197a36b04e1.png"><img src="https://user-images.githubusercontent.com/46538211/208654958-91778886-62fa-4056-b0eb-3197a36b04e1.png" class="w-full"></a>
				<a data-fancybox data-src="https://user-images.githubusercontent.com/46538211/208654989-3997df4f-5254-4eee-ac24-15bc85e8c952.png"><img src="https://user-images.githubusercontent.com/46538211/208654989-3997df4f-5254-4eee-ac24-15bc85e8c952.png" class="w-full"></a>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
