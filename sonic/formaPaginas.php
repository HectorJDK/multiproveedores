<html>
<head>
</head>
<body>
	<form action="http://multiproveedorprueba.herokuapp.com/requestServices/newOnlineRequest" method="post">
		Cliente-Campo1:<input id="cl-campo1" name="cl-campo1" type="text">
		Cliente-Campo2:<input id="cl-campo2" name="cl-campo2" type="text"><br>
		Producto-Campo1:<input id="pd-campo3" name="pd-campo3" type="text">
		Producto-Campo2:<input id="pd-campo4" name="pd-campo4" type="text"><br>
		Comentario:<input id="comentario" name="comentario" type="text"><br>
		<input id="url" name="url" type="hidden" value="www.prueba.com">
		<button type="submit">Enviar</button>
	</form>
</body>
</html>