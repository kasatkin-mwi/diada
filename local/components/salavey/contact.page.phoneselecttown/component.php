<?
$elemIDContact = getContactsElementID(22);
$dintShow = array(24605,24606,24608,25821,24609);
?> <?if (!in_array($elemIDContact,$dintShow)):?> <?
    $showContact = false;
    if ($objElem = CIBlockElement::GetByID($elemIDContact)->GetNextElement()){
        $contact = $objElem->GetProperty(4747);
        if (preg_match("/(\(\d+\).?\d+.?\d+.\d+)[ ]{0,}(\(\S+\))/",current($contact["VALUE"]),$result)) $showContact = true;
    }?>
    <?if ($showContact):?>
        <p class="telephone_shop_contacts">
            <a href="tel:+7<?=str_replace(array(" ","(",")","-"),"",$result[1])?>">+7 <?=$result[1]?></a> <?=$result[2]?>
        </p>
    <?endif;?>
<?endif;?>