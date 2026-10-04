<?php
namespace blog\views;
?>

<?php if (!empty($errors)): ?>
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="post">
    <div>
        <label for="last_name">Nom :</label>
        <input type="text" name="last_name" id="last_name" placeholder="Dupont" required>
    </div>
    <div>
        <label for="first_name">Prénom :</label>
        <input type="text" name="first_name" id="first_name" placeholder="Jean" required>
    </div>
    <div>
        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" placeholder="mail@exemple.com" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="password_verification">Vérification de mot de passe :</label>
        <input type="password" name="password_verification" id="password_verification" required>
    </div>
    <div>
        <label for="phone_number">Téléphone :</label>
        <input type="tel" name="phone_number" id="phone_number" placeholder="0612345678" required> <!-- n pourrait ajouter un pattern -->
    </div>
    <div>
        <input type="checkbox" name="terms" id="terms" required>
        <label for="terms">J'accepte les conditions générales</label><br><br>
    </div>
    <div>
        <input type="submit" name="action" value="S'inscrire">
    </div>
</form>

<!-- en utilisant 'required', les conditions -->