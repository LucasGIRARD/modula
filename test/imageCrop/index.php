<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    </head>
    <body>
        <form action="fonction.php" enctype="multipart/form-data" method="POST" >
            <label for='photo'>photo :</label> <input type='file' id='photo' name='photo' /> <br /><br />
            <input type='hidden' name='action' value="upload" />
            <input type="submit" value="valider" />
        </form>

    </body>
</html>
