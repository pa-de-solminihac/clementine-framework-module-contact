<?php
if (!isset($data['class'])) {
    $data['class'] = 'contact';
}
$this->getModel('cssjs')->register_foot('clementine_contact-submit', $this->getBlockHtml($data['class'] . '/js_submit', $data));
$conf = '';
if (isset($data['config_module_contact'])) {
    $conf = $data['config_module_contact'];
}
// par défaut
if (!$conf) {
    $conf = Clementine::$config['module_' . $data['class']];
}
$ns = $this->getModel('fonctions');
if ($ns->ifSet('message', 'get')) {
?>
<?php
    $err = $ns->ifGet('int', 'message');
    $message = '';
    switch ($err) {
        case 1 :
            $message = '<h2 class="error">Erreur</h2><p class="error">Le message n\'a pas été envoyé</p>';
            break;
        case 2 :
            $message = "Le message a bien été envoyé";
            break;
        default :
            $message = '<h2>Erreur</h2><p class="error">Le message n\'a pas pu être envoyé</p>';
            break;
    }
    echo $message;
?>
    <br /><br />
<?php
} else {
?>
    <form id="form_contact" name="form_contact" class="form_contact" action="<?php echo __WWW__; ?>/<?php echo $data['class']; ?>/post" method="post" accept-charset="utf-8">
<?php
    $this->getBlock($data['class'] . '/index_fields', $data);
?>
</form>
<?php
}
?>
