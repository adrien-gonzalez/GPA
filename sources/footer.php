<footer class="page-footer font-small pt-4">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Call to action -->
    <ul class="list-unstyled list-inline text-center py-2">
      <li class="list-inline-item">
        <h5 class="mb-1">Inscrivez-vous gratuitement</h5>
      </li>
      <li class="list-inline-item">
        <?php if(ma_courante == "index.php")
        {
        ?>
          <a href="sources/inscription.php">S'inscrire !</a>
        <?php 
        }
        else
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
