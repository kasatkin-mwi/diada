<div class="lk_gray_bg">
	<div class="lk_title">Профили заказов</div>
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

if(strlen($arResult["ERROR_MESSAGE"])>0)
{
	ShowError($arResult["ERROR_MESSAGE"]);
}
if(strlen($arResult["NAV_STRING"]) > 0)
{
	?>
	<p><?=$arResult["NAV_STRING"]?></p>
	<?
}

if (count($arResult["PROFILES"]))
{
	?>
	
	<div class="sale-personal-profile-list-container_bl display_none_p display_none_m display_none_mp">
		<table class="table sale-personal-profile-list-container">
			<tr>
				<?
				$dataColumns = array(
					"ID", "DATE_UPDATE", "NAME", "PERSON_TYPE_ID"
				);
				?><?//echo '<pre data>'; print_r($dataColumns); echo '</pre>';?><?
				foreach ($dataColumns as $column)
				{
					?>
					<th>
						<?=Loc::getMessage("P_".$column)?>
						<a class="sale-personal-profile-list-arrow-up" href="<?=$arResult['URL']?>by=<?=$column?>&order=asc#nav_start">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="sale-personal-profile-list-arrow-down" href="<?=$arResult['URL']?>by=<?=$column?>&order=desc#nav_start">
							<i class="fa fa-chevron-down"></i>
						</a>
					</th>
					<?
				}
				?>
				<th><?=Loc::getMessage("SALE_ACTION")?></th>
			</tr>
			<?foreach($arResult["PROFILES"] as $val)
			{
				?>
				<tr>
					<td><?= $val["ID"] ?></td>
					<td><?= $val["DATE_UPDATE"] ?></td>
					<td><?= $val["NAME"] ?></td>
					<td><?= $val["PERSON_TYPE"]["NAME"] ?></td>
					<td class="sale-personal-profile-list-actions">
						<a class="sale-personal-profile-list-change-button" title="<?= Loc::getMessage("SALE_DETAIL_DESCR") ?>"
							href="<?= $val["URL_TO_DETAIL"] ?>"><?= GetMessage("SALE_DETAIL") ?>
						</a>
						<span class="sale-personal-profile-list-border"></span>
						<a class="sale-personal-profile-list-close-button" title="<?= Loc::getMessage("SALE_DELETE_DESCR") ?>"
							href="javascript:if(confirm('<?= Loc::getMessage("STPPL_DELETE_CONFIRM") ?>')) window.location='<?= $val["URL_TO_DETELE"] ?>'">
							<?= Loc::getMessage("SALE_DELETE") ?>
						</a>
					</td>
				</tr>
				<?
			}?>
		</table>
	</div>
		<div class="adaptiv_table sale-personal-profile-list-container display_none_c">
		
			<?foreach($arResult["PROFILES"] as $val)
			{
				?>
				
				<div class="adaptiv_personal_col">
					<div class="adaptiv_personal_el">
						<div class="adaptiv_personal_gray">
							<?=Loc::getMessage("P_ID")?>
						</div>
						<div><?= $val["ID"] ?></div>
					</div>
					<div class="adaptiv_personal_el">
						<div class="adaptiv_personal_gray">
							<?=Loc::getMessage("P_DATE_UPDATE")?>
						</div>
						<div><?= $val["DATE_UPDATE"] ?></div>
					</div>
					<div class="adaptiv_personal_el">
						<div class="adaptiv_personal_gray">
							<?=Loc::getMessage("P_NAME")?>
						</div>
						<div><?= $val["NAME"] ?></div>
					</div>
					<div class="adaptiv_personal_el">
						<div class="adaptiv_personal_gray">
							<?=Loc::getMessage("P_PERSON_TYPE_ID")?>
						</div>
						<div><?= $val["PERSON_TYPE"]["NAME"] ?></div>
					</div>
					<div class="adaptiv_personal_el">
						<div class="adaptiv_personal_gray"><?=Loc::getMessage("SALE_ACTION")?></div>
						<div class="sale-personal-profile-list-actions">
							<a class="sale-personal-profile-list-change-button" title="<?= Loc::getMessage("SALE_DETAIL_DESCR") ?>"
								href="<?= $val["URL_TO_DETAIL"] ?>"><?= GetMessage("SALE_DETAIL") ?>
							</a>
							<span class="sale-personal-profile-list-border"></span>
							<a class="sale-personal-profile-list-close-button" title="<?= Loc::getMessage("SALE_DELETE_DESCR") ?>"
								href="javascript:if(confirm('<?= Loc::getMessage("STPPL_DELETE_CONFIRM") ?>')) window.location='<?= $val["URL_TO_DETELE"] ?>'">
								<?= Loc::getMessage("SALE_DELETE") ?>
							</a>
						</div>
					</div>
				</div>
				<?
			}?>
		</div>
	<?
	if(strlen($arResult["NAV_STRING"]) > 0)
	{
		?>
		<p><?=$arResult["NAV_STRING"]?></p>
		<?
	}
}
else
{
	?>
	<h3><?=Loc::getMessage("STPPL_EMPTY_PROFILE_LIST") ?></h3>
	<?
}
?>
</div>