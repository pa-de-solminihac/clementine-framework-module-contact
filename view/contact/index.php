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
<div class="error"><strong>
<?php
    $err = $ns->ifGet('int', 'message');
    $message = '';
    switch ($err) {
        case 1 :
            $message = "Le message n'a pas été envoyé";
            break;
        case 2 :
            $message = "Le message a bien été envoyé";
            break;
        default :
            $message = "Le message n'a pu être envoyé";
            break;
    }
    echo $message;
?>
    <br /></strong><br />
</div>
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
