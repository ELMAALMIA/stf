<!DOCTYPE html>
<html>

<head>
	<title>Nous contacter</title>
</head>

<body>
	<h2>Message de Client</h2>

	<h3>
		Nom: {{ $request->name }} <br>
		E-mail: {{ $request->email }}
	</h3>

	<br>

	<h3>Message:</h3>
	<p style="font-size: 17px">
		{{ $request->message }}
	</p>
</body>

</html>