<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test</title>
        <script src="jquery.js"></script>
        <script>
        $(function(){
            $("#login").load("./inc/login.html");
        });
        </script>
        
    </head>
    <body>
        <?php echo '<p>test</p>'; ?>
        <div id="login"></div>
        <a href="./inc/login.html">login</a><br>
        <a href="./inc/hilfe.html">hilfe</a><br>
    </body>
</html>