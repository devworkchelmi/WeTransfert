<?php
require_once './fonctions.php';
require_once './header.php';

            <?php if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]): ?>
              <p style="color: green;">Vous êtes connecté.</p>
              <?php else: ?>
                <p style="color: red;">Vous êtes deconnecté.</p>
            <?php endif; ?>

    </section>

    
</body>

<?php   
require_once './footer.php';
?>