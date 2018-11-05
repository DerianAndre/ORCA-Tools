    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/input.js"></script>
    <? if($header['page'] == 'ods') { ?>
      <script>

      </script>
    <? } ?>
    <? if($_POST && ($header['page'] == 'index' || $header['page'] == 'xyz')) { ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/babylonjs/3.0.0-alpha/babylon.js"></script>
      <script src="assets/js/molvwr.js"></script>
      <script src="assets/js/molvwr.init.js"></script>
    <? } ?>
    <? if($_POST) { ?>
      <script src="assets/js/aos.js"></script>
      <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
      <script>
        AOS.init({
          disable: true,
          once: false,
          useClassNames: true,
          initClassName: false,
          animatedClassName: 'animated'
        });

        $('#tab-files a').on('shown.bs.tab', function (e) {
          window.dispatchEvent(new Event('resize'));
        });
      </script>
    <? } ?>
  </body>
</html>
