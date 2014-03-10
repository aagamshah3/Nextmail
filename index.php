<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
		ARA Mail
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.js">
        </script>
    </head>
    <body>
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header" data-position="fixed">
                <h3>
                  ARA Mail
                </h3>
            </div>
            <div data-role="content">
                <form action="verify_login.php" method="POST" data-ajax="false">
                            <input name="username" placeholder="Username" value="" type="text" />
                            <input name="password" placeholder="Password"  value="" type="password" />             
							<select name="server">
								<option value="imap.gmail.com:993/imap/ssl/novalidate-cert">Gmail</option>
								<option value="imap.mail.yahoo.com:993/imap/ssl">Yahoo</option>
							</select>	
                    <input data-theme="b" data-icon="home" data-iconpos="right" value="Login" type="submit" />
                </form>
            </div>
            <div data-theme="a" data-role="footer" data-position="fixed">
                <h3>
                   SFIT
                </h3>
            </div>
        </div>
    </body>
</html>
