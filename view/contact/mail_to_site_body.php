<?php
$ns = $this->getModel('fonctions');
?>
Bonjour,<br />
<br />
Vous avez reçu le message suivant depuis votre site :<br />
<p>
<strong>Coordonnées de l'internaute</strong>
<?php
if ($data['conf']['champ_nom']) {
    echo "\n<br>" . 'Nom : ' . $data['donnees']['champ_nom'];
}
if ($data['conf']['champ_prenom']) {
    echo "\n<br>" . 'Prénom : ' . $data['donnees']['champ_prenom'];
}
if ($data['conf']['champ_societe']) {
    echo "\n<br>" . 'Société : ' . $data['donnees']['champ_societe'];
}
if ($data['conf']['champ_activite']) {
    echo "\n<br>" . 'Activité : ' . $data['donnees']['champ_activite'];
}
if ($data['conf']['champ_adresse']) {
    echo "\n<br>" . 'Adresse : ' . $data['donnees']['champ_adresse'];
}
if ($data['conf']['champ_cp']) {
    echo "\n<br>" . 'Code Postal : ' . $data['donnees']['champ_cp'];
}
if ($data['conf']['champ_ville']) {
    echo "\n<br>" . 'Ville : ' . $data['donnees']['champ_ville'];
}
if ($data['conf']['champ_tel']) {
    echo "\n<br>" . 'Téléphone : ' . $data['donnees']['champ_tel'];
}
if ($data['conf']['champ_mobile']) {
    echo "\n<br>" . 'Mobile : ' . $data['donnees']['champ_mobile'];
}
if ($data['conf']['champ_fax']) {
    echo "\n<br>" . 'Fax : ' . $data['donnees']['champ_fax'];
}
if ($data['conf']['champ_email']) {
    echo "\n<br>" . 'E-mail : ' . $data['donnees']['champ_email'];
}
?>
</p>
<?php
if ($data['conf']['champ_more_infos'] && $data['donnees']['champ_more_infos']) {
?>
<p>
<strong>Informations complémentaires</strong><br />
<?php
    echo $ns->strip_tags(urldecode(base64_decode($data['donnees']['champ_more_infos'])), '<a><br>');
?>
</p>
<?php
}
?>
<p>
<strong>Message de l'internaute</strong><br />
<?php
if ($data['conf']['champ_message']) {
    echo $data['donnees']['champ_message'];
}
?>
</p>
