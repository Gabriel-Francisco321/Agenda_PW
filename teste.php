<pre>
<?php 

include __DIR__.'\classes\Usuario.php';

$user = new Usuario();

$user->find(1);

echo $user->getNome();

?>