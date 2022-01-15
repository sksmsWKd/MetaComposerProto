<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>register</title>
</head>
<body>
    <div style="text-align: center">
		<form action="{{ route('register') }}"method="POST">
			@method('POST')
        <h2>register</h2>
		  <br>
			<label for="email">email</label>
		  <input type="text" id="email"name="email"> 
			<br>
		  <label for="password">password</label>
		  <input type="password" id="password"name="password"> 
			<br>
		  <label for="name">name</label>
		  <input type="text" id="name"name="name"> 
		  <br>
		   <button>submit</button>
    </div>
	
</form>
</body>
</html>