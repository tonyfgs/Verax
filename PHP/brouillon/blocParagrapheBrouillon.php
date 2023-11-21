<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="block-article paragraphe-block">
        <h2> <?php echo $contenu -> getContenu()['titre'] ?> </h2>
        <p> <?php echo $contenu -> getContenu()['contenu'] ?>  </p>
    </div>
</body>
</html>