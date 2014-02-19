<!-- Center -->
<div id="center_column" class="center_column">
    <br />
    <div id="primary_block" class="clearfix">
        <h1>Login</h1><br />
        <%LOGIN_MSG%>
        <form action="?action=doLogin" method="POST">
            <input type="text" name="CustomerEmail" value="<%CustomerEmail%>" /><br />
            <input type="password" name="CustomerPassword" /><br />

            <input type="submit" name="Login" value="Login" />
        </form>
        
</div>
<div id="columns_bottom"></div>
</div>