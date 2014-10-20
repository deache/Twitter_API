API de Twitter para PHP
==========

Ejemplo para utilizar el API de twitter haciendo una peticion de una determinada cuenta de twitter con PHP 

==========
Antes que nada deberan de registrarse como Twitter Developers 
https://dev.twitter.com

todo esto para obtener tus llaves de acceso:
* consumerkey
* consumersecret
* accesstoken
* accesstokensecret

<h4>Usando twitteroauth PHP library</h4>

<p>Descargar la biblioteca de  @abraham recomendada por Twitter</p>
<a href="https://dev.twitter.com/overview/api/twitter-libraries">twitteroauth by @abraham</a>
<p>(ó directamente desde el <a href="https://github.com/deache/Twitter_API_Example/tree/master/example">ejemplo</a>)</p>

=========
<h3>Funcion para Conectar</h3>
<pre>
$consumerkey = "XXXXXXXXXXXXXXXXXXXXX"; //tu consumerkey
$consumersecret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; //tu consumersecretkey
$accesstoken = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; // tu access token
$accesstokensecret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; // tu access token secret


function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
  
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
</pre>


<h3>Obteniendo Tweets</h3>

<p>La funcion de conexion nos regresará un objeto en el cual podemos llamar al metodo get de la siguiente manera:</p>
* Parametro "search/tweets" para el tipo de busqueda
* Array de settings 

<pre>
$tweets = $connection->get('search/tweets', array(
		'q' => '@FIME_Oficial', // Nuestra consulta
		'lang' => 'es', 
		'count' =>100, // Número de tweets
		'include_entities' => false, // No nos interesa información adicional
		));
</pre>

<p>En este ejemplo solo devolveremos el array de objetos en formato JSON</p>
<pre>
echo json_encode($tweets);
</pre>

=========
<h3>Capturando JSON con jQuery</h3>
<p>para obtener el json solo basta con usar la funcion de jQuery getJSON y hacer un append en donde quieras mostrar la informacion</p>

<h5>Append en table</h5>
<p>De una tabla sin contenido (pero con cabeceras) </p>

```html
<table>
	<thead>
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Tweet</th>
		<th>Location</th>
	</thead>
	<tbody id='tweets'>
		
	</tbody>
</table>
```

<p>Un poco de jQuery</p>
```js 
$("document").ready(function(){
	var url = "get.php";
	$.getJSON( url, {
            accion: "select"
	})
         .done(function( data ) {
         	console.log(data);
           str = "";
           $.each(data.statuses, function(index, item){
           		str+="<tr>"
                str+= "	<td><img src='"+item.user.profile_image_url+"'></td>";
                str+= "	<td>"+item.user.screen_name+"</td>";
                str+= "	<td>"+item.text+"</td>";
                str+= "	<td>"+item.user.location+"</td>";
                str+="</tr>"
           });
           $("#tweets").append(str);
        });
});
```

<p><i>Pueden ver todo el JSON en consola ya que mande todo el data en console.log(data)</i></p>
