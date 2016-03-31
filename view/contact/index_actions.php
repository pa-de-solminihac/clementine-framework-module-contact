<div class="form-group">
    <label>&nbsp;</label>
    <input
        type="submit"
        value="Envoyer"
        class="bt_envoyer_form btn btn-primary btn-block"
    />
</div>
<?php
if ($data['conf']['legende_champs_obligatoires']) {
    echo $data['conf']['legende_champs_obligatoires'];
}
?>
