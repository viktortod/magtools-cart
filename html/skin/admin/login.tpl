<html>
    <head>
        <title>Dashboard I Admin Panel</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="<%ADMIN_SKIN_PATH%>/css/login.css" type="text/css" media="screen" />
    </head>
    <body>
        <div class="wrapper">
            <h4>Login</h4>
            <div class="msg"><%MSG%></div>
            <form action="?action=login" method="POST">
                <label>Username:</label><br />
                <input type="text" name="username" value="<%username%>" /><br /><br />
                <label>Password:</label><br />
                <input type="password" name="password" value="" /><br /><br />
                <input type="submit" name="submit" value="Login" />
            </form>
            <br style="clear: both" />
            <div class="sidebar-footer"></div>
        </div>
        
    </body>
</html>