<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Cloudflare Checker</title>
        <style>
            body{
                margin:0px;
                font-family:Verdana;
                color:#00a1ff;
            }
            main{
                height:100VH;
                width:100VW;
                display:flex;
                align-items:center;
                justify-content:center;
                flex-direction:column;
            }
        </style>
    </head>
    <body>
        <main>
            <?php            
            if (!empty($_GET['website'])) {
                $url = filter_var($_GET['website'], FILTER_SANITIZE_URL);                
                $url = strip_tags($url);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 1);
                $response = curl_exec($ch);
                if(empty($response)){
                    echo "not a registered domain";
                }else{
                    echo "Its a real domain at least";
                }
                $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $headers = substr($response, 0, $header_size);                
                curl_close($ch);
                if (strpos($headers, 'Server: cloudflare') !== false) {
                    echo "<h2>SERVER USES CLOUDFLARE</h2>";
                } else {
                    echo "<h2>NO CLOUDFLARE FOR YOU</h2>";
                }               
            }
            ?>

            
            <h1>Will's Cloudflare Tracker</h1>
            <form>
            <input type="name" name='website' placeholder="website" <?php if(!empty($url)){ echo 'value="' . $url . '"';} ?>/>
            </form>
        </main>
    </body>
</html>
