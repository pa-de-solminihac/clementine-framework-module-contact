<?php
$err = $request->get('int', 'message');
if (!isset($data['class'])) {
    $data['class'] = 'contact';
}
$this->getModel('cssjs')->register_foot('clementine_' . $data['class'] . '-submit', $this->getBlockHtml($data['class'] . '/js_submit', $data));
$data['conf'] = '';
if (isset($data['config_module_' . $data['class']])) {
    $data['conf'] = $data['config_module_' . $data['class']];
}
// par défaut
if (!$data['conf']) {
    $data['conf'] = Clementine::$config['module_' . $data['class']];
}
if ($err) {
?>
<?php
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
    <form
        id="form_<?php echo $data['class']; ?>"
        name="form_<?php echo $data['class']; ?>"
        class="form_contact form_<?php echo $data['class']; ?> form-horizontal"
        action="<?php echo __WWW__; ?>/<?php echo $data['class']; ?>/post"
        method="post"
        accept-charset="utf-8">
<?php
    $this->getBlock($data['class'] . '/index_fields', $data, $request);
    $this->getBlock($data['class'] . '/index_captcha', $data, $request);
    $this->getBlock($data['class'] . '/index_actions', $data, $request);
?>
</form>
<?php
}
?>
