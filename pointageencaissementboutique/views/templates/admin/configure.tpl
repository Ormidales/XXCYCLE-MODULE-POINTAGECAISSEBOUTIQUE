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
		<div class="px-2">
			<h1>Pointage Encaissement Boutique</h1>
		</div>
	</div>

	<hr />

	<div class="moduleconfig-content">
		<div class="px-2">
			<div class="w-full px-3 py-1 bg-gray-200 flex items-center mb-5">
				<p class="text-black text-[20px]">Date</p>
				<form class="ml-3 flex inline">
					<input type="date" class="w-[40vh] h-[3vh]">
					<select class="ml-2 w-[12vh] h-[3vh]">
						<option>ESPECE</option>
						<option>CARTE BLEU</option>
						<option>CHEQUE</option>
					</select>
					<select class="ml-2 w-[12vh] h-[3vh]">
						<option>Boutique</option>
					</select>
					<input type="submit" value="Charger" class="ml-2 w-[12vh] h-[3vh] bg-blue-500 px-4 py-1 rounded-lg text-white">
				</form>
			</div>
			<p class="text-black text-[16px]">Liste des encaissements :</p>
			<div class="w-full flex gap-3">
				<div class="w-3/4 rounded-lg">
					<table class="w-full">
						<thead>
							<tr>
								<th>Mode</th>
								<th>Type</th>
								<th>Montant</th>
								<th>Montant Encaissé</th>
								<th>Facture</th>
								<th>Date</th>
								<th>Vendeur</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select class="w-[12vh] h-[3vh]">
										<option>ESPECE</option>
										<option>CARTE BLEU</option>
										<option>CHEQUE</option>
									</select>
								</td>
								<td>FACTURE</td>
								<td>
									<div class="w-full flex inline items-center justify-between">
										<p>200.00</p>
										<input type="checkbox">
									</div>
								</td>
								<td>
									<div class="w-full">
										<input type="text" value="200.00">
									</div>
								</td>
								<td>616224</td>
								<td>10/11/2022</td>
								<td>juliengabriel</td>
							</tr>
							<tr>
								<td>
									<select class="w-[12vh] h-[3vh]">
										<option>ESPECE</option>
										<option>CARTE BLEU</option>
										<option>CHEQUE</option>
									</select>
								</td>
								<td>FACTURE</td>
								<td>
									<div class="w-full flex inline items-center justify-between">
										<p>326.05</p>
										<input type="checkbox">
									</div>
								</td>
								<td>
									<div class="w-full">
										<input type="text" value="326.0">
									</div>
								</td>
								<td>616243</td>
								<td>10/11/2022</td>
								<td>christianvalentin</td>
							</tr>
							<tr>
								<td>
									<select class="w-[12vh] h-[3vh]">
										<option>ESPECE</option>
										<option>CARTE BLEU</option>
										<option>CHEQUE</option>
									</select>
								</td>
								<td>FACTURE</td>
								<td>
									<div class="w-full flex inline items-center justify-between">
										<p>27.90</p>
										<input type="checkbox">
									</div>
								</td>
								<td>
									<div class="w-full">
										<input type="text" value="27.90">
									</div>
								</td>
								<td>616267</td>
								<td>10/11/2022</td>
								<td>christianvalentin</td>
							</tr>
							<tr>
								<td>
									<select class="w-[12vh] h-[3vh]">
										<option>ESPECE</option>
										<option>CARTE BLEU</option>
										<option>CHEQUE</option>
									</select>
								</td>
								<td>FACTURE</td>
								<td>
									<div class="w-full flex inline items-center justify-between">
										<p>44.99</p>
										<input type="checkbox">
									</div>
								</td>
								<td>
									<div class="w-full">
										<input type="text" value="44.99">
									</div>
								</td>
								<td>616289</td>
								<td>10/11/2022</td>
								<td>gabrielbecker</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="w-1/4 rounded-lg">
					<div class="w-full border border-black">
						<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
							<p class="text-black text-[14px]">Nombre de Tickets</p>
							<p class="text-black text-[14px] font-bold">4</p>
						</div>
						<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
							<p class="text-black text-[14px]">Total Théorique</p>
							<p class="text-black text-[14px] font-bold">598.94</p>
						</div>
						<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
							<p class="text-black text-[14px]">Total Coché</p>
							<p class="text-black text-[14px] font-bold">0.00</p>
						</div>
						<div class="w-full flex items-center justify-between border-b border-black px-4 py-2">
							<p class="text-black text-[14px]">Différence</p>
							<p class="text-black text-[14px] font-bold">598.94</p>
						</div>
						<div class="w-full px-4 py-2 pb-4">
							<p class="text-black text-[14px]">Commentaire</p>
							<textarea class="w-full"></textarea>
							<input type="submit" value="Valider" class="mt-2 w-[12vh] h-[3vh] bg-blue-500 px-3 py-1 rounded-lg text-white">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>