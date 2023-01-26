# Analyse Failles

## XSS
?url
?image
app\views\Offer\_form.php:5?
app\views\Offer\show.php:22
app\views\Offer\show.php
app\views\Offer\update.php

## CSRF

app\views\Offer\indexUser.php:16 No session verfication for deleting proposition
app\views\Offer\show.php:26 No session verfication for contact auteur backend not implement
app\views\Offer\_form.php:1 No session verfication for creating proposition
app\views\layout.php:43 action get to logout



