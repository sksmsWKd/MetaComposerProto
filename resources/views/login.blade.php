<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
    <div style="text-align: center">
		<form action="{{ route('login') }}"method="post">
			@csrf
			@method('POST')
        <h2></h2>
		  <br>
			<label for="email">email</label>
		  <input type="text" id="email"name="email"> 
			<br>
		  <label for="password">password</label>
		  <input type="password" id="password"name="password"> 
			<br>
		
		   <button>login</button>
    </div>
	
</form>
</body>
</html>