<html>
<head>
<title>My App</title>
</head>
<body>

<div id="nav">
	<ul>
		<li><a href="/?page=list">List Users</a></li>
		<li><a href="/?page=add">Add Users</a></li>
	</ul>
</div>

<div id="content">
<?php
if(!empty($_GET['page'])) {
	require($_GET['page'] . '.php');
}
?>
</div>


<div>
<pre>
<?php
//DEBUG AREA

//var_dump($_SERVER);
//print_r($_SERVER);
//print_r($_GET);
print_r($_POST);
?>
</pre>
</div>
</body>
</html>
