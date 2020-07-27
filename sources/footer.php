<footer class="page-footer font-small pt-4">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Call to action -->
    <ul class="list-unstyled list-inline text-center py-2">
      <li class="list-inline-item">
        <?php if(!isset($_SESSION['login']))
        {
        ?>
          <h5 class="mb-1">Inscrivez-vous gratuitement</h5>
        <?php
        }
        else
        {
        ?>
          <h5 class="mb-1">Bienvenue</h5>
        <?php
        }
        ?>
      </li>
      <li class="list-inline-item">
        <?php if(ma_courante == "index.php" && !isset($_SESSION['login']))
        {
        ?>
          <a href="sources/inscription.php">S'inscrire !</a>
        <?php 
        }
        else if(ma_courante != "index.php" && !isset($_SESSION['login']))
        {
        ?>
          <a href="inscription.php">S'inscrire !</a>
        <?php
        }
        ?>
      </li>
    </ul>
    <!-- Call to action -->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright -
    <a href="http://global-pa.fr/">Global Prestations Annexes</a>
  </div>
  <!-- Copyright -->

</footer>
