<html><head><style type="text/css"><!--
            body {
                font-family: Arial;
            }
--></style></head><body><?php
if (!isset($data['class'])) {
    $data['class'] = 'contact';
}
$this->getBlock($data['class'] . '/mail_to_site_body', $data);
?>
    </body>
</html>
