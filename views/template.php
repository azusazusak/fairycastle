<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css" type="text/css">
    <link rel="stylesheet" href="css/common.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/admin.css" type="text/css">
	<link rel="apple-touch-icon" sizes="180x180" href="imgs/logos/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="imgs/logos/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="imgs/logos/favicon-16x16.png">
	<link rel="manifest" href="imgs/logos/site.webmanifest">
    <script src="https://kit.fontawesome.com/810540c7a9.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title><?=$this->state["browserTitle"]?></title>
</head>
</head>
<body id="<?=$this->state["bodyId"]?>">
    <div class="contentWrapper" data-backgroundimage="<?=$this->state["bodyBackImage"]?>">
        <?=$this->state["content"]?>
    </div>

    <footer id="footer">
        <?=$this->state["footer"]?>
    </footer>
</body>
</html>