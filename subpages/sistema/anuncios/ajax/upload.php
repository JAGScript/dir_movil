<?php
$jag=time();
?>
<?php
$uploaddir = '../../../anuncios/';
$uploadfile = $uploaddir.$jag;
$namedoc = basename($_FILES['uploadfile']['name']);
$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕñÑ';
$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRrnN';
$cadena = utf8_decode($namedoc);
$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
$cadena = utf8_encode($cadena);
$uploadfile2 = $jag.$cadena;
$uploadfile = $uploaddir.$uploadfile2;
//$uploadfilesolo = basename($_FILES['uploadfile']['name']);
// Lo mueve a la carpeta elegida
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
  echo $uploadfile2;
} else {
  echo "no se pudo subir";
}
?>